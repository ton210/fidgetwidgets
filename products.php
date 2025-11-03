<?php
require_once 'config.php';
$pageTitle = 'Products';

// Product catalog
$products = [
    [
        'id' => 1,
        'name' => 'Spinner Grinder Pro',
        'category' => 'grinder',
        'price' => 29.99,
        'description' => '4-piece aluminum grinder with fidget spinner top and magnetic closure'
    ],
    [
        'id' => 2,
        'name' => 'Widget Rolling Tray',
        'category' => 'tray',
        'price' => 24.99,
        'description' => 'Large rolling tray with built-in storage compartments and non-slip surface'
    ],
    [
        'id' => 3,
        'name' => 'Airtight Storage Container',
        'category' => 'storage',
        'price' => 19.99,
        'description' => 'Premium smell-proof container with humidity control'
    ],
    [
        'id' => 4,
        'name' => 'Fidget Papers',
        'category' => 'rolling_papers',
        'price' => 4.99,
        'description' => 'Premium rolling papers with natural gum, 50 sheets per pack'
    ],
    [
        'id' => 5,
        'name' => 'Spinner Lighter',
        'category' => 'lighter',
        'price' => 9.99,
        'description' => 'Refillable lighter with fidget spinner design'
    ],
    [
        'id' => 6,
        'name' => 'Widget Pipe',
        'category' => 'pipe',
        'price' => 34.99,
        'description' => 'Hand-blown glass pipe with unique fidget-inspired design'
    ],
    [
        'id' => 7,
        'name' => 'Complete Starter Kit',
        'category' => 'grinder',
        'price' => 59.99,
        'description' => 'Everything you need: grinder, tray, storage, papers, and lighter'
    ],
    [
        'id' => 8,
        'name' => 'Mini Travel Kit',
        'category' => 'storage',
        'price' => 39.99,
        'description' => 'Compact travel kit with grinder and smell-proof storage'
    ]
];
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
            <?php foreach ($products as $product): ?>
            <div class="product-card" data-category="<?php echo htmlspecialchars($product['category']); ?>">
                <div class="product-image-placeholder">
                    <span><?php echo htmlspecialchars($product['name']); ?></span>
                </div>
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                    <button class="btn btn-primary">Add to Cart</button>
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
