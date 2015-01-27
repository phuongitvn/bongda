<?php if($data){?>
<div id="schedule" class="content" style="margin: 0 1em;">
<?php foreach ($data as $item){?>
<h3><?php echo $item->name?></h3>
<div class="schedule-main sc_<?php echo $item->description?>"><?php echo $item->html?></div>
<?php }?>
<?php }?>
</div>