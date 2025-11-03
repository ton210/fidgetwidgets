<?php
require_once 'config.php';
require_once 'includes/products-data.php';

$pageTitle = 'Products';
$products = getProducts();
?>

<?php include 'includes/header.php'; ?>

<section class="page-hero">
    <div class="container">
        <h1>Our Products</h1>
        <p>Explore our collection of premium cannabis accessories</p>
    </div>
</section>

<section class="products-section">
    <div class="container">
        <div class="products-filter">
            <button class="filter-btn active" data-filter="all">All Products</button>
            <button class="filter-btn" data-filter="grinder">Grinders</button>
            <button class="filter-btn" data-filter="tray">Trays</button>
            <button class="filter-btn" data-filter="storage">Storage</button>
            <button class="filter-btn" data-filter="accessories">Accessories</button>
        </div>

        <div class="products-grid">
            <?php foreach ($products as $product):
                $imagePath = getProductImagePath($product['image']);
                $isPlaceholder = strpos($imagePath, 'placeholder') !== false;
            ?>
            <div class="product-card" data-category="<?php echo htmlspecialchars($product['category']); ?>">
                <a href="/product.php?slug=<?php echo htmlspecialchars($product['slug']); ?>">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($imagePath); ?>"
                             alt="<?php echo htmlspecialchars($product['name']); ?>"
                             class="<?php echo $isPlaceholder ? 'placeholder' : ''; ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                    </div>
                </a>
                <div class="product-info">
                    <form method="POST" action="/cart.php" style="display: inline;">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="quality-guarantee">
    <div class="container">
        <h2>Our Quality Guarantee</h2>
        <div class="guarantee-grid">
            <div class="guarantee-item">
                <h3>Premium Materials</h3>
                <p>Only the finest materials for lasting quality</p>
            </div>
            <div class="guarantee-item">
                <h3>Satisfaction Guaranteed</h3>
                <p>30-day money-back guarantee on all products</p>
            </div>
            <div class="guarantee-item">
                <h3>Fast Shipping</h3>
                <p>Free shipping on orders over $50</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
