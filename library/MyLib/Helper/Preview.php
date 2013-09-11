<?php

class Zend_View_Helper_Preview extends Zend_View_Helper_Abstract
{
    /**
     * Preview (text before cut)
     *
     * @param   string $post    Post
     * @return  string $preview Preview
     */
    public function preview ($post)
    {
        $post    = str_replace('<p><!-- cut --></p>', '<!-- cut -->', $post);
        $preview = explode('<!-- cut -->', $post);
        $preview = $preview[0];

        return $preview;
    }
}