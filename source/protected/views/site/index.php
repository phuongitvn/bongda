<?php $this->widget('application.widgets.listItems.listItemsWidget', array('data'=>$data,'isLoadMore'=>$isLoadMore))?>
<div class="ui-block" style="text-align: center">
	<a id="loadmore" style="margin: 0;" class="ui-shadow ui-btn ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline">Button</a>
	<input type="hidden" id="page" name="page" value="<?php echo $page+1;?>" />
</div>
