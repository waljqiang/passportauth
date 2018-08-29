<?php

return [
	'user' => [
		'defaultPassword' => '123456'
	],
    'token_expire_in' => 120,//分钟
    'refresh_token_expire_in' => 30,//天
    'scopes' => [
        'user-userInfo' => 'get user info',
        'screen-realTime' => 'get realtime of the screen',
        'screen-getScreenList' => 'get screen list'
    ]
];
