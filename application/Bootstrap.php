<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initAutoload()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
		return $autoloader;
	}

}

