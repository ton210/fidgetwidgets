<?php
require_once 'config.php';
require_once 'includes/products-data.php';

$pageTitle = 'Shopping Cart';

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $productId = (int)$_POST['product_id'];
                $quantity = (int)($_POST['quantity'] ?? 1);
                if (isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId] += $quantity;
                } else {
                    $_SESSION['cart'][$productId] = $quantity;
                }
                break;

            case 'update':
                $productId = (int)$_POST['product_id'];
                $quantity = (int)$_POST['quantity'];
                if ($quantity > 0) {
                    $_SESSION['cart'][$productId] = $quantity;
                } else {
                    unset($_SESSION['cart'][$productId]);
                }
                break;

            case 'remove':
                $productId = (int)$_POST['product_id'];
                unset($_SESSION['cart'][$productId]);
                break;

            case 'clear':
                $_SESSION['cart'] = [];
                break;
        }
        // Redirect to prevent form resubmission
        header('Location: cart.php');
        exit;
    }
}

// Calculate cart totals
$cartItems = [];
$subtotal = 0;

foreach ($_SESSION['cart'] as $productId => $quantity) {
    $product = getProductById($productId);
    if ($product) {
        $product['quantity'] = $quantity;
        $product['line_total'] = $product['price'] * $quantity;
        $cartItems[] = $product;
        $subtotal += $product['line_total'];
    }
}

$tax = $subtotal * 0.08; // 8% tax
$shipping = $subtotal > 50 ? 0 : 9.99; // Free shipping over $50
$total = $subtotal + $tax + $shipping;
?>

<?php include 'includes/header.php'; ?>

<section class="page-hero">
    <div class="container">
        <h1>Shopping Cart</h1>
        <p><?php echo count($cartItems); ?> item(s) in your cart</p>
    </div>
</section>

<section class="cart-section">
    <div class="container">
        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <p>Add some products to your cart to get started!</p>
                <a href="/products.php" class="btn btn-primary">Shop Now</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <div class="cart-items">
                    <h2>Cart Items</h2>
                    <?php foreach ($cartItems as $item):
                        $imagePath = getProductImagePath($item['image']);
                    ?>
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                 alt="<?php echo htmlspecialchars($item['name']); ?>">
                        </div>
                        <div class="cart-item-details">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p class="item-price">$<?php echo number_format($item['price'], 2); ?></p>
                            <p class="item-description"><?php echo htmlspecialchars($item['description']); ?></p>
                        </div>
                        <div class="cart-item-quantity">
                            <form method="POST" class="quantity-form">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <label>Quantity:</label>
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>"
                                       min="0" max="99" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="cart-item-total">
                            <p class="item-total">$<?php echo number_format($item['line_total'], 2); ?></p>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn-remove">Remove</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <form method="POST" style="margin-top: 1rem;">
                        <input type="hidden" name="action" value="clear">
                        <button type="submit" class="btn btn-secondary">Clear Cart</button>
                    </form>
                </div>

                <div class="cart-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-line">
                        <span>Subtotal:</span>
                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="summary-line">
                        <span>Tax (8%):</span>
                        <span>$<?php echo number_format($tax, 2); ?></span>
                    </div>
                    <div class="summary-line">
                        <span>Shipping:</span>
                        <span><?php echo $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2); ?></span>
                    </div>
                    <?php if ($subtotal < 50): ?>
                    <p class="shipping-notice">Add $<?php echo number_format(50 - $subtotal, 2); ?> more for free shipping!</p>
                    <?php endif; ?>
                    <div class="summary-line summary-total">
                        <span>Total:</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <a href="/checkout.php" class="btn btn-primary btn-block">Proceed to Checkout</a>
                    <a href="/products.php" class="btn btn-secondary btn-block">Continue Shopping</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
