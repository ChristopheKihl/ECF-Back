<?php
ob_start();
?>
<article class="card card-g w-50 mt-3 m-auto">
<div class="card-header">
    <?= $title ?>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <label for="user">Email </label>
        </div>
        <div class="col-6">
            <input type="text" name="user" id="user">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="password">Mot de passe </label>
        </div>
        <div class="col-6">
            <input type="password" name="password" id="password">
        </div>
    </div>
</div>
    </article>
<?php
$content = ob_get_clean();
include "Layout.php";

?>