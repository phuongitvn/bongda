<?php 
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
?>
<div data-role="panel" data-position-fixed="true" data-display="push" data-theme="g" id="nav-panel">

		<ul data-role="listview">
            <li data-icon="delete"><a href="#" data-rel="close">Chủ Đề Bóng Đá</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'bong-da-anh'))?>">Bóng đá Anh</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'bong-da-tay-ban-nha'))?>">Bóng đá Tây Ban Nha</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'bong-da-duc'))?>">Bóng đá Đức</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'bong-da-viet-nam'))?>">Bóng đá Việt Nam</a></li>
	</ul>

</div><!-- /panel -->