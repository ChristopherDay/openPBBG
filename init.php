<?php
    
    spl_autoload_register(function ($class) {
        $file = 'class/' . lcfirst($class) . '.php';
        if(file_exists($file)) {
            include $file;
        }

        $moduleClass = 'modules/installed/'.$class.'/' . lcfirst($class) . '.class.php';
        if(file_exists($moduleClass)) {
            include $moduleClass;
        }

    });

    new ErrorHandler();

    $start = microtime();

    session_start();

    if (file_exists("install/index.php") && !file_exists("install/install.lock")) {
        header("Location: install/");
        exit;
    }

    include 'dbconn.php';

    if (!isset($_SESSION['userID']) && isset($_COOKIE["authToken"])) {
        $token = $_COOKIE["authToken"];
        $checkToken = $db->select("SELECT * FROM loginCookies WHERE LC_token = :token", array(
            "token" => $token
        ));
        if ($checkToken) {
            if ($checkToken["LC_userAgent"] == $_SERVER['HTTP_USER_AGENT']) {
                if ($checkToken["LC_expiry"] > time()) {
                    $_SESSION['userID'] = $checkToken["LC_user"];
                } else {
                    $db->query("DELETE FROM loginCookies WHERE LC_id = :id", array(
                        "id" => $checkToken["LC_id"]
                    ));
                }
            }
        }
    } 

    $settings = new settings();

    $page = new Page();
    $page->loadModuleMetaData();

    if (!isset($_GET['page'])) {
        $_GET['page'] = $page->landingPage;
    }

    $pageToLoad = $_GET['page'];


    $user = false;
    if (!empty($_SESSION['userID'])) {
        $user = new user($_SESSION['userID']);
        
        if (isset($user->info->U_id)) {
            $user->updateTimer('laston', time());
            $user->checkRank();
        } else {
            $user = false;
            unset($_SESSION["userID"]);
        }

    }

    if (!isset($page->modules[$pageToLoad])) {
        $page->loadPage("pageNotFound");
    } else {

        $moduleInfo = $page->modules[$pageToLoad];

        /* If the user is logged in load the page */
        if ($user) {
            /* Always let the user logout no matter what */
            if ($_GET["page"] == "logout") {
                $page->loadPage('logout');
            } else {
                /* Let a hook override what page to load */
                $hook = new Hook("moduleLoad");
                $pageToLoad = $hook->run($pageToLoad, true);

                $page->loadPage($pageToLoad);
            }
        
        /* If they are not logged in check if they can access the page when not logged in */
        } else if (!$moduleInfo["requireLogin"]) {
            $page->loadPage($_GET['page']);

        /* show the login page */
        } else {
            $loginPage = "login";
            $hook = new Hook("loginPage");
            $loginPage = $hook->run($loginPage, true);
            $page->loadPage($loginPage);
        }
    
    }

    $page->printPage();

    $page->success = true;
    
?>