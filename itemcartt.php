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

<nav class="navbar bg-body-tertiary position-relative">
    <div class="position-absolute top-50 start-50 translate-middle">
        <img src="img/blomsterlogo1.svg" height="50" </img>
    </div>
    <div class="ms-auto pe-3">
        <a class="navbar-brand fa-solid fa-basket-shopping" href="#"></a>
    </div>
</nav>


<?php
$items = [
    ["id"=>1,"name"=>"Item 1"],
    ["id"=>2,"name"=>"Item 2"],
    ["id"=>3,"name"=>"Item 3"],
    ["id"=>4,"name"=>"Item 4"],
    ["id"=>5,"name"=>"Item 5"],
    ["id"=>6,"name"=>"Item 6"],
    ["id"=>7,"name"=>"Item 7"],
    ["id"=>8,"name"=>"Item 8"],
    ["id"=>9,"name"=>"Item 9"],
];
?>








<div class="container mt-4">
    <div class="row g-3">

        <?php foreach($items as $item): ?>

            <div class="col-4">
                <div class="cart-box">

                    <div class="item-name">
                        <?php echo $item['name']; ?>
                    </div>

                    <div class="controls d-flex align-items-center">

                        <button class="btn btn-outline-danger btn-sm minus" data-id="<?php echo $item['id']; ?>">−</button>

                        <div class="quantity" id="qty-<?php echo $item['id']; ?>">0</div>

                        <button class="btn btn-outline-success btn-sm plus" data-id="<?php echo $item['id']; ?>">+</button>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<script>

   

</script>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/fa23e7aba1.js" crossorigin="anonymous"></script>
</body>
</html>

