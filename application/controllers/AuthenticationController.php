<?php

class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $this->_helper->layout->disableLayout(); //todo temporary line - set wright layout

        //check if user already logged in
        if (Zend_Auth::getInstance()->hasIdentity()){
            $this->redirect('/index/index');
        }

        //form adding
        //$form = Application_Form_LoginForm();
        //$this->view->form = $form;

        $requestType = $this->getRequest();
        $form = new Application_Form_LoginForm();

        if ($requestType->isPost()){
            if ($form->isValid($this->_request->getPost())){
                $authAdapter = $this->getAuthAdapter();
              /*  $username = 'leo';
                $password = 'passworsd1';*/

                $username = $form->getValue('username');
                $password = $form->getValue('password');

                $authAdapter->setIdentity($username)
                    ->setCredential($password);

                $authMethod = Zend_Auth::getInstance();
                $result = $authMethod->authenticate($authAdapter);

                if ($result->isValid()){
                    $identity = $authAdapter->getResultRowObject();
                    $authStorage = $authMethod->getStorage();
                    $authStorage->write($identity);

                    // $this->redirect('index/index');
                } else {
                    $this->view->errorMessage = 'Username or password is Wrong';
                }
            }
        }
        $this->view->form = $form;


    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->redirect('/authentication/login');
    }

    private function getAuthAdapter()
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());

        $authAdapter->setTableName('users')
                    ->setIdentityColumn('usr_name')
                    ->setCredentialColumn('usr_password');
                   // ->setCredentialTreatment(); //todo узнать как прописывается шифрование
        return $authAdapter;
    }


}





