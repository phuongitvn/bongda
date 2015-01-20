<?php

Yii::import('common.models.db._base.BaseCrawlUrlModel');

class CrawlUrlModel extends BaseCrawlUrlModel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}