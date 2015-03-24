<?php

/**
 * This is the model class for table "seo.{{domain_user}}".
 *
 * The followings are the available columns in table 'seo.{{domain_user}}':
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $user_password
 */
class DomainUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DomainUser the static model class
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
		return '{{domain_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name', 'required'),
			array('user_name, user_email, user_password', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_name, user_email, user_password', 'safe', 'on'=>'search'),
		);
	}

        public function getDomainUser(){
            $domainUser=array();
            if($model=DomainUser::model()->findAll()){
                foreach($model as $key){
                    $domainUser[$key->user_id]=$key->user_name;
                }
                return $domainUser;
            }
            return array(0=>'思亿欧');
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
			'user_id' => '用户ID',
			'user_name' => '用户名',
			'user_email' => '用户邮箱',
			'user_password' => '用户密码',
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

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('user_name',$this->user_name,true);

		$criteria->compare('user_email',$this->user_email,true);

		$criteria->compare('user_password',$this->user_password,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}