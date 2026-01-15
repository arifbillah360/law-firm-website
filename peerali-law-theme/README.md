# Peerali Law - WordPress Theme

A minimal, professional WordPress theme for law firms where header, footer, CSS, and JavaScript are loaded from theme files, but page content is added manually via WordPress editor or custom fields.

## Features

- **Minimal Architecture**: Clean separation between theme structure and page content
- **Custom HTML Content**: Add complete HTML sections via WordPress editor or custom meta box
- **Professional Design**: Navy and gold color scheme perfect for law firms
- **Fully Responsive**: Mobile-first design that works on all devices
- **SEO Optimized**: Clean semantic HTML with Schema.org markup
- **Performance Optimized**: Minified assets, lazy loading, deferred JavaScript
- **Security Hardened**: File editing disabled, version info removed, security headers
- **Custom Post Types**: Attorneys, Practice Areas, Case Results
- **Theme Customizer**: Easy customization of colors, fonts, contact info
- **No jQuery**: Pure vanilla JavaScript for better performance

## Installation

1. Download the theme folder
2. Upload to `/wp-content/themes/` directory
3. Activate the theme in WordPress admin
4. Configure settings via Appearance > Customize

## Content Management

### Option 1: Custom HTML Meta Box
1. Create a new page
2. Scroll to "Custom HTML Content" meta box
3. Paste your HTML content
4. Publish

### Option 2: WordPress Editor
1. Create a new page
2. Switch to HTML/Code mode
3. Paste your HTML content
4. Publish

## Theme Structure

```
peerali-law-theme/
├── style.css                  # Theme header + base styles
├── functions.php              # Theme functions and features
├── header.php                 # Header with navigation
├── footer.php                 # Footer section
├── index.php                  # Main template
├── page.php                   # Blank canvas page template
├── single.php                 # Single post template
├── screenshot.png             # Theme screenshot
├── README.md                  # This file
│
├── assets/
│   ├── css/
│   │   ├── main.css           # Global styles
│   │   ├── navigation.css     # Navigation styles
│   │   └── footer.css         # Footer styles
│   │
│   ├── js/
│   │   ├── main.js            # Global JavaScript
│   │   ├── navigation.js      # Navigation JavaScript
│   │   └── footer.js          # Footer JavaScript
│   │
│   └── images/
│       └── (theme images)
│
└── template-parts/
    └── content-page.php       # Page content template part
```

## Customization

### Colors
Navigate to Appearance > Customize to change:
- Primary Navy: #1E3A5F
- Accent Gold: #D4AF37
- Additional theme colors

### Fonts
- Body: Roboto
- Headings: Playfair Display

### Contact Information
Configure in Appearance > Customize:
- Phone number
- Email address
- Address
- Social media links

## Requirements

- WordPress 6.0+
- PHP 8.0+
- Modern browser with ES6+ support

## Support

For issues or questions, please contact:
- Author: Md Arif Billah
- Website: https://softorio.com

## License

GNU General Public License v2 or later
http://www.gnu.org/licenses/gpl-2.0.html

## Credits

Developed by Md Arif Billah for Peerali Law
