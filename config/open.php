<?php

return [
    'token_expire_in' => 2,//分钟
    'refresh_token_expire_in' => 30,//天
    'scopes' => [
        'user-userInfo' => 'get user info',
        'screen-realTime' => 'get realtime of the screen',
        'screen-getScreenList' => 'get screen list'
    ]
];
