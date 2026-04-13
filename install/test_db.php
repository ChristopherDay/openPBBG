<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if (file_exists(__DIR__ . "/install.lock")) {
  echo json_encode(["ok" => false, "message" => "Installation is already completed."]);
  exit;
}

function respond(int $status, array $payload): void {
  http_response_code($status);
  echo json_encode($payload, JSON_UNESCAPED_SLASHES);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  respond(405, ['ok' => false, 'error' => 'Use POST']);
}

$raw = file_get_contents('php://input');
$data = json_decode($raw ?: '', true);
if (!is_array($data)) {
  respond(400, ['ok' => false, 'error' => 'Invalid JSON']);
}

$driver = (string)($data['driver'] ?? 'mysql');
$host   = (string)($data['host'] ?? '');
$port   = (string)($data['port'] ?? '');
$name   = (string)($data['name'] ?? '');
$user   = (string)($data['user'] ?? '');
$pass   = (string)($data['pass'] ?? '');

if ($driver === 'sqlite') {
  // For sqlite, "name" can be a file path.
  if ($name === '') respond(400, ['ok' => false, 'error' => 'SQLite database path is required in "name"']);
  $dsn = "sqlite:" . $name;
  $user = null;
  $pass = null;
} else {
  if ($host === '' || $name === '' || $user === '') {
    respond(400, ['ok' => false, 'error' => 'Missing host/name/user']);
  }

  if ($driver === 'mysql') {
    $port = $port !== '' ? $port : '3306';
    $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
  } elseif ($driver === 'pgsql') {
    $port = $port !== '' ? $port : '5432';
    $dsn = "pgsql:host={$host};port={$port};dbname={$name}";
  } else {
    respond(400, ['ok' => false, 'error' => 'Unsupported driver']);
  }
}

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);

  // Quick sanity query
  $pdo->query('SELECT 1');

  respond(200, ['ok' => true, 'message' => 'Connection OK']);
} catch (Throwable $e) {
  respond(200, ['ok' => false, 'error' => $e->getMessage()]);
}