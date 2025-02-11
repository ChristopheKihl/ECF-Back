<?php
ob_start();
?>
<article class="card card-g mt-3">
        <h3>BASE CREME</h3>
        <div id="creme"
            class="card-body d-flex flex-column gap-3 flex-wrap flex-md-row justify-content-around">

        </div>
    </article>

    <article class="card card-g mt-3">
        <h3>BASE TOMATE</h3>
        <div id="tomate"
            class="card-body d-flex flex-column gap-3 flex-wrap flex-md-row justify-content-around">
        </div>
    </article>
<?php
$content = ob_get_clean();
include "layout.php";

?>
