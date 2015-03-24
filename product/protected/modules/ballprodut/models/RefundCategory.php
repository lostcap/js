<?php

/**
 * This is the model class for table "{{refund_category}}".
 *
 * The followings are the available columns in table '{{refund_category}}':
 * @property integer $refund_category_id
 * @property string $refund_category_name
 * @property integer $refund_category_root
 */
class RefundCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RefundCategory the static model class
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
		return '{{refund_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('refund_category_name, refund_category_root', 'required'),
			array('refund_category_root', 'numerical', 'integerOnly'=>true),
			array('refund_category_name', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('refund_category_id, refund_category_name, refund_category_root', 'safe', 'on'=>'search'),
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
			'refund_category_id' => 'Refund Category',
			'refund_category_name' => 'Refund Category Name',
			'refund_category_root' => 'Refund Category Root',
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

		$criteria->compare('refund_category_id',$this->refund_category_id);
		$criteria->compare('refund_category_name',$this->refund_category_name,true);
		$criteria->compare('refund_category_root',$this->refund_category_root);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}