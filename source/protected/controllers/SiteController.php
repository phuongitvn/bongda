<?php
include dirname(__FILE__).'/../../crawl/protected/components/crawl/simple_html_dom.php';
class SiteController extends FrontendController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function actionTest()
	{
		$url = 'http://tyso.bongda.com.vn/widgets/widget-fixtures-not-started.php?league_id=1&season=1415&limit=20&css=http%3A%2F%2Ftyso.bongda.com.vn%2Fcss%2Ffixture-recent.css';
		$html = file_get_html($url);
		foreach ($html->find("a") as $e)
		{
			$innerText = $e->plaintext;
			$e->href = '#';
		}
		echo $content = $html->find("body",0)->innertext;
		exit;
		$sql = "select * from tbl_crawl_page";
		$data = Yii::app()->db->createCommand($sql)->queryAll();
		$result = array();
		foreach ($data as $key => $item){
			echo '<h2>'.$item['name'].'</h2>';
			echo $item['html'];
			echo '<br />';
		}
		exit;
		foreach ($data as $key => $item){
			$url = $item['url'];
			$html = file_get_html($url);
			foreach ($html->find("a") as $e)
			{
				$innerText = $e->plaintext;
				$e->href = '#';
			}
			$html = $html->find("body table",0)->outertext;
			$sql = "update tbl_crawl_page 
					set html=:html, updated_datetime=NOW() 
					where id=:id";
			$command = Yii::app()->db->createCommand($sql);
			$command->bindParam(':html', $html, PDO::PARAM_STR);
			$command->bindParam(':id', $item['id'], PDO::PARAM_STR);
			$res = $command->execute();
			var_dump($res);
		}
		exit;
		//$url = 'http://vne.soccer.scoreboard.sportsflash.com.au/vneindex.htm#/standings/149/vi-VN/368';
		//$html = file_get_html($url);
		//echo $content = $html->find("#content",0)->innertext;
		//var_dump($url);
		
		$test = file_get_contents('http://webapi-fwc-scoreboard.sportsflash.com.au//Standing/Get/149/vi-VN/368?callback=angular.callbacks._2');
		foreach ($d['lstStandings'] as $item){
			echo $item['ShadeColor']."<br />";
		}
		echo '<pre>';print_r($d);
		exit;
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout='column1';
		$page = Yii::app()->request->getParam('page',1);
		$limit = Yii::app()->params['postsPerPage'];
		$offset = ($page-1)*$limit;
		$criteria = new CDbCriteria();
		$criteria->condition = "status=:status";
		$criteria->params = array(':status'=>CrawlUrlModel::ACTIVE);
		$criteria->limit = $limit;
		$criteria->offset = $offset;
		$criteria->order = "id DESC";
		$data = CrawlUrlModel::model()->findAll($criteria);
		$isLoadMore = false;
		$this->render('index', compact('data','page','isLoadMore'));
		
	}
	public function actionRank()
	{
		$this->layout='column1';
		$rank = Yii::app()->request->getParam('rank','premier_league_rank');
		switch ($rank)
		{
			case 'premier_league':
				$title = 'Ngoại Hạng Anh';
				break;
			case 'seriea':
				$title = 'Serie A';
				break;
			case 'champions_league':
				$title = 'Champions League';
				break;
			case 'league1':
				$title = 'League 1';
				break;
			default:
				$title = ucfirst($league);
				break;
		}
		$crit = new CDbCriteria();
		$crit->condition = "category=:cat";
		$crit->params = array(':cat'=>$rank);
		$crit->order = "ordering ASC";
		$data = WebCrawlPageModel::model()->findAll($crit);
		$this->render('rank', compact('data','title'));
	}
	public function actionSchedule()
	{
		$this->layout='column1';
		$league = Yii::app()->request->getParam('league','premier_league');
		switch ($league)
		{
			case 'premier_league':
				$title = 'Ngoại Hạng Anh';
				break;
			case 'seriea':
				$title = 'Serie A';
				break;
			case 'champions_league':
				$title = 'Champions League';
				break;
			case 'league1':
				$title = 'League 1';
				break;
			default:
				$title = ucfirst($league);
				break;
		}
		$crit = new CDbCriteria();
		$crit->condition = "category=:cat";
		$crit->params = array(':cat'=>$league);
		$crit->order = "ordering ASC";
		$data = WebCrawlPageModel::model()->findAll($crit);
		$this->render('schedule', compact('data','league','title'));
	}
	/**
	 * page html dynamic
	 */
	public function actionPage()
	{
		$alias = Yii::app()->request->getParam('alias');
		$pageDetail = FrontendPagesModel::getPageByAlias($alias);
		$this->render('page', array('pageDetail'=>$pageDetail));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionAbout()
	{
		$this->render('about');
	}
}