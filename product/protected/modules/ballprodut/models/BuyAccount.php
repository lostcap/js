<?php

/**
 * This is the model class for table "seo.{{buy_account}}".
 *
 * The followings are the available columns in table 'seo.{{buy_account}}':
 * @property integer $account_id
 * @property string $account_attribute
 * @property string $account_user
 * @property string $account_password
 * @property string $account_promo_code
 * @property string $account_note
 * @property string $account_address
 */
class BuyAccount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BuyAccount the static model class
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
		return '{{buy_account}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_user, account_password', 'required'),
			array('account_attribute, account_user, account_password, account_promo_code, account_address', 'length', 'max'=>255),
			array('account_note', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('account_id, account_attribute, account_user, account_password, account_promo_code, account_note, account_address', 'safe', 'on'=>'search'),
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
			'account_id' => 'ID ',
			'account_attribute' => '类型 ',
			'account_user' => '账号 ',
			'account_password' => '密码 ',
			'account_promo_code' => '优惠 ',
			'account_note' => '备注 ',
			'account_address' => '网址 ',
		);
	}

        
            public function getAccount(){
            $account=array();
            if($model=BuyAccount::model()->findAll()){
                foreach($model as $key){
                    $account[$key->account_id]=$key->account_attribute;
                }
                return $account;
            }
            return array(0=>'思亿欧');
            
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

		$criteria->compare('account_id',$this->account_id);
                
		$criteria->compare('account_attribute',$this->account_attribute,true);

		$criteria->compare('account_user',$this->account_user,true);

		$criteria->compare('account_password',$this->account_password,true);

		$criteria->compare('account_promo_code',$this->account_promo_code,true);

		$criteria->compare('account_note',$this->account_note,true);

		$criteria->compare('account_address',$this->account_address,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getBuyAccount($name){
            $buyAccount=BuyAccount::model()->findByAttributes(array('account_attribute'=>$name));
            if($buyAccount){
                return $buyAccount->account_id;
            }  else {
                return 0;
            }
        }
}