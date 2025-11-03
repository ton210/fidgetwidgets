<?php
/**
 * Freepik API Integration Class
 * Handles text-to-image generation using Freepik API
 */

class FreepikAPI {
    private $apiKey;
    private $apiUrl;

    public function __construct($apiKey, $apiUrl) {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Generate image from text prompt
     *
     * @param string $prompt The text prompt for image generation
     * @param array $options Additional options for image generation
     * @return array Response from API
     */
    public function generateImage($prompt, $options = []) {
        $defaultOptions = [
            'prompt' => $prompt,
            'negative_prompt' => 'low quality, blurry, ugly',
            'guidance_scale' => 2,
            'seed' => rand(1, 10000),
            'num_images' => 1,
            'image' => [
                'size' => 'square_1_1'
            ],
            'styling' => [
                'style' => 'photo',
                'effects' => [
                    'color' => 'vibrant',
                    'lightning' => 'warm',
                    'framing' => 'close-up'
                ],
                'colors' => [
                    ['color' => '#7CFC00', 'weight' => 1], // Lawn green (matching logo)
                    ['color' => '#228B22', 'weight' => 1]  // Forest green
                ]
            ],
            'filter_nsfw' => true
        ];

        $data = array_merge($defaultOptions, $options);

        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'x-freepik-api-key: ' . $this->apiKey
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            return json_decode($response, true);
        } else {
            return [
                'error' => true,
                'message' => 'API request failed',
                'response' => $response,
                'http_code' => $httpCode
            ];
        }
    }

    /**
     * Generate cannabis accessory themed image
     *
     * @param string $accessoryType Type of accessory (grinder, tray, storage, etc.)
     * @return array Response from API
     */
    public function generateAccessoryImage($accessoryType) {
        $prompts = [
            'grinder' => 'Premium cannabis herb grinder with colorful fidget spinner design, product photography, studio lighting',
            'tray' => 'Modern rolling tray with fun fidget widget patterns, sleek design, studio photography',
            'storage' => 'Stylish cannabis storage container with playful fidget spinner elements, premium quality',
            'rolling_papers' => 'Premium rolling papers package with fun fidget widget branding, product shot',
            'lighter' => 'Designer lighter with fidget spinner design elements, premium quality, studio lighting',
            'pipe' => 'Artistic glass pipe with colorful fidget widget aesthetics, product photography'
        ];

        $prompt = isset($prompts[$accessoryType]) ? $prompts[$accessoryType] : $prompts['grinder'];

        return $this->generateImage($prompt, [
            'styling' => [
                'style' => 'photo',
                'effects' => [
                    'color' => 'vibrant',
                    'lightning' => 'studio',
                    'framing' => 'product'
                ]
            ]
        ]);
    }
}
?>
