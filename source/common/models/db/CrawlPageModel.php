<?php

Yii::import('common.models.db._base.BaseCrawlPageModel');

class CrawlPageModel extends BaseCrawlPageModel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}