<?php

Yii::import('common.models.db.CrawlUrlModel');

class WebCrawlUrlModel extends CrawlUrlModel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}