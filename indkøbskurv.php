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
        <img src="img/blomsterlogo1.svg" height="50" alt="blomsthuset">
    </div>
</nav>

<div class="container">
    <div>
        <h1 class="text-center p-4 overskrift">Indkøbskruv</h1>
    </div>

    <div class="row border-bottom pb-1 mb-3 display-6">
        <div class="col-8"><p class="fw-bold">Produkter</p></div>
        <div class="col-4 text-end"><p class="fw-bold">Pris</p></div>
    </div>

    <div class="row">
        <div class="col-3">
            <img src="img/Bryllup.svg" class="img-fluid border" alt="Bryllup">
        </div>
        <div class="col-6">
            <p class="fw-bold">Bryllup</p>
            <label for="filter-select">Antal:</label>
            <select id="filter-select" class="form-select form-select-sm w-auto">
                <option value="1">1 stk</option>
            </select>
        </div>
        <div class="col-3 text-end"><p class="fw-bold">459 kr</p></div>
    </div>

    <div class="row pt-5">
        <div class="col-3">
            <img src="img/Roser.svg" class="img-fluid border" alt="Roser">
        </div>
        <div class="col-6">
            <p class="fw-bold">Roser</p>
            <label for="filter-select">Antal:</label>
            <select id="filter-select" class="form-select form-select-sm w-auto">
                <option value="2">2 stk</option>
            </select>
        </div>
        <div class="col-3 text-end"><p class="fw-bold">598 kr</p></div>
    </div>
</div>

<div class="container">
    <div class="row border-top pt-5 mt-3 display-6">
        <div class="col-8"><p class="fw-bold">Pris i alt</p></div>
        <div class="col-4 text-end"><p class="fw-bold">1057 kr</p></div>
    </div>
</div>


<div class="container">
    <div class="row m-3">
        <div class="col-6 col-md-6"><a href="#" class="btn bigbtn w-100 mt-3 py-3 rounded-pill">Mobilpay</a></div>
        <div class="col-6 col-md-6"><a href="#" class="btn bigbtn w-100 mt-3 py-3 rounded-pill">Kort</a></div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/fa23e7aba1.js" crossorigin="anonymous"></script>
</body>
</html>