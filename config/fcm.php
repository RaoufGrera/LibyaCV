<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => true,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAA6Bhr9Q8:APA91bEYNLEUW5rGrnjVGFyx1T11FDHS_Wf0TX_aonU-cWGBuOvuCkm9C3Z2SrUJQioRppSDVdISj1IdgIOCK1ZtG65ZBxiONHgYzGhJ67-dX7mqlzb51P4wC6zOyzRymADmRKJ--mrE'),
        'sender_id' => env('FCM_SENDER_ID', '996842140943'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
