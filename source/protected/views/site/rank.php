<div data-role="page" id="site-rank" data-title=".::Bảng Xếp Hạng Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -1em;">
<?php if($data){?>
<div id="schedule" class="content">
<?php foreach ($data as $item){?>
<h3><?php echo $item->name?></h3>
<div class="schedule-main sc_<?php echo $item->description?>"><?php echo $item->html?></div>
<?php }?>
<?php }?>
</div>
</div>
</div>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_panel.php';?>
<script>
$('#site-rank').on('pagecreate', function(event) {
	<?php include_once dirname(dirname(__FILE__)).DS."layouts".DS."analyticstracking_ajax.php"; ?>
})
</script>
</div>