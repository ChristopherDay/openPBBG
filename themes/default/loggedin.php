<?php


    if (!class_exists("mainTemplate")) {

        new Hook("menus", function ($menus) {
            global $page;

            $settings = $page->template->mainTemplate->settings;

            $sidebars = array(
                "left" => array(),
                "right" => array()
            );

            foreach (explode(",", $settings["sidebarLeft"]) as $menu) {
                if (trim($menu) == "custom") {
                    foreach ($menus as $key => $m) {
                        if (is_numeric($key)) $sidebars["left"][] = $m;
                    }
                } else if (isset($menus[trim($menu)])) {
                    $sidebars["left"][] = $menus[trim($menu)];
                }
            }

            foreach (explode(",", $settings["sidebarRight"]) as $menu) {
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

        });

        class mainTemplate {

            public $globalTemplates = array();

            public $settings = array(
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

                if ($this->settings["userInfoPosition"] == "left") {
                    $userInfoLeft = $this->userInfo;
                    $userInfoRight = "";
                } else {
                    $userInfoLeft = "";
                    $userInfoRight = $this->userInfo;
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
    <html>
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

            <nav class="navbar navbar-default">
                <div class="{_themeSettings.layoutContainer}">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">{game_name}</a>
                    </div>

                        <ul class="nav navbar-nav navbar-right hidden-xs">
                            <li>
                                <a href="#" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" title="Notifications" data-content=\'
                                    <div class="list-group">
                                        {#each notificationItems}
                                            <div class="list-group-item">
                                                {#unless read}<small><i class="fa-solid fa-star text-success"></i></small>{/unless}
                                                {{text}}<br />
                                                <small>
                                                    <a href="?page=notifications&action=delete&id={id}">
                                                        <i class="fa-solid fa-trash-can"></i> Delete
                                                    </a>
                                                </small>
                                                <small class="pull-right">{_ago time} ago</small>
                                            </div>
                                        {else}
                                            <div class="list-group-item">
                                                <em>You dont have any notifications</em>
                                            </div>
                                        {/each}
                                        <div class="list-group-item">
                                            <a class="btn btn-sm btn-block btn-default" href="?page=notifications">
                                                <i class="fa-solid fa-bell"></i> All Notifications
                                            </a>
                                        </div>
                                    </div>
                                \'>
                                    <span class="badge"> 
                                        <i class="fa-solid fa-bell"></i> {notificationCount}
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" title="Mail Inbox" data-content=\'
                                    <div class="list-group">
                                        {#each mailItems}
                                            <div class="list-group-item">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object img-thumbnail" src="{user.profilePicture}" height="42px" width="42px" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">
                                                            <a href="?page=mail&action=read&id={id}">
                                                                {subject}
                                                            </a>
                                                            {#unless read}<small class="pull-right"><i class="fa-solid fa-star text-success"></i></small>{/unless}
                                                        </h5>
                                                        <small>{>userName}</small><br />
                                                    </div>
                                                </div>
                                                <small>
                                                    <a href="?page=mail&action=delete&id={id}">
                                                        <i class="fa-solid fa-trash-can"></i> Delete
                                                    </a>
                                                </small>
                                                <small class="pull-right">{_ago time} ago</small>
                                            </div>
                                        {else}
                                            <div class="list-group-item">
                                                <em>You dont have any mail</em>
                                            </div>
                                        {/each}
                                        <div class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a class="btn btn-sm btn-block btn-default" href="?page=mail">
                                                        <i class="fa-solid fa-inbox"></i> Inbox
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a class="btn btn-sm btn-block btn-default" href="?page=mail&action=new">
                                                        <i class="fa-solid fa-file-pen"></i> New
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                \'>
                                    <span class="badge"> 
                                        <i class="fa-solid fa-envelope"></i> {mail}
                                    </span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-circle-user"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="?page=profile&action=password">
                                            <i class="fa-solid fa-key"></i> Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="?page=profile&action=edit">
                                            <i class="fa-solid fa-user-pen"></i> Edit Profile
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="?page=logout">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <div class="{_themeSettings.layoutContainer}">
                <div class="game-container">
                    {#if sidebarLeft}
                        <div class="side-bar left" style="min-width: {_themeSettings.sidebarWidth}; max-width: {_themeSettings.sidebarWidth}">
                            <div class="hidden-xs">
                                '.$userInfoLeft.'
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa-solid fa-link"></i> Navigation
                                </div>
                                <ul class="navigation-menu">
                                    {#each sidebarLeft}
                                        <li>
                                            <a href="#">{title}</a>
                                            <ul>   
                                                {#each items}
                                                    <li>
                                                        <a href="{url}" {#if notAjax}data-not-ajax{/if}>
                                                            {text}
                                                            <small class="pull-right">
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

                    <div class="game-area text-center">
                        {{alerts}}
                        {{game}}
                    </div>
                
                    <div class="side-bar mobile-user-info">
                        '.$this->userInfo.'
                    </div>


                    {#if sidebarRight}
                        <div class="side-bar right" style="min-width: {_themeSettings.sidebarWidth}; max-width: {_themeSettings.sidebarWidth}">
                            <div class="hidden-xs">
                                '.$userInfoRight.'
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa-solid fa-link"></i> Navigation
                                </div>
                                <ul class="navigation-menu">
                                    {#each sidebarRight}
                                        <li>
                                            <a href="#">{title}</a>
                                            <ul>   
                                                {#each items}
                                                    <li>
                                                        <a href="{url}" {#if notAjax}data-not-ajax{/if}>
                                                            {text}
                                                            <small class="pull-right">
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
                    {#if _themeSettings.shoutbox}
                        <div class="side-bar shoutbox" style="min-width: {_themeSettings.shoutbox}px; max-width: {_themeSettings.shoutbox}px">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa-solid fa-comment"></i> Shoutbox
                                </div>
                                <div class="shoutbox-messages list-group">
                                </div>
                                <div class="panel-body">    
                                    <input type="text" class="form-control shoutbox-message" placeholder="message" />
                                </div>
                        </div>
                    {/if}

                </div>

                <nav class="navbar navbar-default navbar-fixed-bottom">
                    <div class="container visible-xs">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-mobile-show=".side-bar.left">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                            <button type="button" class="navbar-toggle" data-mobile-show=".side-bar.mobile-user-info">
                                <i class="fa-solid fa-user"></i>
                            </button>
                            <button type="button" class="navbar-toggle active" data-mobile-show=".game-area">
                                <i class="fa-solid fa-house"></i>
                            </button>
                            <button type="button" class="navbar-toggle" data-mobile-show=".side-bar.shoutbox">
                                <i class="fa-solid fa-comment"></i>
                            </button>
                            <button type="button" class="navbar-toggle" data-mobile-show=".side-bar.right">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </div>
                    </div>

                    <div class="container hidden-xs">
                        <p class="navbar-text">&copy; {game_name} {date "Y"}</p>
                        <p class="navbar-text navbar-right"><a href="https://glscript.net" target="_blank" class="text-muted">Gangster Legends V2</a></small></p>
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
                            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa-solid fa-user"></i> Character
                    </div>
                    <div class="panel-body character-information">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-thumbnail" src="{user.profilePicture}" height="42px" width="42px" />
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    {>userName}
                                </h5>
                                <small>{_setting "gangName"}: {gang.name}</small>
                            </div>
                        </div>
                        <hr />
                        <p>
                            <strong>Money:</strong> <small class="pull-right">{money}</small>
                        </p>
                        <p>
                            <strong>Bullets:</strong> <small class="pull-right">{bullets}</small>
                        </p>
                        <p>
                            <strong>Location:</strong> <small class="pull-right">{location}</small>
                        </p>
                        <p>
                            <strong>{_setting "pointsName"}:</strong> <small class="pull-right">{points}</small>
                        </p>
                        <strong>Rank:</strong> <small class="pull-right">{rank} {exp_perc}%</small>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" style="width: {exp_perc}%"></div>
                        </div>
                        <strong>Health:</strong> <small class="pull-right">{health}%</small>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: {health}%"></div>
                        </div>

                    </div>
                </div>
            ';
            
        }
    }
?>
