<!-- public function printRegisterForm -->
<h1 class="display-4 text-center pb-3">Register</h1>
<?php
if (!empty($_GET['error'])) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>error!</strong> <?=$_GET['error']?>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
    </div>
    <?php
}
?>
<form action="./createnewuser.php" method="post">
    <div class="row">
<?PHP
$counter = 0;
foreach ($this->field_names as $value) {
    if ($counter % 2 == 0 && $counter > 0 && $counter < count($this->field_names)) {
        ?>
        </div><div class="row">
        <?php
}
    ?>
        <div class="col-md-6">
            <div class="form-group">
                <input id="<?=$value?>" name="<?=$value?>" class="form-control" type="<?php
if ($value != "password" && $value != "email" && $value != "date_of_birth") {
        echo "text";
    } else {
        $pos = strpos($value, "_");
        if ($pos === false) {
            echo "$value";
        } else {
            echo substr($value, 0, $pos);
        }
    }
    ?>"
    <?php
if ($value == "user_name" || $value == "password") {
        echo "required";
    }
    ?>
    >
                <label class="form-control-placeholder" for="<?=$value?>"><?=ucfirst(str_replace("_", " ", $value))?><?=$value == "user_name" || $value == "password" ? " (required)" : ""?>
                </label>
            </div>
        </div>
<?php
$counter++;
}?>
    </div>
    <div class="row p-5">
        <div class="col-6">
            <button type="submit" class="btn btn-outline-success btn-block">Submit</button>
        </div>
        <div class="col-6">
            <button type="reset" id="reset" class="btn btn-outline-danger btn-block">Reset</button>
        </div>
    </div>
</form>