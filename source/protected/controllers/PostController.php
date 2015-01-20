<?php
class PostController extends FrontendController
{
	public $layout='body';
	public function actionView()
	{
		$id = Yii::app()->request->getParam('id');
		$data = WebCrawlContentModel::model()->findByPk($id);
		if(!$data){
			throw new CHttpException(404,'Page not found');
		}
		$this->render('view', compact('data'));
	}
	/**
	 * list post by category
	 */
	public function actionIndex()
	{
		$this->layout='scroll';
		$urlKey = Yii::app()->request->getParam('url_key');
		$page = Yii::app()->request->getParam('page',1);
		$limit = Yii::app()->params['postsPerPage'];
		$offset = ($page-1)*$limit;
		$criteria = new CDbCriteria();
		$criteria->join = "left join tbl_crawl_category c1 ON t.category_id=c1.id";
		$criteria->condition = "c1.url_key=:url_key AND t.status=:status";
		$criteria->params = array(':url_key'=>$urlKey, ':status'=>CrawlUrlModel::ACTIVE);
		$criteria->limit = $limit;
		$criteria->offset= $offset;
		$criteria->order = " t.id DESC";
		$data = WebCrawlUrlModel::model()->findAll($criteria);
		$this->render('list', compact('data','page'));
	}
}