<?php

/**
 * This is the model class for table "{{time}}".
 *
 * The followings are the available columns in table '{{time}}':
 * @property integer $time_id
 * @property integer $time_year
 * @property integer $time_month
 * @property integer $time_day
 * @property string $time_time
 */
class Time extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Time the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{time}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('time_year, time_month, time_day, time_time', 'required'),
            array('time_year, time_month, time_day', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('time_id, time_year, time_month, time_day, time_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'time_id' => 'Time',
            'time_year' => 'Time Year',
            'time_month' => 'Time Month',
            'time_day' => 'Time Day',
            'time_time' => 'Time Time',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('time_id', $this->time_id);
        $criteria->compare('time_year', $this->time_year);
        $criteria->compare('time_month', $this->time_month);
        $criteria->compare('time_day', $this->time_day);
        $criteria->compare('time_time', $this->time_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function setTime() {
        $time2012 = '2012-01-01';
        $time2020 = '2020-01-01';
        $day = (strtotime($time2020) - strtotime($time2012)) / 3600 / 24;
        for ($i = 0; $i <= $day; $i++) {
            $date = Statistic::returnStatisticTimeToday($i);
            $time = new Time();
            $time->time_year = $date['Y'];
            $time->time_month = $date['m'];
            $time->time_day = $date['d'];
            $time->time_time = $date['time'];
            $time->save();
        }
    }

    public static function getTime($time='2012', $timeType='month', $show='12') {
        $timeStart = $time . '-01-01';
        $timeEnd = $time . '-12-31';
        $sql = 'select * from syo_time where time_time>="' . $timeStart . '" AND time_time<="' . $timeEnd . '"';
        $timeResult = Yii::app()->db->createCommand($sql)->queryAll();
        $time = array();
        if ($timeResult) {
            foreach ($timeResult as $key => $value) {
                if ($timeType == 'year') {
                    $time[] = $value['time_year'];
                    $time=array_flip(array_flip($time));
                } else if ($timeType == 'day') {
                    $timeString = $value['time_year'] . '-' . $value['time_month'] . '-' . $value['time_day'];
                    $time[] = $timeString;
                    $time = array_flip(array_flip($time));
                } else {
                    $timeString = $value['time_year'] . '-' . $value['time_month'];
                    $time[] = $timeString;
                    $time = array_flip(array_flip($time));
                }
            }
        }
        if($time){
            foreach ($time as $key => $value){
                $timeReturn[]=$value;
            }
        }
        return $timeReturn;
    }
    
    public static function getTimeByState(){
        $year=Yii::app()->user->getState('year');
        if(!$year){
            $year=date('Y');
        }
        return $year;
    } 

}