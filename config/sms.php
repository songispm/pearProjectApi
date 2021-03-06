<?php

return [
    'debug' => false, //debug模式下不发送短信
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'submail'
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'submail' => [
            'app_id' => '40825',
            'app_key' => '51084e8353eac3fa2fbd1488e6af4ec8',
            'project' => 'Cvt044', // 默认 模板ID，可在发送时 data 中指定
        ]
    ],
];
