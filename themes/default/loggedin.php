<?php


    if (!class_exists("mainTemplate")) {

        new Hook("menus", function ($menus) {
            global $page;

            $settings = $page->template->mainTemplate->settings;

            $sidebars = array(
                "left" => array(),
                "right" => array()
            );

            if (!is_array($settings["sidebarLeft"])) {
                $settings["sidebarLeft"] = explode(",", $settings["sidebarLeft"]);
            }

            if (!is_array($settings["sidebarRight"])) {
                $settings["sidebarRight"] = explode(",", $settings["sidebarRight"]);
            }

            foreach ($settings["sidebarLeft"] as $menu) {
                if (trim($menu) == "custom") {
                    foreach ($menus as $key => $m) {
                        if (is_numeric($key)) $sidebars["left"][] = $m;
                    }
                } else if (isset($menus[trim($menu)])) {
                    $sidebars["left"][] = $menus[trim($menu)];
                }
            }

            foreach ($settings["sidebarRight"] as $menu) {
                if (trim($menu) == "custom") {
                    foreach ($menus as $key => $m) {
                        if (is_numeric($key)) $sidebars["right"][] = $m;
                    }
                } else if (isset($menus[trim($menu)])) {
                    $sidebars["right"][] = $menus[trim($menu)];
                }
            }

            $page->addToTemplate("sidebarLeft", $sidebars["left"]);
            $page->addToTemplate("sidebarRight", $sidebars["right"]);
            if ($sidebars["right"] || $settings["userInfoPosition"] == "right") {
                $page->addToTemplate("showSidebarRight", true);
            }

        });

        class mainTemplate {

            public $globalTemplates = array();

            public function sidebar($pos) {

                if ($pos == "Left" && $this->settings["userInfoPosition"] == "left") {
                    $userInfo = $this->userInfo;
                } else if ($pos == "Right" && $this->settings["userInfoPosition"] == "right") {
                    $userInfo = $this->userInfo;
                } else {
                    $userInfo = "";
                }

                return '
                    {#if sidebar'.$pos.'}
                        <div class="side-bar '.strtolower($pos).'" style="min-width: {_themeSettings.sidebarWidth}; max-width: {_themeSettings.sidebarWidth}; font-size: {_themeSettings.navigationFontSize}px">
                            <div class="hidden-xs">
                                '.$userInfo.'
                            </div>

                            <div class="card card-default">
                                <div class="card-header">
                                    <i class="fa-solid fa-link"></i> Navigation
                                </div>
                                <ul class="navigation-menu">
                                    {#each sidebar'.$pos.'}
                                        <li>
                                            <a href="#">{title}</a>
                                            <ul>   
                                                {#each items}
                                                    <li>
                                                        <a href="{url}" {#if notAjax}data-not-ajax{/if}>
                                                            {text}
                                                            <small class="float-end">
                                                                {extra}
                                                                {#if timer}
                                                                    <span data-timer-type="inline" data-timer="{timer}"></span>
                                                                {/if}
                                                            </small>
                                                        </a>
                                                    </li>
                                                {/each}
                                            </ul>
                                        </li>
                                    {/each}
                                </ul>
                            </div>
                        </div>
                    {/if}
                ';
            }

            public $settings = array(
                "navigationFontSize" => "14",
                "navigationHeadingColor" => "primary",
                "navigationPadding" => 1,
                "shoutbox" => "300",
                "bootstrap" => "default",
                "layoutContainer" => "container", 
                "sidebarWidth" => "250px", 
                "userInfoPosition" => "left",
                "sidebarRight" => "",
                "sidebarLeft" => "actions, location, money, casino, kill, gang, points, account, custom"
            );

            public function __construct() {

                global $db, $page, $user;

                $settings = new Settings();

                $themeSettings = $settings->loadSetting("themeSettings", 1, "0");

                if ($themeSettings == "0") {
                    $settings->update("themeSettings", $this->settings);
                    $themeSettings = $this->settings;
                }

                foreach ($themeSettings as $key => $val) {
                    $this->settings[$key] = $val;
                }

                $mailItems = array();

                $notificationItems = $db->selectAll("SELECT N_id as 'id', N_text as 'text', N_read as 'read', N_time as 'time' FROM notifications WHERE N_uid = :user ORDER BY N_time DESC LIMIT 0, 3", array(
                    ":user" => $user->id
                ));

                $mail = $db->selectAll("SELECT * FROM mail WHERE M_uid = :user ORDER BY M_time DESC LIMIT 0, 3", array(
                    ":user" => $user->id
                ));

                foreach ($mail as $m) {
                    $u = new User($m["M_sid"]);
                    $mailItems[] = array(
                        "user" => $u->user, 
                        "subject" => $m["M_subject"],
                        "time" => $m["M_time"], 
                        "read" => $m["M_read"], 
                        "id" => $m["M_id"]
                    );
                }

                $page->addToTemplate("_themeSettings", $this->settings);
                $page->addToTemplate("mailItems", $mailItems);
                $page->addToTemplate("notificationItems", $notificationItems);

     
                $this->globalTemplates["success"] = '<div class="alert alert-success">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';
                $this->globalTemplates["error"] = '<div class="alert alert-danger">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';
                $this->globalTemplates["info"] = '<div class="alert alert-info">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';
                $this->globalTemplates["warning"] = '<div class="alert alert-warning">
                    <button type="button" class="close">
                        <span>&times;</span>
                    </button>
                    <{text}>
                </div>';

                $this->pageMain = '
<!DOCTYPE html>
    <html data-bs-theme="{_themeSettings.bootstrapTheme}">
        <head>
            
            <meta name="timestamp" content="{timestamp}">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>{game_name} - {page}</title>

            <link rel="shortcut icon" href="themes/{_theme}/images/icon.png" />
            
            <link href="themes/{_theme}/bootstrapThemes/{_themeSettings.bootstrap}/variables.css" rel="stylesheet" />
            <link href="themes/{_theme}/bootstrapThemes/{_themeSettings.bootstrap}/bootstrap.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
            <link href="themes/{_theme}/css/style.css" rel="stylesheet" />
            <link href="themes/{_theme}/css/mobile.css" rel="stylesheet" />
            {#if moduleCSSFile}
                <link href="{moduleCSSFile}" rel="stylesheet" />
            {/if}
            {#each CSSFiles}
                <link href="{.}" rel="stylesheet" />
            {/each}

            <style>
                {_themeSettings.customCSS}
            </style>
            
        </head>
        <body class="user-status-{userStatus} {_themeSettings.backgroundRepeat} {_themeSettings.backgroundSize} {_themeSettings.backgroundPosition}" style="{#if _themeSettings.backgroundColor}background-color: {_themeSettings.backgroundColor};{/if} {#if _themeSettings.backgroundURL}background-image: url(\'{_themeSettings.backgroundURL}\');{/if} ">

            <nav class="navbar navbar-expand-lg bg-primary mb-2">
                <div class="{_themeSettings.layoutContainer}">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand text-secondary" href="#">
                        {game_name}
                    </a>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>

                    <ul class="navbar-nav d-flex mb-0">
                        <li class="nav-item d-block">
                            <a class="btn btn-sm btn-secondary" href="?page=notifications">
                                <i class="fa-solid fa-bell"></i> {notificationCount}
                            </a>

                            <a class="btn btn-sm btn-secondary" href="?page=mail">
                                <i class="fa-solid fa-envelope"></i> {mail}
                            </a>
                        </li>
                    </ul>
                </div><!-- /.container-fluid -->
            </nav>

            <div class="{_themeSettings.layoutContainer}">
                <div class="game-container">
                    
                    '.$this->sidebar("Left").'

                    <div class="game-area text-center">
                        {{alerts}}
                        {{game}}
                    </div>
                
                    <div class="side-bar mobile-user-info">
                        '.$this->userInfo.'
                    </div>

                    '.$this->sidebar("Right").'

                    {#if _themeSettings.shoutbox}
                        <div class="side-bar shoutbox" style="min-width: {_themeSettings.shoutbox}px; max-width: {_themeSettings.shoutbox}px; font-size: {_themeSettings.navigationFontSize}px"">
                            <div class="card card-default">
                                <div class="card-header">
                                    <i class="fa-solid fa-comment"></i> Shoutbox
                                </div>
                                <div class="shoutbox-messages list-group list-group-flush">
                                </div>
                                <div class="card-body">    
                                    <input type="text" class="form-control shoutbox-message" placeholder="message" />
                                </div>
                        </div>
                    {/if}

                </div>

                <nav class="navbar fixed-bottom bg-primary">
                    <div class="container d-block d-sm-none text-center">
                        <div class="navbar-header">
                            <button type="button" class="btn btn-primary" data-mobile-show=".side-bar.left">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                            <button type="button" class="btn btn-primary" data-mobile-show=".side-bar.mobile-user-info">
                                <i class="fa-solid fa-user"></i>
                            </button>
                            <button type="button" class="btn btn-primary active" data-mobile-show=".game-area">
                                <i class="fa-solid fa-house"></i>
                            </button>
                            <button type="button" class="btn btn-primary" data-mobile-show=".side-bar.shoutbox">
                                <i class="fa-solid fa-comment"></i>
                            </button>
                            <button type="button" class="btn btn-primary" data-mobile-show=".side-bar.right">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </div>
                    </div>

                    <div class="container d-none d-sm-flex">
                        <div class="navbar-text text-secondary">
                            &copy; {game_name} {date "Y"}
                        </div>
                        <div class="navbar-text navbar-right">
                            <a href="https://openpbbg.com" target="_blank" class="text-muted">
                                Gangster Legends V2
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

            <script src="themes/{_theme}/js/jquery.js"></script>
            <script src="themes/{_theme}/js/bootstrap.min.js"></script>
            <script src="themes/{_theme}/js/timer.js"></script>
            <script src="themes/{_theme}/js/theme.js"></script>
            {#if _themeSettings.shoutbox}
                <script src="themes/{_theme}/js/shoutbox.js"></script>
            {/if}
            {#if moduleJSFile}
                <script src="{moduleJSFile}"></script>
            {/if}
            {#each JSFiles}
                <script src="{.}"></script>
            {/each}
        </body>
    </html>';

            }

            public $pageMain = '';

            public $userInfo = '
                            
                <div class="card card-default mb-2">
                    <div class="card-header">
                        <i class="fa-solid fa-user"></i> {>userName}
                    </div>
                    <img class="card-img-top" src="{user.profilePicture}" />
                    <div class="list-group list-group-flush">
                        <div class="list-group-item p-1">
                            <strong>Money:</strong> <small class="float-end">{money}</small>
                        </div>
                        <div class="list-group-item p-1">
                            <strong>Bullets:</strong> <small class="float-end">{bullets}</small>
                        </div>
                        <div class="list-group-item p-1">
                            <strong>Location:</strong> <small class="float-end">{location}</small>
                        </div>
                        <div class="list-group-item p-1">
                            <strong>{_setting "pointsName"}:</strong> <small class="float-end">{points}</small>
                        </div>
                        <div class="list-group-item p-1">
                            <strong>Rank:</strong> <small class="float-end">{rank} {exp_perc}%</small>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" style="width: {exp_perc}%"></div>
                            </div>
                        </div>
                        <div class="list-group-item p-1">
                            <strong>Health:</strong> <small class="float-end">{health}%</small>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: {health}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
            
        }
    }
?>
