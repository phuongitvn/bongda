<?php
ini_set('max_execution_time', 300);
//include 'E:\source\gcms\bongda\trunk\source\crawl\protected\components\crawl\simple_html_dom.php';
//E:\xampp\php\php E:\source\gcms\bongda\trunk\source\crawl\index.php CrawlData view
class FindFromApiCommand extends CConsoleCommand
{
	public function actionIndex(){
		echo $url = 'http://webapi-fwc-scoreboard.sportsflash.com.au/Standing/Get/148/vi-VN/368';
		$dataRaw = file_get_contents($url);
		$data = json_decode($dataRaw);
		echo '<pre>';print_r($data[0]->lstStandings);
	}
}