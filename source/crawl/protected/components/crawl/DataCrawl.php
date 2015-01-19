<?php
Yii::import('application.components.crawl.AbstractDataCrawl');
class DataCrawl extends AbstractDataCrawl
{
	protected $url = '';
	protected $html = '';
	protected  $config = array();
	public function __construct($config)
	{
		$this->config = $config;
	}
	public function setUrl($url)
	{
		$this->url = $url;
		$this->html = file_get_html($this->url);
		$this->removeElements();
	}
	public function getTitle()
	{
		if(!isset($this->config['title_pattern']) || empty($this->config['title_pattern'])){
			throw new Exception('Title pattern is empty', 606);
		}
		$titleParttern = $this->config['title_pattern'];
		$title = $this->html->find("$titleParttern",0)->plaintext;
		return $title;
	}
	public function getContentBody()
	{
		if(!isset($this->config['content_pattern']) || empty($this->config['content_pattern'])){
			throw new Exception('Content pattern is empty', 606);
		}
		$contentParttern = $this->config['content_pattern'];
		$this->beforeGetContent();
		$contentBody = $this->html->find("$contentParttern",0)->outertext;
		$this->afterGetContent();
		return $contentBody;
	}
	public function getFirstImage()
	{
		$imageUrl = '';
		if(isset($this->config['imgavatar_pattern']) || !empty($this->config['imgavatar_pattern'])){
			$avatarUrlPattern = $this->config['imgavatar_pattern'];
			$imageUrl = $this->html->find("$avatarUrlPattern",0)->getAttribute('src');
		}
		return $imageUrl;
	}
	protected function removeElements()
	{
		if(isset($this->config['remove_pattern']) || !empty($this->config['remove_pattern'])){
			$removePattern = explode('|', $this->config['remove_pattern']);
			foreach ($removePattern as $rpt){
				if($rpt!=''){
					foreach ($this->html->find("$rpt") as $e)
					{
						$e->outertext='';
					}
				}
			}
		}
		foreach ($this->html->find("a") as $e)
		{
			$innerText = $e->plaintext;
			//$e->outertext = $innerText;
			$e->href = '#';
		}
	}
	protected function beforeGetContent()
	{
		//
	}
	protected function afterGetContent()
	{
		//
	}
}