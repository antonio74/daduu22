<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'gruppicontatti'],                         
                ['class' => 'yii\rest\UrlRule', 'controller' => 'gruppo'],             
                ['class' => 'yii\rest\UrlRule', 'controller' => 'categoria'],             
                ['class' => 'yii\rest\UrlRule', 'controller' => 'newrubrica'],             
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'], 
                ['class' => 'yii\rest\UrlRule', 'controller' => 'post',
                    'extraPatterns' => [
                        'GET search' => 'search',
                    ],
                ],
            ],
        ],        
    ],
    'params' => $params,
];
