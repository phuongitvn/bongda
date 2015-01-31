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
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'bong-da-y'))?>">Bóng đá Ý</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'bong-da-viet-nam'))?>">Bóng đá Việt Nam</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'hau-truong-san-co'))?>">Hậu trường sân cỏ</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'vo-ban-gai-cau-thu'))?>">WAGs</a></li>
	</ul>

</div><!-- /panel -->
<div data-role="panel" data-position="right" data-position-fixed="true" data-display="overlay" data-theme="a" id="add-form">

        <form class="userform">

        	<h2>Login</h2>

            <label for="name">Username:</label>
            <input type="text" name="name" id="name" value="" data-clear-btn="true" data-mini="true">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="" data-clear-btn="true" autocomplete="off" data-mini="true">

            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-b ui-mini">Cancel</a></div>
                <div class="ui-block-b"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-mini">Save</a></div>
			</div>
        </form>

	</div><!-- /panel -->