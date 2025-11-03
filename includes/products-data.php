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
        ],
        [
            'id' => 9,
            'name' => 'Mega Grinder XL',
            'slug' => 'mega-grinder-xl',
            'category' => 'grinder',
            'price' => 44.99,
            'description' => 'Extra-large 5-piece grinder with fidget spinner top and kief catcher',
            'long_description' => 'Our largest grinder features a massive grinding chamber, 5-piece construction, and triple-layer kief catcher. Perfect for group sessions with the signature fidget spinner top.',
            'features' => [
                'XL 3" diameter',
                '5-piece construction',
                'Triple kief catcher',
                'Extra sharp teeth',
                'Heavy-duty aluminum'
            ],
            'image' => 'mega-grinder-xl.jpg'
        ],
        [
            'id' => 10,
            'name' => 'Pocket Rolling Tray',
            'slug' => 'pocket-rolling-tray',
            'category' => 'tray',
            'price' => 12.99,
            'description' => 'Compact pocket-sized tray with magnetic closure',
            'long_description' => 'Take your rolling station anywhere with this pocket-sized tray. Features magnetic closure, built-in paper holder, and green fidget widget design.',
            'features' => [
                'Compact 5" x 3"',
                'Magnetic closure',
                'Built-in paper holder',
                'Portable design',
                'Non-slip surface'
            ],
            'image' => 'pocket-rolling-tray.jpg'
        ],
        [
            'id' => 11,
            'name' => 'Glass Jar Storage Set',
            'slug' => 'glass-jar-storage-set',
            'category' => 'storage',
            'price' => 34.99,
            'description' => 'Set of 3 UV-protected glass jars with fidget spinner lids',
            'long_description' => 'Premium set of three storage jars in different sizes. Each features UV-protected glass, airtight seals, and decorative fidget spinner lids.',
            'features' => [
                'Set of 3 jars',
                'UV-protected glass',
                'Airtight seals',
                'Fidget spinner lids',
                'Multiple sizes'
            ],
            'image' => 'glass-jar-storage-set.jpg'
        ],
        [
            'id' => 12,
            'name' => 'Bamboo Rolling Tray',
            'slug' => 'bamboo-rolling-tray',
            'category' => 'tray',
            'price' => 28.99,
            'description' => 'Eco-friendly bamboo tray with laser-engraved fidget design',
            'long_description' => 'Sustainable bamboo construction with laser-engraved fidget widget artwork. Features curved edges, smooth finish, and natural antimicrobial properties.',
            'features' => [
                'Sustainable bamboo',
                'Laser engraving',
                'Curved edges',
                'Antimicrobial',
                'Natural finish'
            ],
            'image' => 'bamboo-rolling-tray.jpg'
        ],
        [
            'id' => 13,
            'name' => 'Spinner Ashtray',
            'slug' => 'spinner-ashtray',
            'category' => 'accessories',
            'price' => 18.99,
            'description' => 'Windproof ashtray with functional fidget spinner center',
            'long_description' => 'Unique ashtray featuring a functional fidget spinner in the center. Deep bowl design, windproof construction, and easy-clean surface.',
            'features' => [
                'Functional spinner',
                'Windproof design',
                'Deep bowl',
                'Easy to clean',
                'Weighted base'
            ],
            'image' => 'spinner-ashtray.jpg'
        ],
        [
            'id' => 14,
            'name' => 'Pre-Roll Tube Pack',
            'slug' => 'pre-roll-tube-pack',
            'category' => 'storage',
            'price' => 15.99,
            'description' => 'Pack of 6 smell-proof tubes with fidget widget caps',
            'long_description' => 'Protect your pre-rolls with these smell-proof tubes. Pack of 6 includes waterproof seals and signature green fidget spinner caps.',
            'features' => [
                'Pack of 6 tubes',
                'Smell-proof',
                'Waterproof seal',
                'Crush-resistant',
                'Fidget caps'
            ],
            'image' => 'pre-roll-tube-pack.jpg'
        ],
        [
            'id' => 15,
            'name' => 'Complete Cleaning Kit',
            'slug' => 'complete-cleaning-kit',
            'category' => 'accessories',
            'price' => 22.99,
            'description' => 'Professional cleaning kit with brushes, solution, and pipe cleaners',
            'long_description' => 'Keep all your pieces pristine with our complete cleaning kit. Includes cleaning solution, multiple brush sizes, pipe cleaners, and microfiber cloths.',
            'features' => [
                'Cleaning solution',
                'Multiple brushes',
                '100 pipe cleaners',
                'Microfiber cloths',
                'Storage case'
            ],
            'image' => 'complete-cleaning-kit.jpg'
        ],
        [
            'id' => 16,
            'name' => 'Smell-Proof Backpack',
            'slug' => 'smell-proof-backpack',
            'category' => 'storage',
            'price' => 54.99,
            'description' => 'Discreet backpack with activated carbon lining and combo lock',
            'long_description' => 'Premium smell-proof backpack featuring activated carbon lining, combination lock, and padded compartments. Perfect for travel with green fidget branding.',
            'features' => [
                'Activated carbon',
                'Combination lock',
                'Padded compartments',
                'Water-resistant',
                'Discreet design'
            ],
            'image' => 'smell-proof-backpack.jpg'
        ],
        [
            'id' => 17,
            'name' => 'Electric Spinner Grinder',
            'slug' => 'electric-spinner-grinder',
            'category' => 'grinder',
            'price' => 79.99,
            'description' => 'Battery-powered electric grinder with fidget spinner activation',
            'long_description' => 'Revolutionary electric grinder activated by spinning the top. Rechargeable battery, variable speed control, and automatic dispensing into storage chamber.',
            'features' => [
                'Battery-powered',
                'Spinner activation',
                'Variable speed',
                'Auto-dispensing',
                'USB rechargeable'
            ],
            'image' => 'electric-spinner-grinder.jpg'
        ],
        [
            'id' => 18,
            'name' => 'Magnetic LED Rolling Tray',
            'slug' => 'magnetic-led-rolling-tray',
            'category' => 'tray',
            'price' => 42.99,
            'description' => 'Premium tray with built-in LED lights and magnetic accessories',
            'long_description' => 'The ultimate rolling tray features color-changing LED lights, magnetic tool holders, and rechargeable battery. Includes magnetic grinder card and poker.',
            'features' => [
                'LED lighting',
                'Magnetic accessories',
                'USB rechargeable',
                'Color-changing',
                'Non-slip base'
            ],
            'image' => 'magnetic-led-rolling-tray.jpg'
        ],
        [
            'id' => 19,
            'name' => 'UV Stash Box',
            'slug' => 'uv-stash-box',
            'category' => 'storage',
            'price' => 64.99,
            'description' => 'Wooden stash box with UV sterilizer and humidity control',
            'long_description' => 'Premium wooden stash box with built-in UV-C sterilizer, digital humidity monitor, and multiple compartments. Features combination lock and fidget spinner decoration.',
            'features' => [
                'UV-C sterilizer',
                'Humidity monitor',
                'Combination lock',
                'Multiple compartments',
                'Premium wood'
            ],
            'image' => 'uv-stash-box.jpg'
        ],
        [
            'id' => 20,
            'name' => 'Fidget Widget Bong',
            'slug' => 'fidget-widget-bong',
            'category' => 'pipe',
            'price' => 89.99,
            'description' => 'Premium glass bong with spinning percolator and green accents',
            'long_description' => 'Hand-crafted glass bong featuring a unique spinning percolator inspired by fidget spinners. Green accents, ice catcher, and splash guard. Each piece is one-of-a-kind.',
            'features' => [
                'Spinning percolator',
                'Ice catcher',
                'Splash guard',
                'Hand-crafted glass',
                'Green accents'
            ],
            'image' => 'fidget-widget-bong.jpg'
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
