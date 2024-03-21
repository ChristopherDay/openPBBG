<?php
new hook("accountMenu", function ($user) {
    if ($user) return array(
        "url" => "?page=notifications", 
        "text" => "Notifications", 
        "sort" => -5,
        "extraID" => "notificationCount", 
        "extra" => $user->getNotificationCount($user->info->U_id, 'notifications')
    );
});
// * Clear user entries hook
new Hook('deleteUserEntries', function ($userId) {
    global $db;
    $db->delete("DELETE FROM `notifications` WHERE `N_uid` = :id;", [":id" => $userId]);
});