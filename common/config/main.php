<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '<_c:\w*>/<_a:\w+>/<id:\d+>'=>'<_c>/<_a>',
                '<_c:\w*>/<_a:\w+>'=>'<_c>/<_a>',
                '/'=>'/site/index',
                '/lenta'=>'/site/lenta',
                '/users'=>'/site/users',
                '/user'=>'/user',
                '<_c:\w*>/<_a:\w+>/<id:\d+>'=>'<_c>/<_a>',
            ],

        ]
    ],
];
