<?php

/**
 * This is the model class for table "seo.{{domain_attribute}}".
 *
 * The followings are the available columns in table 'seo.{{domain_attribute}}':
 * @property integer $attribute_id
 * @property string $attribute_name
 */
class DomainAttribute extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DomainAttribute the static model class
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
		return '{{domain_attribute}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attribute_name', 'required'),
			array('attribute_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attribute_id, attribute_name', 'safe', 'on'=>'search'),
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

        
        public function getDomainAttribute(){
            $attribute=array();
            if($model=DomainAttribute::model()->findAll()){
                foreach($model as $key){
                    $attribute[$key->attribute_id]=$key->attribute_name;
                }
                return $attribute;
            }
            return array(0=>'思亿欧');
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attribute_id' => '属性 ID',
			'attribute_name' => '属性名称',
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

		$criteria->compare('attribute_id',$this->attribute_id);

		$criteria->compare('attribute_name',$this->attribute_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}