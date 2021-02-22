<?php

namespace App\Helper;

use App\Notification;

class Helper {
    
    /**
     * @id user_id
     * table: notifications;
     */
    public function setNotifications( $id ) {

        $notifications = Notification::where('user_id', $id)->first();
        if (empty($notifications)) {
            $notifications = new Notification;
            $notifications->user_id = $id;
            $notifications->notifications = 1;
        }else {
            $notifications->notifications = $notifications->notifications + 1;
        }

        $notifications->save();
    }
}