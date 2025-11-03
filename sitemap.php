<?php
require_once 'config.php';
require_once 'includes/products-data.php';

$pageTitle = 'Sitemap';
$products = getProducts();
?>

<?php include 'includes/header.php'; ?>

<section class="page-hero">
    <div class="container">
        <h1>Sitemap</h1>
        <p>Find everything on Fidget Widgets</p>
    </div>
</section>

<section class="sitemap-section">
    <div class="container">
        <div class="sitemap-grid">
            <div class="sitemap-column">
                <h2>Main Pages</h2>
                <ul class="sitemap-list">
                    <li><a href="/">Home</a></li>
                    <li><a href="/products.php">All Products</a></li>
                    <li><a href="/about.php">About Us</a></li>
                    <li><a href="/contact.php">Contact</a></li>
                    <li><a href="/cart.php">Shopping Cart</a></li>
                    <li><a href="/checkout.php">Checkout</a></li>
                </ul>
            </div>

            <div class="sitemap-column">
                <h2>Product Categories</h2>
                <ul class="sitemap-list">
                    <li><a href="/products.php?category=grinder">Grinders</a></li>
                    <li><a href="/products.php?category=tray">Rolling Trays</a></li>
                    <li><a href="/products.php?category=storage">Storage Solutions</a></li>
                    <li><a href="/products.php?category=pipe">Pipes & Bongs</a></li>
                    <li><a href="/products.php?category=accessories">Accessories</a></li>
                    <li><a href="/products.php?category=rolling_papers">Rolling Papers</a></li>
                    <li><a href="/products.php?category=lighter">Lighters</a></li>
                </ul>
            </div>

            <div class="sitemap-column">
                <h2>Tools & Resources</h2>
                <ul class="sitemap-list">
                    <li><a href="/generate-image.php">AI Image Generator</a></li>
                    <li><a href="/sitemap.php">Sitemap</a></li>
                </ul>

                <h2 style="margin-top: 2rem;">Legal</h2>
                <ul class="sitemap-list">
                    <li><a href="/privacy.php">Privacy Policy</a></li>
                    <li><a href="/terms.php">Terms of Service</a></li>
                </ul>
            </div>

            <div class="sitemap-column">
                <h2>All Products (<?php echo count($products); ?>)</h2>
                <ul class="sitemap-list products-list">
                    <?php foreach ($products as $product): ?>
                    <li>
                        <a href="/product.php?slug=<?php echo htmlspecialchars($product['slug']); ?>">
                            <?php echo htmlspecialchars($product['name']); ?>
                            <span class="product-price">$<?php echo number_format($product['price'], 2); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="sitemap-footer">
            <h2>External Links</h2>
            <ul class="sitemap-list">
                <li><a href="https://munchmakers.com/product-category/custom-rolling-trays/" target="_blank" rel="noopener">MunchMakers - Custom Rolling Trays</a></li>
            </ul>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
