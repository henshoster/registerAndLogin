<?php
session_start();
$php_self = htmlentities($_SERVER['PHP_SELF']);
if (!empty($_GET['page'])) {
    $get_self = "?page=" . $_GET['page'];
} else {
    $get_self = "";
}
if (isset($_POST['log_out'])) {
    unset($_COOKIE['PHPSESSID']);
    setcookie('PHPSESSID', '', time() - 3600, '/');
    session_destroy();
    header("Location:" . $php_self . $get_self);
    die();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
    <a class="navbar-brand" href="./">Register&Login</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="./">Home</a>
            </li>
        </ul>
        <span class="navbar-text">
            <?php
if (isset($_SESSION['user_details'][0]['user_name'])) {
    $user_name = $_SESSION['user_details'][0]['user_name'];
    ?>
    Hello <?=$user_name?><a class="btn text-primary" href="./index.php?page=controlpanel.php">settings</a>/<form class="d-inline" action="
    <?=$php_self . $get_self?>" method="post"><button type="submit" name="log_out" class="btn btn-link">log out</button></form>
    <?php
} else {
    ?>
    Hello Guest (<a class="btn text-primary" href="./index.php?page=register.php">register</a> / <button type="button" class="btn btn-link" data-toggle="modal" data-target="#logInModal">log in</button>)
    <?php
}
?>
        </span>
    </div>
    </div>
</nav>

<!--log in Modal -->
<div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="logInModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logInModalTitle">Log in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
if (!empty($_GET['loginerror'])) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>error!</strong> <?=$_GET['loginerror']?>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
    </div>
    <?php
}
?>
        <form action="./login.php" method="post">
            <input type="hidden" name="last_page" value="<?=$php_self . $get_self?>">
            <div class="row pt-1">
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="user_name_login" name="user_name_login" class="form-control" type="text" required>
                        <label class="form-control-placeholder" for="user_name_login">User name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="password_login" name="password_login" class="form-control" type="password" required>
                        <label class="form-control-placeholder" for="password_login">Password</label>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button name="log_in" type="submit" class="btn btn-outline-primary">Log-in</button>
        </form>
      </div>
    </div>
  </div>
</div>

