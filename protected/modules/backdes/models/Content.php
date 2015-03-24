<?php

/**
 * This is the model class for table "{{content}}".
 *
 * The followings are the available columns in table '{{content}}':
 * @property string $content_id
 * @property integer $catgory_id
 * @property string $content_title
 * @property string $content_keywords
 * @property string $content_description
 * @property string $content_thumb
 * @property string $content_url
 * @property integer $content_order
 * @property integer $content_status
 * @property string $content_username
 * @property string $content_edit_name
 * @property string $content_from_name
 * @property string $inputtime
 * @property string $updatetime
 */
class Content extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
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
		return '{{content}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_description, content_url, content_username, content_edit_name, content_from_name', 'required'),
			array('catgory_id, content_order, content_status', 'numerical', 'integerOnly'=>true),
			array('content_title', 'length', 'max'=>80),
			array('content_keywords', 'length', 'max'=>40),
			array('content_thumb, content_url', 'length', 'max'=>100),
			array('content_username, content_edit_name, content_from_name', 'length', 'max'=>20),
			array('inputtime, updatetime', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('content_id, catgory_id, content_title, content_keywords, content_description, content_thumb, content_url, content_order, content_status, content_username, content_edit_name, content_from_name, inputtime, updatetime', 'safe', 'on'=>'search'),
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
			'catgory_id' => '分类ID',
			'content_title' => '文章标题',
			'content_keywords' => '文章关键词',
			'content_description' => '文章描述',
			'content_thumb' => '文章附件地址',
			'content_url' => 'URL地址',
			'content_order' => '文章排序',
			'content_status' => '文章状态',
			'content_username' => '作者',
			'content_edit_name' => '编辑',
			'content_from_name' => '来源',
			'inputtime' => '添加时间',
			'updatetime' => '跟新时间',
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
		$criteria->compare('catgory_id',$this->catgory_id);
		$criteria->compare('content_title',$this->content_title,true);
		$criteria->compare('content_keywords',$this->content_keywords,true);
		$criteria->compare('content_description',$this->content_description,true);
		$criteria->compare('content_thumb',$this->content_thumb,true);
		$criteria->compare('content_url',$this->content_url,true);
		$criteria->compare('content_order',$this->content_order);
		$criteria->compare('content_status',$this->content_status);
		$criteria->compare('content_username',$this->content_username,true);
		$criteria->compare('content_edit_name',$this->content_edit_name,true);
		$criteria->compare('content_from_name',$this->content_from_name,true);
		$criteria->compare('inputtime',$this->inputtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}