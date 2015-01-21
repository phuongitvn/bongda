<?php if($data){
	if(!$isLoadMore){
		echo '<ul id="data-list" data-role="listview" data-inset="true" style="margin-top: 0;">';
		foreach ($data as $item){
			$avatarUrl = SITE_URL.'/storage/'.$item->avatar_path;
			$publishDate = date('d/m/Y', strtotime($item->created_datetime));
			$viewUrl = Yii::app()->createUrl('/post/view', array('id'=>$item->id, 'url_key'=>Common::makeFriendlyUrl($item->name)));
			echo '<li>
					<a href="'.$viewUrl.'" class="ui-link">
					<img width="80" height="80" src="'.$avatarUrl.'">
					<h3>'.$item->name.'</h3>
					<p>'.$publishDate.'</p>
					</a>
				</li>';
		}
		echo '</ul>';
	}else{
		foreach ($data as $item){
			$avatarUrl = SITE_URL.'/storage/'.$item->avatar_path;
			$publishDate = date('d/m/Y', strtotime($item->created_datetime));
			$viewUrl = Yii::app()->createUrl('/post/view', array('id'=>$item->id, 'url_key'=>Common::makeFriendlyUrl($item->name)));
			echo '<li class="ui-li-has-thumb">
				<a class="ui-btn ui-btn-icon-right ui-icon-carat-r" href="'.$viewUrl.'" class="ui-link">
				<img width="80" height="80" src="'.$avatarUrl.'">
				<h3>'.$item->name.'</h3>
				<p>'.$publishDate.'</p>
				</a>
			</li>';
		}
	}
}?>