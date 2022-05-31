<?php

use kartik\mpdf\Pdf;

return [
    'language' => 'pt-BR',
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'formatter' => [
            'class'			=> 'yii\i18n\Formatter',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'decimalSeparator'	=> ',',
            'thousandSeparator'	=> '.',
            'currencyCode'		=> 'R$',
            'locale'		=> 'pt_br',
            'defaultTimeZone'	=> 'America/Sao_Paulo',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'pdf' => [
            'class' => Pdf::classname(),
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'methods' => [
                'SetHeader'=>['Grupo Evpar'],
                'SetFooter'=>["{PAGENO}"],
            ]
        ]
    ],
];
