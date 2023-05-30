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

    if (file_exists("install/index.php")) {
        header("Location: install/");
        exit;
    }

    include 'dbconn.php';

    $settings = new settings();

    $page = new Page();
    $page->loadModuleMetaData();

    if (!isset($_GET['page'])) {
        $_GET['page'] = $page->landingPage;
    }

    $pageToLoad = $_GET['page'];

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

        debug($moduleInfo);
        exit;

        $user = false;

        if ($user) {
            
            if ($_GET["page"] == "logout") {
                $page->loadPage('logout');
            } else if ($user->info->U_status == 2 && $jailPageCheck["requireLogin"]) {
                $page->loadPage('users');

            } else {
                $page->loadPage($pageToLoad);
            }
                
        } else if (!$jailPageCheck["requireLogin"]) {
            $page->loadPage($_GET['page']);
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