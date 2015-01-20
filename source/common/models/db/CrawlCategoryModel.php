<?php

Yii::import('common.models.db._base.BaseCrawlCategoryModel');

class CrawlCategoryModel extends BaseCrawlCategoryModel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}