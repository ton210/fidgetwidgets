const https = require('https');
const fs = require('fs');
const path = require('path');

const API_KEY = 'FPSX381b01bdceb04b9fa3c51f52816cfacd';
const OUTPUT_DIR = path.join(__dirname, 'assets', 'images', 'products');

const failedProducts = [
    {
        name: 'pocket-rolling-tray',
        prompt: 'Small compact rolling tray with green fidget spinner design, magnetic lid, metallic finish, product photography, white background'
    },
    {
        name: 'glass-jar-storage-set',
        prompt: 'Three glass jars with green lids arranged together, different sizes, UV protected glass, product photography, white background'
    },
    {
        name: 'smell-proof-backpack',
        prompt: 'Black backpack with green logo patch, combination lock, discreet design, product photography, white background'
    },
    {
        name: 'electric-spinner-grinder',
        prompt: 'Electric cannabis grinder with green spinner top, USB port, battery powered, modern design, product photography, white background'
    }
];

function generateImage(product, index) {
    return new Promise((resolve, reject) => {
        const postData = JSON.stringify({
            prompt: product.prompt,
            negative_prompt: 'low quality, blurry, dark, people, hands',
            guidance_scale: 2,
            seed: 30000 + index * 2222,
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

        console.log(`\nRetrying: ${product.name}...`);

        const req = https.request(options, (res) => {
            let data = '';

            res.on('data', (chunk) => {
                data += chunk;
            });

            res.on('end', () => {
                try {
                    const response = JSON.parse(data);
                    const jsonPath = path.join(OUTPUT_DIR, `${product.name}.json`);
                    fs.writeFileSync(jsonPath, JSON.stringify(response, null, 2));

                    if (response.data && response.data[0] && response.data[0].base64) {
                        const imgBuffer = Buffer.from(response.data[0].base64, 'base64');
                        const imgPath = path.join(OUTPUT_DIR, `${product.name}.jpg`);
                        fs.writeFileSync(imgPath, imgBuffer);
                        console.log(`✓ Saved: ${product.name}.jpg`);
                        resolve();
                    } else {
                        console.log(`✗ Still failed: ${product.name}`);
                        reject(new Error(`No image data`));
                    }
                } catch (err) {
                    console.error(`✗ Error for ${product.name}:`, err.message);
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

async function retryFailedImages() {
    console.log('Retrying 4 failed images...\n');

    for (let i = 0; i < failedProducts.length; i++) {
        try {
            await generateImage(failedProducts[i], i);
            if (i < failedProducts.length - 1) {
                console.log('Waiting 3 seconds...');
                await new Promise(resolve => setTimeout(resolve, 3000));
            }
        } catch (err) {
            console.error(`Failed: ${failedProducts[i].name}`);
        }
    }

    console.log('\n✓ Retry complete!');
}

retryFailedImages().catch(console.error);
