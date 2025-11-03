<?php
/**
 * Generate All Product Images
 * Run this script once to generate all product images using Freepik API
 */

require_once 'config.php';
require_once 'api/FreepikAPI.php';

// Create images directory if it doesn't exist
$imagesDir = IMAGES_PATH . '/products';
if (!is_dir($imagesDir)) {
    mkdir($imagesDir, 0755, true);
}

// Initialize Freepik API
$freepik = new FreepikAPI(FREEPIK_API_KEY, FREEPIK_API_URL);

// Define all products and their image prompts
$products = [
    [
        'id' => 1,
        'name' => 'spinner-grinder-pro',
        'prompt' => 'Premium 4-piece aluminum cannabis herb grinder with green fidget spinner top, metallic finish, magnetic closure, product photography, studio lighting, white background',
        'style' => 'photo'
    ],
    [
        'id' => 2,
        'name' => 'widget-rolling-tray',
        'prompt' => 'Large green rolling tray with fidget spinner pattern design, built-in storage compartments, non-slip surface, product photography, studio lighting, white background',
        'style' => 'photo'
    ],
    [
        'id' => 3,
        'name' => 'airtight-storage',
        'prompt' => 'Premium green cannabis storage container with fidget widget design, airtight seal, smell-proof, modern aesthetic, product photography, studio lighting, white background',
        'style' => 'photo'
    ],
    [
        'id' => 4,
        'name' => 'fidget-papers',
        'prompt' => 'Premium rolling papers package with green fidget widget logo, modern packaging design, 50 sheets, product photography, studio lighting, white background',
        'style' => 'photo'
    ],
    [
        'id' => 5,
        'name' => 'spinner-lighter',
        'prompt' => 'Designer refillable lighter with green fidget spinner design elements on top, metallic finish, premium quality, product photography, studio lighting, white background',
        'style' => 'photo'
    ],
    [
        'id' => 6,
        'name' => 'widget-pipe',
        'prompt' => 'Artistic glass pipe with green and colorful fidget widget aesthetics, swirled glass design, premium quality, product photography, studio lighting, white background',
        'style' => 'photo'
    ],
    [
        'id' => 7,
        'name' => 'complete-starter-kit',
        'prompt' => 'Complete cannabis accessories starter kit with green fidget theme, grinder, tray, storage container, papers and lighter arranged together, product photography, studio lighting, white background',
        'style' => 'photo'
    ],
    [
        'id' => 8,
        'name' => 'mini-travel-kit',
        'prompt' => 'Compact green travel kit for cannabis, small grinder and smell-proof storage in portable case with fidget design, product photography, studio lighting, white background',
        'style' => 'photo'
    ]
];

echo "===========================================\n";
echo "Fidget Widgets - Image Generation Script\n";
echo "===========================================\n\n";

$successCount = 0;
$errorCount = 0;

foreach ($products as $product) {
    echo "Generating image for: {$product['name']}...\n";
    echo "Prompt: {$product['prompt']}\n";

    $options = [
        'prompt' => $product['prompt'],
        'negative_prompt' => 'low quality, blurry, ugly, dark, shadows, people, hands, text, watermark',
        'guidance_scale' => 3,
        'seed' => rand(1, 100000),
        'num_images' => 1,
        'image' => [
            'size' => 'square_1_1'
        ],
        'styling' => [
            'style' => $product['style'],
            'effects' => [
                'color' => 'vibrant',
                'lightning' => 'studio',
                'framing' => 'product'
            ],
            'colors' => [
                ['color' => '#7CFC00', 'weight' => 2], // Lawn green (primary)
                ['color' => '#228B22', 'weight' => 1]  // Forest green
            ]
        ],
        'filter_nsfw' => true
    ];

    $result = $freepik->generateImage($product['prompt'], $options);

    if (isset($result['error'])) {
        echo "❌ ERROR: " . ($result['message'] ?? 'Unknown error') . "\n";
        echo "HTTP Code: " . ($result['http_code'] ?? 'N/A') . "\n";
        echo "Response: " . substr($result['response'] ?? '', 0, 200) . "...\n";
        $errorCount++;
    } else {
        echo "✅ SUCCESS!\n";
        echo "Response data:\n";
        echo json_encode($result, JSON_PRETTY_PRINT) . "\n";

        // Save the response data for later use
        $responseFile = $imagesDir . '/' . $product['name'] . '.json';
        file_put_contents($responseFile, json_encode($result, JSON_PRETTY_PRINT));
        echo "Saved response to: {$responseFile}\n";

        // Note: The actual image URL or data will be in the response
        // You may need to download the image from the URL provided in the response
        if (isset($result['data']) && isset($result['data'][0]['url'])) {
            $imageUrl = $result['data'][0]['url'];
            $imageData = file_get_contents($imageUrl);
            if ($imageData !== false) {
                $imageFile = $imagesDir . '/' . $product['name'] . '.jpg';
                file_put_contents($imageFile, $imageData);
                echo "Downloaded image to: {$imageFile}\n";
            }
        }

        $successCount++;
    }

    echo "\n-------------------------------------------\n\n";

    // Add delay to avoid rate limiting
    sleep(2);
}

echo "===========================================\n";
echo "Image Generation Complete!\n";
echo "Success: {$successCount}\n";
echo "Errors: {$errorCount}\n";
echo "===========================================\n";
?>
