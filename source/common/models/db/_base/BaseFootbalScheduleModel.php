<?php

/**
 * This is the model base class for the table "footbal_schedule".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "FootbalScheduleModel".
 *
 * Columns in table "footbal_schedule" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $api_id
 * @property integer $GroupId
 * @property string $IsLatestMatch
 * @property integer $RoundId
 * @property string $RoundName
 * @property string $Status
 * @property string $SubStatus
 * @property string $StatusCode
 * @property string $CurrentStatus
 * @property string $Result
 * @property string $HasPenaltyShootOut
 * @property string $PoolName
 * @property string $HomeTeam
 * @property string $AwayTeam
 * @property string $homeTeamPrediction
 * @property string $awayTeamPrediction
 * @property string $drawPrediction
 * @property string $homeTeamPredictedGoals
 * @property string $awayTeamPredictedGoals
 * @property string $Venue
 * @property integer $WinnerId
 * @property string $StartDateTime
 * @property string $StartDateTimeUTC
 * @property string $SeriesName
 * @property integer $league_id
 * @property string $session_league
 * @property string $created_datetime
 * @property string $updated_datetime
 *
 */
abstract class BaseFootbalScheduleModel extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'footbal_schedule';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'FootbalScheduleModel|FootbalScheduleModels', $n);
	}

	public static function representingColumn() {
		return 'IsLatestMatch';
	}

	public function rules() {
		return array(
			array('id', 'required'),
			array('id, api_id, GroupId, RoundId, WinnerId, league_id', 'numerical', 'integerOnly'=>true),
			array('IsLatestMatch', 'length', 'max'=>20),
			array('RoundName, Status, SubStatus, Result, homeTeamPrediction, awayTeamPrediction, drawPrediction, homeTeamPredictedGoals, awayTeamPredictedGoals, StartDateTime, StartDateTimeUTC, SeriesName, session_league', 'length', 'max'=>100),
			array('StatusCode', 'length', 'max'=>5),
			array('CurrentStatus', 'length', 'max'=>50),
			array('HasPenaltyShootOut, PoolName', 'length', 'max'=>10),
			array('HomeTeam, AwayTeam, Venue, created_datetime, updated_datetime', 'safe'),
			array('api_id, GroupId, IsLatestMatch, RoundId, RoundName, Status, SubStatus, StatusCode, CurrentStatus, Result, HasPenaltyShootOut, PoolName, HomeTeam, AwayTeam, homeTeamPrediction, awayTeamPrediction, drawPrediction, homeTeamPredictedGoals, awayTeamPredictedGoals, Venue, WinnerId, StartDateTime, StartDateTimeUTC, SeriesName, league_id, session_league, created_datetime, updated_datetime', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, api_id, GroupId, IsLatestMatch, RoundId, RoundName, Status, SubStatus, StatusCode, CurrentStatus, Result, HasPenaltyShootOut, PoolName, HomeTeam, AwayTeam, homeTeamPrediction, awayTeamPrediction, drawPrediction, homeTeamPredictedGoals, awayTeamPredictedGoals, Venue, WinnerId, StartDateTime, StartDateTimeUTC, SeriesName, league_id, session_league, created_datetime, updated_datetime', 'safe', 'on'=>'search'),
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
			'api_id' => Yii::t('app', 'Api'),
			'GroupId' => Yii::t('app', 'Group'),
			'IsLatestMatch' => Yii::t('app', 'Is Latest Match'),
			'RoundId' => Yii::t('app', 'Round'),
			'RoundName' => Yii::t('app', 'Round Name'),
			'Status' => Yii::t('app', 'Status'),
			'SubStatus' => Yii::t('app', 'Sub Status'),
			'StatusCode' => Yii::t('app', 'Status Code'),
			'CurrentStatus' => Yii::t('app', 'Current Status'),
			'Result' => Yii::t('app', 'Result'),
			'HasPenaltyShootOut' => Yii::t('app', 'Has Penalty Shoot Out'),
			'PoolName' => Yii::t('app', 'Pool Name'),
			'HomeTeam' => Yii::t('app', 'Home Team'),
			'AwayTeam' => Yii::t('app', 'Away Team'),
			'homeTeamPrediction' => Yii::t('app', 'Home Team Prediction'),
			'awayTeamPrediction' => Yii::t('app', 'Away Team Prediction'),
			'drawPrediction' => Yii::t('app', 'Draw Prediction'),
			'homeTeamPredictedGoals' => Yii::t('app', 'Home Team Predicted Goals'),
			'awayTeamPredictedGoals' => Yii::t('app', 'Away Team Predicted Goals'),
			'Venue' => Yii::t('app', 'Venue'),
			'WinnerId' => Yii::t('app', 'Winner'),
			'StartDateTime' => Yii::t('app', 'Start Date Time'),
			'StartDateTimeUTC' => Yii::t('app', 'Start Date Time Utc'),
			'SeriesName' => Yii::t('app', 'Series Name'),
			'league_id' => Yii::t('app', 'League'),
			'session_league' => Yii::t('app', 'Session League'),
			'created_datetime' => Yii::t('app', 'Created Datetime'),
			'updated_datetime' => Yii::t('app', 'Updated Datetime'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('api_id', $this->api_id);
		$criteria->compare('GroupId', $this->GroupId);
		$criteria->compare('IsLatestMatch', $this->IsLatestMatch, true);
		$criteria->compare('RoundId', $this->RoundId);
		$criteria->compare('RoundName', $this->RoundName, true);
		$criteria->compare('Status', $this->Status, true);
		$criteria->compare('SubStatus', $this->SubStatus, true);
		$criteria->compare('StatusCode', $this->StatusCode, true);
		$criteria->compare('CurrentStatus', $this->CurrentStatus, true);
		$criteria->compare('Result', $this->Result, true);
		$criteria->compare('HasPenaltyShootOut', $this->HasPenaltyShootOut, true);
		$criteria->compare('PoolName', $this->PoolName, true);
		$criteria->compare('HomeTeam', $this->HomeTeam, true);
		$criteria->compare('AwayTeam', $this->AwayTeam, true);
		$criteria->compare('homeTeamPrediction', $this->homeTeamPrediction, true);
		$criteria->compare('awayTeamPrediction', $this->awayTeamPrediction, true);
		$criteria->compare('drawPrediction', $this->drawPrediction, true);
		$criteria->compare('homeTeamPredictedGoals', $this->homeTeamPredictedGoals, true);
		$criteria->compare('awayTeamPredictedGoals', $this->awayTeamPredictedGoals, true);
		$criteria->compare('Venue', $this->Venue, true);
		$criteria->compare('WinnerId', $this->WinnerId);
		$criteria->compare('StartDateTime', $this->StartDateTime, true);
		$criteria->compare('StartDateTimeUTC', $this->StartDateTimeUTC, true);
		$criteria->compare('SeriesName', $this->SeriesName, true);
		$criteria->compare('league_id', $this->league_id);
		$criteria->compare('session_league', $this->session_league, true);
		$criteria->compare('created_datetime', $this->created_datetime, true);
		$criteria->compare('updated_datetime', $this->updated_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}