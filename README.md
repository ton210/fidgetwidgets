# Fidget Widgets

Premium Cannabis Accessories & Fidget Widgets

## About

Fidget Widgets is a cannabis accessories e-commerce website that combines playful fidget-inspired designs with high-quality cannabis products.

## Features

- Modern, responsive PHP website
- Freepik AI integration for product image generation
- Product catalog with filtering
- Contact form
- Newsletter subscription
- Age verification
- Mobile-friendly design

## Technologies Used

- PHP 7.4+
- HTML5, CSS3, JavaScript
- Freepik AI API for image generation
- Apache (with mod_rewrite)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/ton210/fidgetwidgets.git
   ```

2. Configure your web server to point to the project directory

3. Update `config.php` with your settings

4. Ensure Apache mod_rewrite is enabled

5. Set proper file permissions

## API Configuration

The Freepik API is configured in `config.php`. To use the image generation features:

1. Ensure you have a valid Freepik API key
2. Update the `FREEPIK_API_KEY` constant in `config.php`
3. Visit `/generate-image.php` to test the image generation

## File Structure

```
fidgetwidgets/
├── api/
│   └── FreepikAPI.php      # Freepik API integration
├── assets/
│   ├── css/
│   │   └── style.css       # Main stylesheet
│   ├── js/
│   │   └── main.js         # JavaScript functionality
│   └── images/
│       └── logo.webp       # Site logo
├── includes/
│   ├── header.php          # Site header
│   └── footer.php          # Site footer
├── index.php               # Homepage
├── products.php            # Products catalog
├── about.php               # About page
├── contact.php             # Contact page
├── generate-image.php      # AI image generator
├── config.php              # Configuration file
├── .htaccess               # Apache configuration
└── README.md               # This file
```

## Deployment

This site is deployed at: https://www.fidget-widgets.com

## License

All rights reserved. Must be 21+ to purchase.

## Contact

Email: info@fidget-widgets.com
Phone: +1 (555) 123-4567
