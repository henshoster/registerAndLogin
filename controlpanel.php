<?php
if (empty($_SESSION['user_details'])) {
    header("Location:./index.php");
    die();
}
require "database.php";
class User extends DataBaseOperetor
{
    protected $user_details;
    protected $php_self;
    protected $get_self;

    public function __construct($user_details, $host = "localhost", $username = "root", $password = "", $databasename = "users")
    {
        parent::__construct($host, $username, $password, $databasename);
        $this->user_details = $user_details[0];
        $this->php_self = htmlentities($_SERVER['PHP_SELF']);
        if (!empty($_GET['page'])) {
            $this->get_self = "?page=" . $_GET['page'];
        } else {
            $this->get_self = "";
        }
    }
    public function printProfile()
    {
        $user_details = $this->user_details;
        array_splice($user_details, 0, 1);
        include "./printprofile.php";
    }
    public function updateProfile()
    {
        if ($this->select('usersdetails', 'user_name', "user_name = '{$_SESSION['user_details'][0]['user_name']}'")) {
            $columns = [];
            $values = [];
            foreach ($_POST as $key => $value) {
                array_push($columns, $key);
                array_push($values, $value);
            }
            if ($this->multiUpdate('usersdetails', $columns, $values, "user_name = '{$_SESSION['user_details'][0]['user_name']}'")) {
                $_SESSION['user_details'] = $this->select('usersdetails', '*', "user_name = '{$_SESSION['user_details'][0]['user_name']}'");
                header("Location:./index.php?page=controlpanel.php");
                die();}
        } else {
            header("Location:./index.php?page=controlpanel.php&error=something%20went%20wrong,%20please%20try%20again%20latter");
            die();
        }
    }
}
$user = new User($_SESSION['user_details']);
if (isset($_POST['edit_button'])) {
    $user->updateProfile();
}
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">contact</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab"><?=$user->printProfile()?></div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Hello ZAZA!Coming soon....</div>
</div>
