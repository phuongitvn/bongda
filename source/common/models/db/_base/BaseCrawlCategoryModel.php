<?php

/**
 * This is the model base class for the table "{{crawl_category}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CrawlCategoryModel".
 *
 * Columns in table "{{crawl_category}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $url_key
 * @property string $site
 * @property integer $status
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property integer $created_by
 *
 */
abstract class BaseCrawlCategoryModel extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{crawl_category}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'CrawlCategoryModel|CrawlCategoryModels', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('status, created_by', 'numerical', 'integerOnly'=>true),
			array('name, url_key, site', 'length', 'max'=>255),
			array('created_datetime, updated_datetime', 'safe'),
			array('name, url_key, site, status, created_datetime, updated_datetime, created_by', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, url_key, site, status, created_datetime, updated_datetime, created_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'url_key' => Yii::t('app', 'Url Key'),
			'site' => Yii::t('app', 'Site'),
			'status' => Yii::t('app', 'Status'),
			'created_datetime' => Yii::t('app', 'Created Datetime'),
			'updated_datetime' => Yii::t('app', 'Updated Datetime'),
			'created_by' => Yii::t('app', 'Created By'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('url_key', $this->url_key, true);
		$criteria->compare('site', $this->site, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('created_datetime', $this->created_datetime, true);
		$criteria->compare('updated_datetime', $this->updated_datetime, true);
		$criteria->compare('created_by', $this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}