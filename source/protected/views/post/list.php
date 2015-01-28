<div data-role="page" id="post-list" data-title=".::Tin Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -1em;">
<?php $this->widget('application.widgets.listItems.listItemsWidget', array('data'=>$data,'category'=>$urlKey))?>
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
$('#post-list').on('pagecreate', function() {
	$("#loadmore").bind("click", function(e){
		console.log('test')
		var page = parseInt($("#page").val());
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('/post/loadMore', array('url_key'=>$urlKey))?>',
			data: {page:page},
			beforeSend: function(){
				$("#loadmore").attr("class","loading");
				$("#loadmore").html("<img width='25' src='<?php echo Yii::app()->request->baseUrl?>/images/loading.gif' />");
			},
			success: function(data){
				$("#loadmore").attr("class","ui-shadow ui-btn ui-corner-all ui-icon-arrow-d ui-btn-icon-notext ui-btn-inline");
				//$("#data-list").append(data);
				$("body").find("ul#data-list").append(data);
				$("#page").attr("value",page+1);
			}
		})
	})
})

</script>
</div>
