<?php
/**
 * Products Data
 * Central repository for all product information
 */

function getProducts() {
    return [
        [
            'id' => 1,
            'name' => 'Spinner Grinder Pro',
            'slug' => 'spinner-grinder-pro',
            'category' => 'grinder',
            'price' => 29.99,
            'description' => '4-piece aluminum grinder with fidget spinner top and magnetic closure',
            'long_description' => 'Premium 4-piece grinder featuring our signature fidget spinner top. Includes magnetic closure, diamond-shaped teeth, pollen catcher, and smooth grinding action. Made from aircraft-grade aluminum.',
            'features' => [
                '4-piece construction',
                'Fidget spinner top',
                'Magnetic closure',
                'Pollen catcher',
                'Aircraft-grade aluminum'
            ],
            'image' => 'spinner-grinder-pro.jpg'
        ],
        [
            'id' => 2,
            'name' => 'Widget Rolling Tray',
            'slug' => 'widget-rolling-tray',
            'category' => 'tray',
            'price' => 24.99,
            'description' => 'Large rolling tray with built-in storage compartments and non-slip surface',
            'long_description' => 'Premium rolling tray featuring our fidget widget design with built-in compartments for organized storage. Non-slip surface and raised edges keep everything in place.',
            'features' => [
                'Large 11" x 7" surface',
                'Built-in compartments',
                'Non-slip surface',
                'Raised edges',
                'Easy to clean'
            ],
            'image' => 'widget-rolling-tray.jpg'
        ],
        [
            'id' => 3,
            'name' => 'Airtight Storage Container',
            'slug' => 'airtight-storage',
            'category' => 'storage',
            'price' => 19.99,
            'description' => 'Premium smell-proof container with humidity control',
            'long_description' => 'Keep your herbs fresh with our airtight storage container. Features an integrated humidity pack holder and UV-protected glass to preserve quality and potency.',
            'features' => [
                'Airtight seal',
                'Smell-proof',
                'UV-protected glass',
                'Humidity control',
                '2oz capacity'
            ],
            'image' => 'airtight-storage.jpg'
        ],
        [
            'id' => 4,
            'name' => 'Fidget Papers',
            'slug' => 'fidget-papers',
            'category' => 'rolling_papers',
            'price' => 4.99,
            'description' => 'Premium rolling papers with natural gum, 50 sheets per pack',
            'long_description' => 'Ultra-thin rolling papers made from natural fibers with Arabic gum. Burns slow and even for the perfect experience every time.',
            'features' => [
                '50 sheets per pack',
                'Natural fibers',
                'Natural Arabic gum',
                'Ultra-thin',
                'Slow burn'
            ],
            'image' => 'fidget-papers.jpg'
        ],
        [
            'id' => 5,
            'name' => 'Spinner Lighter',
            'slug' => 'spinner-lighter',
            'category' => 'lighter',
            'price' => 9.99,
            'description' => 'Refillable lighter with fidget spinner design',
            'long_description' => 'Premium refillable lighter featuring a functional fidget spinner on top. Adjustable flame, reliable ignition, and satisfying spin action.',
            'features' => [
                'Refillable',
                'Functional fidget spinner',
                'Adjustable flame',
                'Metal construction',
                'Reliable ignition'
            ],
            'image' => 'spinner-lighter.jpg'
        ],
        [
            'id' => 6,
            'name' => 'Widget Pipe',
            'slug' => 'widget-pipe',
            'category' => 'pipe',
            'price' => 34.99,
            'description' => 'Hand-blown glass pipe with unique fidget-inspired design',
            'long_description' => 'Artisan hand-blown glass pipe featuring swirled colors and fidget-inspired curves. Each piece is unique with thick, durable glass construction.',
            'features' => [
                'Hand-blown glass',
                'Unique design',
                'Thick, durable glass',
                'Easy to clean',
                'Includes case'
            ],
            'image' => 'widget-pipe.jpg'
        ],
        [
            'id' => 7,
            'name' => 'Complete Starter Kit',
            'slug' => 'complete-starter-kit',
            'category' => 'grinder',
            'price' => 59.99,
            'description' => 'Everything you need: grinder, tray, storage, papers, and lighter',
            'long_description' => 'The ultimate starter package includes our Spinner Grinder, Rolling Tray, Storage Container, Papers, and Lighter. Everything you need in one complete kit with matching fidget widget branding.',
            'features' => [
                'Complete set',
                'Grinder included',
                'Rolling tray',
                'Storage container',
                'Papers & lighter'
            ],
            'image' => 'complete-starter-kit.jpg'
        ],
        [
            'id' => 8,
            'name' => 'Mini Travel Kit',
            'slug' => 'mini-travel-kit',
            'category' => 'storage',
            'price' => 39.99,
            'description' => 'Compact travel kit with grinder and smell-proof storage',
            'long_description' => 'Perfect for on-the-go, this compact kit includes a mini grinder and smell-proof storage in a discreet carrying case. TSA-friendly design (for legal use only).',
            'features' => [
                'Compact size',
                'Mini grinder',
                'Smell-proof case',
                'Discreet design',
                'TSA-friendly'
            ],
            'image' => 'mini-travel-kit.jpg'
        ]
    ];
}

function getProductById($id) {
    $products = getProducts();
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}

function getProductBySlug($slug) {
    $products = getProducts();
    foreach ($products as $product) {
        if ($product['slug'] == $slug) {
            return $product;
        }
    }
    return null;
}

function getProductImagePath($imageName) {
    $imagePath = '/assets/images/products/' . $imageName;
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;

    // Check if image exists, otherwise return placeholder
    if (file_exists($fullPath)) {
        return $imagePath;
    } else {
        return '/assets/images/placeholder-product.jpg';
    }
}

function getProductsByCategory($category) {
    $products = getProducts();
    if ($category === 'all') {
        return $products;
    }

    return array_filter($products, function($product) use ($category) {
        return $product['category'] === $category;
    });
}
?>
