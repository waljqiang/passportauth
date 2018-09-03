<?php

return [
	'user' => [
		'defaultPassword' => '123456'
	],
    'token_expire_in' => 120,//分钟
    'refresh_token_expire_in' => 30,//天
    'scopes' => [
        'user-tags' => 'Get the tags of the user',//获取用户标签列表
        'screen-lists' => 'Get the screens of the user',//获取用户显示屏列表
        'screen-spotcheck' => 'Get the spotcheck data of the screen for user',//获取单个屏体点检数据
        'screen-monitor' => 'Get the monitor data of the screen for user',//获取单个屏体监控数据
        'screen-image' => 'Get a monitor image of the screen for user',//获取屏体的一张监控图片(原始图)
        'screen-thumbnail' => 'Get a monitor thumbnail of the screen for user',//获取屏体最新一张监控图片(缩略图)
        'screen-images' => 'Get a monitor image of the screen that have more cameras',//获取多摄像机屏体的最新一张监控图片(原始图)
    ]
];
