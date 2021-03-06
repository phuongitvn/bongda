<?php

/**
 * This is the model base class for the table "{{crawl_page}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CrawlPageModel".
 *
 * Columns in table "{{crawl_page}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $category
 * @property string $html
 * @property string $description
 * @property integer $ordering
 * @property string $pattern_main
 * @property string $created_datetime
 * @property string $updated_datetime
 *
 */
abstract class BaseCrawlPageModel extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{crawl_page}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'CrawlPageModel|CrawlPageModels', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, html', 'required'),
			array('ordering', 'numerical', 'integerOnly'=>true),
			array('name, url, description', 'length', 'max'=>255),
			array('category, pattern_main', 'length', 'max'=>100),
			array('created_datetime, updated_datetime', 'safe'),
			array('url, category, description, ordering, pattern_main, created_datetime, updated_datetime', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, url, category, html, description, ordering, pattern_main, created_datetime, updated_datetime', 'safe', 'on'=>'search'),
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
			'url' => Yii::t('app', 'Url'),
			'category' => Yii::t('app', 'Category'),
			'html' => Yii::t('app', 'Html'),
			'description' => Yii::t('app', 'Description'),
			'ordering' => Yii::t('app', 'Ordering'),
			'pattern_main' => Yii::t('app', 'Pattern Main'),
			'created_datetime' => Yii::t('app', 'Created Datetime'),
			'updated_datetime' => Yii::t('app', 'Updated Datetime'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('category', $this->category, true);
		$criteria->compare('html', $this->html, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('ordering', $this->ordering);
		$criteria->compare('pattern_main', $this->pattern_main, true);
		$criteria->compare('created_datetime', $this->created_datetime, true);
		$criteria->compare('updated_datetime', $this->updated_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}