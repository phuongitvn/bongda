<?php
//include 'E:\source\gcms\bongda\trunk\source\crawl\protected\components\crawl\simple_html_dom.php';
//E:\xampp\php\php E:\source\gcms\bongda\trunk\source\crawl\index.php CrawlData view
class CrawlDataCommand extends CConsoleCommand
{
	public function actionIndex(){
		//
		include dirname(__FILE__).'/../components/crawl/simple_html_dom.php';
		$urlCategory = $this->getUrlCrawlCategory();
		foreach ($urlCategory as $urlCat){
			echo '---Start crawl from: '.$urlCat['url_crawl'].'---'."\n";
			$html = file_get_html($urlCat['url_crawl']);
			$i=0;
			$article = array();
			$sqlItems = array();
			foreach ($html->find("#thirdbox_double ._title_ h1 a") as $e){
				$url = $e->href;
				$title = $e->plaintext;
				if($urlCat['site']='http://bongdaso.com'){
					$url = $urlCat['site'].'/'.$url;
				}
				$imgAvatar = $html->find("#thirdbox_double .foto_news_foto img", $i)->src;
				$filePath = helper::downloadAvatar($imgAvatar, time().'_'.$i);
				$sqlItems[] = "('".$url."','".$title."','".$urlCat['category_id']."','".$urlCat['site']."', NOW(), NOW(), '".$filePath."')";
				$i++;
				echo 'Crawl success |'.$url."\n";
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
			if($res){
				echo 'insert data success!';
			}else{
				echo 'fail';
			}
			
		}
		
	}
	public function actionView()
	{
		try{
			$viewUrlList = $this->getUrlCrawlDetail();
			if($viewUrlList){
				$data = CrawlDataFactory::makeDataCrawl('bds');
				foreach ($viewUrlList as $item){
					echo '---Start crawl detail from: '.$item['url'].'---'."\n";
					$data->setUrl($item['url']);
					echo $title = $data->getTitle();
					echo $urlKey = helper::makeFriendlyUrl($title);
					echo $content = addslashes($data->getContentBody());
					//$urlImage = $data->getImageThumb();
					$sqlItems[] = "('{$item['id']}','$title','$urlKey','$content','{$item['avatar_path']}',NOW(),NOW())";
				}
				$sql = "INSERT INTO tbl_crawl_content(url_id,title,url_key,content,avatar_url,created_datetime,updated_datetime) VALUES ";
				$sql .=implode(',', $sqlItems);
				$sql .=" ON DUPLICATE KEY UPDATE title = VALUES(title),
										url_key = VALUES(url_key),
										content = VALUES(content),
										avatar_url = VALUES(avatar_url),
										updated_datetime = NOW() ";
				$res = Yii::app()->db->createCommand($sql)->execute();
				echo $res?'success':'fail';
			}
		}catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	private function getUrlCrawlCategory()
	{
		$sql = "select * from tbl_crawl_category_url";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	private function getUrlCrawlDetail()
	{
		$sql = "select * from tbl_crawl_url";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
}