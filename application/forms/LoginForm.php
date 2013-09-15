<?php

class Application_Form_LoginForm extends Zend_Form
{

    public function __construct($option = null)
    {
        parent::__construct($option);
        $this->setName('login'); //set this form name
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('User Name')
                ->setRequired(true);

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                ->setRequired(true);

        $login = new Zend_Form_Element_Submit('login');
        $login->setLabel('Login');

        $this->addElements(array($username, $password, $login));
        $this->setMethod('post');
        $this->setAction('/authentication/login');
        //$this->action(Zend_Controller_Front::getInstance()->getBaseUrl().'authentication/login');
    }

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    }


}

