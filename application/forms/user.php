<?php

class Application_Form_User extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        // Add hidden field for user ID
        $this->addElement('hidden', 'id');

        // Add text field for user name
        $this->addElement('text', 'nom', [
            'label'      => 'Name:',
            'required'   => true,
            'filters'    => ['StringTrim'],
            'validators' => ['NotEmpty']
        ]);

        // Add text field for user email
        $this->addElement('text', 'email', [
            'label'      => 'Email:',
            'required'   => true,
            'validators' => ['EmailAddress']
        ]);

        // Add submit button
        $this->addElement('submit', 'submit', [
            'ignore'   => true,
            'label'    => 'Submit',
        ]);

        // Add CSRF protection
        $this->addElement('hash', 'csrf', [
            'ignore' => true,
        ]);
    }
}
