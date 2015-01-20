<?php require_once '_header.php';?>
<?php 
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
?>
<div data-role="page" id="panel-fixed-page1" data-title=".::Tin Bóng Đá::.">
    <div data-role="header" data-position="fixed" style="border-bottom: 0;background: #108040;text-shadow: none;color: #fff;">
        <h1 style="background: #108040">BÓNG ĐÁ</h1>
        
        <?php if($controller=='post' && $action=='view'){?>
        <a href="<?php echo Yii::app()->createUrl('/site/index');?>" data-icon="back" data-iconpos="notext" >Quay lại</a>
        <?php }else{?>
        <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
        <?php }?>
        <a href="#add-form" data-icon="gear" data-iconpos="notext">Add</a>
        <div data-role="navbar">
			<ul data-ajax="false" class="smenu">
				<li><a href="<?php echo Yii::app()->createUrl('/site/index');?>" class="<?php if(($controller=='site' && $action=='index') || ($controller=='post' && $action=='view')) echo 'ui-btn-active ui-state-persist';?>">Tin Tức</a></li>
				<li><a class="<?php if($controller=='site' && $action=='schedule') echo 'ui-btn-active ui-state-persist';?>" href="<?php echo Yii::app()->createUrl('/site/schedule')?>">Lịch Thi Đấu</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/site/rank');?>" class="<?php if($controller=='site' && $action=='rank') echo 'ui-btn-active ui-state-persist';?> ui-link">Bảng Xếp Hạng</a></li>
			</ul>
		</div>
    </div><!-- /header -->
    <?php echo $content;?>
	<div data-role="panel" data-position-fixed="true" data-display="push" data-theme="g" id="nav-panel">

		<ul data-role="listview">
            <li data-icon="delete"><a href="#" data-rel="close">Tin tức bóng đá</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/post/index', array('url_key'=>'bong-da-anh'))?>">Bóng đá Anh</a></li>
                <li><a href="#panel-fixed-page2">Bóng đá Tây Ban Nha</a></li>
                <li><a href="#panel-fixed-page2">Bóng đá Đức</a></li>
                <li><a href="#panel-fixed-page2">Europa Leage</a></li>
                <li><a href="#panel-fixed-page2">Bóng đá Việt Nam</a></li>
                <li><a href="#panel-fixed-page2">Lịch thi đấu</a></li>
                <li><a href="#panel-fixed-page2">Bảng xếp hạng</a></li>
                <li><a href="#panel-fixed-page2">Chuyển nhượng</a></li>
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

</div><!-- /page -->

<div data-role="page" id="panel-fixed-page2">

    <div data-role="header">
        <h1>Landing page</h1>
    </div><!-- /header -->

    <div role="main" class="ui-content jqm-content">

        <p>This is just a landing page.</p>

        <a href="#panel-fixed-page1" class="ui-btn ui-shadow ui-corner-all ui-btn-inline ui-mini ui-icon-back ui-btn-icon-left">Back</a>

    </div><!-- /content -->

</div><!-- /page -->
</body>
</html>
