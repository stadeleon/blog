<?php
/**
 * Created by PhpStorm.
 * User: Mrakobes
 * Date: 10.09.13
 * Time: 0:18
 */

class Application_Model_Categories extends Zend_Db_Table_Abstract
{
    /**
     * DB table name
     *
     * @var string
     */
    protected $_name = 'categories';

    /**
     * Get all categories
     *
     * @param
     * @return array
     */
    public function getCategories()
    {
        $select = $this->select()->order('cat_id DESC');
        return $this->fetchAll($select);
    }

    /**
     * Get category by ID
     *
     * @param  int   $id ID
     * @return array
     */
    public function getCategoryById($id)
    {
        $id = intval($id);
        $row = $this->fetchRow('cat_id = ' . $id);
        if (!$row) {
            throw new Exception('Alert! getCategoryById Failed !!! :(');
        }
        return $row;
    }
}