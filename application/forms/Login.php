<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'username', array(
            'label'      => 'Username',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(4, 30))
            ),
        ));

        $this->addElement('password', 'password', array(
            'label'      => 'Password',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(4, 20))
            ),
        ));

        $this->addElement('submit', 'submit', array(
            'ignore'     => true,
            'label'      => 'Login',
        ));
    }


}

