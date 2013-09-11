<?php
/**
 * Comments model
 *
 *
 **/
class Application_Model_Comments extends Zend_Db_Table_Abstract
{
    /**
     * DB table name
     *
     * @var string
     */
    protected $_name = 'comments';

    /**
     * Get comments by post's ID
     *
     * @param  int   $postId ID of post
     * @return array
     */
    public function getCommentsByPostId($postId)
    {
        $postId = intval($postId);
        $row = $this->fetchAll('com_post_id = ' . $postId);
        if (!$row) {
            throw new Exception('Alert! getCommentsByPostId Failed !!! :(');
        }
        return $row->toArray();
    }
} 