<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link type="image/x-icon" rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/themes/default/images/favicon.ico" >	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/css/screen.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/css/login.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="wrr-body">
<center style="margin-bottom: 20px"><img width="150" class="logo" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_g.png" /></center>
<?php echo $content; ?>
</div>
</body>
</html>
