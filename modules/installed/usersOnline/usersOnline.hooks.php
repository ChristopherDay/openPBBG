<?php

    new hook("accountMenu", function ($user) {

    	global $page, $db;

        $online = $user->db->selectAll("SELECT * FROM userTimers WHERE UT_desc = 'laston' AND UT_time > ".(time()-1800));

        $page->addTotemplate("usersOnline", count($online));

        return array(
            "url" => "?page=usersOnline", 
            "extraID" => "usersOnline", 
            "extra" => count($online),
            "text" => "Users Online"
        );
    });
