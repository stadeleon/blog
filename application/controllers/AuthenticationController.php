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
        $this->_helper->layout->setLayout('loginLayout');
        //check if user already logged in
     //   if (Zend_Auth::getInstance()->hasIdentity()){
     //       $this->redirect('/');
     //   }

        //form adding into view
        //$form = Application_Form_LoginForm();
        //$this->view->form = $form;

        // login script including to view login
        $this->view->headScript()->appendFile('/js/authentication/login.js', 'text/javascript');

    }

    public function authAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $result = array();

        /*  $username = 'leo';
          $password = 'password1';*/

        /*$username = $form->getValue('username');
        $password = $form->getValue('password');*/

        $username = $this->_getParam('username');
        $password = $this->_getParam('password');


        if (($username != null) && ($username != '') && ($password != null) && ($password != '')){


            $authAdapter = $this->getAuthAdapter();
            $authAdapter->setIdentity($username)
                        ->setCredential($password);

            $authObject = Zend_Auth::getInstance();
            $resultAuth = $authObject->authenticate($authAdapter);

            if ($resultAuth->isValid()){
                $identity = $authAdapter->getResultRowObject();
                $authStorage = $authObject->getStorage();
                $authStorage->write($identity);
                $result = array(
                    'result' => true,
                    'message' => 'Access Granted'
                );
            } else {
                //$this->view->errorMessage = 'Username or password is Wrong';
                $result = array('result' => false,
                    'message' => 'Username or password is Wrong'
                );
            }
        } else {
            $result = array(
                'result' => false,
                'message' => '0'
            );
        }

        print Zend_Json::encode($result);
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





