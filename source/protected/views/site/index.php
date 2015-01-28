<div data-role="page" id="site-home" data-title=".::Tin Tức Tổng Hợp Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -1em;">
<?php $this->widget('application.widgets.listItems.listItemsWidget', array('data'=>$data,'isLoadMore'=>$isLoadMore))?>
</div>
</div>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_panel.php';?>
</div>
