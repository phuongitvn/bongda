<?php
class listItemsWidget extends CWidget
{
	public $data = null;
	public $isLoadMore=false;
	public $category = '';
	public function run(){
		$this->render('list_items', array(
				'data'=>$this->data,
				'isLoadMore'=>$this->isLoadMore,
				'category'=>$this->category
		));
	}
}