<?php
session_start();
if (!empty($_SESSION['user_details'])) {
    header("Location:./index.php?page=controlpanel");
    die();
}
if (!isset($_POST['user_name_login']) || !isset($_POST['password_login']) || !isset($_POST['last_page'])) {
    header("Location:./index.php");
    die();
}

require "database.php";
class LogIn extends DataBaseOperetor
{

    protected $user_name_login;
    protected $password_login;
    protected $last_page;

    public function __construct($user_name_login, $password_login, $last_page, $host = "localhost", $username = "root", $password = "", $databasename = "users")
    {
        parent::__construct($host, $username, $password, $databasename);
        $this->user_name_login = $user_name_login;
        $this->password_login = $password_login;
        $this->last_page = $last_page;
        $this->logMeIn();
    }
    public function logMeIn()
    {
        if ($this->select('usersdetails', 'password', "user_name = '{$this->user_name_login}'")[0]['password'] == $this->password_login) {
            $_SESSION['user_details'] = $this->select('usersdetails', '*', "user_name = '{$this->user_name_login
            }'");
            header("Location:./index.php?page=controlpanel.php");
            die();
        } else {
            $error_msg = "loginerror=user%20name%20or%20password%20incorrect%20or%20not%20exist";
            if (strpos($this->last_page, "?") === false) {
                $error_msg = "?" . $error_msg;
            } else {
                $error_msg = "&" . $error_msg;
            }
            header("Location:" . $this->last_page . $error_msg);
            die();
        }
    }
}
$logMe = new LogIn($_POST['user_name_login'], $_POST['password_login'], $_POST['last_page']);
