<?php
require "database.php";

if (!empty($_SESSION['user_details'])) {
    header("Location:./index.php?page=controlpanel.php");
    die();
}

class RegisterForm extends DataBaseOperetor
{
    protected $field_names;
    public function __construct($host = "localhost", $username = "root", $password = "", $databasename = "users")
    {
        parent::__construct($host, $username, $password, $databasename);
        $this->field_names = $this->describeTable('userdetails');
        $this->printRegisterForm();
    }
    public function printRegisterForm()
    {
        return include "registerform.php";
    }
}

$registerForm = new RegisterForm();
