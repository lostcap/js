<?php

/**
 * This is the model class for table "{{content_detial}}".
 *
 * The followings are the available columns in table '{{content_detial}}':
 * @property string $content_id
 * @property string $content_detial_text
 * @property integer $content_detial_is_pagination
 * @property integer $content_detial_is_allow_comment
 */
class ContentDetial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContentDetial the static model class
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
		return '{{content_detial}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_detial_text, content_detial_is_pagination', 'required'),
			array('content_detial_is_pagination, content_detial_is_allow_comment', 'numerical', 'integerOnly'=>true),
			array('content_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('content_id, content_detial_text, content_detial_is_pagination, content_detial_is_allow_comment', 'safe', 'on'=>'search'),
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
			'content_id' => '文章ID',
			'content_detial_text' => '正文',
			'content_detial_is_pagination' => '是否分页',
			'content_detial_is_allow_comment' => '是否允许评论',
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

		$criteria->compare('content_id',$this->content_id,true);
		$criteria->compare('content_detial_text',$this->content_detial_text,true);
		$criteria->compare('content_detial_is_pagination',$this->content_detial_is_pagination);
		$criteria->compare('content_detial_is_allow_comment',$this->content_detial_is_allow_comment);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}