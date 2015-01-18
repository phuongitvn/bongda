<?php
class PageController extends FrontendController
{
	public $layout='body';
	public function actionView()
	{
		$this->render('schedule');
	}
	public function actionSchedule()
	{
		$this->render('schedule');
	}
}