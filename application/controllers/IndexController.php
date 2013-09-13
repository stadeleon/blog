<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        // Уставливаем название блога
        $this->view->title = 'Тестовый блог на Zend Framework';
        // Устанавливаем разделитель для тега title с помощью хелперов
        // headTitle() и setSeparator()
        $this->view->headTitle()->setSeparator(' | ');
        // Передаем заголовок в тег title, с помошью хелпера headTitle()
        $this->view->headTitle($this->view->title);

        // Создаем экземпляр модели категорий
        $categories = new Application_Model_Categories();
        // Выбираем все категории
        $this->view->categories = $categories->getCategories();

        // добавлаяю хелперы
        //$view = new Zend_View();
        $this->view->addHelperPath(APPLICATION_PATH.'/../library/MyLib/Helper/');
    }

    public function indexAction()
    {

        $this->view->del = $this->_getParam('del');
        // Создаем экземпляр модели постов
        $posts = new Application_Model_Posts();

        //include_once(APPLICATION_PATH.'/../library/MyLib/Helper/HelloWorld.php');
        //$this->_MyLib_Helper_HelloWorld->helloWorld();
        //MyLib_Helper_HelloWorld::helloWorld();

        // Выбираем все посты
        $this->view->posts = $posts->getPosts();

    	//$blogModel = new Application_Model_News();
    	//$this->view->newsList = $blogModel->getList();   // action body
        $this->view->headScript()->appendFile('/js/index/action.js', 'text/javascript');
    }

    /**
     * View post
     *
     * @return void
     */
    public function postAction()
    {
        // Берем ID'шник из параметра
        $id = intval($this->_getParam('id', 0));
        $this->view->new = $this->_getParam('new');

        if ($id > 0) {
            // Создаем экземпляр модели постов и выбираем посты по ID
            $postModel = new Application_Model_Posts();
            $this->view->post = $post = $postModel->getPostById($id);

            // Устанавливаем заголовок для поста в тег title
            $this->view->postTitle = $post['po_title'];
            $this->view->headTitle($this->view->postTitle);

            Zend_Controller_Action_HelperBroker::addPrefix('MyLib_Helper');
            $this->view->cutTag = $this->_helper->removeCutTag($post['po_blog_post']);

            // Получаем комменты к посту
            $comments = new Application_Model_Comments();
            $this->view->comments = $comments->getCommentsByPostId($id);
        }
    }

    public function newPostAction()
    {
        //получаем список категорий
        $category = new Application_Model_Categories();
        $this->view->categoryList = $category->getCategories();
        //выводим форму добавления поста
    }

    public function insertPostAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $cat_id = $this->_getParam('cat_id');
        $url = $this->_getParam('url');
        $title = $this->_getParam('title');
        $blog_post = $this->_getParam('blog_post');

        $postModel = new Application_Model_Posts();
        $this->view->post = $postModel->insertNewPost($cat_id, $url, $title, $blog_post);
    }

    public function editPostAction()
    {
        $id = $this->_getParam('id');
        $this->view->success = $this->_getParam('success');

        $post = new Application_Model_Posts();
        $this->view->post = $post->getPostById($id);

        //получаем список категорий
        $category = new Application_Model_Categories();
        $this->view->categoryList = $category->getCategories();
    }

    public function updatePostAction()
    {
        $id = $this->_getParam('id');
        $cat_id = $this->_getParam('cat_id');
        $url = $this->_getParam('url');
        $title = $this->_getParam('title');
        $blog_post = $this->_getParam('blog_post');
        $date = $this->_getParam('date');

        $post = new Application_Model_Posts();
        $this->view->post = $post->updatePostById($id, $cat_id, $url, $title, $blog_post, $date);
    }

    public function deletePostAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

//        // deletes a particular post from database and redirects too allposts action.
        $id = $this->_getParam('id',0);
        $postModel = new Application_Model_Posts();
        $postModel->deletePostById($id);
//        // $this->_redirect('/index/');
//        $this->redirect("/index/index/del/{$id}");
//        //setResponse($response);
        print Zend_Json::encode(array('result' => true,
                                      'id' => 1
                                ));

    }

    /**
     * View category
     *
     * @return void
     */
    public function categoryAction()
    {
        $id = intval($this->_getParam('id', 0));
        if ($id > 0) {
            $posts = new Application_Model_Posts();
            $this->view->posts = $posts->getPostsByCategoryId($id);
            // Получаем данные по категории
            $category = new Application_Model_Categories();
            $this->view->category = $category->getCategoryById($id);
            // Устанавливаем заголовок для категории в тег title
            $this->view->categoryTitle = $this->view->category['cat_title'];
            $this->view->headTitle($this->view->categoryTitle);
        }
    }

    public function viewAction()
    {
    	$id = $this->_getParam('id');
    	$blogModel = new Application_Model_News();
    	$this->view->newsContent = $blogModel->getRow($id);
    }
}

