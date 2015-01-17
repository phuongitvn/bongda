<?php

Yii::import('common.models.db._base.BaseCrawlContentModel');

class CrawlContentModel extends BaseCrawlContentModel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}