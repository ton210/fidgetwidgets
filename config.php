<?php
// Fidget Widgets - Configuration File

// Site Configuration
define('SITE_NAME', 'Fidget Widgets');
define('SITE_URL', 'https://www.fidget-widgets.com');
define('SITE_DESCRIPTION', 'Premium Cannabis Accessories & Fidget Widgets');

// Freepik API Configuration
define('FREEPIK_API_KEY', 'FPSX381b01bdceb04b9fa3c51f52816cfacd');
define('FREEPIK_API_URL', 'https://api.freepik.com/v1/ai/text-to-image');

// Database Configuration (for future expansion)
define('DB_HOST', 'localhost');
define('DB_NAME', 'fidgetwidgets');
define('DB_USER', 'root');
define('DB_PASS', '');

// Paths
define('BASE_PATH', __DIR__);
define('ASSETS_PATH', BASE_PATH . '/assets');
define('IMAGES_PATH', ASSETS_PATH . '/images');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session Start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
