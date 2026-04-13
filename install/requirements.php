<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if (file_exists(__DIR__ . "/install.lock")) {
  echo json_encode(["ok" => false, "message" => "Installation is already completed."]);
  exit;
}

$required = [
  'pdo',
  'pdo_mysql',
  'mbstring',
  'json',
  'openssl',
  'zip',
];

$extensions = [];
foreach ($required as $ext) {
  $extensions[$ext] = extension_loaded($ext);
}

echo json_encode([
  'ok' => true,
  'php_version' => PHP_VERSION,
  'sapi' => php_sapi_name(),
  'os' => PHP_OS_FAMILY ?? PHP_OS,
  'extensions' => $extensions,
], JSON_UNESCAPED_SLASHES);