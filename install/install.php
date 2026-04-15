<?php

    header('Content-Type: application/json; charset=utf-8');

    if (file_exists(__DIR__ . "/install.lock")) {
        echo json_encode(["ok" => false, "message" => "Installation is already completed."]);
        exit;
    }

    $installData = json_decode(file_get_contents("php://input"), true);
    
    spl_autoload_register(function ($class) {
        $file = '../class/' . lcfirst($class) . '.php';
        if(file_exists($file)) {
            include $file;
        }

        $moduleClass = '../modules/installed/'.$class.'/' . lcfirst($class) . '.class.php';
        if(file_exists($moduleClass)) {
            include $moduleClass;
        }

    });

    if (!isset($installData["db"]) || !isset($installData["admin"])) {
        echo json_encode(["ok" => false, "message" => "Missing required POST data."]);
        exit;
    }

    $pdo = new PDO(
        $installData["db"]["driver"] . ":host=" . $installData["db"]["host"] . ";port=" . $installData["db"]["port"] . ";dbname=" . $installData["db"]["name"],
        $installData["db"]["user"],
        $installData["db"]["pass"],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    if (!$pdo) {
        echo json_encode(["ok" => false, "message" => "Failed to connect to the database."]);
        exit;
    }

    $stmt = $pdo->query("SHOW TABLES");

    if ($stmt->fetch()) {
        echo json_encode(["ok" => false, "message" => "Database is not empty. Please use an empty database for installation."]);
        exit;
    }

    $config = array(
        "debug" => false,
        "db" => array(
            "driver" => $installData["db"]["driver"],
            "port" => $installData["db"]["port"],
            "host" => $installData["db"]["host"],
            "database" => $installData["db"]["name"],
            "user" => $installData["db"]["user"],
            "pass" => $installData["db"]["pass"]
        )
    );

    $configContent = "<?php\n\$config = " . var_export($config, true) . ";\n";

    file_put_contents(__DIR__ . "/../config.php", $configContent);

    require_once __DIR__ . "/../config.php";
    require_once __DIR__ . "/../dbconn.php";

    $schema = file_get_contents(__DIR__ . "/schema.sql");
    $data = file_get_contents(__DIR__ . "/data.sql");

    try {
        $pdo->exec($schema);
        $pdo->exec($data);

        $u = new User();

        $makeUser = $u->makeUser(
            $installData["admin"]["username"], 
            $installData["admin"]["email"], 
            $installData["admin"]["password"]
        );

        if (!ctype_digit($makeUser)) {
            echo '<div class="alert alert-danger">'.$makeUser.'</div>';
        } else {
            $_SESSION["userID"] = $makeUser;
            $user = new User($makeUser);
            $user->set("U_userLevel", 2);
        }

        echo json_encode(["ok" => true, "message" => "Installation completed successfully."]);
        
        file_put_contents(__DIR__ . "/install.lock", "Installed on " . date("Y-m-d H:i:s"));
        
    } catch (PDOException $e) {
        echo json_encode(["ok" => false, "message" => "Database error: " . $e->getMessage()]);
    }
