<?php
session_start()
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script type="module" src="js/app.js"></script>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/animations.css">
    <link rel="shortcut icon" href="img/favicon/favicon.png" type="image/x-icon">
    <title>Pizzaria Bella Notte</title>
</head>

<body>
    <header>
        <section id="headerImg" class="row">
            <article id="header"
                class="contours d-flex flex-column flex-lg-row align-items-center justify-content-around">
                <div>Bienvenue</div>
                <div>PIZZERIA BELLA NOTTE</div>
                <div>Le veritable gout de l'Italie directement sortie du four</div>
            </article>
        </section>
    </header>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid justify-content-end">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center justify-content-lg-end mt-2" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                            <!-- <button class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modale"><i
                                    class="bi bi-person-fill me-2"></i>Mon compte</button> -->
                    </li>
                    <li class="nav-item">
                        <button id="panier" class="nav-link" href="index.php?lol=lol" data-bs-toggle="modal"
                            data-bs-target="#modale"><i class="bi bi-cart4 me-2"></i>Ma commande</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <section class="row">
            <article class="text-center col-10 m-auto">
                <h2 class="contours">Notre carte</h2>
                <section id="alimentation" class="d-flex justify-content-around fs-3">
                    <div>
                        <input type="checkbox" name="halal" id="halal">
                        <label for="halal">Halal</label>
                    </div>
                    <div>
                        <input type="checkbox" name="vegane" id="vegane">
                        <label for="vegane">Vegane</label>
                    </div>
                    <div>
                        <input type="checkbox" name="vegetarienne" id="vegetarienne">
                        <label for="vegetarienne">Vegetarien</label>
                    </div>
                    <div>
                        <input type="checkbox" name="sans_Gluten" id="sans_gluten">
                        <label for="sans_gluten">Sans Gluten</label>
                    </div>
                </section>
                <section class="mt-3">
                <?=$content ?>
                </section>
            </article>
        </section>

        <div class="modal fade" id="modale" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-end">
                    <button id="poursuivre" type="button" class="btn btn-outline-danger"
                    data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
                    </div>
                    <div id="modaleContent" class="modal-body">
                    </div>
                    <div id="footerModale" class="modal-footer d-flex justify-content-center">
                        <a href="index.php?route=verification"><button id="commander" type="button" class="btn btn-outline-success">Commander</button></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="sticky-bottom d-flex justify-content-between">
        <article id="adresse" class="d-flex flex-column justify-content-center ms-lg-3 px-1 border-end">
            <div>PIZZERIA BELLA NOTTE</div>
            <div>55, rue d'Italie</div>
            <div>99000 PARADIS CITY</div>
        </article>
        <article class="align-content-center border-end px-1"><i class="bi bi-telephone me-2"></i>06 06 06
            06 06
        </article>
        <article class="me-4 align-content-center">
            <div>Retrouvez-nous</div>
            <div class="d-flex justify-content-between">
                <img src="img/social/facebook.png" alt="logo facebook">
                <img src="img/social/telegram.png" alt="logo telegram">
                <img src="img/social/twitter.png" alt="logo twitter">
                <img src="img/social/youtube.png" alt="logo youtube">
            </div>
        </article>
    </footer>

</body>

</html>