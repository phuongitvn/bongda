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
					$sqlItems[] = "('".$url."','".$title."','".$urlCat['category_id']."','".$urlCat['site']."', NOW(), NOW(), '".$filePath."',3)";
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
				$sql = "INSERT INTO tbl_crawl_url(url, name, category_id, site, created_datetime, updated_datetime, avatar_path, status) VALUES";
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
						$imgCrop->resizeCrop($fileDest, $desWidth, $desHeight, 100);
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
	public function actionView()
	{
		$connection=Yii::app()->db;
		$transaction=$connection->beginTransaction();
		try{
			$viewUrlList = $this->getUrlCrawlDetail(0);
			if($viewUrlList){
				$data = CrawlDataFactory::makeDataCrawl('bdcv');
				$listUrl = array();
				foreach ($viewUrlList as $item){
					//$url = $item['site'].'/'.$item['url'];
					$url = $item['url'];
					echo '---Start crawl detail from: '.$url.'---'."\n";
					$data->setUrl($url);
					$title = addslashes($data->getTitle());
					
					$urlKey = helper::makeFriendlyUrl($title);
					$content = addslashes($data->getContentBody());
					$author = $data->getAuthor();
					//$urlImage = $data->getImageThumb();
					$sqlItems[] = "('{$item['id']}','$title','$urlKey','$content','{$item['avatar_path']}',NOW(),NOW(),'{$author}')";
					$listUrl[]=$item['id'];
				}
				$sql1 = "INSERT INTO tbl_crawl_content(url_id,title,url_key,content,avatar_url,created_datetime,updated_datetime,from) VALUES ";
				$sql1 .=implode(',', $sqlItems);
				$sql1 .=" ON DUPLICATE KEY UPDATE updated_datetime = NOW() ";
				$res = $connection->createCommand($sql1)->execute();
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