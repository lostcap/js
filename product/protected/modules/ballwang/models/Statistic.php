<?php

/**
 * This is the model class for table "{{statistic}}".
 *
 * The followings are the available columns in table '{{statistic}}':
 * @property integer $statistic_id
 * @property integer $statistic_time_year
 * @property integer $statistic_time_month
 * @property integer $statistic_time_day
 * @property string $statistic_time
 * @property integer $statistic_category
 * @property integer $statistic_currency
 * @property double $statistic_account
 * @property integer $statistic_success_order
 * @property integer $statistic_register_customer
 * @property integer $statistic_order_customer
 * @property integer $statistic_order_site_num
 */
class Statistic extends CActiveRecord {
    const statisticDay=1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Statistic the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{statistic}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('statistic_time_year, statistic_time_month, statistic_time_day, statistic_time, statistic_category, statistic_currency, statistic_account, statistic_success_order, statistic_register_customer, statistic_order_customer, statistic_order_site_num', 'required'),
            array('statistic_time_year, statistic_time_month, statistic_time_day, statistic_category, statistic_currency, statistic_success_order, statistic_register_customer, statistic_order_customer, statistic_order_site_num ', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('statistic_id, statistic_time_year, statistic_time_month, statistic_time_day, statistic_time, statistic_category, statistic_currency, statistic_account, statistic_success_order, statistic_register_customer, statistic_order_customer, statistic_order_site_num', 'safe', 'on' => 'search'),
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
            'statistic_id' => 'Statistic',
            'statistic_time_year' => 'Statistic Time Year',
            'statistic_time_month' => 'Statistic Time Month',
            'statistic_time_day' => 'Statistic Timie Day',
            'statistic_time' => 'Statistic Time',
            'statistic_category' => 'Statistic Category',
            'statistic_currency' => 'Statistic Currency',
            'statistic_account' => 'Statistic Account',
            'statistic_success_order' => 'Statistic Success Order',
            'statistic_register_customer' => 'Statistic Register Customer',
            'statistic_order_customer' => 'Statistic Order Customer',
            'statistic_order_site_num' => 'Statistic Order Site Num',
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

        $criteria->compare('statistic_id', $this->statistic_id);
        $criteria->compare('statistic_time_year', $this->statistic_time_year);
        $criteria->compare('statistic_time_month', $this->statistic_time_month);
        $criteria->compare('statistic_time_day', $this->statistic_time_day);
        $criteria->compare('statistic_time', $this->statistic_time, true);
        $criteria->compare('statistic_category', $this->statistic_category);
        $criteria->compare('statistic_currency', $this->statistic_currency);
        $criteria->compare('statistic_account', $this->statistic_account);
        $criteria->compare('statistic_success_order', $this->statistic_success_order);
        $criteria->compare('statistic_register_customer', $this->statistic_register_customer);
        $criteria->compare('statistic_order_customer', $this->statistic_order_customer);
        $criteria->compare('statistic_order_site_num', $this->statistic_order_site_num);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function returnStatisticTime($i=0) {
        $date['Y'] = date('Y', strtotime("-$i day"));
        $date['m'] = date('m', strtotime("-$i day"));
        $date['d'] = date('d', strtotime("-$i day"));
        $date['time'] = date('Y-m-d', strtotime("-$i day"));
        $i++;
        $date['yesterdayY'] = date('Y', strtotime("-$i day"));
        $date['yesterdaym'] = date('m', strtotime("-$i day"));
        $date['yesterdayd'] = date('d', strtotime("-$i day"));
        $date['yesterdaytime'] = date('Y-m-d', strtotime("-$i day"));
        return $date;
    }

    public static function returnStatisticTimeToday($i=3) {
        $date['Y'] = date('Y', strtotime("2012-01-01 +$i day"));
        $date['m'] = date('m', strtotime("2012-01-01 +$i day"));
        $date['d'] = date('d', strtotime("2012-01-01 +$i day"));
        $date['time'] = date('Y-m-d', strtotime("2012-01-01 +$i day"));
        return $date;
    }

    public static function returnStatisticByTime($date) {
        $dateArray = array();
        $dateString = strtotime($date);
        $dateArray['Y'] = date('Y', $dateString);
        $dateArray['m'] = date('m', $dateString);
        $dateArray['d'] = date('d', $dateString);
        $dateArray['time'] = date('Y-m-d', $dateString);
        return $dateArray;
    }

    public static function returnStatisticOrderAccount($siteIdArray='', $time, $USDToCNYRate='', $AnyCurrencyToUSDArray='') {
        $account = 0;
        $data = array();
        $customer = array();
        $orderSite = array();
        $criteria = new CDbCriteria();
        $criteria->addCondition('order_status=:paymentAccepted', 'OR');
        $criteria->params[':paymentAccepted'] = Order::PaymentAccepted;
        $criteria->addCondition('order_status=:paymentShipped', 'OR');
        $criteria->params[':paymentShipped'] = Order::Shipped;
        $criteria->addCondition('order_status=:preparationProgress', 'OR');
        $criteria->params[':preparationProgress'] = Order::PreparationProgress;
        $criteria->addInCondition('order_site_id', $siteIdArray);
        $yesterday = date('Y-m-d', (strtotime($time) - 3600 * 24 * Statistic::statisticDay));
        $criteria->addBetweenCondition('order_create_at', $yesterday, $time);
        $order = Order::model()->findAll($criteria);
        if ($order) {
            foreach ($order as $key => $value) {
                $customer[$value->customer_id] = $value->customer_id;
                $orderSite[$value->order_site_id] = $value->order_site_id;
                $account += $USDToCNYRate * $AnyCurrencyToUSDArray[$value->order_currency_id] * $value->order_grandtotal;
            }
        }
        $data['account'] = $account;
        $data['orderCount'] = count($order);
        $data['customer'] = count($customer);
        $data['orderSite'] = count($orderSite);

        return $data;
    }

    public static function returnAllOrderDate($siteIdArray='', $time) {
        $customer = array();
        $orderData = array();
        $criteria = new CDbCriteria();
        $criteria->addInCondition('order_site_id', $siteIdArray);
        $yesterday = date('Y-m-d', (strtotime($time) - 3600 * 24 * Statistic::statisticDay));
        $criteria->addBetweenCondition('order_create_at', $yesterday, $time);
        $order = Order::model()->findAll($criteria);
        if ($order) {
            foreach ($order as $key => $value) {
                $customer[$value->customer_id] = $value->customer_id;
            }
        }
        $orderData['registerCustomer'] = count($customer);
        return $orderData;
    }

    /**
     * 所有的统计使用该函数实现
     * @param type $stepChartName        统计表的名称
     * @param type $type                 统计项目类型
     * @param type $xName                统计表X轴名称
     * @param type $yName                统计表Y轴名称
     * @param type $width                统计图表的宽度
     * @param type $height               统计图表的高度
     * @param type $timeStart            统计开始时间
     * @param type $timeEnd              统计结束时间
     * @param type $timeType             统计时间类型（day，month，year）
     * @return type 
     */
    public static function getCalculateSex($stepChartName='阶梯图', $type='total', $timeType='month', $xName=' ', $yName='Number', $timeStart='', $timeEnd='', $width=1000, $height=300) {
        $data['stepChartName'] = $stepChartName;
        $data['type'] = $type;
        $data['xName'] = $xName;
        $data['yName'] = $yName;
        $data['width'] = $width;
        $data['height'] = $height;
        $data['timeType'] = '';
        $data['data'] = array();

        $xValueString = '';
        if ($timeStart > $timeEnd) {
            $timeMiddle = $timeStart;
            $timeStart = $timeEnd;
            $timeEnd = $timeMiddle;
        }
        $sqlTime = '';
        $timeMark = '';
        if ($timeStart && $timeEnd) {
            if ($timeStart == $timeEnd) {
                $timeMark = '(' . $timeStart . ' 当天)';
            } else {
                $timeMark.='( ' . $timeStart . ' 至 ' . $timeEnd . ' )';
            }
            $sqlTime = ' AND statistic_time>="' . $timeStart . '" AND statistic_time<="' . $timeEnd . '"';
        }

        switch ($type) {
            //销售总额统计
            case 'total':
                $data['stepChartName'] = '销售总额统计' . $timeMark;
                if ($timeType == 'day') {
                    $data['timeType'] = 'day';
                    $sql = 'select statistic_account, statistic_time_year,statistic_time_month,statistic_time_day from syo_statistic where statistic_total =1' . $sqlTime;
                } else if ($timeType == 'month') {
                    $data['timeType'] = 'month';
                    $sql = 'select sum(statistic_account) as statistic_account, statistic_time_year,statistic_time_month from syo_statistic where statistic_total =1 ' . $sqlTime . ' group by statistic_time_year,statistic_time_month';
                } else if ($timeType == 'year') {
                    $data['timeType'] = 'year';
                    $sql = 'select sum(statistic_account) as statistic_account, statistic_time_year from syo_statistic where statistic_total =1 ' . $sqlTime . ' group by statistic_time_year';
                }
                $team = Yii::app()->db->createCommand($sql)->queryAll();
                if ($team) {
                    foreach ($team as $key => $value) {
                        $xValueString = Statistic::getReturnXValueByTimeType($timeType, $value);
                        $data['data'][$xValueString] = $value['statistic_account'];
                        $data['total'] +=$value['statistic_account'];
                        $max = $max > $value['statistic_account'] ? $max : $value['statistic_account'];
                    }
                }
                $max +=50000;
                $data['max'] = $max;
                $data['minCell'] = $max / 10;
                break;
            case 'totalArea':
                $data['stepChartName'] = '每条产品线销售总额统计' . $timeMark;
                $categorySql = "select primary_site_id,primary_site_name from syo_primary_site ";
                $categoryData = Yii::app()->db->createCommand($categorySql)->queryAll();
                $category = array();
                if ($categoryData) {
                    foreach ($categoryData as $key => $value) {
                        $category[$value['primary_site_id']] = $value['primary_site_name'];
                    }
                }
                if ($timeType == 'day') {
                    $sql = 'select statistic_account, statistic_time_year,statistic_time_month,statistic_time_day,statistic_time,statistic_category from syo_statistic where statistic_total !=1' . $sqlTime;
                } else if ($timeType == 'month') {
                    $sql = 'select sum(statistic_account) as statistic_account, statistic_time_year,statistic_time_month ,statistic_category from syo_statistic where statistic_total !=1 ' . $sqlTime . ' group by statistic_time_year,statistic_time_month,statistic_category';
                } else if ($timeType == 'year') {
                    $sql = 'select sum(statistic_account) as statistic_account, statistic_time_year  ,statistic_category from syo_statistic where statistic_total !=1 ' . $sqlTime . ' group by statistic_time_year,statistic_category';
                }
                $team = Yii::app()->db->createCommand($sql)->queryAll();
                if ($team) {
                    foreach ($team as $key => $value) {
                        $xValueString = Statistic::getReturnXValueByTimeType($timeType, $value);
                        $data['data'][$xValueString][$category[$value['statistic_category']]] = $value['statistic_account'];
                        $data['total'][$category[$value['statistic_category']]] +=$value['statistic_account'];
                        $max = $max > $value['statistic_account'] ? $max : $value['statistic_account'];
                    }
                }
                $max +=50000;
                $data['max'] = $max;
                $data['minCell'] = $max / 10;
                break;
            case 'totalCategory':
                $data['stepChartName'] = '售总额每条产品线所占比例' . $timeMark;
                $categorySql = "select primary_site_id,primary_site_name from syo_primary_site ";
                $categoryData = Yii::app()->db->createCommand($categorySql)->queryAll();
                $category = array();
                if ($categoryData) {
                    foreach ($categoryData as $key => $value) {
                        $category[$value['primary_site_id']] = $value['primary_site_name'];
                    }
                }
                if ($timeType == 'day') {
                    $sql = 'select statistic_account, statistic_time_year,statistic_time_month,statistic_time_day,statistic_time,statistic_category from syo_statistic where statistic_total !=1' . $sqlTime;
                } else if ($timeType == 'month') {
                    $sql = 'select sum(statistic_account) as statistic_account, statistic_time_year,statistic_time_month ,statistic_category from syo_statistic where statistic_total !=1 ' . $sqlTime . ' group by statistic_category';
                } else if ($timeType == 'year') {
                    $sql = 'select sum(statistic_account) as statistic_account, statistic_time_year,statistic_category from syo_statistic  where statistic_total !=1 ' . $sqlTime . ' group by statistic_category';
                }
                $team = Yii::app()->db->createCommand($sql)->queryAll();
                if ($team) {
                    foreach ($team as $key => $value) {
                        $data['data'][$category[$value['statistic_category']]] = $value['statistic_account'];
                        $max = $max > $value['statistic_account'] ? $max : $value['statistic_account'];
                    }
                }
                $max +=50000;
                $data['max'] = $max;
                $data['minCell'] = $max / 10;
                break;
            case 'refund':
                $data['stepChartName'] = '退款订单统计' . $timeMark;
                $categorySql = "select primary_site_id,primary_site_name from syo_primary_site ";
                $categoryData = Yii::app()->db->createCommand($categorySql)->queryAll();
                $category = array();
                if ($categoryData) {
                    foreach ($categoryData as $key => $value) {
                        $category[$value['primary_site_id']] = $value['primary_site_name'];
                    }
                }
                $sql = 'select * from syo_refund where refund_status !=0' . $sqlTime;
                $team = Yii::app()->db->createCommand($sql)->queryAll();
                if ($team) {
                    foreach ($team as $key => $value) {
                        $xValueString = Statistic::getReturnXValueByTimeType($timeType, $value);
                        $data['data']['refundTimeCount'][$xValueString] += $value['refund_account_cny'];
                        $data['data']['refundTimeTotalCount'] += $value['refund_account_cny'];
                        $data['data']['refundTimeOrderNum'][$xValueString] +=1;
                        $data['data']['refundTimeOrderTotalNum'] +=1;
                        $data['data']['refundCount'][$category[$value['refund_category']]][$xValueString] = $value['refund_account_cny'];
                        $data['data']['refundOrderNum'][$category[$value['refund_category']]][$xValueString] +=1;
                        $data['data']['refundCategoryContent'][$value['refund_content_category_id']][$xValueString] +=1;
                        $data['data']['refundCountry'][$value['refund_country']][$xValueString] +=1;
                    }
                }
                $max +=50000;
                $data['max'] = $max;
                $data['minCell'] = $max / 10;
                break;
            default :
                break;
        }
        return $data;
    }

    public static function getReturnXValueByTimeType($timeType='month', $value='') {
        if ($timeType == 'day') {
            $xValueString = $value['statistic_time_year'] . '-' . $value['statistic_time_month'] . '-' . $value['statistic_time_day'];
        } else if ($timeType == 'month') {
            $xValueString = $value['statistic_time_year'] . '-' . $value['statistic_time_month'];
        } elseif ($timeType == 'year') {
            $xValueString = $value['statistic_time_year'];
        }
        return $xValueString;
    }

}