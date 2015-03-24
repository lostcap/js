<?php

/**
 * This is the model class for table "{{content_log}}".
 *
 * The followings are the available columns in table '{{content_log}}':
 * @property string $content_log_id
 * @property string $content_log_action
 * @property string $content_log_action_type
 * @property integer $content_log_admin_id
 * @property string $content_log_admin_ip
 * @property string $content_log_time
 */
class ContentLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContentLog the static model class
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
		return '{{content_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_log_action, content_log_action_type, content_log_admin_ip', 'required'),
			array('content_log_admin_id', 'numerical', 'integerOnly'=>true),
			array('content_log_action', 'length', 'max'=>100),
			array('content_log_action_type, content_log_admin_ip', 'length', 'max'=>15),
			array('content_log_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('content_log_id, content_log_action, content_log_action_type, content_log_admin_id, content_log_admin_ip, content_log_time', 'safe', 'on'=>'search'),
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
			'content_log_id' => '日志ID',
			'content_log_action' => '操作',
			'content_log_action_type' => '操作类型',
			'content_log_admin_id' => '管理员ID',
			'content_log_admin_ip' => '管理员IP',
			'content_log_time' => '操作时间',
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

		$criteria->compare('content_log_id',$this->content_log_id,true);
		$criteria->compare('content_log_action',$this->content_log_action,true);
		$criteria->compare('content_log_action_type',$this->content_log_action_type,true);
		$criteria->compare('content_log_admin_id',$this->content_log_admin_id);
		$criteria->compare('content_log_admin_ip',$this->content_log_admin_ip,true);
		$criteria->compare('content_log_time',$this->content_log_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}