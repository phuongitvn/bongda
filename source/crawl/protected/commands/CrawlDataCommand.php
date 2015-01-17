<?php
//C:\xampp\php\php E:\phuongnv\Vega\yiilab\console.php CrawlData index
include dirname(__FILE__).'/../components/crawl/simple_html_dom.php';
class CrawlDataCommand extends CConsoleCommand
{
	public function actionIndex(){
		//
		$urlCategory = $this->getUrlCrawlCategory();
		foreach ($urlCategory as $urlCat){
			$html = file_get_html($urlCat['url_crawl']);
			$i=0;
			$article = array();
			$sqlItems = array();
			foreach ($html->find("#thirdbox_double ._title_ h1 a") as $e){
				$url = urldecode($e->href);
				$title = $e->plaintext;
				if($urlCat['site']='http://bongdaso.com'){
					$url = $urlCat['site'].'/'.$url;
				}
				$imgAvatar = $html->find("#thirdbox_double .foto_news_foto img", $i)->src;
				$filePath = helper::downloadAvatar($imgAvatar, helper::makeFriendlyUrl($title,false,'_'));
				$sqlItems[] = "('".$url."','".$title."','".$urlCat['category_id']."','".$urlCat['site']."', NOW(), NOW(), '".$filePath."')";
				$i++;
			}
			//echo '<pre>';print_r($article);exit;
			$sql = "INSERT INTO tbl_crawl_url(url, name, category_id, site, created_datetime, updated_datetime, avatar_path) VALUES";
			$sql .=implode(',', $sqlItems);
			$sql .=" ON DUPLICATE KEY UPDATE name = VALUES(name),
										 url = VALUES(url),
										category_id = VALUES(category_id),
										site = VALUES(site),
										avatar_path = VALUES(avatar_path),
										updated_datetime = NOW() ";
			$res = Yii::app()->db->createCommand($sql)->execute();
		}
		
	}
	private function getUrlCrawlCategory()
	{
		$sql = "select * from tbl_crawl_category_url";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
}