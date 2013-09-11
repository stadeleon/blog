<?php
class Application_Model_News extends Zend_Db_Table_Abstract
{
	protected $_name = 'news';

	public function getList() 
	{
		return $this->fetchAll();
	}

	public function getRow($id)
	{
		return $this->fetchRow("nw_id = {$this->getDefaultAdapter()->quote($id)}");
	}

}