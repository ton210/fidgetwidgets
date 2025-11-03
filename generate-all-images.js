const https = require('https');
const fs = require('fs');
const path = require('path');

const API_KEY = 'FPSX381b01bdceb04b9fa3c51f52816cfacd';
const OUTPUT_DIR = path.join(__dirname, 'assets', 'images', 'products');

// Ensure output directory exists
if (!fs.existsSync(OUTPUT_DIR)) {
    fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

const products = [
    {
        name: 'spinner-grinder-pro',
        prompt: 'Premium 4-piece aluminum cannabis herb grinder with bright green fidget spinner top, metallic silver finish, magnetic closure, professional product photography, studio lighting, pure white background, sharp focus, 8k quality'
    },
    {
        name: 'widget-rolling-tray',
        prompt: 'Large rectangular rolling tray with bright green fidget spinner pattern embossed design, built-in compartments, metallic surface, professional product photography, studio lighting, pure white background, top view, 8k quality'
    },
    {
        name: 'airtight-storage',
        prompt: 'Premium cylindrical cannabis storage jar with bright green fidget spinner logo, brushed metal cap, glass body, airtight seal, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'fidget-papers',
        prompt: 'Rolling papers package with vibrant green fidget spinner character logo, modern minimalist design, premium cardboard box, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'spinner-lighter',
        prompt: 'Refillable metal lighter with bright green fidget spinner design on top, chrome finish, ergonomic shape, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'widget-pipe',
        prompt: 'Hand-blown glass smoking pipe with swirled bright green and clear glass, fidget-inspired curved design, artistic glasswork, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'complete-starter-kit',
        prompt: 'Complete cannabis accessories set arranged neatly, grinder rolling tray storage jar papers and lighter all with matching bright green fidget spinner branding, professional product photography, studio lighting, pure white background, 8k quality'
    },
    {
        name: 'mini-travel-kit',
        prompt: 'Compact cannabis travel kit in sleek black case with bright green fidget logo, mini grinder and storage visible inside, professional product photography, studio lighting, pure white background, 8k quality'
    }
];

function generateImage(product, index) {
    return new Promise((resolve, reject) => {
        const postData = JSON.stringify({
            prompt: product.prompt,
            negative_prompt: 'low quality, blurry, distorted, ugly, dark background, shadows, people, hands, text',
            guidance_scale: 2,
            seed: 10000 + index * 1111,
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
    console.log('Fidget Widgets - Generating Product Images');
    console.log('============================================');

    for (let i = 0; i < products.length; i++) {
        try {
            await generateImage(products[i], i);
            // Wait 3 seconds between requests to avoid rate limiting
            if (i < products.length - 1) {
                console.log('Waiting 3 seconds...');
                await new Promise(resolve => setTimeout(resolve, 3000));
            }
        } catch (err) {
            console.error(`Failed to generate ${products[i].name}:`, err.message);
            // Continue with next image
        }
    }

    console.log('\n============================================');
    console.log('Image Generation Complete!');
    console.log('============================================');
}

generateAllImages().catch(console.error);
