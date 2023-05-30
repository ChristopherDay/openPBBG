<?php


    if (!class_exists("mainTemplate")) {
        class mainTemplate {

            public $globalTemplates = array();

            public $settings = array(
                "logoURL" => "themes/default/images/logo.png",
                "menuPosition" => "top",
                "bootstrap" => "default",
                "layoutContainer" => "container", 
                "sidebarWidth" => "250px", 
                "sidebarLocation" => "250px"
            );

            public function __construct() {

                global $db, $page, $user;

                $settings = new Settings();

                $themeSettings = $settings->loadSetting("loginSettings", 1, "0");

                if ($themeSettings == "0") {
                    $settings->update("loginSettings", $this->settings);
                    $themeSettings = $this->settings;
                }

                foreach ($themeSettings as $key => $val) {
                    $this->settings[$key] = $val;
                }

                $this->settings["menuTop"] = $this->settings["menuPosition"] == "top";
                $this->settings["menuLeft"] = $this->settings["menuPosition"] == "left";
                $this->settings["menuRight"] = $this->settings["menuPosition"] == "right";

                $page->addToTemplate("_themeSettings", $this->settings);

                $round = new Round();

                $usersOnline = $db->select("
                    SELECT COUNT(*) as 'count' FROM userTimers WHERE UT_desc = 'laston' AND UT_time > ".(time()-900)."
                ");
                $users = $db->select("
                    SELECT COUNT(*) as 'count' FROM users WHERE U_round = :round
                ", array(
                    ":round" => $round->id
                ));

                $page->addToTemplate("usersOnlineNow", number_format($usersOnline["count"]));
                $page->addToTemplate("registeredUsers", number_format($users["count"]));

            }

            public $pageMain = '
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
            
        </head>
        <body class="{_themeSettings.backgroundRepeat} {_themeSettings.backgroundSize} {_themeSettings.backgroundPosition}" style="{#if _themeSettings.backgroundColor}background-color: {_themeSettings.backgroundColor};{/if} {#if _themeSettings.backgroundURL}background-image: url(\'{_themeSettings.backgroundURL}\');{/if} ">


            {#if _themeSettings.menuTop}
                <nav class="navbar navbar-default">
                    <div class="{_themeSettings.layoutContainer}">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">{game_name}</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav navbar-right">
                                {#each menus.login.items}
                                    <li>
                                        <a href="{url}" {#if notAjax}data-not-ajax{/if}>
                                            {text}
                                        </a>
                                    </li>
                                {/each}
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            {else}
                <nav class="navbar navbar-default visible-xs">
                    <div class="{_themeSettings.layoutContainer}">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">{game_name}</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav navbar-right">
                                {#each menus.login.items}
                                    <li>
                                        <a href="{url}" {#if notAjax}data-not-ajax{/if}>
                                            {text}
                                        </a>
                                    </li>
                                {/each}
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            {/if}

            <p class="text-center">
                <img src="{_themeSettings.logoURL}" />
            </p>

            <div class="{_themeSettings.layoutContainer}">
                <div class="game-container">
                    {#if _themeSettings.menuLeft}
                        <div class="side-bar" style="min-width: {_themeSettings.sidebarWidth}; max-width: {_themeSettings.sidebarWidth}">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa-solid fa-link"></i> Navigation
                                </div>
                                <ul class="navigation-menu">
                                    <li>
                                        <ul>   
                                            {#each menus.login.items}
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
                                </ul>
                            </div>
                        </div>
                    {/if}

                    <div class="game-area text-center">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {page}
                            </div>
                            <div class="panel-body">
                                {{alerts}}
                                {{game}}
                            </div>
                        </div>
                    </div>

                    {#if _themeSettings.menuRight}
                        <div class="side-bar" style="min-width: {_themeSettings.sidebarWidth}; max-width: {_themeSettings.sidebarWidth}">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa-solid fa-link"></i> Navigation
                                </div>
                                <ul class="navigation-menu">
                                    <li>
                                        <ul>   
                                            {#each menus.login.items}
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
                                </ul>
                            </div>
                        </div>
                    {/if}
                </div>
            </div>

            <nav class="navbar navbar-default navbar-fixed-bottom">
                <div class="container">
                    <p class="navbar-text">&copy; {game_name} {date "Y"}</p>
                    <p class="navbar-text navbar-right hidden-xs"><a href="https://glscript.net" target="_blank" class="text-muted">Gangster Legends V2</a></small></p>
                </div>
            </nav>

            <script src="themes/{_theme}/js/jquery.js"></script>
            <script src="themes/{_theme}/js/bootstrap.min.js"></script>
            <script src="themes/{_theme}/js/timer.js"></script>
            <script src="themes/{_theme}/js/theme.js"></script>
            {#if moduleJSFile}
                <script src="{moduleJSFile}"></script>
            {/if}
            {#each JSFiles}
                <script src="{.}"></script>
            {/each}
        </body>
    </html>';
            
        }
    }
?>
