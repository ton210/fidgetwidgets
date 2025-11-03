<?php
/**
 * Admin Tool: Generate All Product Images
 * Access via browser: http://your-domain/admin/generate-products.php
 */

require_once '../config.php';
require_once '../api/FreepikAPI.php';

// Simple authentication (change this password!)
$adminPassword = 'fidget2024';

$authenticated = false;
if (isset($_POST['password']) && $_POST['password'] === $adminPassword) {
    $_SESSION['admin_authenticated'] = true;
    $authenticated = true;
} elseif (isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] === true) {
    $authenticated = true;
}

if (!$authenticated) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Login - Generate Products</title>
        <style>
            body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f5f5f5; }
            .login-box { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            input { padding: 0.5rem; margin: 0.5rem 0; width: 100%; }
            button { padding: 0.75rem; background: #7CFC00; border: none; cursor: pointer; width: 100%; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h2>Admin Login</h2>
            <form method="POST">
                <input type="password" name="password" placeholder="Enter admin password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Create images directory if it doesn't exist
$imagesDir = IMAGES_PATH . '/products';
if (!is_dir($imagesDir)) {
    mkdir($imagesDir, 0755, true);
}

// Handle image generation
$generating = false;
$results = [];

if (isset($_POST['generate'])) {
    $generating = true;
    $productId = $_POST['product_id'];

    // Initialize Freepik API
    $freepik = new FreepikAPI(FREEPIK_API_KEY, FREEPIK_API_URL);

    // Product definitions
    $products = [
        1 => [
            'name' => 'spinner-grinder-pro',
            'prompt' => 'Premium 4-piece aluminum cannabis herb grinder with bright green fidget spinner top, metallic silver finish, magnetic closure, professional product photography, studio lighting, pure white background, sharp focus, 8k quality'
        ],
        2 => [
            'name' => 'widget-rolling-tray',
            'prompt' => 'Large rectangular rolling tray with bright green fidget spinner pattern embossed design, built-in compartments, metallic surface, professional product photography, studio lighting, pure white background, top view, 8k quality'
        ],
        3 => [
            'name' => 'airtight-storage',
            'prompt' => 'Premium cylindrical cannabis storage jar with bright green fidget spinner logo, brushed metal cap, glass body, airtight seal, professional product photography, studio lighting, pure white background, 8k quality'
        ],
        4 => [
            'name' => 'fidget-papers',
            'prompt' => 'Rolling papers package with vibrant green fidget spinner character logo, modern minimalist design, premium cardboard box, professional product photography, studio lighting, pure white background, 8k quality'
        ],
        5 => [
            'name' => 'spinner-lighter',
            'prompt' => 'Refillable metal lighter with bright green fidget spinner design on top, chrome finish, ergonomic shape, professional product photography, studio lighting, pure white background, 8k quality'
        ],
        6 => [
            'name' => 'widget-pipe',
            'prompt' => 'Hand-blown glass smoking pipe with swirled bright green and clear glass, fidget-inspired curved design, artistic glasswork, professional product photography, studio lighting, pure white background, 8k quality'
        ],
        7 => [
            'name' => 'complete-starter-kit',
            'prompt' => 'Complete cannabis accessories set arranged neatly, grinder, rolling tray, storage jar, papers, and lighter, all with matching bright green fidget spinner branding, professional product photography, studio lighting, pure white background, 8k quality'
        ],
        8 => [
            'name' => 'mini-travel-kit',
            'prompt' => 'Compact cannabis travel kit in sleek black case with bright green fidget logo, mini grinder and storage visible inside, professional product photography, studio lighting, pure white background, 8k quality'
        ]
    ];

    if (isset($products[$productId])) {
        $product = $products[$productId];

        $options = [
            'prompt' => $product['prompt'],
            'negative_prompt' => 'low quality, blurry, distorted, ugly, dark background, shadows, people, hands, fingers, text overlay, watermark, multiple items, cluttered',
            'guidance_scale' => 4,
            'seed' => rand(1, 100000),
            'num_images' => 1,
            'image' => [
                'size' => 'square_1_1'
            ],
            'styling' => [
                'style' => 'photo',
                'effects' => [
                    'color' => 'vibrant',
                    'lightning' => 'studio',
                    'framing' => 'product'
                ],
                'colors' => [
                    ['color' => '#7CFC00', 'weight' => 3],
                    ['color' => '#FFFFFF', 'weight' => 2],
                    ['color' => '#228B22', 'weight' => 1]
                ]
            ],
            'filter_nsfw' => true
        ];

        $result = $freepik->generateImage($product['prompt'], $options);

        if (!isset($result['error'])) {
            // Save response data
            $responseFile = $imagesDir . '/' . $product['name'] . '.json';
            file_put_contents($responseFile, json_encode($result, JSON_PRETTY_PRINT));

            // Try to download image if URL is provided
            $imageDownloaded = false;
            if (isset($result['data'][0]['url'])) {
                $imageUrl = $result['data'][0]['url'];
                $imageData = @file_get_contents($imageUrl);
                if ($imageData !== false) {
                    $imageFile = $imagesDir . '/' . $product['name'] . '.jpg';
                    file_put_contents($imageFile, $imageData);
                    $imageDownloaded = true;
                }
            } elseif (isset($result['data'][0]['base64'])) {
                $imageData = base64_decode($result['data'][0]['base64']);
                $imageFile = $imagesDir . '/' . $product['name'] . '.jpg';
                file_put_contents($imageFile, $imageData);
                $imageDownloaded = true;
            }

            $results = [
                'success' => true,
                'product' => $product['name'],
                'response' => $result,
                'imageDownloaded' => $imageDownloaded
            ];
        } else {
            $results = [
                'success' => false,
                'error' => $result['message'] ?? 'Unknown error',
                'response' => $result
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Product Images - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; padding: 2rem; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #228B22; margin-bottom: 2rem; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .product-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .product-card h3 { color: #228B22; margin-bottom: 1rem; }
        .product-card p { color: #666; font-size: 0.9rem; margin-bottom: 1rem; }
        .btn { padding: 0.75rem 1.5rem; background: #7CFC00; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; }
        .btn:hover { background: #90EE90; }
        .btn:disabled { background: #ccc; cursor: not-allowed; }
        .result { background: white; padding: 2rem; border-radius: 8px; margin-bottom: 2rem; }
        .success { border-left: 4px solid #28a745; }
        .error { border-left: 4px solid #dc3545; }
        pre { background: #f8f9fa; padding: 1rem; border-radius: 4px; overflow-x: auto; font-size: 0.85rem; }
        .status { display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.85rem; margin-bottom: 0.5rem; }
        .status-exists { background: #d4edda; color: #155724; }
        .status-missing { background: #f8d7da; color: #721c24; }
        .logout { float: right; padding: 0.5rem 1rem; background: #dc3545; color: white; text-decoration: none; border-radius: 4px; }
        .generate-all { background: #228B22; color: white; padding: 1rem 2rem; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 1.1rem; margin-bottom: 2rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            Generate Product Images
            <a href="?logout=1" class="logout" onclick="return confirm('Logout?')">Logout</a>
        </h1>

        <?php if ($generating && !empty($results)): ?>
        <div class="result <?php echo $results['success'] ? 'success' : 'error'; ?>">
            <?php if ($results['success']): ?>
                <h2>✅ Image Generated Successfully!</h2>
                <p><strong>Product:</strong> <?php echo htmlspecialchars($results['product']); ?></p>
                <p><strong>Image Downloaded:</strong> <?php echo $results['imageDownloaded'] ? 'Yes' : 'No (check response data below)'; ?></p>
                <h3>API Response:</h3>
                <pre><?php echo htmlspecialchars(json_encode($results['response'], JSON_PRETTY_PRINT)); ?></pre>
            <?php else: ?>
                <h2>❌ Generation Failed</h2>
                <p><strong>Error:</strong> <?php echo htmlspecialchars($results['error']); ?></p>
                <h3>API Response:</h3>
                <pre><?php echo htmlspecialchars(json_encode($results['response'], JSON_PRETTY_PRINT)); ?></pre>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="products-grid">
            <?php
            $productsList = [
                ['id' => 1, 'name' => 'Spinner Grinder Pro', 'file' => 'spinner-grinder-pro'],
                ['id' => 2, 'name' => 'Widget Rolling Tray', 'file' => 'widget-rolling-tray'],
                ['id' => 3, 'name' => 'Airtight Storage', 'file' => 'airtight-storage'],
                ['id' => 4, 'name' => 'Fidget Papers', 'file' => 'fidget-papers'],
                ['id' => 5, 'name' => 'Spinner Lighter', 'file' => 'spinner-lighter'],
                ['id' => 6, 'name' => 'Widget Pipe', 'file' => 'widget-pipe'],
                ['id' => 7, 'name' => 'Complete Starter Kit', 'file' => 'complete-starter-kit'],
                ['id' => 8, 'name' => 'Mini Travel Kit', 'file' => 'mini-travel-kit']
            ];

            foreach ($productsList as $prod):
                $imageExists = file_exists($imagesDir . '/' . $prod['file'] . '.jpg');
            ?>
            <div class="product-card">
                <h3><?php echo htmlspecialchars($prod['name']); ?></h3>
                <span class="status <?php echo $imageExists ? 'status-exists' : 'status-missing'; ?>">
                    <?php echo $imageExists ? '✓ Image Exists' : '✗ Not Generated'; ?>
                </span>
                <p>Product ID: <?php echo $prod['id']; ?></p>
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $prod['id']; ?>">
                    <button type="submit" name="generate" class="btn">
                        <?php echo $imageExists ? 'Regenerate' : 'Generate'; ?> Image
                    </button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 8px;">
            <h3>Instructions:</h3>
            <ol style="margin-left: 1.5rem; line-height: 1.8;">
                <li>Click "Generate Image" for each product</li>
                <li>Wait for the API to process (may take 10-30 seconds)</li>
                <li>Check the response to see if the image was generated</li>
                <li>Images are saved to: <code>/assets/images/products/</code></li>
                <li>If download fails, check the JSON response for the image URL</li>
            </ol>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: generate-products.php');
    exit;
}
?>
