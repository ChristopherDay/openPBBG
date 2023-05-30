<?php
    if (!class_exists("mainTemplate")) {

    class mainTemplate {

        public $pageMain =  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <link href="themes/{_theme}/css/bootstrap.min.css" rel="stylesheet" />
                <link href="themes/{_theme}/css/admin.css" rel="stylesheet" />
                <link rel="shortcut icon" href="/themes/{_theme}/images/icon.png" />
                <link rel="stylesheet" href="themes/{_theme}/3rdparty/datatables/datatables.min.css">
                <link rel="stylesheet" href="themes/{_theme}/3rdparty/summernote/summernote.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
                {#if moduleCSSFile}
                    <link href="{moduleCSSFile}" rel="stylesheet" />
                {/if}
                {#each CSSFiles}
                    <link href="{.}" rel="stylesheet" />
                {/each}

                <title>{game_name} - {page}</title>
            </head>
            <body>

                <nav class="navbar navbar-default">
                    <div class="">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="?page=admin">{game_name} - ACP</a>
                        </div>

                        <form class="navbar-form navbar-left admin-search">
                            <div class="form-group">
                                <input type="text" placeholder="Username, Email, Setting ...">
                            </div>
                        </form>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="?"><i class="fa-solid fa-circle-chevron-left"></i> Back To The Game</a></li>
                                <li><a href="?page={adminModule}"><i class="fa-solid fa-eye"></i> View Module</a></li>
                                <li><a href="?page=logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>

                <div class="admin">
                    <div class="admin-container">
                        <div class="admin-sidenav chiller-theme">
                            <nav id="sidebar" class="sidebar-wrapper">
                                <div class="sidebar-content">
                                    
                                    <div class="sidebar-menu">
                                        <ul>

                                            {#each menus}
                                                <li class="sidebar-dropdown {#each items}{#if active}active{/if}{/each}">
                                                    <a>
                                                        <span class="menu-icon">
                                                            <i class="{icon}"></i>
                                                        </span> {title}</span>
                                                    </a>
                                                    <div class="sidebar-submenu">
                                                        <ul>
                                                            {#each items}
                                                                {#if seperator}
                                                                    <hr />
                                                                {/if}
                                                                {#unless seperator}
                                                                    {#unless hide}
                                                                        <li {#if active}class="active"{/if}>
                                                                            <i class="fa-solid fa-chevron-right"></i> <a href="{url}">{text}</a>
                                                                        </li>
                                                                    {/unless}
                                                                {/unless}
                                                            {/each}
                                                        </ul>
                                                    </div>
                                                </li>

                                            {/each}
                                        </ul>
                                    </div>
                                    <!-- sidebar-menu  -->
                                </div>
                            </nav>
                        </div>
                        <div class="admin-page">
                            <div class="admin-page-container">
                                {#if moduleActions.items}
                                    <ul class="nav nav-tabs">
                                        {#each moduleActions.items}
                                            {#unless hide}
                                                <li class="{#if active}active{/if}"><a href="{url}">{text}</a></li>
                                            {/unless}
                                            {#if hide}
                                                {#if active}
                                                    <li class="active"><a href="#">{text}</a></li>
                                                {/if}
                                            {/if}
                                        {/each}
                                    </ul>
                                {/if}
                                <div class="page">
                                    <{game}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script src="themes/{_theme}/js/jquery.js"></script>
                <script src="themes/{_theme}/3rdparty/datatables/datatables.min.js"></script>

                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.flash.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
                <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
                <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

                <script src="themes/{_theme}/js/bootstrap.min.js"></script>
                <script src="themes/{_theme}/3rdparty/summernote/summernote.js"></script>
                <script src="themes/{_theme}/3rdparty/sidebar/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
                <script src="themes/{_theme}/3rdparty/sidebar/assets/js/custom.js"></script>
                <script src="themes/{_theme}/js/admin.js"></script>
                {#if moduleJSFile}
                    <script src="{moduleJSFile}"></script>
                {/if}
                {#each JSFiles}
                    <script src="{.}"></script>
                {/each}

            </body>
            </html>
        ';
    }
}

?>
