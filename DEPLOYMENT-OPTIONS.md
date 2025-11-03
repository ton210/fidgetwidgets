# Fidget Widgets - Deployment Options

## Important: GitHub Pages vs PHP Hosting

**THIS SITE IS BUILT WITH PHP** and requires proper PHP hosting for full functionality.

### Current Status

- **GitHub Pages (ton210.github.io/fidgetwidgets)**: Shows static HTML preview only
- **Full PHP Site**: Requires proper web hosting with PHP 7.4+

## Option 1: Static HTML Version (GitHub Pages) ⚠️ LIMITED

**Current URL**: https://ton210.github.io/fidgetwidgets/

**What Works:**
- ✅ Basic homepage display
- ✅ Product images
- ✅ CSS styling
- ✅ Static product listing

**What DOESN'T Work:**
- ❌ Shopping cart (requires PHP sessions)
- ❌ Checkout process (requires PHP)
- ❌ Contact forms (requires PHP)
- ❌ Product detail pages (requires PHP)
- ❌ Dynamic content

**Use Case**: Preview/demo only

## Option 2: PHP Hosting (RECOMMENDED for fidget-widgets.com) ✅ FULL FEATURES

### Requirements:
- PHP 7.4 or higher
- Apache with mod_rewrite
- SSL certificate
- cURL extension

### Hosting Providers (Choose One):

**Budget Options:**
- Hostinger - $2.99/mo
- Namecheap Shared - $1.98/mo
- SiteGround - $3.99/mo

**Premium Options:**
- WP Engine (if using WordPress)
- Cloudways
- DigitalOcean + ServerPilot

### Deployment Steps:

1. **Purchase Hosting & Domain**
   - Buy hosting with PHP support
   - Point fidget-widgets.com to hosting

2. **Upload Files**
   ```bash
   # Via SSH
   cd /var/www/html
   git clone https://github.com/ton210/fidgetwidgets.git .

   # Via FTP
   Upload all files to public_html directory
   ```

3. **Configure Domain**
   - Point A record to hosting IP
   - Enable SSL certificate
   - Wait for DNS propagation (24-48 hours)

4. **Test**
   - Visit https://fidget-widgets.com
   - Test cart functionality
   - Test checkout process

## Option 3: Free PHP Hosting (For Testing)

**Free Options:**
- InfinityFree - free PHP hosting
- 000webhost - free with limitations
- AwardSpace - free tier

**Steps:**
1. Sign up for free hosting
2. Upload via FTP or File Manager
3. Configure domain or use subdomain

## GitHub Pages Configuration

### To Enable GitHub Pages:

1. Go to repository settings
2. Navigate to "Pages"
3. Source: Deploy from branch
4. Branch: main
5. Folder: / (root)
6. Save

### Custom Domain Setup (fidget-widgets.com):

1. In repository, create CNAME file:
   ```
   fidget-widgets.com
   ```

2. In your domain registrar (e.g., Namecheap, GoDaddy):
   - Add A records pointing to GitHub Pages IPs:
     ```
     185.199.108.153
     185.199.109.153
     185.199.110.153
     185.199.111.153
     ```
   - Add CNAME record:
     ```
     www -> ton210.github.io
     ```

3. Enable "Enforce HTTPS" in GitHub settings

**⚠️ IMPORTANT**: This will only serve the static HTML version, NOT the full PHP site!

## Recommended Setup for fidget-widgets.com

### Best Approach:

1. **Use PHP Hosting** for fidget-widgets.com (full features)
2. **Keep GitHub Pages** for preview/demo at ton210.github.io/fidgetwidgets

### Quick Setup with Hostinger:

```bash
# 1. Purchase Hostinger hosting + domain
# 2. Access cPanel or hPanel
# 3. Go to File Manager
# 4. Upload all PHP files
# 5. Or use Git:

cd public_html
git clone https://github.com/ton210/fidgetwidgets.git .

# 6. Set permissions
chmod -R 755 .
chmod 644 config.php

# 7. Enable SSL in cPanel
# 8. Visit https://fidget-widgets.com
```

## Current File Structure

```
fidgetwidgets/
├── index.html          # Static version (GitHub Pages)
├── index.php           # Dynamic version (PHP hosting)
├── products.html       # Static version
├── products.php        # Dynamic version
├── cart.php           # PHP only (shopping cart)
├── checkout.php       # PHP only (checkout)
├── product.php        # PHP only (detail pages)
└── assets/            # Works on both
    ├── css/
    ├── js/
    └── images/
```

## Testing Locally

### With PHP:
```bash
cd fidgetwidgets
php -S localhost:8000
# Visit http://localhost:8000
```

### With Python (static only):
```bash
cd fidgetwidgets
python -m http.server 8000
# Visit http://localhost:8000
```

## Troubleshooting

### "PHP files showing as text"
- **Cause**: Server not configured for PHP
- **Fix**: Use PHP hosting, not GitHub Pages

### "Images not loading"
- **Cause**: Incorrect paths
- **Fix**: Use relative paths (already done)

### "Cart not working"
- **Cause**: PHP sessions not available
- **Fix**: Must use PHP hosting

## Next Steps

1. **For Preview**: GitHub Pages is already working at ton210.github.io/fidgetwidgets
2. **For Production**: Purchase PHP hosting and deploy full site to fidget-widgets.com

## Support

- GitHub Issues: https://github.com/ton210/fidgetwidgets/issues
- Hosting Support: Contact your hosting provider
