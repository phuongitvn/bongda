<?php 
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
?>
<div id="header" data-role="header" data-position="fixed">
        <h1 class="h_title"><img width="144" src="/images/logo.png" /></h1>
        
        <?php if($controller=='post' && $action=='view'){?>
        <a href="javascript: window.history.go(-1)" data-icon="back" data-iconpos="notext" >Quay lại</a>
        <?php }else{?>
        <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
        <?php }?>
        <a href="#add-form" data-icon="gear" data-iconpos="notext">Add</a>
        <div data-role="navbar" id="header_nav">
			<ul data-ajax="true" class="smenu">
				<li><a href="<?php echo Yii::app()->createUrl('/site/index');?>" class="<?php if(($controller=='site' && $action=='index') || ($controller=='post' && $action=='view')) echo 'ui-btn-active ui-state-persist';?>">Tin Tức</a></li>
			<li><a class="<?php if($controller=='site' && $action=='schedule') echo 'ui-btn-active ui-state-persist';?>" href="<?php echo Yii::app()->createUrl('/site/schedule')?>">Lịch Thi Đấu</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('/site/rank');?>" class="<?php if($controller=='site' && $action=='rank') echo 'ui-btn-active ui-state-persist';?> ui-link">Bảng Xếp Hạng</a></li>
			</ul>
		</div>
</div><!-- /header -->