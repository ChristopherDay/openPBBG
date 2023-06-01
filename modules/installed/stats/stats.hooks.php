<?php

    new hook("accountMenu", function () {
        return array(
            "url" => "?page=stats", 
            "text" => "Game Stats", 
            "sort" => 100
        );
    });

    // Shortens a number and attaches K, M, B, etc. accordingly
    function number_shorten($number, $precision = 3, $divisors = null) {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );    
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }


        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return number_format($number / $divisor, $precision) . $shorthand;
    }

    new hook("adminWidget-html", function ($user) {
        global $page, $db;
        $stats = $db->select("
            SELECT 
                SUM(US_points) as 'points',
                SUM(US_money) + SUM(US_bank) as 'cash', 
                COUNT(U_id) as 'alive'
            FROM users INNER JOIN userStats ON (US_id = U_id) 
            WHERE U_status != 0 AND U_userLevel = 1
            ORDER BY U_id DESC LIMIT 0, 20
        ");
        $html = '<div class="card flat-card">
        <div class="row-table">
            <div class="col-sm-6 card-body br">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="material-icons-two-tone text-primary mb-1">group</i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>'.number_format($stats["alive"]).'</h5>
                        <span>Players Alive</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-none d-md-table-cell d-lg-table-cell d-xl-table-cell card-body br">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="material-icons-two-tone text-primary mb-1">language</i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>'.number_shorten($stats["cash"], 2) .'</h5>
                        <span>Money</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="material-icons-two-tone text-primary mb-1">unarchive</i>
                    </div>
                    <div class="col-sm-8 text-md-center">
                        <h5>'.number_shorten($stats["points"], 0) .'</h5>
                        <span>'. _setting("pointsName") .'</span>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        return array(
            "sort" => -1,
            "size" => 6, 
            "html" => $html,
            "type" => "html", 
            "title" => "Game Statistics"
        );
    });









    new hook("adminWidget-table", function ($user) {
        
        global $db, $page;

        $stats = $db->select("
            SELECT 
                SUM(US_points) as 'points',
                SUM(US_money) + SUM(US_bank) as 'cash', 
                COUNT(U_id) as 'alive'
            FROM users 
            INNER JOIN userStats ON (US_id = U_id) 
            WHERE U_status != 0 AND U_userLevel = 1
            ORDER BY U_id DESC LIMIT 0, 20
        ");

        $items = $db->select("SELECT IFNULL(SUM(UI_qty), 0) as 'count' FROM userInventory WHERE UI_user NOT IN (SELECT U_id FROM users WHERE U_userLevel != 1)")["count"];

        return array(
            "size" => 6, 
            "title" => "Statistics",
            "type" => "table", 
            "header" => array(
                "columns" => array(
                    array( "name" => "Stat"),
                    array( "name" => "#")
                )
            ),
            "data" => array(
                array(
                    "columns" => array(
                        array( "value" => "Items" ),
                        array( "value" => number_format($items) ),
                    )
                ), 
                array(
                    "columns" => array(
                        array( "value" => "Money" ),
                        array( "value" => number_format($stats["cash"]) ),
                    )
                ), 
                array(
                    "columns" => array(
                        array( "value" => _setting("pointsName") ),
                        array( "value" => number_format($stats["points"]) ),
                    )
                )
            )
        );

    });

    new hook("adminWidget-table", function ($user) {
        
        global $db, $page, $user;

        $users = $db->selectAll("
            SELECT
                U_id as 'id', 
                U_name as 'name', 
                FROM_UNIXTIME(UT_time) as 'date'
            FROM users
            INNER JOIN userTimers on (UT_user = U_id AND UT_desc = 'signup')
            ORDER BY UT_time DESC
            LIMIT 0, 5
        ");

        $data = array();

        foreach ($users as $u) {
            $data[] = array(
                "columns" => array(
                    array( "value" => "<a href='/page/admin/edit?module=users&id=".$u["id"]."'>".$u["name"]."</a>" ),
                    array( "value" => $u["date"] )
                )
            );
        }

        return array(
            "size" => 4,
            "sort" => 1, 
            "title" => "New Users",
            "type" => "table", 
            "header" => array(
                "columns" => array(
                    array( "name" => "Username"),
                    array( "name" => "Registered")
                )
            ),
            "data" => $data
        );

    });
