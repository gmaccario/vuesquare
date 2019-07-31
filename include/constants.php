<?php 
/* GENERAL */
define( 'FTI_VERSION', 1.0 );

/* PATHs */
define( 'FTI_PATH_VENDOR', FTI_PATH . 'vendor' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_CLASSES', FTI_PATH . 'classes' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_CONFIG', FTI_PATH . 'conf' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_TEMPLATES', FTI_PATH . 'templates' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_TEMPLATES_INCLUDE', FTI_PATH . 'templates' . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_PUBLIC', FTI_PATH . 'public' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_CSS', FTI_PATH_PUBLIC . 'css' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_JS', FTI_PATH_PUBLIC . 'js' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_IMAGES', FTI_PATH_PUBLIC . 'img' . DIRECTORY_SEPARATOR );

/* URLs */
define( 'FTI_URL',  $_SERVER['REQUEST_URI']);
define( 'FTI_URL_CONFIG', FTI_URL . 'conf' . '/' );
define( 'FTI_URL_PUBLIC', FTI_URL . 'public' . '/' );
define( 'FTI_URL_CSS', FTI_URL_PUBLIC . 'css' . '/' );
define( 'FTI_URL_JS', FTI_URL_PUBLIC . 'js' . '/' );
define( 'FTI_URL_IMAGES', FTI_URL_PUBLIC . 'img' . '/' );

/* KEYS */
$config = include(FTI_PATH_CONFIG . 'config.php');

define( 'CLIENT_ID', $config['client_id'] );
define( 'CLIENT_SECRET', $config['client_secret'] );