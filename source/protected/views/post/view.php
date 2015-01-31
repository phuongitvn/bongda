<div data-role="page" id="post-view" data-title=".::Tin Bóng Đá::.">
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -5px;">
	<h3><?php echo CHtml::encode($data['title']);?></h3><br />
	<?php
	$this->widget('application.widgets.social.ShareWidget', array(
	    'pageTitle' => $data['title'],
	    'pageDescription' => 'The long descriptions of the page.',
	    'pageType' => 'article',
	    'pageImages' => array(
	    		'/storage/'.$data['avatar_url'],
	    		'/storage/'.$data['avatar_url']
	    ),
	));
	?>
	<div class="content" id="postview"><?php echo $data['content'];?></div>
	<p style="text-align: right"><strong style="font-style: italic;font-size: 14px;"><?php echo $data['author'];?></strong></p>
</div>
</div>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_panel.php';?>
<script>
$('#post-view').on('pagecreate', function(event) {
	<?php include_once dirname(dirname(__FILE__)).DS."layouts".DS."analyticstracking_ajax.php"; ?>
})
</script>
</div>
