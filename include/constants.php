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

/* KEYS */
$config = include(FTI_PATH_CONFIG . 'config.php');

define( 'CLIENT_ID', $config['client_id'] );
define( 'CLIENT_SECRET', $config['client_secret'] );