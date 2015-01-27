<?php

Yii::import('common.models.db.CrawlPageModel');

class WebCrawlPageModel extends CrawlPageModel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}