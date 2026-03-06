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
        <img src="img/blomsterlogo1.svg" height="50" alt="Blomsterhuset" <img>
    </div>
    <div class="ms-auto pe-3">
        <a class="navbar-brand fa-solid fa-basket-shopping" href="#"></a>
    </div>
</nav>

<div class="container-fluid mt-4 pb-5">
    <div class="row g-3">

        <?php
        $sql = "SELECT * FROM products WHERE prodCategoryId = 2";
        $products = $db->sql($sql);

        foreach($products as $product) {

            $imagePath = "img/" . $product->prodName . ".svg";



            ?>
            <div class="col-md-4 col-4">
                <div class="card">
                    <div class="card-body p-2 text-center">
                        <img src="<?php echo $imagePath; ?>" class='img-fluid' alt='<?php echo $product->prodName; ?>'>
                    </div>

                    <div class="card-header">
                        <?php
                        echo $product->prodName;
                        ?>
                    </div>
                    <div class="card-footer">
                        <?php
                        echo $product->prodPrice;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

    </div>
</div>










        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fa23e7aba1.js" crossorigin="anonymous"></script>
</body>
</html>