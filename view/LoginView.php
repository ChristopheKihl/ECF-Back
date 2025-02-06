<?php
ob_start();
?>
<article class="card card-g w-50 mt-5 mb-5 m-auto">
    <div class="card-header">
        <?= $title ?>
    </div>
    <?php

    if(isset($exist)){
        echo '<div class="alert alert-danger" role="alert">
                L\'UTILISATEUR EST DEJA EXISTANT
            </div>';
    }
    ?>
    <form action="index.php?route=verification" method="post">
        <div class="card-body">
            <div class="row mb-1">
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
        <div class="card-footer">
            <div class="row">
                    <button type="submit" class="btn btn-outline-success col-4 m-auto">Valider</button>
            </div>
        </div>
    </form> 
            <div class="row p-3">
                <a href="index.php?route=register">CREER UN COMPTE</a>
            </div>
</article>
<?php
$content = ob_get_clean();
include "Layout.php";
?>