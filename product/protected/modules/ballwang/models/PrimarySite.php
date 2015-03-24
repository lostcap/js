<?php

/**
 * This is the model class for table "seo.{{primary_site}}".
 *
 * The followings are the available columns in table 'seo.{{primary_site}}':
 * @property integer $primary_site_id
 * @property string $primary_site_name
 * @property string $primary_site_keyword
 */
class PrimarySite extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return PrimarySite the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{primary_site}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('primary_site_name', 'required'),
            array('primary_site_name, primary_site_keyword', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('primary_site_id, primary_site_name, primary_site_keyword', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    public function getPrimarySite() {
        $primarySite = array();
        if ($model = PrimarySite::model()->findAll()) {
            foreach ($model as $key) {
                $primarySite[$key->primary_site_id] = $key->primary_site_name;
            }
            return $primarySite;
        }
        return array(0 => '思亿欧');
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'primary_site_id' => '主站 ID',
            'primary_site_name' => '主站名称',
            'primary_site_keyword' => '主站关键词',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('primary_site_id', $this->primary_site_id);

        $criteria->compare('primary_site_name', $this->primary_site_name, true);

        $criteria->compare('primary_site_keyword', $this->primary_site_keyword, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public static function getActiveSiteCategory() {
        $siteCategory = array();
        $category = PrimarySite::model()->findAllByAttributes(array('primary_site_used'=>1));
        if ($category) {
            foreach ($category as $key => $value) {
                $siteCategory[$value->primary_site_id] = $value->primary_site_name;
            }
        }
        return $siteCategory;
    }

}