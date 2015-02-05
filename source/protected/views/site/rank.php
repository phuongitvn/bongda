<div data-role="page" id="site-rank" data-title=".::Bảng Xếp Hạng Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -1em;">
	<div id="schedule" class="content">
	<div style="margin-top: 10px" >
		<a href="#inside-g" class="ui-btn ui-shadow ui-corner-all ui-icon-star ui-btn-icon-right"><?php echo $title?></a>
	</div>
<?php if($data){?>
<div class="schedule-main sc_rank">
<table>
<thead>
	<tr><th>stt</th><th>Đội</th><th>Trận</th><th>Hệ số</th><th>Điểm</th></tr>
</thead>
<tbody>
	<?php 
	$i=0;
	foreach ($data as $key => $value){
	$i++;
	?>
	<tr class="<?php if($i%2==0) echo 'row row_even'; else echo 'row row_odd';?>">
	<td align="center" style="background-color:<?php echo ($value->ShadeColor=='transparent')?'#eee':$value->ShadeColor;?>"><?php echo $value->Pos?></td>
	<td><div class="team"><img src="/storage/flags/<?php echo $value->teamid?>.png" />&nbsp;<?php echo $value->long_name?></div></td>
	<td><?php echo $value->P?></td>
	<td><?php echo $value->GD?></td>
	<td><?php echo $value->PTS?></td></tr>
	<?php }?>
</tbody>
</table>
</div>
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
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>2))?>" class="ui-btn">Laliga</a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>3))?>" class="ui-btn">Bundesliga</a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>4))?>" class="ui-btn">Serie A</a>
		</li>
		<?php /* ?>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>'champions_league_rank'))?>" class="ui-btn">Champions League</a>
		</li>
		<?php */?>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/site/rank', array('league'=>5))?>" class="ui-btn">League 1</a>
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