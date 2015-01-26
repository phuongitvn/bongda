<?php $this->widget('application.widgets.listItems.listItemsWidget', array('data'=>$data,'category'=>$urlKey))?>
<div class="ui-block" style="text-align: center">
	<div id="wrload">
		<a id="loadmore" onclick="loadMore('<?php echo Yii::app()->createUrl('/post/loadMore', array('url_key'=>$urlKey))?>')" style="margin: 0;" class="ui-shadow ui-btn ui-corner-all ui-icon-arrow-d ui-btn-icon-notext ui-btn-inline">Button</a>
	</div>
	<input type="hidden" id="page" name="page" value="<?php echo $page+1;?>" />
</div>
