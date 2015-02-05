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
				foreach ($data[0]['lstStandings'] as $key => $value){
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
	private function isExists($value)
	{
		$crit = new CDbCriteria();
		$crit->condition = "P=:p AND teamid=:tid AND session_league=:ss ";
		$crit->params = array(':p'=>$value['P'],':tid'=>$value['Team']['Id'],':ss'=>self::session_league);
		$result = FootballRankPointModel::model()->find($crit);
		return ($result)?$result->id:false;
	}
}