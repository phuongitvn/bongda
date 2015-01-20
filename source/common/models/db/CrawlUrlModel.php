<?php

Yii::import('common.models.db._base.BaseCrawlUrlModel');

class CrawlUrlModel extends BaseCrawlUrlModel
{
const ACTIVE=1;
const DEACTIVE=2;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}