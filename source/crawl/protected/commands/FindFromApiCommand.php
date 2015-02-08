<?php
ini_set('max_execution_time', 300);
//include 'E:\source\gcms\bongda\trunk\source\crawl\protected\components\crawl\simple_html_dom.php';
//E:\xampp\php\php E:\source\gcms\bongda\trunk\source\crawl\index.php FindFromApi
class FindFromApiCommand extends CConsoleCommand
{
	//mùa giải
	const session_league = '2014';
	public function actionIndex(){
		$leagues = array(
				1=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Standing/Get/148/vi-VN/368',//ngoai hang anh
				2=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Standing/Get/149/vi-VN/379',//laliga
				3=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Standing/Get/149/vi-VN/373',//bundesliga
				4=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Standing/Get/149/vi-VN/380',//Seriea
				5=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Standing/Get/149/vi-VN/376'
		);
		echo '--Start crawl --'."\n";
		foreach ($leagues as $leagId => $url){
			echo $url."\n";
			$dataRaw = file_get_contents($url);
			$data = json_decode($dataRaw,true);
			if(isset($data[0]['lstStandings'])){
				$i=0;
				foreach ($data[0]['lstStandings'] as $key => $value){
					$i++;
					$isExist = $this->isExists($value);
					if($isExist==false){
						$model = new FootballRankPointModel();
						$model->created_datetime = date('Y-m-d H:i:s');
					}else{
						$model = FootballRankPointModel::model()->findByPk($isExist);
						$model->updated_datetime = date('Y-m-d H:i:s');
					}
					$model->Pos = $value['Pos'];
					$model->P = $value['P'];
					$model->W = $value['W'];
					$model->D = $value['D'];
					$model->L = $value['L'];
					$model->GF = $value['GF'];
					$model->GA = $value['GA'];
					$model->GD = $value['GD'];
					$model->PTS = $value['PTS'];
					$model->ShadeColor = $value['ShadeColor'];
					$model->long_name = $value['Team']['LongName'];
					$model->short_name = $value['Team']['ShortName'];
					$model->teamid = $value['Team']['Id'];
					$model->league_id = $leagId;
					$model->session_league = self::session_league;
					$model->pos_now = $i;
					$this->updatePos($value);
					$res = $model->save();
					$errors = $model->getErrors();
					//get falg icon
					$folderDest = SITE_PATH.DS.'storage'.DS.'flags';
					$fileDest = $folderDest.DS.$value['Team']['Id'].'.png';
					if(!is_file($fileDest)){
						FileHelper::_makeFolder($folderDest);
						$fileSource = 'http://resource.sportsflash.com.au/Soccer/Image/Scoreboardlogos/small/'.$value['Team']['Id'].'.png';
						$getFile = FileHelper::_downloadFileCurl($fileSource, $fileDest);
						echo '--get file flag '.json_encode($getFile)."\n";
					}
					echo $res?'--update success--':'--update fail--'.json_encode($errors);
					echo "\n";
				}
			}
		}
	}
	/**
	 * 
	 * @param int $round round=0=>lastest
	 */
	public function actionSchedule($round)
	{
		$round=0;
		$leagues = array(
				1=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Fixture/Get/149/vi-VN/368/'.$round.'/0/0/0',//ngoai hang anh
				2=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Fixture/Get/149/vi-VN/379/'.$round.'/0/0/0',//laliga
				3=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Fixture/Get/149/vi-VN/373/'.$round.'/0/0/0',//bundesliga
				4=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Fixture/Get/149/vi-VN/380/'.$round.'/0/0/0',//Seriea
				5=>'http://webapi-fwc-scoreboard.sportsflash.com.au/Fixture/Get/149/vi-VN/376/'.$round.'/0/0/0'
		);
		echo '--Start crawl --'."\n";
		foreach ($leagues as $leagId => $url){
			echo $url."\n";
			$dataRaw = file_get_contents($url);
			$data = json_decode($dataRaw,true);
			if(isset($data)){
				foreach ($data as $key => $value){
					//echo '<pre>';print_r($value);exit;
					$isExist = $this->isExistsSchedule($value,$leagId);
					if($isExist==false){
						$model = new FootbalScheduleModel();
						$model->created_datetime = date('Y-m-d H:i:s');
					}else{
						$model = FootbalScheduleModel::model()->findByPk($isExist);
						$model->updated_datetime = date('Y-m-d H:i:s');
					}
					$model->api_id = $value['Id'];
					$model->GroupId = $value['GroupId'];
					$model->IsLatestMatch = $value['IsLatestMatch'];
					$model->RoundId = $value['RoundId'];
					$model->RoundName = $value['RoundName'];
					$model->Status = $value['Status'];
					$model->SubStatus = $value['SubStatus'];
					$model->StatusCode = $value['StatusCode'];
					$model->CurrentStatus = $value['CurrentStatus'];
					$model->Result = $value['Result'];
					$model->HasPenaltyShootOut = $value['HasPenaltyShootOut'];
					$model->PoolName = $value['PoolName'];
					$model->HomeTeam = json_encode($value['HomeTeam']);
					$model->AwayTeam = json_encode($value['AwayTeam']);
					$model->homeTeamPrediction = $value['homeTeamPrediction'];
					$model->Venue = json_encode($value['Venue']);
					$model->WinnerId = $value['WinnerId'];
					$model->StartDateTime = $value['StartDateTime'];
					$model->StartDateTimeUTC = $value['StartDateTimeUTC'];
					$model->SeriesName = $value['SeriesName'];
					$model->league_id = $leagId;
					$model->session_league = self::session_league;
					$res = $model->save();
					$errors = $model->getErrors();
					echo $res?'--update success--':'--update fail--'.json_encode($errors);
					echo "\n";
				}
			}
		}
	}
	private function isExistsSchedule($value,$leagueId)
	{
		$crit = new CDbCriteria();
		$crit->condition = " RoundId=:rid AND league_id=:lid AND session_league=:ss";
		$crit->params = array(':rid'=>$value['RoundId'],':lid'=>$leagueId,':ss'=>self::session_league);
		$result = FootbalScheduleModel::model()->find($crit);
		return ($result)?$result->id:false;
	}
	private function isExists($value)
	{
		$crit = new CDbCriteria();
		$crit->condition = "P=:p AND teamid=:tid AND session_league=:ss ";
		$crit->params = array(':p'=>$value['P'],':tid'=>$value['Team']['Id'],':ss'=>self::session_league);
		$result = FootballRankPointModel::model()->find($crit);
		return ($result)?$result->id:false;
	}
	private function updatePos($value)
	{
		return Yii::app()->db->createCommand("update football_rank_point set pos_now='' where teamid=".$value['Team']['Id']." AND session_league='".self::session_league."'");
	}
}