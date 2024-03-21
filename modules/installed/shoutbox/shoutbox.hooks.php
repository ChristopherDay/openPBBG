<?php
new hook("accountMenu", function () {
    return array(
        "url" => "?page=shoutbox", 
        "text" => "Shoutbox", 
        "sort" => 150
    );
});
// * Clear user entries hook
new Hook('deleteUserEntries', function ($userId) {
    global $db;
    $db->delete("DELETE FROM `chat` WHERE `CH_user` = :id;", [":id" => $userId]);
});