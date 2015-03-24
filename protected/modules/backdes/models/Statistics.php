<?php

/**
 * This is the model class for table "{{statistics}}".
 *
 * The followings are the available columns in table '{{statistics}}':
 * @property string $statistics_id
 * @property string $statistics_category_id
 * @property string $statistics_views
 * @property string $statistics_ip
 * @property string $statistics_yesterday_ip
 * @property string $statistics_day_ip
 * @property string $statistics_week_ip
 * @property string $statistics_month_ip
 * @property string $statistics_yesterday_views
 * @property string $statistics_day_views
 * @property string $statistics_week_views
 * @property string $statistics_month_views
 * @property string $statistics_update_time
 */
class Statistics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Statistics the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{statistics}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('statistics_category_id, statistics_views, statistics_ip, statistics_yesterday_ip, statistics_day_ip, statistics_week_ip, statistics_month_ip, statistics_yesterday_views, statistics_day_views, statistics_week_views, statistics_month_views, statistics_update_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('statistics_id, statistics_category_id, statistics_views, statistics_ip, statistics_yesterday_ip, statistics_day_ip, statistics_week_ip, statistics_month_ip, statistics_yesterday_views, statistics_day_views, statistics_week_views, statistics_month_views, statistics_update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'statistics_id' => 'Statistics',
			'statistics_category_id' => 'Statistics Category',
			'statistics_views' => 'Statistics Views',
			'statistics_ip' => 'Statistics Ip',
			'statistics_yesterday_ip' => 'Statistics Yesterday Ip',
			'statistics_day_ip' => 'Statistics Day Ip',
			'statistics_week_ip' => 'Statistics Week Ip',
			'statistics_month_ip' => 'Statistics Month Ip',
			'statistics_yesterday_views' => 'Statistics Yesterday Views',
			'statistics_day_views' => 'Statistics Day Views',
			'statistics_week_views' => 'Statistics Week Views',
			'statistics_month_views' => 'Statistics Month Views',
			'statistics_update_time' => 'Statistics Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('statistics_id',$this->statistics_id,true);
		$criteria->compare('statistics_category_id',$this->statistics_category_id,true);
		$criteria->compare('statistics_views',$this->statistics_views,true);
		$criteria->compare('statistics_ip',$this->statistics_ip,true);
		$criteria->compare('statistics_yesterday_ip',$this->statistics_yesterday_ip,true);
		$criteria->compare('statistics_day_ip',$this->statistics_day_ip,true);
		$criteria->compare('statistics_week_ip',$this->statistics_week_ip,true);
		$criteria->compare('statistics_month_ip',$this->statistics_month_ip,true);
		$criteria->compare('statistics_yesterday_views',$this->statistics_yesterday_views,true);
		$criteria->compare('statistics_day_views',$this->statistics_day_views,true);
		$criteria->compare('statistics_week_views',$this->statistics_week_views,true);
		$criteria->compare('statistics_month_views',$this->statistics_month_views,true);
		$criteria->compare('statistics_update_time',$this->statistics_update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}