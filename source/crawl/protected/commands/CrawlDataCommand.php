<?php
ini_set('max_execution_time', 300);
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
			//bongdaso.com
			/* foreach ($html->find("#thirdbox_double ._title_ h1 a") as $e){
				$url = $e->href;
				$checkIsset = $this->issetUrl($url);
				if(!$checkIsset){
					$title = $e->plaintext;
					$imgAvatar = $html->find("#thirdbox_double .foto_news_foto img", $i)->src;
					$key = time().'_'.$i;
					$filePath = helper::downloadAvatar($imgAvatar, $key);
					$sqlItems[] = "('".$url."','".$title."','".$urlCat['category_id']."','".$urlCat['site']."', NOW(), NOW(), '".$filePath."',3)";
				}
				$i++;
				echo 'Crawl success |'.$url."\n";
			} */
			//bongda.com.vn
			if($urlCat['site']=='http://www.bongda.com.vn'){
			foreach ($html->find(".post-listing article.item-list h2 a") as $e){
				echo $i;
				$url = $e->href;
				$checkIsset = $this->issetUrl($url);
				if(!$checkIsset){
					$title = trim(addslashes($e->plaintext));
					$src = 'data-src';
					$imgAvatar = $html->find(".post-listing article.item-list .post-thumbnail a noscript img", $i);
					if(is_object($imgAvatar)){
						$imgAvatar = $imgAvatar->src;
					}else{
						$imgAvatar = '';
					}
					echo $imgAvatar;
					echo "\n";
					$key = time().'_'.$i;
					$filePath = helper::downloadAvatar($imgAvatar, $key);
					$introText = $html->find(".post-listing article.item-list .entry .excerpt")->innerText;
					$introText = str_replace('BongDa.com.vn', 'BongDa8.mobi', $introText);
					$introText = trim(addslashes($introText));
					$sqlItems[] = "('".$url."','".$title."','".$introText."','".$urlCat['category_id']."','".$urlCat['site']."', NOW(), NOW(), '".$filePath."',3)";
				}else{
					echo 'isset';
				}
				$i++;
				echo 'Crawl success |'.$url."\n";
			}
			}
			
			if(count($sqlItems)){
				for ($i=count($sqlItems)-1;$i>=0;$i--){
					$sqlItemsSort[] = $sqlItems[$i];
				}
				$sql = "INSERT INTO tbl_crawl_url(url, name, intro_text, category_id, site, created_datetime, updated_datetime, avatar_path, status) VALUES";
				$sql .=implode(',', $sqlItemsSort);
				$sql .=" ON DUPLICATE KEY UPDATE updated_datetime = NOW() ";
				$res = Yii::app()->db->createCommand($sql)->execute();
			}
			//xu ly lai anh thumb
			$list = $this->getUrlCrawlDetail(3);
			if($list){
				$fileSystem = new Filesystem();
				$fileUpdate = array();
				$fileUpdateError = array();
				foreach ($list as $item){
					$fileSource = SITE_PATH.DS.'storage'.DS.str_replace('/', DS, $item['avatar_path']);
						
					if (file_exists($fileSource)) {
						echo 'exists '.$fileSource."\n";
						$parseFilePath = explode('/', $item['avatar_path']);
						$parseFileName = explode('.', $parseFilePath[count($parseFilePath)-1]);
						$fileExt = $parseFileName[count($parseFileName)-1];
						$fileDest = SITE_PATH.DS.'storage'.DS.$parseFilePath[0].DS.$parseFilePath[1].DS.$item['id'].'.'.$fileExt;
						echo "\n";
						list($width, $height) = getimagesize($fileSource);
						$imgCrop = new ImageCrop($fileSource, 0, 0, $width, $height);
						$desWidth = $desHeight = 120;
						//$imgCrop->resizeRatio($fileDest, $desWidth, $desHeight, 100);
						$crop = $imgCrop->resizeCrop($fileDest, $desWidth, $desHeight, 100);
						if(!$crop) continue;
						$fileSystem->remove($fileSource);
						if(file_exists($fileDest)){
							$fileUpdate[$item['id']] = $parseFilePath[0].'/'.$parseFilePath[1].'/'.$item['id'].'.'.$fileExt;
						}
					}else{
						echo 'not exists '.$fileSource."\n";
						$fileUpdateError[] = $item['id'];
					}
				}
				if(count($fileUpdate)>0){
					//echo '<pre>';print_r($fileUpdate);
					foreach ($fileUpdate as $key => $value){
						$sql = "UPDATE tbl_crawl_url SET avatar_path='$value',status=0 WHERE id=$key";
						Yii::app()->db->createCommand($sql)->execute();
					}
				}
				if(count($fileUpdateError)>0){
					foreach ($fileUpdateError as $key => $value){
						$sql = "UPDATE tbl_crawl_url SET status=2 WHERE id=$value";
						Yii::app()->db->createCommand($sql)->execute();
					}
				}
			}
			//end xu ly lai anh thumb
			
			/* $sql .=" ON DUPLICATE KEY UPDATE name = VALUES(name),
										 url = VALUES(url),
										category_id = VALUES(category_id),
										site = VALUES(site),
										avatar_path = VALUES(avatar_path),
										updated_datetime = NOW() "; */
		}
		
	}
	public function actionPage()
	{
		include dirname(__FILE__).'/../components/crawl/simple_html_dom.php';
		$sql = "select * from tbl_crawl_page";
		$data = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($data as $key => $item){
			echo $url = urldecode($item['url']);
			echo "\n";
			$html = file_get_html($url);
			if(!$html) continue;
			foreach ($html->find("a") as $e)
			{
				$innerText = $e->plaintext;
				$e->href = '#';
			}
			foreach ($html->find("td.col_detail") as $e)
			{
				$e->outertext = '';
			}
			if($item['description']=='rank'){
				$domRemove = array('col_won','col_played_away','col_goals','col_goal_againsts','col_played_home','col_draw','col_lost');
				$html->find("thead tr th.col_no",0)->innertext='#';
				$html->find("thead tr th.col_team",0)->innertext='Đội';
				$html->find("thead tr th.col_played",0)->innertext='Trận';
				$html->find("thead tr th.col_goal_diffs",0)->innertext='Hệ số';
				$html->find("thead tr th.col_points",0)->innertext='Điểm';
				
				foreach ($domRemove as $dom){
					$html->find("thead tr th.$dom",0)->outertext='';
					foreach ($html->find("tbody tr td.$dom") as $e)
					{
						$e->outertext = '';
					}
				}
			}
			
			$pattern = $item['pattern_main'];
			$html = $html->find("$pattern",0)->outertext;
			$sql = "update tbl_crawl_page
					set html=:html, updated_datetime=NOW()
					where id=:id";
			$command = Yii::app()->db->createCommand($sql);
			$command->bindParam(':html', $html, PDO::PARAM_STR);
			$command->bindParam(':id', $item['id'], PDO::PARAM_STR);
			$res = $command->execute();
			if($res) echo 'update success';
		}
	}
	public function actionView()
	{
		$connection=Yii::app()->db;
		$transaction=$connection->beginTransaction();
		try{
			$viewUrlList = $this->getUrlCrawlDetail(0);
			if($viewUrlList){
				$data = CrawlDataFactory::makeDataCrawl('bdcv');
				$listUrl = array();
				$sqlItems = array();
				$errorItems = array();
				foreach ($viewUrlList as $item){
					//$url = $item['site'].'/'.$item['url'];
					$url = $item['url'];
					echo '---Start crawl detail from: '.$url.'---'."\n";
					$set = $data->setUrl($url);
					if(!$set){ 
						$errorItems[]=$item['id'];
						continue;
					}
					$title = addslashes($data->getTitle());
					
					$urlKey = helper::makeFriendlyUrl($title);
					$content = addslashes($data->getContentBody());
					$author = $data->getAuthor();
					$introText = $item['intro_text'];
					//$urlImage = $data->getImageThumb();
					$sqlItems[] = "('{$item['id']}','$title','$introText','$urlKey','$content','{$item['avatar_path']}','{$author}',NOW(),NOW())";
					$listUrl[]=$item['id'];
				}
				if(count($sqlItems)>0){
					$sql1 = "INSERT INTO tbl_crawl_content(url_id,title,intro_text,url_key,content,avatar_url,author,created_datetime,updated_datetime) VALUES ";
					$sql1 .=implode(',', $sqlItems);
					$sql1 .=" ON DUPLICATE KEY UPDATE updated_datetime = NOW() ";
					$res = $connection->createCommand($sql1)->execute();
				}
				if(count($errorItems)>0){
					$sql2 = "UPDATE tbl_crawl_url SET status=2 WHERE id IN(".implode(',', $errorItems).")";
					$res = $connection->createCommand($sql2)->execute();
				}
				$sql2 = "UPDATE tbl_crawl_url SET status=1 WHERE id IN(".implode(',', $listUrl).")";
				$res = $connection->createCommand($sql2)->execute();
				$transaction->commit();
			}else{
				echo 'have not any url to crawl';
			}
			
			echo 'success';
		}catch (Exception $e)
		{
			echo $e->getMessage();
			$transaction->rollback();
		}
	}
	private function getUrlCrawlCategory()
	{
		$sql = "select * from tbl_crawl_category_url";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	private function getUrlCrawlDetail($status=0)
	{
		$sql = "select * from tbl_crawl_url where status=:status limit 100";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':status', $status, PDO::PARAM_STR);
		return $command->queryAll();
	}
	private function issetUrl($url){
		$sql = "SELECT count(id) as total FROM tbl_crawl_url WHERE url=:url";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':url', $url, PDO::PARAM_STR);
		$result = $command->queryScalar();
		return $result>0?true:false;
	}
}