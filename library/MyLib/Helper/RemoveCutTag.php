<?php

class MyLib_Helper_RemoveCutTag extends Zend_Controller_Action_Helper_Abstract
{
    /**
     *
     * @var Zend_Loader_PluginLoader
     */
    public $pluginLoader;

    /**
     * Constructor: initialize plugin loader
     */
    public function __construct()
    {
        $this->pluginLoader = new Zend_Loader_PluginLoader();
    }

    /*
     * cut the post`s separator
     *
     * @param   string $post  Post
     * @return  string
     */
    public function tttt($post)
    {
        if (!(strpos($post, '<!-- cut -->') === false)){
            $post = str_replace('<p><!-- cut --></p>', '', $post);
            $post = str_replace('<!-- cut -->', '', $post);
        }

        return $post;
    }

    public function direct($post)
    {
        return $this->tttt($post);
    }
}