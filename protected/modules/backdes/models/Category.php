<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $category_id
 * @property integer $category_level
 * @property integer $category_parentid
 * @property string $category_name
 * @property string $category_description
 * @property string $category_url
 * @property integer $category_show_order
 * @property integer $category_is_menu
 * @property integer $category_is_delete
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_name, category_description, category_url', 'required'),
			array('category_level, category_parentid, category_show_order, category_is_menu, category_is_delete', 'numerical', 'integerOnly'=>true),
			array('category_name', 'length', 'max'=>30),
			array('category_url', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_id, category_level, category_parentid, category_name, category_description, category_url, category_show_order, category_is_menu, category_is_delete', 'safe', 'on'=>'search'),
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
			'category_id' => '分类ID',
			'category_level' => '分类等级',
			'category_parentid' => '父类ID',
			'category_name' => '分类名称',
			'category_description' => '分类描述',
			'category_url' => '分类链接',
			'category_show_order' => '分类排序',
			'category_is_menu' => '是否是菜单',
			'category_is_delete' => '是否删除',
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

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('category_level',$this->category_level);
		$criteria->compare('category_parentid',$this->category_parentid);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('category_description',$this->category_description,true);
		$criteria->compare('category_url',$this->category_url,true);
		$criteria->compare('category_show_order',$this->category_show_order);
		$criteria->compare('category_is_menu',$this->category_is_menu);
		$criteria->compare('category_is_delete',$this->category_is_delete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}