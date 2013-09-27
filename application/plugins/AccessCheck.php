<?php
/**
 * Created by PhpStorm.
 * User: Mrakobes
 * Date: 21.09.13
 * Time: 4:08
 */

class Application_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{
    private $_acl = null;
    private $_auth = null;

    public function __construct(Zend_Acl $acl, Zend_Auth $auth)
    {
        $this->_acl = $acl;
        $this->_auth = $auth;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        //get controller/action params from request
        $resource = $request->getControllerName();
        $action = $request->getActionName();

        $this->_auth->getStorage = new stdClass();
        //get the users logged role
        $identity = $this->_auth->getStorage()->read();
        var_dump($identity);

        if (is_object($identity))
        {
            $role = $identity->usr_role_name;

            $this->_acl->isAllowed($role, $resource, $action);

            echo $this->_acl->isAllowed($role, $resource, $action) . ' aaaaa ';

            echo $role . ' ' . $resource . ' ' . $action . ' ';
            if (!$this->_acl->isAllowed($role, $resource, $action))
            {
                $request->setControllerName('authentication')
                        ->setActionName('login');
                echo "Message: You don't have the permission to access the requested page";
            }
        } else {
            echo 'ups Guest does`t exist';
        }
    }

}