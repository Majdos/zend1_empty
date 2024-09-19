<?php

class IndexController extends Zend_Controller_Action
{
    protected $userModel;

    public function init()
    {
        $this->userModel = new Application_Model_User();
    }

    public function indexAction()
    {
        // Fetch all users
        $users = $this->userModel->fetchAll();
        $myClass = new CustomLib_CustomLib();
        
        // Call a method from your library
        $message = $myClass->hey();
        $this->view->message = $message;
        // Pass the data to the view
        $this->view->users = $users;
    }

    public function editAction()
    {
        $id = $this->getParam('id');

        if (!$id) {
            $this->redirect('/index');
        }

        // Fetch user details
        $user = $this->userModel->find($id)->current();
        
        if (!$user) {
            $this->redirect('/index');
        }

        // Create and configure the form
        $form = new Application_Form_User();
        
        // Handle form submission
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $data = $form->getValues();
                $this->userModel->update($data, ['id = ?' => $id]);
                $this->redirect('/index');
            }
        } else {
            // Populate the form with user data
            $form->populate($user->toArray());
        }

        // Pass the form to the view
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        $id = $this->getParam('id');

        if (!$id) {
            $this->redirect('/index');
        }

        // Delete the user
        $this->userModel->delete(['id = ?' => $id]);

        $this->redirect('/index');
    }

    public function addAction()
    {
        // Create and configure the form
        $form = new Application_Form_User();
        
        // Handle form submission
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $data = $form->getValues();
                // Remove the 'id' field if it's present as it should not be part of the new user data
                unset($data['id']);
                $this->userModel->insert($data);
                $this->redirect('/index');
            }
        }

        // Pass the form to the view
        $this->view->form = $form;
    }
}
