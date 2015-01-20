<?php $this->widget('application.widgets.listItems.listItemsWidget', array('data'=>$data))?>
<div class="ui-block" style="text-align: center">
	<a id="loadmore" style="margin: 0;" class="ui-shadow ui-btn ui-corner-all ui-icon-arrow-d ui-btn-icon-notext ui-btn-inline">Button</a>
	<input type="hidden" id="page" name="page" value="<?php echo $page+1;?>" />
</div>
<script>
$(document).ready(function(){
	$("#loadmore").on("click", function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('/post/loadMore', array('url_key'=>$urlKey))?>',
			data: {page:$("#page").val()},
			success: function(data){
				$("#data-list").append(data);
			}
		})
	})
})
</script>