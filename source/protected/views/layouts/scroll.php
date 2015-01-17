<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div data-iscroll="" data-role="content" role="main" class="ui-content" id="main-content">
		<div class="iscroll-pulldown">
          <span class="iscroll-pull-icon"></span><span class="iscroll-pull-label"></span>
        </div>
		<div data-demo-html="false" style="margin: 0 -1em;">
			<div><?php echo $content;?></div>
		</div>
		<div data-demo-html="#panel-fixed-page1"></div><!--/demo-html -->
</div>
<!-- /content -->
<?php $this->endContent(); ?>