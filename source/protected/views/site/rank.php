<div data-role="page" id="site-rank" data-title=".::Bảng Xếp Hạng Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -1em;">
	<div id="schedule" class="content">
	<div style="margin-top: 10px" >
		<a href="#inside-g" class="ui-btn ui-shadow ui-corner-all ui-icon-star ui-btn-icon-right"><?php echo $title?></a>
	</div>
<?php if($data){?>
<h3><?php echo $data->name?></h3>
<div class="schedule-main sc_<?php echo $item->description?>"><?php echo $item->html?></div>
<?php }?>
</div>
</div>
</div>

<div data-role="panel" id="inside-g" data-position="right" data-display="overlay" data-theme="a">
	<div class="ui-panel-inner">
	<ul data-role="listview" class="ui-listview">
		<li>
		<a href="<?php echo Yii::app()->createUrl('/site/rank')?>" class="ui-btn">Ngoại Hạng Anh</a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>'laliga_rank'))?>" class="ui-btn">Laliga</a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>'bundesliga_rank'))?>" class="ui-btn">Bundesliga</a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>'seriea_rank'))?>" class="ui-btn">Serie A</a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>'champions_league_rank'))?>" class="ui-btn">Champions League</a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>'league1_rank'))?>" class="ui-btn">League 1</a>
		</li>
	</ul></div>
</div>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_panel.php';?>
<script>
$('#site-rank').on('pagecreate', function(event) {
	<?php include_once dirname(dirname(__FILE__)).DS."layouts".DS."analyticstracking_ajax.php"; ?>
})
</script>
</div>