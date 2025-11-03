<?php
require_once 'config.php';
require_once 'includes/products-data.php';

$pageTitle = 'Checkout';

// Initialize cart if not exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
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

$tax = $subtotal * 0.08;
$shipping = $subtotal > 50 ? 0 : 9.99;
$total = $subtotal + $tax + $shipping;

// Handle checkout submission
$orderComplete = false;
$orderNumber = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
    // In a real application, process payment here
    $orderNumber = 'FW' . date('Ymd') . rand(1000, 9999);
    $orderComplete = true;

    // Clear cart
    $_SESSION['cart'] = [];
}
?>

<?php include 'includes/header.php'; ?>

<section class="page-hero">
    <div class="container">
        <h1>Checkout</h1>
        <p>Complete your order</p>
    </div>
</section>

<section class="checkout-section">
    <div class="container">
        <?php if ($orderComplete): ?>
            <div class="order-complete">
                <h2>✓ Order Complete!</h2>
                <p>Thank you for your order!</p>
                <p class="order-number">Order Number: <strong><?php echo htmlspecialchars($orderNumber); ?></strong></p>
                <p>You will receive a confirmation email shortly.</p>
                <a href="/products.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        <?php else: ?>
            <form method="POST" class="checkout-form">
                <div class="checkout-layout">
                    <div class="checkout-details">
                        <h2>Billing & Shipping Information</h2>

                        <div class="form-section">
                            <h3>Contact Information</h3>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Shipping Address</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name">First Name *</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name *</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Street Address *</label>
                                <input type="text" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="address2">Apartment, Suite, etc. (optional)</label>
                                <input type="text" id="address2" name="address2">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city">City *</label>
                                    <input type="text" id="city" name="city" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">State *</label>
                                    <input type="text" id="state" name="state" required>
                                </div>
                                <div class="form-group">
                                    <label for="zip">ZIP Code *</label>
                                    <input type="text" id="zip" name="zip" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" required>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Payment Information</h3>
                            <div class="mock-payment-notice">
                                <p><strong>🎭 Mock Checkout - No Real Payment</strong></p>
                                <p>This is a demonstration checkout. No actual payment will be processed.</p>
                            </div>
                            <div class="form-group">
                                <label for="card_number">Card Number *</label>
                                <input type="text" id="card_number" name="card_number" placeholder="4111 1111 1111 1111" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="exp_date">Expiration *</label>
                                    <input type="text" id="exp_date" name="exp_date" placeholder="MM/YY" required>
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV *</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="123" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <label class="checkbox-label">
                                <input type="checkbox" name="age_confirm" required>
                                I confirm I am 21 years of age or older
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="terms" required>
                                I agree to the <a href="/terms.php">Terms & Conditions</a>
                            </label>
                        </div>
                    </div>

                    <div class="checkout-summary">
                        <h2>Order Summary</h2>

                        <div class="summary-items">
                            <?php foreach ($cartItems as $item): ?>
                            <div class="summary-item">
                                <span><?php echo htmlspecialchars($item['name']); ?> (<?php echo $item['quantity']; ?>)</span>
                                <span>$<?php echo number_format($item['line_total'], 2); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="summary-totals">
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
                            <div class="summary-line summary-total">
                                <span>Total:</span>
                                <span>$<?php echo number_format($total, 2); ?></span>
                            </div>
                        </div>

                        <button type="submit" name="submit_order" class="btn btn-primary btn-block">
                            Complete Order - $<?php echo number_format($total, 2); ?>
                        </button>
                        <a href="/cart.php" class="btn btn-secondary btn-block">Back to Cart</a>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
