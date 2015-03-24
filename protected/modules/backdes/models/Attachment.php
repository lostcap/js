<?php

/**
 * This is the model class for table "{{attachment}}".
 *
 * The followings are the available columns in table '{{attachment}}':
 * @property string $attachment_id
 * @property integer $attachment_catid
 * @property string $attachment_filename
 * @property string $attachment_filepath
 * @property integer $attachment_is_image
 * @property integer $attachment_is_thumb
 * @property string $attachment_userid
 * @property string $attachment_uploadtime
 * @property string $attachment_uploadip
 * @property integer $attachment_status
 */
class Attachment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attachment the static model class
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
		return '{{attachment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attachment_catid, attachment_filename, attachment_filepath, attachment_uploadip', 'required'),
			array('attachment_catid, attachment_is_image, attachment_is_thumb, attachment_status', 'numerical', 'integerOnly'=>true),
			array('attachment_filename', 'length', 'max'=>50),
			array('attachment_filepath', 'length', 'max'=>200),
			array('attachment_userid, attachment_uploadtime', 'length', 'max'=>10),
			array('attachment_uploadip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attachment_id, attachment_catid, attachment_filename, attachment_filepath, attachment_is_image, attachment_is_thumb, attachment_userid, attachment_uploadtime, attachment_uploadip, attachment_status', 'safe', 'on'=>'search'),
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
			'attachment_id' => 'Attachment',
			'attachment_catid' => '附件分类',
			'attachment_filename' => '名称',
			'attachment_filepath' => '路径',
			'attachment_is_image' => '是否是图片',
			'attachment_is_thumb' => '是否是文件',
			'attachment_userid' => '上传者',
			'attachment_uploadtime' => '上传时间',
			'attachment_uploadip' => '上传IP',
			'attachment_status' => '状态',
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

		$criteria->compare('attachment_id',$this->attachment_id,true);
		$criteria->compare('attachment_catid',$this->attachment_catid);
		$criteria->compare('attachment_filename',$this->attachment_filename,true);
		$criteria->compare('attachment_filepath',$this->attachment_filepath,true);
		$criteria->compare('attachment_is_image',$this->attachment_is_image);
		$criteria->compare('attachment_is_thumb',$this->attachment_is_thumb);
		$criteria->compare('attachment_userid',$this->attachment_userid,true);
		$criteria->compare('attachment_uploadtime',$this->attachment_uploadtime,true);
		$criteria->compare('attachment_uploadip',$this->attachment_uploadip,true);
		$criteria->compare('attachment_status',$this->attachment_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}