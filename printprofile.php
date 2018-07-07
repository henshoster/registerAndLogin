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
<div class="container shadow pt-3 ">
    <div class="row">
        <div class="col-md-8">
            <form id="profileCpanel" action="<?=$this->php_self . $this->get_self?>" method="post">
<?php
foreach ($user_details as $key => $value) {
    ?>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"><?=ucfirst(str_replace("_", " ", $key))?></label>
                <div class="col-sm-10">
                    <input <?=$key != "user_name" ? 'disabled' : 'readonly'?> id="<?=$key?>" name="<?=$key?>" class="form-control form-control-sm" type="<?php
if ($key != "password" && $key != "email" && $key != "date_of_birth") {
        echo "text";
    } else {
        $pos = strpos($key, "_");
        if ($pos === false) {
            echo "$key";
        } else {
            echo substr($key, 0, $pos);
        }
    }
    ?>" value="<?=$value?>">
            </div>
        </div>
    <?php
}
?>
            <div class="row py-2">
                <div class="col-6">
                    <button type="submit" id="edit_button" name="edit_button" class="btn btn-outline-primary btn-block disabled">Edit</button>
                </div>
                <div class="col-6">
                    <button onclick="editController()" id="edit_controller" type="button" class="btn btn-outline-success btn-block">Open editting</button>
                </div>
            </div>
        </form>
        </div>
    <div class="col-md-4">
        <img src="icons/user.png" id="profile_cpanel_img" >
    </div>
    </div>
</div>