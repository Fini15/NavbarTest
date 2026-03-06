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
        <img src="img/blomsterlogo1.svg" height="50" </img>
    </div>
    <div class="ms-auto pe-3">
        <a class="navbar-brand fa-solid fa-basket-shopping" href="#"></a>
    </div>
</nav>

<div class="container-fluid mt-4 pb-5">
    <div class="row g-3">

        <?php
        $products = [
                ["id" => 1, "name" => "Big Mac", "price" => 5.99, "emoji" => "🍔"],
                ["id" => 2, "name" => "Quarter Pounder", "price" => 5.49, "emoji" => "🍔"],
                ["id" => 3, "name" => "Chicken McNuggets", "price" => 4.99, "emoji" => "🍗"],
                ["id" => 4, "name" => "Filet-O-Fish", "price" => 4.49, "emoji" => "🐟"],
                ["id" => 5, "name" => "French Fries", "price" => 2.99, "emoji" => "🍟"],
                ["id" => 6, "name" => "Apple Pie", "price" => 1.99, "emoji" => "🥧"],
                ["id" => 7, "name" => "Coca-Cola", "price" => 2.49, "emoji" => "🥤"],
                ["id" => 8, "name" => "McFlurry", "price" => 3.99, "emoji" => "🍦"],
                ["id" => 9, "name" => "Salad", "price" => 6.99, "emoji" => "🥗"],
        ];
        ?>

        <?php foreach($products as $product): ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="product-emoji text-center mb-2">
                            <span style="font-size: 3rem;"><?php echo $product['emoji']; ?></span>
                        </div>

                        <h5 class="card-title text-center"><?php echo $product['name']; ?></h5>

                        <p class="card-text text-center text-danger fw-bold">
                            $<?php echo number_format($product['price'], 2); ?>
                        </p>

                        <div class="controls d-flex justify-content-center gap-2 mt-auto">
                            <button class="btn btn-outline-danger btn-sm minus" data-id="<?php echo $product['id']; ?>" data-price="<?php echo $product['price']; ?>">−</button>
                            <div class="quantity text-center" id="qty-<?php echo $product['id']; ?>" style="min-width: 40px;">0</div>
                            <button class="btn btn-outline-success btn-sm plus" data-id="<?php echo $product['id']; ?>" data-price="<?php echo $product['price']; ?>">+</button>
                        </div>

                        <button class="btn btn-secondary btn-sm mt-2 add-to-cart" data-id="<?php echo $product['id']; ?>" data-name="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>" data-emoji="<?php echo $product['emoji']; ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- Shopping Cart Offcanvas -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/fa23e7aba1.js" crossorigin="anonymous"></script>

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





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/fa23e7aba1.js" crossorigin="anonymous"></script>
</body>
</html>

