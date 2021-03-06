<?php

/**
 * This is the model class for table "{{payment}}".
 *
 * The followings are the available columns in table '{{payment}}':
 * @property integer $payment_id
 * @property string $payment_name
 * @property string $payment_username
 * @property integer $payment_test
 */
class Payment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return '{{payment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_name, payment_username, payment_test', 'required'),
			array('payment_test', 'numerical', 'integerOnly'=>true),
			array('payment_name', 'length', 'max'=>20),
			array('payment_username', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('payment_id, payment_name, payment_username, payment_test', 'safe', 'on'=>'search'),
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
			'payment_id' => 'Payment',
			'payment_name' => 'Payment Name',
			'payment_username' => 'Payment Username',
			'payment_test' => 'Payment Test',
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

		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('payment_name',$this->payment_name,true);
		$criteria->compare('payment_username',$this->payment_username,true);
		$criteria->compare('payment_test',$this->payment_test);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}