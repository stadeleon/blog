<?php
/**
 * Created by PhpStorm.
 * User: Mrakobes
 * Date: 09.09.13
 * Time: 12:45
 */
class Application_Model_Posts extends Zend_Db_Table_Abstract
{
    /**
     * Db table name
     *
     * @var string
     */
    protected $_name = 'posts';

    public function getPosts()
    {
        $select = $this->select()->order('po_created_at DESC')
                                 ->order('po_id DESC');
        return $this->fetchAll($select);
    }

    /**
     * Get Posts by category's ID
     *
     * @param  int   $categoryId ID of category
     * @return array
     */
    public function getPostsByCategoryId($categoryId)
    {
        $categoryId = intval($categoryId);
        // Формируем условие запроса
        $select = $this->select()->where('po_category_id = ?', $categoryId)
                                 ->order('po_created_at DESC')
                                 ->order('po_id DESC');
        // Выполняем запрос
        $row = $this->fetchAll($select);
        if (!$row) {
            throw new Exception('Alert! getPostByCategoryId failed !!! :(');
        }
        return $row->toArray();
    }

    /**
     * Get post by ID
     *
     * @param  int   $id ID of post
     * @return array
     */
    public function getPostById($id)
    {
        $id = intval($id);
        $row = $this->fetchRow("po_id = {$this->getDefaultAdapter()->quote($id)}");
        if (!$row) {
            throw new Exception('Error! Get posts Failed :(');
        }
        return $row;
    }

    /**
     * Create new post
     *
     * @param
     * @return bool
     */

    public function insertNewPost($category_id, $url, $title, $blog_post)
    {
        $data = array(
            'po_id'          => 'NULL',
            'po_category_id' => $category_id,
            'po_url'         => $url,
            'po_title'       => $title,
            'po_blog_post'   => $blog_post,
            'po_created_at'  => date("y.m.d H:m:s")
        );
        $query = $this->insert($data);
        if (!$query) {
            throw new Exception('Error! insertNewPost Failed :(');
        }
        $id = $this->_db->lastInsertId();
        return $id;
    }


    /**
     * Update post by ID
     *
     * @param  int   $id ID of post
     * @return array
     */

    public function updatePostById($id, $cat_id, $url, $title, $blog_post, $date)
    {
        $data = array(
            'po_category_id' => $cat_id,
            'po_url'         => $url,
            'po_title'       => $title,
            'po_blog_post'   => $blog_post,
            'po_created_at'  => $date
        );

        $query = $this->update($data, "po_id = {$id}" );
        if (!$query) {
            throw new Exception('Error! updatePost Failed :(');
        }
        return $id;
    }

    public function deletePost($id)
    {
        $query = $this->delete('id=' . ((int)$id));
        echo 'Tratata!';
        if (!$query) {
            throw new Exception('Error! deletePost Failed :(');
        }
        return $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
}