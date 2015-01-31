<div data-role="page" id="site-home" data-title=".::Tin Tức Tổng Hợp Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -1em;">
	<?php $this->widget('application.widgets.listItems.listItemsWidget', array('data'=>$data))?>
	<div class="ui-block" style="text-align: center">
		<div id="wrload">
			<a id="loadmore" style="margin: 0;" class="ui-shadow ui-btn ui-corner-all ui-icon-arrow-d ui-btn-icon-notext ui-btn-inline">Button</a>
		</div>
		<input type="hidden" id="page" name="page" value="<?php echo $page+1;?>" />
	</div>
</div>
</div>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_panel.php';?>
<script>
$('#site-home').on('pagecreate', function(event) {
	<?php include_once dirname(dirname(__FILE__)).DS."layouts".DS."analyticstracking_ajax.php"; ?>
	$("#site-home #loadmore").on("click", function(event){
		var page = parseInt($("#site-home #page").val());
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('/site/loadMore')?>',
			data: {page:page},
			beforeSend: function(){
				$("#site-home #loadmore").attr("class","loading");
				$("#site-home #loadmore").html("<img width='25' src='<?php echo Yii::app()->request->baseUrl?>/images/loading.gif' />");
			},
			success: function(data){
				$("#site-home #loadmore").attr("class","ui-shadow ui-btn ui-corner-all ui-icon-arrow-d ui-btn-icon-notext ui-btn-inline");
				//$("#data-list").append(data);
				$("body #site-home").find("ul#data-list").append(data);
				$("#site-home #page").attr("value",page+1);
			}
		})
	})
})
</script>
</div>
