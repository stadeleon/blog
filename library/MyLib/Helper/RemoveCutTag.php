<?php

class Zend_View_Helper_RemoveCutTag extends Zend_View_Helper_Abstract
{
    /*
     * cut the post`s separator
     *
     * @param   string $post  Post
     * @return  string
     */
    public function removeCutTag($post)
    {
        if (!(strpos($post, '<!-- cut -->') === false)){
            $post = str_replace('<p><!-- cut --></p>', '', $post);
            $post = str_replace('<!-- cut -->', '', $post);
        }

        return $post;
    }
}