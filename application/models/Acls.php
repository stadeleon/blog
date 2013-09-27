<?php

class Application_Model_Acls extends Zend_Acl
{
    public function __construct(){
        // identifying access rules to different page actions
        $this->addResource(new Zend_Acl_Resource('index'));
        $this->addResource(new Zend_Acl_Resource('view'), 'index');
        $this->addResource(new Zend_Acl_Resource('category'), 'index');
        $this->addResource(new Zend_Acl_Resource('post'), 'index');
        //$this->addResource(new Zend_Acl_Resource('list'), 'index');

        $this->addResource(new Zend_Acl_Resource('add-comment'), 'index');

        $this->addResource(new Zend_Acl_Resource('edit-post'), 'index');
        $this->addResource(new Zend_Acl_Resource('update-post'), 'index');

        $this->addResource(new Zend_Acl_Resource('new-post'), 'index');
        $this->addResource(new Zend_Acl_Resource('insert-post'), 'index');

        $this->addResource(new Zend_Acl_Resource('delete-post'), 'index');

        $this->addResource(new Zend_Acl_Resource('authentication'));
        $this->addResource(new Zend_Acl_Resource('login', 'authentication'));
        $this->addResource(new Zend_Acl_Resource('logout', 'authentication'));


        //$this->addResource(new Zend_Acl_Resource('comments'));


        // identifying roles inherits
        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('user'), 'guest');
        $this->addRole(new Zend_Acl_Role('admin'), 'user');

        // identifying access for roles
        $this->allow('guest', 'authentication', 'login');
        $this->allow('guest', 'authentication', 'logout');
        $this->allow('guest', 'index');
        $this->allow('guest', 'index', 'view');
        $this->allow('guest', 'index', 'category');
        $this->allow('guest', 'index', 'post');
        //$this->allow('guest', 'comments', 'post');
        $this->allow('guest', 'index', 'category');
        $this->allow('user', 'index', 'add-comment');
        $this->allow('admin', 'index', 'edit-post');
        $this->allow('admin', 'index', 'update-post');
        $this->allow('admin', 'index', 'new-post');
        $this->allow('admin', 'index', 'insert-post');
        $this->allow('admin', 'index', 'delete-post');
    }

}

