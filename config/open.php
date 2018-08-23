<?php

return [
    'auth_code_expire_in' => 10,//分钟
    'token_expire_in' => 120,//分钟
    'refresh_token_expire_in' => 30,//天
    'scopes' => [
        'user-userInfo' => 'get user info',
        'user-test' => 'get user test',
        'screen-getScreenList' => 'get screen list'
    ]
];
