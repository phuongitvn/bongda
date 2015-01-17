<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
		require_once dirname(__FILE__).'../../../../common/config/local.php',array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.components.*',
		'application.components.crawl.*',
		'application.vendors.*',
		'application.vendors.utilities.*',
	),
	/* 'behaviors' => array(
		'onBeginRequest' => array(
			'class' => 'application.components.BeginRequest'
		),
	), */
	'modules'=>array(
		/* 'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1', '*'),
		), */
	),
	'sourceLanguage' => 'en',
	'language' => 'en',	
	
	// application components
	'components'=>array(
		/* 'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		), */
		// uncomment the following to enable URLs in path-format
		
		//Forces source language never exists
		
		// uncomment the following to use a MySQL database
		/* 'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ahpproject',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123456',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		), */
		/*'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
));