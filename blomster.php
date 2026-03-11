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

    <title>Blomsterhuset</title>

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<body>

<nav class="navbar bg-body-tertiary position-relative">
    <div class="position-absolute top-50 start-50 translate-middle">
        <a href="index.php"> <img src="img/blomsterlogo1.svg" height="50" alt="Blomsterhuset"></a>
    </div>
    <div class="ms-auto pe-3">
        <a class="navbar-brand fa-solid fa-basket-shopping" href="indkøbskurv.php"></a>
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
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column text-center">

                        <div class="text-center mb-2">
                            <img src="<?php echo $imagePath; ?>" class='img-fluid' style="height: 150px; object-fit: contain;" alt='<?php echo $product->prodName; ?>'>
                        </div>

                        <h5 class="card-title text-center mb-2">
                            <?php echo $product->prodName; ?>
                        </h5>

                        <div class="card-text text-center text-danger fw-bold mb-3">
                            <?php echo number_format($product->prodPrice, 2, ',', '.'); ?> kr.
                        </div>

                        <div class="controls d-flex justify-content-center align-items-center gap-2 mt-auto">
                            <button class="btn btn-outline-danger btn-sm minus" data-id="<?php echo $product->prodId; ?>">−</button>
                            <div class="quantity text-center" id="qty-<?php echo $product->prodId; ?>" style="min-width: 40px;">0</div>
                            <button class="btn btn-outline-success btn-sm plus" data-id="<?php echo $product->prodId; ?>">+</button>
                        </div>

                        <button class="btn btn-secondary btn-sm mt-2 add-to-cart"
                                data-id="<?php echo $product->prodId; ?>"
                                data-name="<?php echo $product->prodName; ?>"
                                data-price="<?php echo $product->prodPrice; ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
    <div class="offcanvas-header bg-danger text-white">
        <h5 class="offcanvas-title">Order Summary</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <div id="cartItems" class="flex-grow-1">
            <p class="text-muted text-center">Your cart is empty</p>
        </div>
        <div class="cart-footer border-top pt-3">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong id="cartTotal" class="text-danger">$0.00</strong>
            </div>
            <button class="btn btn-danger w-100 btn-lg" id="checkoutBtn" disabled>Proceed to Checkout</button>
        </div>
    </div>
</div>

<script>
    // Cart storage
    let cart = {};

    // Quantity controls
    document.querySelectorAll('.plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const qtyEl = document.getElementById(`qty-${id}`);
            qtyEl.textContent = parseInt(qtyEl.textContent) + 1;
        });
    });

    document.querySelectorAll('.minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const qtyEl = document.getElementById(`qty-${id}`);
            const current = parseInt(qtyEl.textContent);
            if (current > 0) {
                qtyEl.textContent = current - 1;
            }
        });
    });

    // Add to cart
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            const emoji = this.dataset.emoji;
            const qty = parseInt(document.getElementById(`qty-${id}`).textContent);

            if (qty === 0) {
                alert('Please select a quantity');
                return;
            }

            if (!cart[id]) {
                cart[id] = {name, price, emoji, quantity: 0};
            }

            cart[id].quantity += qty;
            document.getElementById(`qty-${id}`).textContent = 0;

            updateCart();
        });
    });

    // Update cart display
    function updateCart() {
        const cartItemsEl = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        const cartBadge = document.getElementById('cartBadge');
        const checkoutBtn = document.getElementById('checkoutBtn');

        let html = '';
        let total = 0;
        let itemCount = 0;

        Object.values(cart).forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            itemCount += item.quantity;

            html += `
                <div class="card mb-2">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span style="font-size: 1.5rem;">${item.emoji}</span>
                                <strong>${item.name}</strong>
                                <div class="text-muted small">$${item.price.toFixed(2)} x ${item.quantity}</div>
                            </div>
                            <div class="text-end">
                                <div class="text-danger fw-bold">$${itemTotal.toFixed(2)}</div>
                                <button class="btn btn-sm btn-outline-danger mt-1" onclick="removeFromCart('${Object.keys(cart).find(key => cart[key] === item)}')">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        cartItemsEl.innerHTML = html || '<p class="text-muted text-center">Your cart is empty</p>';
        cartTotal.textContent = '$' + total.toFixed(2);
        cartBadge.textContent = itemCount;
        checkoutBtn.disabled = itemCount === 0;
    }

    // Remove from cart
    function removeFromCart(id) {
        delete cart[id];
        updateCart();
    }

    // Checkout
    document.getElementById('checkoutBtn').addEventListener('click', function() {
        if (Object.keys(cart).length > 0) {
            alert('Order placed!\n\nTotal: ' + document.getElementById('cartTotal').textContent);
            cart = {};
            updateCart();
            document.querySelectorAll('.quantity').forEach(el => el.textContent = '0');
        }
    });
</script>


<div class=" mb-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-10 text-center">
            <a href="indkøbskurv.php" class="btn bigbtn w-100 mt-3 py-3 rounded-pill">Går til klassen</a>
        </div>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fa23e7aba1.js" crossorigin="anonymous"></script>
</body>
</html>