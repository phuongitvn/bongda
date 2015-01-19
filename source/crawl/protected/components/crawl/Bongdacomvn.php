<?php
Yii::import('application.components.crawl.DataCrawl');
class Bongdacomvn extends DataCrawl
{
	public function __construct($config)
	{
		$config = array(
				'title_pattern'=>'#main-content .post-inner h1',
				'content_pattern'=>'#main-content .post-inner .entry',
				'remove_pattern'=>'.widget-top|.widget-container|.post-source|.text-html-box|.letsop-ads-mobile|#disqus_thread|script',
				'imgavatar_pattern'=>'.art_content img'
		);
		parent::__construct($config);
		
	}
	public function test()
	{
		echo '<pre>';print_r($this->config);
	}
	protected function beforeGetContent()
	{
		parent::beforeGetContent();
		//$modify = $this->html->find("#main-content .post-inner .entry img",0);
		foreach ($this->html->find("#main-content .post-inner .entry img") as $e){
			$src = 'data-src';
			$e->src = $e->$src;
		}
		foreach($this->html->find("#main-content .post-inner .entry .wp-caption") as $e){
			$e->style='';
		}
		/* if($modify){
			$src = $this->getFirstImage();
			if(strpos($src, 'http')===false){
				$modify->src = 'http://www.bongda.com.vn/'.$src;
			}
		} */
	}
	/* public function setUrl($url)
	{
		$this->url = $url;
		$this->html = file_get_html($this->url);
		$this->removeElements();
	}
	public function getTitle()
	{
		$title = $this->html->find(".art_title h3",0)->plaintext;
		return $title;
	}
	public function getContentBody()
	{
		$this->html->find(".art_content img",0)->src = 'http://bongdaso.com'.$this->getImageThumb();
		$contentBody = $this->html->find(".art_content",0)->outertext;
		return $contentBody;
	}
	public function getImageThumb()
	{
		$imageUrl = $this->html->find(".art_content img",0)->getAttribute('src');
		return $imageUrl;
	}
	private function removeElements()
	{
		$this->html->find(".art_center_banner",0)->outertext = '';//remove banner in article
	} */
}