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
}