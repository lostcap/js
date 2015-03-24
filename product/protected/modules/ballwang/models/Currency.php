<?php

/**
 * This is the model class for table "{{Currency}}".
 *
 * The followings are the available columns in table '{{Currency}}':
 * @property integer $currency_id
 * @property string $currency_title
 * @property string $currency_code
 * @property string $currency_symbol
 * @property string $currency_rate
 * @property string $currency_active
 * @property string $currency_last_updated
 */
class Currency extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Currency the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{currency}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('currency_symbol, currency_rate, currency_active', 'required'),
            array('currency_title', 'length', 'max' => 32),
            array('currency_code', 'length', 'max' => 3),
            array('currency_symbol', 'length', 'max' => 8),
            array('currency_rate', 'length', 'max' => 6),
            array('currency_active', 'length', 'max' => 1),
            array('currency_last_updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('currency_id, currency_title, currency_code, currency_symbol, currency_rate, currency_active, currency_last_updated', 'safe', 'on' => 'search'),
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

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'currency_id' => 'Currency',
            'currency_title' => 'Currency Title',
            'currency_code' => 'Currency Code',
            'currency_symbol' => 'Currency Symbol',
            'currency_rate' => 'Currency Rate',
            'currency_active' => 'Currency Active',
            'currency_last_updated' => 'Currency Last Updated',
        );
    }

    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'currency_active=1',
            )
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

        $criteria->compare('currency_id', $this->currency_id);

        $criteria->compare('currency_title', $this->currency_title, true);

        $criteria->compare('currency_code', $this->currency_code, true);

        $criteria->compare('currency_symbol', $this->currency_symbol, true);

        $criteria->compare('currency_rate', $this->currency_rate, true);

        $criteria->compare('currency_active', $this->currency_active, true);

        $criteria->compare('currency_last_updated', $this->currency_last_updated, true);

        return new CActiveDataProvider('Currency', array(
            'criteria' => $criteria,
        ));
    }

    public static function getCurrency() {
        if (Yii::app()->user->hasState('currency')) {
            return Yii::app()->user->getState('currency');
        }

        $cookie = Yii::app()->request->cookies['currency'];
        if ($cookie && !empty($cookie->value) && ($currency = Yii::app()->getSecurityManager()->validateData($cookie->value)) !== false) {
            return $currency;
        } else {
            $currency = Yii::app()->params['currency'];
            Yii::app()->user->setState('currency', $currency);
            $cookie = new CHttpCookie('currency', $currency);
            $cookie->expire = time() + 2592000;
            Yii::app()->request->cookies['currency'] = $cookie;
        }

        unset($cookie);

        return $currency;
    }

    public static function getCurrencySymbol($currencyID=0, $code=false) {
        $currencyID = ($currencyID == 0) ? self::getCurrency() : $currencyID;

        $currency = Currency::model()->findByPk($currencyID);

        $symbol = $code ? $currency->currency_code : $currency->currency_symbol;

        return $symbol;
    }

    public static function getAllCurrency() {
        $currency = array();
        foreach (self::model()->active()->findAll() as $key) {
            $currency[$key->currency_id] = $key->currency_code;
        }
        return $currency;
    }

    public static function returnUSDToAnyCurrencyRate($currency='CNY') {
        $sql = 'select currency_rate from syo_currency where currency_code ="' . $currency . '"';
        $currencyResult = Yii::app()->db->createCommand($sql)->queryRow();
        return $currencyResult['currency_rate'];
    }

    public static function returnAnyCurrencyToUSD($currencyId) {
        $sql = 'select currency_rate_back from syo_currency where currency_id ="' . $currencyId . '"';
        $currencyResult = Yii::app()->db->createCommand($sql)->queryRow();
        return $currencyResult['currency_rate_back'];
    }
    
    public static function returnAnyCurrencyToUSDArray() {
        $currencyArray=array();
        $currency=Currency::model()->findAll();
        if($currency){
            foreach ($currency as $key => $value){
                $currencyArray[$value->currency_id]=$value->currency_rate_back;
            }
        }
            
        return $currencyArray;
    }
    
    public static function getCurrencyId($acronym){
        $sql = 'select currency_id from syo_currency where currency_code ="' . $acronym . '"';
        $currencyResult = Yii::app()->db->createCommand($sql)->queryRow();
        return $currencyResult['currency_id'];
    }
    
    

}