<?php
/**
 * @var db $db
 */

require "settings/init.php";
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Sigende titel</title>

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<nav class="navbar bg-body-tertiary position-relative p-4">
    <div class="position-absolute top-50 start-50 translate-middle">
        <img src="img/blomsterlogo1.svg" height="50"</img>
    </div>
</nav>

<div class="container">
    <div>
        <h1 class="text-center p-4 overskrift">Indkøbskruv</h1>
    </div>

    <div class="row border-bottom pb-1 mb-3">
        <div class="col-8"><p class="fw-bold">Produkter</p></div>
        <div class="col-4 text-end"><p class="fw-bold">Pris</p></div>
    </div>

    <div class="row">
        <div class="col-3">
            <img src="img/rødrose.svg" class="img-fluid border" alt="Rød rose">
        </div>
        <div class="col-6">
            <p class="fw-bold">Rød rose</p>
            <select class="form-select form-select-sm w-auto">
                <option value="5">5 stk</option>
            </select>
        </div>
        <div class="col-3 text-end"><p class="fw-bold">125 kr</p></div>
    </div>

    <div class="row pt-5">
        <div class="col-3">
            <img src="img/rødrose.svg" class="img-fluid border" alt="Rød rose">
        </div>
        <div class="col-6">
            <p class="fw-bold">Rød rose</p>
            <select class="form-select form-select-sm w-auto">
                <option value="5">5 stk</option>
            </select>
        </div>
        <div class="col-3 text-end"><p class="fw-bold">125 kr</p></div>
    </div>
</div>

<div>
    <div class="row border-top pt-5 mt-3">
        <div class="col-8"><p class="fw-bold">Pris i alt</p></div>
        <div class="col-4 text-end"><p class="fw-bold">250 kr</p></div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/fa23e7aba1.js" crossorigin="anonymous"></script>
</body>
</html>