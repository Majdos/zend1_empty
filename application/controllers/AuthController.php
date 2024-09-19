<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function loginAction()
    {
        $form = new Application_Form_Login();
        $this->view->form = $form;

        // Check if form is submitted
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $username = $form->getValue('username');
                $password = $form->getValue('password');
    
                $auth = Zend_Auth::getInstance();
                $adapter = new Zend_Auth_Adapter_DbTable(
                    Zend_Db_Table::getDefaultAdapter(),
                    'users',
                    'email',
                    'password'
                );

                $adapter->setIdentity($username)
                        ->setCredential($password); // Password is hashed

                $result = $auth->authenticate($adapter);
                
                if ($result->isValid()) {
                    // Authentication successful
                    $storage = $auth->getStorage();
                    $storage->write($adapter->getResultRowObject());

                    // Redirect to a protected page
                    $this->_helper->redirector('index', 'index');
                } else {
                    // Authentication failed
                    $this->view->error = 'Invalid username or password';
                }
            }
        }
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('login');
    }

}

