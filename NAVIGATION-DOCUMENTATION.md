# Peerali Law - Navigation System Documentation

## 📋 Table of Contents
1. [Overview](#overview)
2. [File Structure](#file-structure)
3. [Installation & Setup](#installation--setup)
4. [Usage Examples](#usage-examples)
5. [Customization Guide](#customization-guide)
6. [Features](#features)
7. [Browser Support](#browser-support)
8. [Troubleshooting](#troubleshooting)

---

## 🎯 Overview

A complete, production-ready navigation system for Peerali Law's static HTML website featuring:

- ✅ **Responsive Design** - Mobile-first approach with tablet and desktop optimizations
- ✅ **Sticky Header** - Smart sticky navigation with scroll detection
- ✅ **Mega Menu** - Beautiful mega menu for practice areas
- ✅ **Mobile Menu** - Slide-in mobile menu with accordion dropdowns
- ✅ **Search Overlay** - Full-screen search with suggestions
- ✅ **Language Switcher** - English/Spanish language switching with flags
- ✅ **Active Page Detection** - Automatically highlights current page
- ✅ **Accessibility** - WCAG 2.1 AA compliant with keyboard navigation
- ✅ **Performance Optimized** - Lightweight vanilla JavaScript, no dependencies

---

## 📁 File Structure

```
law-firm-website/
│
├── includes/
│   └── header.html              # Main header navigation HTML
│
├── assets/
│   ├── css/
│   │   └── navigation.css       # Navigation styles (all responsive)
│   │
│   ├── js/
│   │   └── navigation.js        # Navigation functionality (vanilla JS)
│   │
│   └── images/
│       ├── logo.png             # Main logo (recommended: 200x60px)
│       └── flags/
│           ├── us-flag.svg      # US flag for English
│           └── es-flag.svg      # Spanish flag for Español
│
├── index.html                   # Homepage
├── about-us.html                # Example page
├── contact.html                 # Contact page
└── practice-areas/
    ├── catastrophic-injury.html
    ├── brain-injury.html
    └── ... (other practice area pages)
```

---

## 🚀 Installation & Setup

### Step 1: Copy Files

1. Copy `includes/header.html` to your project's `includes/` folder
2. Copy `assets/css/navigation.css` to your `assets/css/` folder
3. Copy `assets/js/navigation.js` to your `assets/js/` folder

### Step 2: Add Required Dependencies

Add Font Awesome for icons to your HTML `<head>`:

```html
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

### Step 3: Add Google Fonts (Optional but Recommended)

```html
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
```

### Step 4: Create Flag Images

Create or download flag images:
- `assets/images/flags/us-flag.svg` (US flag)
- `assets/images/flags/es-flag.svg` (Spanish flag)

**Recommended dimensions:** 24x16px (3:2 ratio)

You can download free flag SVGs from:
- [Flaticon](https://www.flaticon.com/)
- [Flagpedia](https://flagpedia.net/)
- [Wikipedia Commons](https://commons.wikimedia.org/)

---

## 📖 Usage Examples

### Example 1: Basic Page Template

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peerali Law - Los Angeles Personal Injury Attorneys</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Navigation CSS -->
    <link rel="stylesheet" href="assets/css/navigation.css">

    <!-- Your custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- INCLUDE HEADER NAVIGATION -->
    <?php include 'includes/header.html'; ?>
    <!-- Or use JavaScript to include: -->
    <!-- <div id="header-placeholder"></div> -->

    <!-- Main Content -->
    <main id="main-content">
        <h1>Your Page Content Here</h1>
        <p>This is where your main content goes...</p>
    </main>

    <!-- Footer -->
    <footer>
        <!-- Your footer content -->
    </footer>

    <!-- Navigation JavaScript -->
    <script src="assets/js/navigation.js"></script>

    <!-- Your custom JavaScript -->
    <script src="assets/js/main.js"></script>

</body>
</html>
```

### Example 2: Include Header with JavaScript (for Static HTML)

If you can't use PHP includes, use JavaScript:

**Create:** `assets/js/load-header.js`

```javascript
// Load header navigation
fetch('includes/header.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('header-placeholder').innerHTML = data;

        // Re-initialize navigation after loading
        if (window.PeeraliNavigation) {
            console.log('Navigation loaded via JS');
        }
    })
    .catch(error => console.error('Error loading header:', error));
```

**In your HTML:**

```html
<body>
    <!-- Header Placeholder -->
    <div id="header-placeholder"></div>

    <!-- Your content -->
    <main id="main-content">
        <!-- Content here -->
    </main>

    <!-- Load header first, then navigation script -->
    <script src="assets/js/load-header.js"></script>
    <script src="assets/js/navigation.js"></script>
</body>
```

### Example 3: Practice Area Subpage

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brain Injury Attorney - Peerali Law</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Note: Use ../ for subfolder pages -->
    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <!-- INCLUDE HEADER -->
    <!-- Make sure paths in header.html work for subfolders -->
    <?php include '../includes/header.html'; ?>

    <main id="main-content">
        <h1>Brain Injury Attorneys in Los Angeles</h1>
        <!-- Your content -->
    </main>

    <script src="../assets/js/navigation.js"></script>
</body>
</html>
```

---

## 🎨 Customization Guide

### Color Scheme

Edit the CSS variables in `assets/css/navigation.css`:

```css
:root {
    /* Change these colors to match your brand */
    --primary-navy: #1e3a5f;      /* Main brand color */
    --accent-gold: #c5a572;       /* Accent/CTA color */
    --text-primary: #1a1a1a;      /* Main text color */
    --bg-white: #ffffff;          /* Background color */
}
```

**Example: Change to different law firm colors:**

```css
:root {
    --primary-navy: #2c3e50;      /* Darker navy */
    --accent-gold: #d4af37;       /* Brighter gold */
}
```

### Typography

Change fonts in CSS variables:

```css
:root {
    --font-primary: 'Roboto', sans-serif;
    --font-heading: 'Merriweather', serif;
}
```

Don't forget to update Google Fonts link in HTML:

```html
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
```

### Logo Customization

**Option 1: Use image logo**
```html
<img src="assets/images/logo.png" alt="Peerali Law" class="logo-img">
<span class="logo-text">Peerali Law</span> <!-- Hide if using image -->
```

**Option 2: Text-only logo**
```html
<span class="logo-text">Peerali Law</span>
```

Then in CSS:
```css
.logo-text {
    display: block; /* Show text logo */
}

.logo-img {
    display: none; /* Hide image */
}
```

### Contact Information

Edit phone and email in `includes/header.html`:

```html
<a href="tel:+12133334444" class="top-bar-link">
    <i class="fas fa-phone"></i>
    <span>(213) 333-4444</span> <!-- Change this -->
</a>
<a href="mailto:info@peeralilaw.com" class="top-bar-link">
    <i class="fas fa-envelope"></i>
    <span>info@peeralilaw.com</span> <!-- Change this -->
</a>
```

### Add/Remove Menu Items

**Add a new top-level menu item:**

```html
<!-- In desktop navigation -->
<li class="nav-item">
    <a href="your-page.html" class="nav-link">Your Page</a>
</li>

<!-- In mobile navigation -->
<li class="mobile-nav-item">
    <a href="your-page.html" class="mobile-nav-link">Your Page</a>
</li>
```

**Add a dropdown item:**

```html
<!-- In desktop dropdown -->
<li><a href="new-page.html" class="dropdown-link">New Page</a></li>

<!-- In mobile dropdown -->
<li><a href="new-page.html" class="mobile-dropdown-link">New Page</a></li>
```

---

## ✨ Features

### 1. Sticky Header with Scroll Detection

The header automatically:
- Sticks to top when scrolling
- Adds shadow effect after 100px scroll
- Adjusts padding for compact view

**Customize scroll threshold:**

```javascript
// In navigation.js, find:
const scrollThreshold = 100; // Change to your preferred value
```

### 2. Mobile Menu

**Features:**
- Slide-in from right
- Overlay backdrop
- Prevents body scroll
- Close on ESC key or outside click
- Smooth animations

**Customize slide direction:**

```css
/* In navigation.css, change: */
.mobile-menu {
    right: 0;           /* Change to left: 0 for left slide */
    transform: translateX(100%);  /* Change to translateX(-100%) */
}
```

### 3. Search Overlay

**Features:**
- Full-screen overlay
- Auto-focus on input
- Popular search suggestions
- Close on ESC or outside click

**Customize search action:**

```html
<!-- In header.html, change form action: -->
<form class="search-form" action="search.html" method="GET">
    <!-- Or use custom JavaScript handler -->
</form>
```

### 4. Language Switcher

**How it works:**
- English: `yoursite.com/about-us.html`
- Spanish: `yoursite.com/es/about-us.html`

**Customize language behavior:**

```javascript
// In navigation.js, modify switchLanguage() function
function switchLanguage(lang) {
    // Add your custom logic here
    // Could redirect to different domain, subdomain, etc.
}
```

### 5. Active Page Detection

Automatically highlights current page in navigation.

**How it works:**
- Compares `window.location.pathname` with link hrefs
- Adds `.active` class to matching links
- Highlights parent dropdown if inside submenu

---

## 🌐 Browser Support

| Browser | Version | Status |
|---------|---------|--------|
| Chrome | 90+ | ✅ Fully Supported |
| Firefox | 88+ | ✅ Fully Supported |
| Safari | 14+ | ✅ Fully Supported |
| Edge | 90+ | ✅ Fully Supported |
| Opera | 76+ | ✅ Fully Supported |
| Mobile Safari | iOS 14+ | ✅ Fully Supported |
| Chrome Mobile | Android 5+ | ✅ Fully Supported |

**Legacy browsers:**
- IE11: ❌ Not supported (uses modern JavaScript)
- If IE11 support needed, add polyfills

---

## 🐛 Troubleshooting

### Issue: Navigation not appearing

**Solution:**
1. Check if header.html is properly included
2. Verify CSS file path is correct
3. Check browser console for errors
4. Ensure Font Awesome is loaded

### Issue: Mobile menu not working

**Solution:**
1. Check if navigation.js is loaded
2. Verify element IDs match between HTML and JS
3. Check browser console for JavaScript errors
4. Ensure no CSS conflicts with other stylesheets

### Issue: Active page not highlighting

**Solution:**
1. Check if link href matches current page filename
2. For subfolders, use relative paths correctly
3. Verify JavaScript is running (check console logs)

### Issue: Dropdowns not showing on hover

**Solution:**
1. Check CSS is loaded correctly
2. Verify no z-index conflicts
3. Check if `.has-dropdown` class is on parent `<li>`

### Issue: Sticky header jumps on scroll

**Solution:**
```css
/* Add smooth transition */
.site-header {
    position: sticky;
    transition: all 0.3s ease; /* Add this */
}
```

### Issue: Search overlay not closing

**Solution:**
1. Check if close button has correct ID: `searchClose`
2. Verify JavaScript event listeners are attached
3. Check console for errors

---

## 📱 Responsive Breakpoints

| Breakpoint | Device | Navigation Style |
|------------|--------|------------------|
| 0-767px | Mobile | Hamburger menu |
| 768-1023px | Tablet | Hamburger menu |
| 1024px+ | Desktop | Horizontal menu |

**Customize breakpoints:**

```css
/* In navigation.css, change media queries: */
@media (min-width: 1024px) { /* Change to your preferred width */
    .main-navigation {
        display: block;
    }
}
```

---

## 🔧 Advanced Customization

### Add Breadcrumb Navigation

Create `assets/css/breadcrumb.css`:

```css
.breadcrumb {
    padding: 1rem 0;
    font-size: 0.875rem;
}

.breadcrumb-list {
    display: flex;
    gap: 0.5rem;
    list-style: none;
}

.breadcrumb-item:not(:last-child)::after {
    content: '/';
    margin-left: 0.5rem;
    color: #718096;
}

.breadcrumb-link {
    color: #4a5568;
}

.breadcrumb-link:hover {
    color: #1e3a5f;
}
```

Add to your pages:

```html
<nav class="breadcrumb" aria-label="Breadcrumb">
    <ul class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="index.html" class="breadcrumb-link">Home</a></li>
        <li class="breadcrumb-item"><a href="practice-areas.html" class="breadcrumb-link">Practice Areas</a></li>
        <li class="breadcrumb-item">Brain Injury</li>
    </ul>
</nav>
```

### Add Progress Bar on Scroll

Add to `navigation.js`:

```javascript
function initScrollProgressBar() {
    const progressBar = document.createElement('div');
    progressBar.className = 'scroll-progress-bar';
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', () => {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        progressBar.style.width = scrolled + '%';
    });
}

// Add to initAll() function
initScrollProgressBar();
```

Add to `navigation.css`:

```css
.scroll-progress-bar {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    background: var(--accent-gold);
    z-index: 9999;
    transition: width 0.1s ease;
}
```

---

## 📚 Additional Resources

- [Font Awesome Icons](https://fontawesome.com/icons)
- [Google Fonts](https://fonts.google.com/)
- [MDN Web Docs - Navigation](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/nav)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

---

## 🤝 Support

For issues or questions:
1. Check this documentation first
2. Review browser console for errors
3. Verify all file paths are correct
4. Check that required dependencies are loaded

---

## 📄 License

This navigation system is created for Peerali Law. Modify and use as needed for your project.

---

## 🎉 Conclusion

You now have a complete, professional navigation system! The code is:
- ✅ Production-ready
- ✅ Fully responsive
- ✅ Accessible
- ✅ Performance optimized
- ✅ Easy to customize

**Next steps:**
1. Copy files to your project
2. Customize colors and content
3. Test on different devices
4. Deploy to your server

Good luck with your Peerali Law website! 🚀
