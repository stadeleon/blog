<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initAutoload()
	{
        // Set timezone
        date_default_timezone_set("Europe/Kiev");
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('MyLib_');

		$acl = new Application_Model_Acls;
        $auth = Zend_Auth::getInstance();


        $frontControllerInstance = Zend_Controller_Front::getInstance();
        $frontControllerInstance->registerPlugin(new Application_Plugin_AccessCheck($acl, $auth));
		return $autoloader;
	}

}

