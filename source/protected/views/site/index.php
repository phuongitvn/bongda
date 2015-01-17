<?php if($data){
	echo '<ul data-role="listview" data-inset="true" style="margin-top: 0;">';
	foreach ($data as $item){
		$avatarUrl = SITE_URL.'/storage/'.$item['avatar_path'];
		$publishDate = date('d/m/Y', strtotime($item['created_datetime']));
		$viewUrl = Yii::app()->createUrl('/post/view', array('id'=>$item['id']));
		echo '<li>
				<a href="'.$viewUrl.'" class="ui-link">
				<img width="80" height="80" src="'.$avatarUrl.'">
				<h3>'.$item['name'].'</h3>
				<p>'.$publishDate.'</p>
				</a>
			</li>';
	}
	echo '</ul>';
}?>