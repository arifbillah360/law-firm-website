# Peerali Law WordPress Theme - Installation & Setup Guide

## Version 1.0.2 - Front Page & CSS Connection Fixes

This guide will help you set up the theme and configure your WordPress site to use a static page as the front page.

---

## 🚀 Quick Start

### 1. Upload Theme to WordPress

```bash
# Via FTP or cPanel File Manager:
# Upload peerali-law-theme folder to: wp-content/themes/

# Via Git:
cd wp-content/themes/
git clone [your-repo] peerali-law-theme
```

### 2. Activate Theme

1. Go to WordPress Admin → **Appearance** → **Themes**
2. Find "Peerali Law" theme
3. Click **Activate**

---

## 🏠 Setting Up Front Page

### Step 1: Create Home Page

1. Go to **Pages** → **Add New**
2. Title: **Home** (or any name you prefer)
3. Click the **Text** or **Code** tab (not Visual)
4. Paste your HTML content (example below)
5. Click **Publish**

**Example HTML Content to Paste:**

```html
<section class="hero-section">
    <div class="container">
        <h1>Welcome to Peerali Law</h1>
        <p>Los Angeles catastrophic injury attorneys. Over $50M recovered since 2021.</p>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <h2>About Our Firm</h2>
        <p>Your about content here...</p>
    </div>
</section>
```

### Step 2: Set as Front Page

1. Go to **Settings** → **Reading**
2. Under **Your homepage displays**, select **A static page**
3. **Front page**: Select "Home" (the page you just created)
4. **Posts page**: Select a page for blog posts (optional)
5. Click **Save Changes**

### Step 3: Visit Your Site

- Go to your site's homepage
- You should see your HTML content displayed with proper styling
- The theme header and footer will wrap your content automatically

---

## ✅ Verification Checklist

### Check #1: Front Page Displays

- [ ] Visit homepage
- [ ] Your HTML content is visible
- [ ] Header navigation is showing
- [ ] Footer is showing
- [ ] Content is full-width (no unwanted margins)

### Check #2: CSS Is Loading

**Method 1: View Page Source**

1. Right-click on page → **View Page Source**
2. Search for `style.css` (Ctrl+F)
3. You should see:
   ```html
   <link rel='stylesheet' id='peerali-law-style-css'
         href='http://yoursite.com/wp-content/themes/peerali-law-theme/style.css'
         media='all' />
   ```
4. Click the CSS link - it should load and show the file contents

**Method 2: Browser DevTools**

1. Press **F12** to open Developer Tools
2. Go to **Network** tab
3. Reload page (Ctrl+R)
4. Filter by **CSS**
5. You should see:
   - ✅ style.css (status: 200)
   - ✅ main.css (loaded via @import from style.css)
   - ✅ navigation.css (loaded via @import)
   - ✅ footer.css (loaded via @import)

### Check #3: Inspect Styles

1. Press **F12** → **Elements** tab
2. Click on any element (like `<h1>`)
3. Look at **Styles** panel on right
4. You should see styles from:
   - `main.css`
   - `navigation.css`
   - `footer.css`
5. If you see WordPress default styles, those should be overridden by `!important`

### Check #4: Console Errors

1. Press **F12** → **Console** tab
2. You should see **NO errors** related to:
   - 404 Not Found for CSS files
   - Failed to load stylesheets
   - JavaScript errors

### Check #5: Admin Debug Info (Administrators Only)

1. View page source
2. Scroll to bottom
3. Look for HTML comment:
   ```html
   <!-- PEERALI LAW THEME CSS DEBUG:
   style.css path: http://yoursite.com/wp-content/themes/peerali-law-theme/style.css
   main.css path: http://yoursite.com/wp-content/themes/peerali-law-theme/assets/css/main.css
   main.css exists: YES
   navigation.css exists: YES
   footer.css exists: YES
   -->
   ```
4. All files should show "YES"

---

## 📝 How to Add Content to Pages

### Method 1: WordPress Editor (HTML Mode)

1. Create new page or edit existing
2. Switch to **Text** or **Code** tab (top right)
3. Paste your HTML content
4. Click **Update** or **Publish**

### Method 2: Custom HTML Meta Box

1. Create new page
2. Scroll down to **Custom HTML Content** meta box
3. Paste your HTML content
4. Click **Publish**

**What HTML to Add:**

```html
<!-- Full-width hero section -->
<section class="hero-section">
    <div class="container">
        <h1>Your Title</h1>
        <p>Your content...</p>
    </div>
</section>

<!-- Another section -->
<section class="services-section">
    <div class="container">
        <h2>Our Services</h2>
        <p>Services content...</p>
    </div>
</section>
```

**Important Notes:**

- ❌ Don't include `<html>`, `<head>`, or `<body>` tags
- ❌ Don't include `<header>` or `<footer>` tags (theme provides these)
- ✅ Start with `<section>` tags
- ✅ Use `.container` class inside sections for max-width
- ✅ Sections without `.container` will be full-width

---

## 🎨 How CSS Loading Works

### The CSS Cascade:

```
1. style.css (WordPress theme stylesheet)
   ├── Contains WordPress resets and overrides
   ├── @import url('assets/css/main.css')
   ├── @import url('assets/css/navigation.css')
   └── @import url('assets/css/footer.css')

2. main.css (Your design system)
   ├── High specificity overrides
   ├── CSS variables
   ├── Typography
   ├── Components
   └── Utilities

3. navigation.css (Navigation styles)
   └── Header and menu styles

4. footer.css (Footer styles)
   └── Footer and back-to-top button
```

### Why This Works:

- **style.css** is the WordPress default stylesheet location
- It uses **@import** to load your custom CSS files
- WordPress automatically enqueues style.css
- Your custom CSS is loaded via @import from style.css
- WordPress default styles are aggressively removed
- High specificity ensures your styles win

---

## 🔧 Troubleshooting

### Problem: Front Page is Blank

**Solution:**

1. Check Settings → Reading → "A static page" is selected
2. Check "Front page" dropdown has a page selected
3. Make sure the page has content in it
4. Try re-saving the page

### Problem: CSS Not Loading

**Solution 1: Check File Paths**

```bash
# Verify files exist:
ls wp-content/themes/peerali-law-theme/style.css
ls wp-content/themes/peerali-law-theme/assets/css/main.css
ls wp-content/themes/peerali-law-theme/assets/css/navigation.css
ls wp-content/themes/peerali-law-theme/assets/css/footer.css
```

**Solution 2: Clear WordPress Cache**

1. Install **WP Super Cache** or similar plugin
2. Go to Settings → WP Super Cache
3. Click "Delete Cache"
4. Reload your site

**Solution 3: Check Browser Cache**

1. Press **Ctrl+Shift+R** (hard reload)
2. Or press **Ctrl+Shift+Delete** → Clear browser cache
3. Reload page

**Solution 4: Check File Permissions**

```bash
chmod 644 wp-content/themes/peerali-law-theme/style.css
chmod 644 wp-content/themes/peerali-law-theme/assets/css/*.css
chmod 755 wp-content/themes/peerali-law-theme/assets/css/
```

### Problem: Styles Are Being Overridden

**Solution:**

The theme uses `!important` extensively to override WordPress defaults. If you need to override theme styles:

```css
/* In Appearance → Customize → Additional CSS */
body .your-element {
    property: value !important;
}
```

### Problem: Page Not Full Width

**Solution:**

1. Check that you're NOT adding `.container` to top-level sections
2. Structure should be:
   ```html
   <section class="hero-section">  <!-- Full width -->
       <div class="container">     <!-- Max-width inside -->
           Content here
       </div>
   </section>
   ```

---

## 📚 File Structure Reference

```
peerali-law-theme/
├── style.css               ← WordPress theme stylesheet (imports others)
├── functions.php           ← Theme functions
├── front-page.php          ← Front page template (NEW)
├── page.php                ← Page template
├── index.php               ← Fallback template
├── header.php              ← Header/navigation
├── footer.php              ← Footer
├── single.php              ← Single post template
├── README.md               ← General documentation
├── FIXES.md                ← Technical fixes documentation
├── INSTALLATION.md         ← This file
│
├── assets/
│   ├── css/
│   │   ├── main.css        ← Design system
│   │   ├── navigation.css  ← Navigation styles
│   │   └── footer.css      ← Footer styles
│   │
│   └── js/
│       ├── main.js         ← Main JavaScript
│       ├── navigation.js   ← Navigation functionality
│       └── footer.js       ← Footer functionality
│
└── template-parts/
    └── content-page.php    ← Page content template
```

---

## 🎓 Advanced Usage

### Custom Page Templates

You can create custom page templates:

1. Create new PHP file: `template-custom.php`
2. Add header:
   ```php
   <?php
   /*
   Template Name: Custom Template
   */
   get_header();
   while (have_posts()) : the_post();
       the_content();
   endwhile;
   get_footer();
   ```
3. Select template in Page → Template dropdown

### Adding Custom CSS

**Method 1: Appearance → Customize → Additional CSS**

```css
/* Your custom CSS here */
.my-custom-class {
    color: red;
}
```

**Method 2: Edit main.css Directly**

1. Go to Appearance → Theme File Editor
2. Select main.css
3. Add your CSS at the bottom
4. Click "Update File"

### Adding Custom JavaScript

1. Create file: `assets/js/custom.js`
2. Add to functions.php:
   ```php
   wp_enqueue_script('peerali-custom',
       get_template_directory_uri() . '/assets/js/custom.js',
       array('peerali-main-js'), '1.0.0', true);
   ```

---

## 📞 Support & Resources

### Theme Information

- **Theme Name:** Peerali Law
- **Version:** 1.0.2
- **Author:** Md Arif Billah
- **Requires WordPress:** 6.0+
- **Requires PHP:** 8.0+

### Key Features

- ✅ Static front page support
- ✅ Full-width content
- ✅ Manual HTML editing
- ✅ WordPress admin integration
- ✅ Custom HTML meta box
- ✅ Aggressive WordPress style removal
- ✅ Theme editor enabled
- ✅ SEO optimized
- ✅ Performance optimized

### Changelog

**Version 1.0.2 (Current)**

- Added front-page.php template
- Updated style.css with @import statements
- Aggressive WordPress default style removal
- CSS loading fixes
- High specificity overrides in main.css
- CSS debug function for administrators

**Version 1.0.1**

- Full-width page fixes
- Theme editor enabled
- CSS loading improvements

**Version 1.0.0**

- Initial release

---

## ✅ Success!

If you've followed all the steps above:

- ✅ Front page displays your HTML content
- ✅ CSS files are loading correctly
- ✅ Styles are applied to your content
- ✅ No 404 errors in console
- ✅ Theme is ready to use!

**Next Steps:**

1. Create additional pages (About, Services, Contact, etc.)
2. Add HTML content to those pages
3. Customize colors/styles via main.css
4. Set up navigation menus
5. Configure theme settings in Customizer

---

## 🎉 You're All Set!

Your Peerali Law WordPress theme is now properly configured with:

- Static front page support
- Full CSS connectivity
- Manual HTML content editing
- Professional law firm design

Happy building! 🚀
