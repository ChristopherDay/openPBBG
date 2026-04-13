<?php

    $db = NEW DB($config["db"]["driver"] . ":host=" . $config["db"]["host"] . ";port=".$config["db"]["port" ].";dbname=" . $config["db"]["database"], $config["db"]["user"], $config["db"]["pass"]);
