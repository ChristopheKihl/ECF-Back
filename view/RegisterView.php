<?php
ob_start();
?>
<article class="card card-g w-50 mt-5 mb-5 m-auto">
    <div class="card-header">
        <?= $title ?>
    </div>
    <form action="index.php?route=register" method="post">
        <div class="card-body">
            <!-- Champ pour le nom -->
            <div class="row mb-1">
                <div class="col-6">
                    <label for="lastname">NOM </label>
                </div>
                <div class="col-6">
                    <input type="text" name="lastname" id="lastname" required>
                </div>
            </div>

            <!-- Champ pour le prénom -->
            <div class="row mb-1">
                <div class="col-6">
                    <label for="firstname">PRENOM </label>
                </div>
                <div class="col-6">
                    <input type="text" name="firstname" id="firstname" required>
                </div>
            </div>

            <!-- Champ pour l'adresse -->
            <div class="row">
                <div class="col-6">
                    <label for="adresse">ADRESSE </label>
                </div>
                <div class="col-6">
                    <textarea name="adresse" id="adresse" required></textarea>
                </div>
            </div>

            <!-- Champ pour le téléphone -->
            <div class="row">
                <div class="col-6">
                    <label for="phone">TELEPHONE </label>
                </div>
                <div class="col-6">
                    <input type="text" name="phone" id="phone" required>
                </div>
            </div>

            <hr>
            <div class="fs-6 text-decoration-underline mb-2">
                Vos identifiants de connexion
            </div>

            <!-- Champ pour l'adresse mail -->
            <div class="row mb-1">
                <div class="col-6">
                    <label for="mail">Adresse mail </label>
                </div>
                <div class="col-6">
                    <input type="email" name="mail" id="mail" required>
                </div>
            </div>

            <!-- Champ pour le mot de passe -->
            <div class="row">
                <div class="col-6">
                    <label for="password">Mot de passe </label>
                </div>
                <div class="col-6">
                    <input type="password" name="password" id="password" required>
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
        <a href="index.php?route=login">Se connecter</a>
    </div>
</article>
<?php
$content = ob_get_clean();
include "Layout.php";
?>