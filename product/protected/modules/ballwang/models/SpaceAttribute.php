<?php

/**
 * This is the model class for table "seo.{{space_attribute}}".
 *
 * The followings are the available columns in table 'seo.{{space_attribute}}':
 * @property integer $space_id
 * @property string $space_name
 * @property string $space_address
 */
class SpaceAttribute extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SpaceAttribute the static model class
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
		return '{{space_attribute}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('space_name, space_address', 'required'),
			array('space_name, space_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('space_id, space_name, space_address', 'safe', 'on'=>'search'),
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
			'space_id' => '空间 ID',
			'space_name' => '空间名称',
			'space_address' => '空间地址',
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

		$criteria->compare('space_id',$this->space_id);

		$criteria->compare('space_name',$this->space_name,true);

		$criteria->compare('space_address',$this->space_address,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        
        public function getSpaceAttribute(){
            $attribute=array();
            if($modle=SpaceAttribute::model()->findAll()){
                foreach($modle as $key){
                    $attribute[$key->space_id]=$key->space_name;
                }
                return $attribute;    
            }
            return array('0'=>'思亿欧');
        }
}