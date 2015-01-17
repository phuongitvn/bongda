<?php
//error_reporting(E_ALL | E_STRICT);
ini_set('display_errors','On');
include_once dirname(__FILE__).'/../common/config/define.php';
// change the following paths if necessary
$config=dirname(__FILE__).'/protected/config/main.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createConsoleApplication($config)->run();
//Yii::createWebApplication($config)->run();
