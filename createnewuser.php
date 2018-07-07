<?php
session_start();

if (!empty($_SESSION['user_details'])) {
    header("Location:./index.php?page=controlpanel.php");
    die();
}

require "database.php";
class NewUser extends DataBaseOperetor
{
    protected $field_names;

    public function __construct()
    {
        parent::__construct();
        $this->field_names = $this->describeTable('userdetails');
        $this->createNewUser();
    }

    public function createNewUser()
    {
        if (!$this->select('usersdetails', 'user_name', "user_name = '{$_POST['user_name']}'")) {
            $columns = [];
            $values = [];
            foreach ($_POST as $key => $value) {
                array_push($columns, $key);
                array_push($values, $value);
            }
            if ($this->multiInsert('usersdetails', $columns, $values)) {
                $_SESSION['user_details'] = $this->select('usersdetails', '*', "user_name = '{$_POST['user_name']}'");
                header("Location:./index.php?page=controlpanel.php");
                die();
            } else {
                header("Location:./index.php?page=register.php&error=something%20went%20wrong");
                die();
            }

        } else {
            header("Location:./index.php?page=register.php&error=user%20name%20alreay%20exist");
            die();
        }
    }
}
$newUser = new NewUser;
