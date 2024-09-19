<?php
class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'users'; // Name of the table
    protected $_primary = 'id'; // Primary key column
}
