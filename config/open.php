<?php

return [
	'user' => [
		'defaultPassword' => '123456'
	],
    'token_expire_in' => 120,//分钟
    'refresh_token_expire_in' => 30,//天
    'scopes' => [
        'user-tags' => 'Get the tags of the user',//获取用户标签列表
        'screen-spotcheck' => 'Get the spotcheck data of the screen for user',//获取单个屏体点检数据
        'screen-monitor' => 'Get the monitor data of the screen for user',//获取单个屏体监控数据
    ]
];
