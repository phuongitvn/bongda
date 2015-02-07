<div data-role="page" id="post-view" data-title="<?php echo $data['title'];?>">
<?php $this->pageTitle=$data['title'];?>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_header.php';?>
<div data-role="content" role="main" class="ui-content" id="main-content" style="padding-top: 0;">
	<div style="margin: 0 -5px;">
	<h3 style="margin-bottom: 0;"><?php echo $data['title'];?></h3>
	<?php
	$this->widget('application.widgets.social.ShareWidget', array(
	    'pageTitle' => htmlentities($data['title']),
	    'pageDescription' => !empty($data['intro_text'])?htmlentities($data['intro_text']):'(BongDa8.Mobi) - Tin tức tổng hợp bóng đá, '.$data['title'],
	    'pageType' => 'article',
	    'pageImages' => array(
	    		'/storage/'.$data['avatar_url'],
	    		'/storage/'.$data['avatar_url']
	    ),
	));
	?>
	<div class="content" id="postview"><?php echo $data['content'];?></div>
	<p style="text-align: right"><strong style="font-style: italic;font-size: 14px;">Theo <?php echo $data['author'];?></strong></p>
</div>
</div>
<?php require_once dirname(dirname(__FILE__)).DS.'layouts'.DS.'_data_role_panel.php';?>
<script>
$('#post-view').on('pagecreate', function(event) {
	<?php include_once dirname(dirname(__FILE__)).DS."layouts".DS."analyticstracking_ajax.php"; ?>
})
</script>
</div>
