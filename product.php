<?php
require_once 'config.php';
require_once 'includes/products-data.php';

// Get product by slug
$slug = $_GET['slug'] ?? '';
$product = getProductBySlug($slug);

if (!$product) {
    header('Location: /products.php');
    exit;
}

$pageTitle = $product['name'];
$imagePath = getProductImagePath($product['image']);
$isPlaceholder = strpos($imagePath, 'placeholder') !== false;

// Get related products (same category, exclude current)
$relatedProducts = array_filter(getProducts(), function($p) use ($product) {
    return $p['category'] === $product['category'] && $p['id'] !== $product['id'];
});
$relatedProducts = array_slice($relatedProducts, 0, 4);
?>

<?php include 'includes/header.php'; ?>

<section class="product-detail-section">
    <div class="container">
        <div class="product-detail-layout">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="<?php echo htmlspecialchars($imagePath); ?>"
                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                         class="<?php echo $isPlaceholder ? 'placeholder' : ''; ?>">
                </div>
            </div>

            <div class="product-info-detail">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="product-category"><?php echo ucfirst(str_replace('_', ' ', $product['category'])); ?></p>

                <div class="product-price">
                    <span class="price-amount">$<?php echo number_format($product['price'], 2); ?></span>
                </div>

                <div class="product-description">
                    <p><?php echo htmlspecialchars($product['long_description']); ?></p>
                </div>

                <div class="product-features">
                    <h3>Key Features:</h3>
                    <ul>
                        <?php foreach ($product['features'] as $feature): ?>
                        <li><?php echo htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <form method="POST" action="/cart.php" class="add-to-cart-form">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                    <div class="quantity-selector">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="99">
                    </div>

                    <button type="submit" class="btn btn-primary btn-large">
                        Add to Cart - $<?php echo number_format($product['price'], 2); ?>
                    </button>
                </form>

                <div class="product-meta">
                    <p><strong>Free Shipping</strong> on orders over $50</p>
                    <p><strong>30-Day</strong> money-back guarantee</p>
                    <p><strong>Secure</strong> checkout</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($relatedProducts)): ?>
<section class="related-products">
    <div class="container">
        <h2>You May Also Like</h2>
        <div class="products-grid">
            <?php foreach ($relatedProducts as $relProd):
                $relImagePath = getProductImagePath($relProd['image']);
                $relIsPlaceholder = strpos($relImagePath, 'placeholder') !== false;
            ?>
            <div class="product-card">
                <a href="/product.php?slug=<?php echo htmlspecialchars($relProd['slug']); ?>">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($relImagePath); ?>"
                             alt="<?php echo htmlspecialchars($relProd['name']); ?>"
                             class="<?php echo $relIsPlaceholder ? 'placeholder' : ''; ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($relProd['name']); ?></h3>
                        <p><?php echo htmlspecialchars($relProd['description']); ?></p>
                        <p class="price">$<?php echo number_format($relProd['price'], 2); ?></p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
