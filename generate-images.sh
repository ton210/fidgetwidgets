#!/bin/bash

# Fidget Widgets - Image Generation Script
# This script generates all product images using the Freepik API

API_KEY="FPSX381b01bdceb04b9fa3c51f52816cfacd"
API_URL="https://api.freepik.com/v1/ai/text-to-image"
OUTPUT_DIR="assets/images/products"

cd "$(dirname "$0")"

# Create output directory if it doesn't exist
mkdir -p "$OUTPUT_DIR"

echo "============================================"
echo "Fidget Widgets - Generating Product Images"
echo "============================================"
echo ""

# Function to generate image
generate_image() {
    local name=$1
    local prompt=$2
    local seed=$3

    echo "Generating: $name..."

    # Call API
    curl --silent --request POST \
      --url "$API_URL" \
      --header 'Content-Type: application/json' \
      --header "x-freepik-api-key: $API_KEY" \
      --data "{
      \"prompt\": \"$prompt\",
      \"negative_prompt\": \"low quality, blurry, distorted, ugly, dark background, shadows, people, hands, text\",
      \"guidance_scale\": 2,
      \"seed\": $seed,
      \"num_images\": 1,
      \"image\": {
        \"size\": \"square_1_1\"
      },
      \"styling\": {
        \"style\": \"photo\",
        \"effects\": {
          \"color\": \"vibrant\",
          \"lightning\": \"warm\"
        },
        \"colors\": [
          {\"color\": \"#7CFC00\", \"weight\": 1},
          {\"color\": \"#228B22\", \"weight\": 0.5}
        ]
      }
    }" > "$OUTPUT_DIR/$name.json"

    # Check if we got data
    if grep -q '"base64"' "$OUTPUT_DIR/$name.json"; then
        # Extract base64 and decode
        python3 -c "import json, base64; data = json.load(open('$OUTPUT_DIR/$name.json')); img_data = base64.b64decode(data['data'][0]['base64']); open('$OUTPUT_DIR/$name.jpg', 'wb').write(img_data)"
        echo "✓ Saved: $name.jpg"
    else
        echo "✗ Failed: $name"
        cat "$OUTPUT_DIR/$name.json"
    fi

    echo ""
    sleep 3  # Rate limiting
}

# Generate all products
generate_image "spinner-grinder-pro" "Premium 4-piece aluminum cannabis herb grinder with bright green fidget spinner top, metallic silver finish, magnetic closure, professional product photography, studio lighting, pure white background" 12345

generate_image "widget-rolling-tray" "Large rectangular rolling tray with bright green fidget spinner pattern embossed design, built-in compartments, metallic surface, professional product photography, studio lighting, pure white background, top view" 23456

generate_image "airtight-storage" "Premium cylindrical cannabis storage jar with bright green fidget spinner logo, brushed metal cap, glass body, airtight seal, professional product photography, studio lighting, pure white background" 34567

generate_image "fidget-papers" "Rolling papers package with vibrant green fidget spinner character logo, modern minimalist design, premium cardboard box, professional product photography, studio lighting, pure white background" 45678

generate_image "spinner-lighter" "Refillable metal lighter with bright green fidget spinner design on top, chrome finish, ergonomic shape, professional product photography, studio lighting, pure white background" 56789

generate_image "widget-pipe" "Hand-blown glass smoking pipe with swirled bright green and clear glass, fidget-inspired curved design, artistic glasswork, professional product photography, studio lighting, pure white background" 67890

generate_image "complete-starter-kit" "Complete cannabis accessories set arranged neatly, grinder, rolling tray, storage jar, papers, and lighter, all with matching bright green fidget spinner branding, professional product photography, studio lighting, pure white background" 78901

generate_image "mini-travel-kit" "Compact cannabis travel kit in sleek black case with bright green fidget logo, mini grinder and storage visible inside, professional product photography, studio lighting, pure white background" 89012

echo "============================================"
echo "Image Generation Complete!"
echo "============================================"
