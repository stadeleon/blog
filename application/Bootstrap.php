<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initAutoload()
	{
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $autoLoader->registerNamespace('MyLib_');

		$autoloader = Zend_Loader_Autoloader::getInstance();
		return $autoloader;
	}

}

