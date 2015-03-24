<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginChageForm extends CFormModel {

    public $oldPassword;
    public $password;
    public $confirmPassword;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // rememberMe needs to be a boolean
            
            array('password,confirmPassword', 'length', 'min' => 6, 'max' => 32),
            array('confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => '输入两次密码不一致！'),
            array('oldPassword', 'authenticate'),
            array('password,confirmPassword', 'required', 'message' => '{attribute}不能为空！'),
        // password needs to be authenticated
        );
    }

    public function authenticate($attribute, $params) {
        if (!Employee::model()->findByAttributes(array('employee_passwd' => Employee::hashPwd($this->oldPassword)))) {
            $this->addError('oldPassword', '原始密码输入错误！');
        }
    }
    
    public function attributeLabels() {
        return array(
            'oldPassword' => '原始密码',
            'password' => '新密码',
            'confirmPassword' => '确认新密码',
        );
    }

}
