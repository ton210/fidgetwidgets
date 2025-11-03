# Fidget Widgets - Deployment Guide

## Deployment to www.fidget-widgets.com

### Prerequisites

1. A web hosting service with:
   - PHP 7.4 or higher
   - Apache web server with mod_rewrite enabled
   - HTTPS/SSL certificate
   - SSH access (recommended)

2. Domain: www.fidget-widgets.com configured and pointing to your hosting

### Deployment Methods

#### Method 1: Direct Git Clone (Recommended)

If your hosting supports SSH and Git:

```bash
# SSH into your server
ssh user@your-server.com

# Navigate to your web root
cd /var/www/html

# Clone the repository
git clone https://github.com/ton210/fidgetwidgets.git .

# Set proper permissions
chmod -R 755 .
chmod 644 config.php
```

#### Method 2: FTP/SFTP Upload

1. Download the repository from GitHub or use your local copy
2. Connect to your server via FTP/SFTP
3. Upload all files to your web root directory (usually `public_html` or `www`)
4. Ensure `.htaccess` file is uploaded (it might be hidden)

#### Method 3: cPanel / Web Hosting Control Panel

1. Access your cPanel or hosting control panel
2. Navigate to File Manager
3. Go to your public_html directory
4. Upload all files from the repository
5. Extract if uploaded as ZIP

### Post-Deployment Configuration

1. **Update config.php** (if needed):
   ```php
   define('SITE_URL', 'https://www.fidget-widgets.com');
   ```

2. **Verify .htaccess** is working:
   - Test clean URLs (e.g., /products instead of /products.php)
   - Ensure HTTPS redirect is working

3. **Check File Permissions**:
   - Files: 644
   - Directories: 755
   - config.php: 644 (or 600 for extra security)

4. **Test the Website**:
   - Visit https://www.fidget-widgets.com
   - Test all pages (home, products, about, contact)
   - Test the image generator at /generate-image
   - Verify mobile responsiveness

### SSL Certificate Setup

If not already configured:

1. **Using Let's Encrypt (Free)**:
   ```bash
   # Install certbot
   sudo apt-get install certbot python3-certbot-apache

   # Get certificate
   sudo certbot --apache -d www.fidget-widgets.com -d fidget-widgets.com
   ```

2. **Using cPanel**:
   - Navigate to SSL/TLS section
   - Use AutoSSL or upload your certificate

### Environment-Specific Settings

#### Production Settings

Update `config.php` for production:

```php
// Disable error display in production
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');
```

### Automated Deployment with GitHub

Set up a webhook for automatic deployment:

1. Create a deployment script on your server (`deploy.php`):
   ```php
   <?php
   $secret = 'your-secret-key';

   if ($_SERVER['HTTP_X_HUB_SIGNATURE']) {
       exec('cd /var/www/html && git pull origin main');
       echo 'Deployment successful!';
   }
   ?>
   ```

2. Configure GitHub webhook:
   - Go to repository Settings > Webhooks
   - Add webhook: https://www.fidget-widgets.com/deploy.php
   - Set content type to application/json
   - Add your secret key

### Database Setup (Optional - For Future Expansion)

If you plan to add database functionality:

```sql
CREATE DATABASE fidgetwidgets;
CREATE USER 'fidgetuser'@'localhost' IDENTIFIED BY 'strong-password';
GRANT ALL PRIVILEGES ON fidgetwidgets.* TO 'fidgetuser'@'localhost';
FLUSH PRIVILEGES;
```

Update `config.php` with your database credentials.

### Monitoring and Maintenance

1. **Regular Updates**:
   ```bash
   git pull origin main
   ```

2. **Backup**:
   - Set up automated backups
   - Backup both files and database (if used)

3. **Monitor Logs**:
   - Check error logs regularly
   - Monitor API usage (Freepik)

### Troubleshooting

#### Common Issues:

1. **500 Internal Server Error**:
   - Check .htaccess syntax
   - Verify mod_rewrite is enabled
   - Check PHP error logs

2. **Images Not Loading**:
   - Verify file permissions
   - Check image paths in code

3. **Clean URLs Not Working**:
   - Enable mod_rewrite: `sudo a2enmod rewrite`
   - Restart Apache: `sudo service apache2 restart`

4. **HTTPS Issues**:
   - Verify SSL certificate is installed
   - Check .htaccess HTTPS redirect rules

### Performance Optimization

1. **Enable Caching**:
   - Already configured in .htaccess
   - Consider adding Cloudflare or similar CDN

2. **Optimize Images**:
   - Compress images before upload
   - Use WebP format (logo already in WebP)

3. **Enable Gzip Compression**:
   - Already configured in .htaccess

### Security Checklist

- [ ] HTTPS is enforced
- [ ] config.php is protected (via .htaccess)
- [ ] File permissions are correct
- [ ] Error display is disabled in production
- [ ] Age verification is working
- [ ] Security headers are set (.htaccess)

### Support

For deployment issues, contact your hosting provider or check the repository issues:
https://github.com/ton210/fidgetwidgets/issues
