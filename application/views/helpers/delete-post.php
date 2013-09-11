<?php

class Zend_View_Helper_DeletePost extends Zend_View_Helper_Abstract
{
    /**
     * Preview (text before cut)
     *
     * @param   string $post    Post
     * @return  string $preview Preview
     */
    public function deletePostHelp ($id)
    {
        $post = new Application_Model_Posts();
        $post->deletePost($id);
    }
}