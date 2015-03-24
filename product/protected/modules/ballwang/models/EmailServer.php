<?php

/**
 * This is the model class for table "{{email_server}}".
 *
 * The followings are the available columns in table '{{email_server}}':
 * @property integer $email_id
 * @property string $email_send_address
 * @property integer $email_port
 * @property integer $email_smtp
 * @property string $email_name
 * @property string $email_pwd
 * @property integer $email_limit
 * @property integer $email_used
 * @property integer $email_used_times
 * @property integer $email_active
 */
class EmailServer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailServer the static model class
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
		return '{{email_server}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_send_address, email_port, email_smtp, email_name, email_pwd, email_limit, email_used, email_used_times, email_active', 'required'),
			array('email_port, email_smtp, email_limit, email_used, email_used_times, email_active', 'numerical', 'integerOnly'=>true),
			array('email_send_address, email_name, email_pwd', 'length', 'max'=>225),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('email_id, email_send_address, email_port, email_smtp, email_name, email_pwd, email_limit, email_used, email_used_times, email_active', 'safe', 'on'=>'search'),
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
			'email_id' => 'Email',
			'email_send_address' => 'Email Send Address',
			'email_port' => 'Email Port',
			'email_smtp' => 'Email Smtp',
			'email_name' => 'Email Name',
			'email_pwd' => 'Email Pwd',
			'email_limit' => 'Email Limit',
			'email_used' => 'Email Used',
			'email_used_times' => 'Email Used Times',
			'email_active' => 'Email Active',
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

		$criteria->compare('email_id',$this->email_id);
		$criteria->compare('email_send_address',$this->email_send_address,true);
		$criteria->compare('email_port',$this->email_port);
		$criteria->compare('email_smtp',$this->email_smtp);
		$criteria->compare('email_name',$this->email_name,true);
		$criteria->compare('email_pwd',$this->email_pwd,true);
		$criteria->compare('email_limit',$this->email_limit);
		$criteria->compare('email_used',$this->email_used);
		$criteria->compare('email_used_times',$this->email_used_times);
		$criteria->compare('email_active',$this->email_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static  function  sendMail($order){
        $EmailConfig=array();
        $languageArray=array('1'=>'en','2'=>'it','3'=>'de','4'=>'fr');
        $EmailConfig['emailHostPort']=26;
        $EmailConfig['emailSMTPAuth']=1;
        $EmailConfig['emailCharset']='UTF-8';
        $EmailConfig['emailContentType']='text/html';
        foreach($order as $key=>$value){
            $email=EmailServer::model()->find('email_limit>email_used AND email_active=1');
            if($email&&$email->email_limit>$email->email_used){
                $EmailConfig['emailHost']=$email->email_send_address;
                $EmailConfig['emailUsername']=$email->email_name;
                $EmailConfig['emailPassword']=$email->email_pwd;
                $domain=$value->site->domain_name;
                $EmailConfig['emailFromName']=$domain.'#'.$value->getInvoice();
                $EmailConfig['emailFromAddress']=str_replace('www.','service@',$domain);
                $mail=new SyoEdmEmail($EmailConfig);
                $data['subject']=$EmailConfig['emailFromName'];
                $data['name']=$value->customer->customer_name;
                $data['email']=$value->customer->customer_email;
                $data['hostName']=$domain;
                $data['hostUrl']='http://'.$domain;
                $data['order']=$value;
                $data['order_name']=$value->getInvoice();
                if($value->order_ship_id){
                    $data['shipCode']=$value->ship->ship_code;
                    $data['trackUrl']=$value->carrier->carrier_url;
                }
                $data['address']=$value->address;
                $data['items']=$value->items;
                $data['view']=$value->order_email_queue;
                Yii::app()->language=$languageArray[$value->site->domain_language];
                if($mail->sendEDM($data)){
                    $email->email_used +=1;
                    $value->order_email_queue=-$value->order_email_queue;
                    $email->update();
                    $value->update();
                }else{
                    $email->email_active=0;
                    $email->update();
                }
            }
        }
    }

    public static function getEmailServerStatus(){
        $emailServer=EmailServer::model()->findAll();
        $emailArray['email_limit']=0;
        $emailArray['email_used']=0;
        $emailArray['email_active']=0;
        $emailArray['email_down']=0;
        if($emailServer){
            foreach($emailServer as $key=>$value){
                if($value->email_active){
                    $emailArray['email_limit'] +=$value->email_limit;
                    $emailArray['email_used'] +=$value->email_used;
                    $emailArray['email_active'] +=1;
                }else{
                    $emailArray['email_down'] +=1;
                }
            }
        }
        return $emailArray;
    }
}