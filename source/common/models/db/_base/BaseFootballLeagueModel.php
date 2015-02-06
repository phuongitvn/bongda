<?php

/**
 * This is the model base class for the table "football_league".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "FootballLeagueModel".
 *
 * Columns in table "football_league" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 * @property string $flag
 * @property string $created_datetime
 *
 */
abstract class BaseFootballLeagueModel extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'football_league';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'FootballLeagueModel|FootballLeagueModels', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('country_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('flag', 'length', 'max'=>10),
			array('created_datetime', 'safe'),
			array('name, country_id, flag, created_datetime', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, country_id, flag, created_datetime', 'safe', 'on'=>'search'),
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
			'country_id' => Yii::t('app', 'Country'),
			'flag' => Yii::t('app', 'Flag'),
			'created_datetime' => Yii::t('app', 'Created Datetime'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('country_id', $this->country_id);
		$criteria->compare('flag', $this->flag, true);
		$criteria->compare('created_datetime', $this->created_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}