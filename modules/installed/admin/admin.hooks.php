<?php

    global $page;


    new hook("pagePreLoad", function ($page) {
        global $user;

        if (isset($_GET["page"]) && $_GET["page"] == "admin" && isset($_GET["module"])) {
            $page->addToTemplate("adminModule", $_GET["module"]);
        }
        
        $page->addMenu("admin", "Admin", "adminMenu", 100);

        if ($user && count($user->adminModules)) {

            new Hook("adminMenu", function () {
                return array(
                    "url" => "?page=admin", 
                    "notAjax" => true,
                    "text" => "Admin"
                );
            });

            if (isset($page->loadedModule["admin"]) && $user->hasAdminAccessTo($page->loadedModule["id"])) {
                foreach ($page->loadedModule["admin"] as $k => $v) {
                    if (isset($v["hide"])) continue; 
                    $items[] = array(
                        "url" => "?page=admin&module=" . $page->loadedModule["id"] . "&action=" . $v["method"], 
                        "notAjax" => true,
                        "text" => $v["text"]
                    );
                }

            }

            
        } 
    });