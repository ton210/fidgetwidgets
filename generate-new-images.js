const https = require('https');
const fs = require('fs');
const path = require('path');

const API_KEY = 'FPSX381b01bdceb04b9fa3c51f52816cfacd';
const OUTPUT_DIR = path.join(__dirname, 'assets', 'images', 'products');

// Ensure output directory exists
if (!fs.existsSync(OUTPUT_DIR)) {
    fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

const newProducts = [
    {
        name: 'mega-grinder-xl',
        prompt: 'Extra large 5-piece aluminum cannabis grinder with bright green fidget spinner top, massive grinding chamber, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'pocket-rolling-tray',
        prompt: 'Compact pocket-sized rolling tray with magnetic closure, bright green fidget widget design, portable, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'glass-jar-storage-set',
        prompt: 'Set of 3 UV-protected glass storage jars with bright green fidget spinner lids, different sizes, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'bamboo-rolling-tray',
        prompt: 'Eco-friendly bamboo rolling tray with laser-engraved green fidget design, natural wood finish, curved edges, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'spinner-ashtray',
        prompt: 'Windproof ashtray with functional bright green fidget spinner in center, deep bowl, metallic finish, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'pre-roll-tube-pack',
        prompt: 'Pack of 6 smell-proof pre-roll tubes with bright green fidget spinner caps, arranged in a row, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'complete-cleaning-kit',
        prompt: 'Cannabis cleaning kit with bottles brushes pipe cleaners and green fidget branding, all items laid out neatly, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'smell-proof-backpack',
        prompt: 'Discreet black backpack with bright green fidget logo patch, combination lock visible, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'electric-spinner-grinder',
        prompt: 'Battery-powered electric cannabis grinder with bright green fidget spinner on top, USB charging port, modern design, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'magnetic-led-rolling-tray',
        prompt: 'Premium rolling tray with LED lights glowing green, magnetic accessories attached, modern tech design, professional product photography, studio lighting, white background, 8k quality'
    },
    {
        name: 'uv-stash-box',
        prompt: 'Premium wooden stash box with digital display, bright green accents, combination lock, UV light visible, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'fidget-widget-bong',
        prompt: 'Hand-crafted glass water pipe with bright green accents, spinning percolator, ice catcher, artistic glasswork, professional product photography, studio lighting, pure white background, 8k quality'
    }
];

function generateImage(product, index) {
    return new Promise((resolve, reject) => {
        const postData = JSON.stringify({
            prompt: product.prompt,
            negative_prompt: 'low quality, blurry, distorted, ugly, dark background, shadows, people, hands, text',
            guidance_scale: 2,
            seed: 20000 + index * 1111,
            num_images: 1,
            image: {
                size: 'square_1_1'
            },
            styling: {
                style: 'photo',
                effects: {
                    color: 'vibrant',
                    lightning: 'warm'
                },
                colors: [
                    { color: '#7CFC00', weight: 1 },
                    { color: '#228B22', weight: 0.5 }
                ]
            }
        });

        const options = {
            hostname: 'api.freepik.com',
            port: 443,
            path: '/v1/ai/text-to-image',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'x-freepik-api-key': API_KEY,
                'Content-Length': Buffer.byteLength(postData)
            }
        };

        console.log(`\nGenerating: ${product.name}...`);

        const req = https.request(options, (res) => {
            let data = '';

            res.on('data', (chunk) => {
                data += chunk;
            });

            res.on('end', () => {
                try {
                    const response = JSON.parse(data);

                    // Save JSON response
                    const jsonPath = path.join(OUTPUT_DIR, `${product.name}.json`);
                    fs.writeFileSync(jsonPath, JSON.stringify(response, null, 2));

                    if (response.data && response.data[0] && response.data[0].base64) {
                        // Decode and save image
                        const imgBuffer = Buffer.from(response.data[0].base64, 'base64');
                        const imgPath = path.join(OUTPUT_DIR, `${product.name}.jpg`);
                        fs.writeFileSync(imgPath, imgBuffer);
                        console.log(`✓ Saved: ${product.name}.jpg`);
                        resolve();
                    } else {
                        console.log(`✗ Failed: ${product.name}`);
                        console.log('Response:', JSON.stringify(response, null, 2).substring(0, 500));
                        reject(new Error(`No image data for ${product.name}`));
                    }
                } catch (err) {
                    console.error(`✗ Error parsing response for ${product.name}:`, err.message);
                    reject(err);
                }
            });
        });

        req.on('error', (err) => {
            console.error(`✗ Request error for ${product.name}:`, err.message);
            reject(err);
        });

        req.write(postData);
        req.end();
    });
}

async function generateAllImages() {
    console.log('============================================');
    console.log('Fidget Widgets - Generating 12 New Products');
    console.log('============================================');

    for (let i = 0; i < newProducts.length; i++) {
        try {
            await generateImage(newProducts[i], i);
            // Wait 3 seconds between requests to avoid rate limiting
            if (i < newProducts.length - 1) {
                console.log('Waiting 3 seconds...');
                await new Promise(resolve => setTimeout(resolve, 3000));
            }
        } catch (err) {
            console.error(`Failed to generate ${newProducts[i].name}:`, err.message);
            // Continue with next image
        }
    }

    console.log('\n============================================');
    console.log('12 New Images Generated!');
    console.log('============================================');
}

generateAllImages().catch(console.error);
