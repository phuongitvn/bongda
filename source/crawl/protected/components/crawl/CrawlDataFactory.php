<?php
Yii::import('application.components.crawl.BongdasoData');
class CrawlDataFactory
{
	//
	public static function makeDataCrawl($site, $config=array())
	{
		switch ($site)
		{
			case 'bds':
				$data = new BongdasoData($config);
				break;
			case 'bd24h':
				$data = new Bongda24h($config);
				break;
			default:
				$data = NULL;
				break;
		}
		return $data;
	}
}