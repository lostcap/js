<?php

/**
 * This is the model class for table "{{member_group}}".
 *
 * The followings are the available columns in table '{{member_group}}':
 * @property integer $member_group_id
 * @property string $member_group_name
 * @property integer $member_group_allow_message
 * @property integer $member_group_allow_visit
 * @property integer $member_group_allow_post
 * @property integer $member_group_allow_postverify
 * @property integer $member_group_allow_send_message
 * @property integer $member_group_allow_post_num
 * @property string $member_group_description
 * @property integer $member_group_sort
 * @property integer $member_group_is_delete
 */
class MemberGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberGroup the static model class
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
		return '{{member_group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_group_name, member_group_allow_postverify, member_group_allow_send_message, member_group_description', 'required'),
			array('member_group_allow_message, member_group_allow_visit, member_group_allow_post, member_group_allow_postverify, member_group_allow_send_message, member_group_allow_post_num, member_group_sort, member_group_is_delete', 'numerical', 'integerOnly'=>true),
			array('member_group_name', 'length', 'max'=>15),
			array('member_group_description', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('member_group_id, member_group_name, member_group_allow_message, member_group_allow_visit, member_group_allow_post, member_group_allow_postverify, member_group_allow_send_message, member_group_allow_post_num, member_group_description, member_group_sort, member_group_is_delete', 'safe', 'on'=>'search'),
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
			'member_group_id' => '用户组ID',
			'member_group_name' => '用户组姓名',
			'member_group_allow_message' => '允许接受信息',
			'member_group_allow_visit' => '允许浏览',
			'member_group_allow_post' => '允许发帖',
			'member_group_allow_postverify' => '发帖需验证',
			'member_group_allow_send_message' => '允许发送信息',
			'member_group_allow_post_num' => '最大发送量',
			'member_group_description' => '用户组描述',
			'member_group_sort' => '用户组排序',
			'member_group_is_delete' => '删除',
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

		$criteria->compare('member_group_id',$this->member_group_id);
		$criteria->compare('member_group_name',$this->member_group_name,true);
		$criteria->compare('member_group_allow_message',$this->member_group_allow_message);
		$criteria->compare('member_group_allow_visit',$this->member_group_allow_visit);
		$criteria->compare('member_group_allow_post',$this->member_group_allow_post);
		$criteria->compare('member_group_allow_postverify',$this->member_group_allow_postverify);
		$criteria->compare('member_group_allow_send_message',$this->member_group_allow_send_message);
		$criteria->compare('member_group_allow_post_num',$this->member_group_allow_post_num);
		$criteria->compare('member_group_description',$this->member_group_description,true);
		$criteria->compare('member_group_sort',$this->member_group_sort);
		$criteria->compare('member_group_is_delete',$this->member_group_is_delete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}