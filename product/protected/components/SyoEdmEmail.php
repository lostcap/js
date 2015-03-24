<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-22
 * Time: 下午4:22
 * To change this template use File | Settings | File Templates.
 */

Yii::import('ext.mailer.EMailer');
class SyoEdmEmail
{

    private  $_mailer;
    public function  __construct($EmailConfig)
    {
        $this->_mailer=new EMailer();
        $this->_mailer->IsSMTP();
        $this->_mailer->Host = $EmailConfig['emailHost'];
        $this->_mailer->Port = $EmailConfig['emailHostPort'];
        $this->_mailer->SMTPAuth = $EmailConfig['emailSMTPAuth'];
        $this->_mailer->Username = $EmailConfig['emailUsername'];
        $this->_mailer->Password = $EmailConfig['emailPassword'];
        $this->_mailer->From = $EmailConfig['emailFromAddress'];
        $this->_mailer->AddReplyTo($EmailConfig['emailUsername']);
        $this->_mailer->FromName = $EmailConfig['emailFromName'];
        $this->_mailer->ContentType = $EmailConfig['emailContentType'];
        $this->_mailer->CharSet = $EmailConfig['emailCharset'];
    }

    public function sendByRegister($data)
    {
        if($data && is_array($data))
        {
            $this->_mailer->Subject = $data['subject'];
            $this->_mailer->getView($data['view'], $data, $layouts);
            $address[]=$data['email'];
            return $this->send($address);
        }
        return false;
    }

    public function sendByFindPwd($data)
    {
        if($data && is_array($data))
        {
            $this->_mailer->Subject = $data['subject'];

            $this->_mailer->getView($data['view'], $data, $layouts);

            $address[]=$data['email'];
            return $this->send($address);
        }
        return false;
    }

    public function sendByOrder($data)
    {
        if($data && is_array($data))
        {
            $this->_mailer->Subject = $data['subject'];
            $this->_mailer->getView($data['view'], $data, $layouts);
            $address[]=$data['email'];
            return $this->send($address);
        }
        return false;
    }

    public function sendmixed($data)
    {
        if($data && is_array($data))
        {
            $this->_mailer->Subject = $data['subject'];
            $this->_mailer->getView($data['view'], $data, $layouts);
            $address[]=$data['email'];
            return $this->send($address);
        }
        return false;
    }

    public function sendEDM($data){
	
        if($data && is_array($data))
        {
            $this->_mailer->Subject = $data['subject'];
            $this->_mailer->getView($data['view'], $data, $layouts);
            $address[]=$data['email'];
            return $this->send($address);
        }
        return false;
    }


    private  function send($addresses)
    {
        if($addresses)
        {
            foreach($addresses as $address)
            {
                $this->_mailer->AddAddress($address);
            }
            return $this->_mailer->send();
        }
        return FALSE;
    }

}
