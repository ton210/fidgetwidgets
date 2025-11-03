<?php
require_once 'config.php';
require_once 'includes/products-data.php';

$pageTitle = 'Home';
$featuredProducts = array_slice(getProducts(), 0, 4); // Get first 4 products
?>

<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Welcome to Fidget Widgets</h1>
            <p class="tagline">Where Cannabis Accessories Meet Playful Design</p>
            <p class="subtitle">Premium quality products that spin, roll, and elevate your experience</p>
            <div class="cta-buttons">
                <a href="/products.php" class="btn btn-primary">Shop Now</a>
                <a href="/about.php" class="btn btn-secondary">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2>Why Choose Fidget Widgets?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🎨</div>
                <h3>Unique Design</h3>
                <p>Stand out with our distinctive fidget-inspired cannabis accessories</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Premium Quality</h3>
                <p>Built to last with high-quality materials and craftsmanship</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🌿</div>
                <h3>Eco-Friendly</h3>
                <p>Sustainable products that are kind to our planet</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✨</div>
                <h3>Innovation</h3>
                <p>Cutting-edge designs that enhance your experience</p>
            </div>
        </div>
    </div>
</section>

<section class="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <div class="products-grid">
            <?php foreach ($featuredProducts as $product):
                $imagePath = getProductImagePath($product['image']);
                $isPlaceholder = strpos($imagePath, 'placeholder') !== false;
            ?>
            <div class="product-card">
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
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="/products.php" class="btn btn-primary">View All Products</a>
        </div>
    </div>
</section>

<section class="newsletter">
    <div class="container">
        <div class="newsletter-content">
            <h2>Stay Updated</h2>
            <p>Get exclusive deals and new product announcements</p>
            <form class="newsletter-form" method="POST" action="/subscribe.php">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
