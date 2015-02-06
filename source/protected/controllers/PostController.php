<?php
class PostController extends FrontendController
{
	public $layout='body';
	public function actionView()
	{
		$this->layout='column1';
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
		//$this->layout='scroll';
		$this->layout='column1';
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
		$title = Yii::app()->db->createCommand("select name from tbl_crawl_category where url_key='$urlKey'")->queryScalar();
		$this->render('list', compact('data','page','urlKey','title'));
	}
	/**
	 * load more items
	 */
	public function actionLoadMore()
	{
		$this->layout=false;
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
		$this->renderPartial('_ajax_list', compact('data','page'));
	}
}