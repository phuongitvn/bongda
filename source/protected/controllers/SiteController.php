<?php
include 'E:\source\gcms\bongda\trunk\source\crawl\protected\components\crawl\simple_html_dom.php';
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
		$d = '{
    "GroupName": "",
    "lstStandings": [
      {
        "Pos": "1",
        "P": "22",
        "W": "16",
        "D": "4",
        "L": "2",
        "GF": "51",
        "GA": "19",
        "GD": "32",
        "PTS": "52",
        "ShadeColor": "#7dafd2",
        "Team": {
          "LongName": "Chelsea",
          "LongName2": null,
          "ShortName": "CHE",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "21",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "2",
        "P": "22",
        "W": "14",
        "D": "5",
        "L": "3",
        "GF": "45",
        "GA": "22",
        "GD": "23",
        "PTS": "47",
        "ShadeColor": "#7dafd2",
        "Team": {
          "LongName": "Man. City",
          "LongName2": null,
          "ShortName": "MCI",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "29",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "3",
        "P": "22",
        "W": "13",
        "D": "3",
        "L": "6",
        "GF": "37",
        "GA": "16",
        "GD": "21",
        "PTS": "42",
        "ShadeColor": "#7dafd2",
        "Team": {
          "LongName": "Southampton",
          "LongName2": null,
          "ShortName": "SOT",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "33",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "4",
        "P": "22",
        "W": "11",
        "D": "7",
        "L": "4",
        "GF": "36",
        "GA": "21",
        "GD": "15",
        "PTS": "40",
        "ShadeColor": "#bdd9ee",
        "Team": {
          "LongName": "Man. Utd",
          "LongName2": null,
          "ShortName": "MUN",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "30",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "5",
        "P": "22",
        "W": "11",
        "D": "6",
        "L": "5",
        "GF": "39",
        "GA": "25",
        "GD": "14",
        "PTS": "39",
        "ShadeColor": "#deedf4",
        "Team": {
          "LongName": "Arsenal",
          "LongName2": null,
          "ShortName": "ARS",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "17",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "6",
        "P": "22",
        "W": "11",
        "D": "4",
        "L": "7",
        "GF": "32",
        "GA": "30",
        "GD": "2",
        "PTS": "37",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Tottenham",
          "LongName2": null,
          "ShortName": "TOT",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "35",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "7",
        "P": "22",
        "W": "10",
        "D": "6",
        "L": "6",
        "GF": "35",
        "GA": "25",
        "GD": "10",
        "PTS": "36",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "West Ham",
          "LongName2": null,
          "ShortName": "WHM",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "36",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "8",
        "P": "22",
        "W": "10",
        "D": "5",
        "L": "7",
        "GF": "31",
        "GA": "27",
        "GD": "4",
        "PTS": "35",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Liverpool",
          "LongName2": null,
          "ShortName": "LIV",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "28",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "9",
        "P": "22",
        "W": "8",
        "D": "6",
        "L": "8",
        "GF": "26",
        "GA": "30",
        "GD": "-4",
        "PTS": "30",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Swansea",
          "LongName2": null,
          "ShortName": "SWA",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "796",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "10",
        "P": "22",
        "W": "8",
        "D": "5",
        "L": "9",
        "GF": "23",
        "GA": "27",
        "GD": "-4",
        "PTS": "29",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Stoke",
          "LongName2": null,
          "ShortName": "STO",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "778",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "11",
        "P": "22",
        "W": "7",
        "D": "6",
        "L": "9",
        "GF": "26",
        "GA": "35",
        "GD": "-9",
        "PTS": "27",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Newcastle",
          "LongName2": null,
          "ShortName": "NEW",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "32",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "12",
        "P": "22",
        "W": "5",
        "D": "8",
        "L": "9",
        "GF": "30",
        "GA": "34",
        "GD": "-4",
        "PTS": "23",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Everton",
          "LongName2": null,
          "ShortName": "EVE",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "24",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "13",
        "P": "22",
        "W": "5",
        "D": "8",
        "L": "9",
        "GF": "25",
        "GA": "33",
        "GD": "-8",
        "PTS": "23",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Crystal Palace",
          "LongName2": null,
          "ShortName": "CRY",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "43",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "14",
        "P": "22",
        "W": "5",
        "D": "7",
        "L": "10",
        "GF": "20",
        "GA": "29",
        "GD": "-9",
        "PTS": "22",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "West Brom",
          "LongName2": null,
          "ShortName": "WBA",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "58",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "15",
        "P": "22",
        "W": "5",
        "D": "7",
        "L": "10",
        "GF": "11",
        "GA": "25",
        "GD": "-14",
        "PTS": "22",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Aston Villa",
          "LongName2": null,
          "ShortName": "AVL",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "18",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "16",
        "P": "22",
        "W": "3",
        "D": "11",
        "L": "8",
        "GF": "19",
        "GA": "33",
        "GD": "-14",
        "PTS": "20",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Sunderland",
          "LongName2": null,
          "ShortName": "SUN",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "34",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "17",
        "P": "22",
        "W": "4",
        "D": "8",
        "L": "10",
        "GF": "21",
        "GA": "36",
        "GD": "-15",
        "PTS": "20",
        "ShadeColor": "transparent",
        "Team": {
          "LongName": "Burnley",
          "LongName2": null,
          "ShortName": "BUR",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "41",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "18",
        "P": "22",
        "W": "4",
        "D": "7",
        "L": "11",
        "GF": "20",
        "GA": "30",
        "GD": "-10",
        "PTS": "19",
        "ShadeColor": "#d79fa0",
        "Team": {
          "LongName": "Hull",
          "LongName2": null,
          "ShortName": "HUL",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "803",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "19",
        "P": "22",
        "W": "5",
        "D": "4",
        "L": "13",
        "GF": "23",
        "GA": "39",
        "GD": "-16",
        "PTS": "19",
        "ShadeColor": "#d79fa0",
        "Team": {
          "LongName": "QPR",
          "LongName2": null,
          "ShortName": "QPR",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "52",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      },
      {
        "Pos": "20",
        "P": "22",
        "W": "4",
        "D": "5",
        "L": "13",
        "GF": "20",
        "GA": "34",
        "GD": "-14",
        "PTS": "17",
        "ShadeColor": "#d79fa0",
        "Team": {
          "LongName": "Leicester",
          "LongName2": null,
          "ShortName": "LEI",
          "Score": null,
          "HalfTimeScore": null,
          "PenaltyShootOutScore": null,
          "Id": "27",
          "RedCardPlayers": null,
          "YellowCardPlayers": null,
          "GoalScorers": null,
          "PenaltyShootOuts": null,
          "StartingLineUp": null,
          "Substitute": null,
          "Manager": null
        }
      }
    ]
  }
		';
		$d = json_decode($d, true);
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
		$this->layout='scroll';
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
		$this->layout='scroll';
		$this->render('rank');
	}
	public function actionSchedule()
	{
		$this->layout='scroll';
		$league = Yii::app()->request->getParam('league','premier_league');
		$crit = new CDbCriteria();
		$crit->condition = "category=:cat";
		$crit->params = array(':cat'=>$league);
		$crit->order = "ordering ASC";
		$data = WebCrawlPageModel::model()->findAll($crit);
		$this->render('schedule', compact('data'));
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