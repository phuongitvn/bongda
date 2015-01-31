<div data-role="page" id="site-schedule" data-title=".::Lịch Thi Đấu Bóng Đá Hợp Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -1em;">
<div id="schedule" class="content">
<div>
<a style="margin: 0" href="#inside-g" class="ui-btn ui-shadow ui-corner-all ui-icon-star ui-btn-icon-right"><?php echo $title?></a>
</div>
<?php if($data){?>
<?php foreach ($data as $item){?>
<h3><?php echo $item->name?></h3>
<div class="schedule-main sc_<?php echo $item->description?>"><?php echo $item->html?></div>
<?php }?>
<?php }?>
</div>
</div>
</div>
<div data-role="panel" id="inside-g" data-position="right" data-display="overlay" data-theme="a">
			<div class="ui-panel-inner">
			<ul data-role="listview" class="ui-listview">
				<li>
				<a href="<?php echo Yii::app()->createUrl('/site/schedule')?>" class="ui-btn">Ngoại Hạng Anh</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('/site/schedule', array('league'=>'laliga'))?>" class="ui-btn">Laliga</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('/site/schedule', array('league'=>'bundesliga'))?>" class="ui-btn">Bundesliga</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('/site/schedule', array('league'=>'seriea'))?>" class="ui-btn">Serie A</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('/site/schedule', array('league'=>'champions_league'))?>" class="ui-btn">Champions League</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('/site/schedule', array('league'=>'league1'))?>" class="ui-btn">League 1</a>
				</li>
			</ul></div>
		</div>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_panel.php';?>
<script>
$('#site-schedule').on('pagecreate', function(event) {
	<?php include_once dirname(dirname(__FILE__)).DS."layouts".DS."analyticstracking_ajax.php"; ?>
})
</script>
</div>