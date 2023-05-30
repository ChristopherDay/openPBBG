<?php

    new hook("accountMenu", function () {
        return array(
            "url" => "?page=shoutbox", 
            "text" => "Shoutbox", 
            "sort" => 150
        );
    });