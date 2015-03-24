<?php

/**
 * This is the model class for table "{{member}}".
 *
 * The followings are the available columns in table '{{member}}':
 * @property string $member_id
 * @property string $member_username
 * @property string $member_password
 * @property string $member_nickname
 * @property string $member_email
 * @property integer $member_group_id
 * @property integer $member_message
 * @property string $member_mobile
 * @property string $member_register_date
 * @property string $member_last_login_date
 * @property string $member_register_ip
 * @property string $member_last_login_ip
 * @property integer $member_login_num_rand
 * @property integer $member_is_lock
 * @property integer $member_is_delete
 */
class Member extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
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
		return '{{member}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_nickname', 'required'),
			array('member_group_id, member_message, member_login_num_rand, member_is_lock, member_is_delete', 'numerical', 'integerOnly'=>true),
			array('member_username, member_nickname', 'length', 'max'=>20),
			array('member_password, member_email', 'length', 'max'=>32),
			array('member_mobile', 'length', 'max'=>11),
			array('member_register_date, member_last_login_date', 'length', 'max'=>10),
			array('member_register_ip, member_last_login_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('member_id, member_username, member_password, member_nickname, member_email, member_group_id, member_message, member_mobile, member_register_date, member_last_login_date, member_register_ip, member_last_login_ip, member_login_num_rand, member_is_lock, member_is_delete', 'safe', 'on'=>'search'),
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
			'member_id' => '用户ID',
			'member_username' => '账号',
			'member_password' => '密码',
			'member_nickname' => '昵称',
			'member_email' => '邮件',
			'member_group_id' => '分类ID',
			'member_message' => '消息',
			'member_mobile' => '手机号码',
			'member_register_date' => '注册时间',
			'member_last_login_date' => '最后登录时间',
			'member_register_ip' => '注册IP',
			'member_last_login_ip' => '最后登录IP',
			'member_login_num_rand' => '登录随机数',
			'member_is_lock' => '账号锁定',
			'member_is_delete' => '账号删除',
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

		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('member_username',$this->member_username,true);
		$criteria->compare('member_password',$this->member_password,true);
		$criteria->compare('member_nickname',$this->member_nickname,true);
		$criteria->compare('member_email',$this->member_email,true);
		$criteria->compare('member_group_id',$this->member_group_id);
		$criteria->compare('member_message',$this->member_message);
		$criteria->compare('member_mobile',$this->member_mobile,true);
		$criteria->compare('member_register_date',$this->member_register_date,true);
		$criteria->compare('member_last_login_date',$this->member_last_login_date,true);
		$criteria->compare('member_register_ip',$this->member_register_ip,true);
		$criteria->compare('member_last_login_ip',$this->member_last_login_ip,true);
		$criteria->compare('member_login_num_rand',$this->member_login_num_rand);
		$criteria->compare('member_is_lock',$this->member_is_lock);
		$criteria->compare('member_is_delete',$this->member_is_delete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}