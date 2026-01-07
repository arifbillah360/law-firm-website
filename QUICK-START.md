# 🚀 Peerali Law Navigation - Quick Start Guide

## 5-Minute Setup

Follow these steps to get your navigation running in 5 minutes.

---

## ✅ Step 1: Copy These Files to Your Project

```
law-firm-website/
├── includes/
│   └── header.html
├── assets/
│   ├── css/
│   │   └── navigation.css
│   ├── js/
│   │   └── navigation.js
│   └── images/
│       ├── logo.png (add your own)
│       └── flags/
│           ├── us-flag.svg
│           └── es-flag.svg
```

---

## ✅ Step 2: Add This to Every HTML Page

### In the `<head>` section:

```html
<!-- Font Awesome (for icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<!-- Navigation CSS -->
<link rel="stylesheet" href="assets/css/navigation.css">
```

### At the start of `<body>`:

**Option A: Using PHP**
```html
<?php include 'includes/header.html'; ?>
```

**Option B: Using JavaScript (for static HTML)**
```html
<div id="header-container"></div>
```

### Before closing `</body>` tag:

```html
<!-- If using JavaScript include method -->
<script>
fetch('includes/header.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('header-container').innerHTML = data;
    })
    .catch(error => console.error('Error loading header:', error));
</script>

<!-- Navigation JavaScript -->
<script src="assets/js/navigation.js"></script>
```

---

## ✅ Step 3: For Subfolder Pages (like practice-areas/)

Use `../` to go up one level:

```html
<!-- In head -->
<link rel="stylesheet" href="../assets/css/navigation.css">

<!-- Include header -->
<?php include '../includes/header.html'; ?>
<!-- OR -->
<script>
fetch('../includes/header.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('header-container').innerHTML = data;
    });
</script>

<!-- Before closing body -->
<script src="../assets/js/navigation.js"></script>
```

---

## ✅ Step 4: Customize Your Info

### Update Contact Information

Open `includes/header.html` and change:

```html
<!-- Line ~25-35 -->
<a href="tel:+12133334444">YOUR PHONE</a>
<a href="mailto:info@peeralilaw.com">YOUR EMAIL</a>
```

### Add Your Logo

Replace `assets/images/logo.png` with your logo (recommended size: 200x60px)

### Change Colors (Optional)

Open `assets/css/navigation.css` and edit line ~15-20:

```css
:root {
    --primary-navy: #1e3a5f;    /* Change to your brand color */
    --accent-gold: #c5a572;     /* Change to your accent color */
}
```

---

## ✅ Step 5: Test It!

Open your HTML file in a browser and test:

- ✅ Navigation appears
- ✅ Dropdowns work on desktop (hover)
- ✅ Mobile menu works (click hamburger)
- ✅ Search overlay opens
- ✅ Language switcher buttons visible

---

## 🎯 Complete Template

Here's a complete working template:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peerali Law - Your Page Title</title>

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

    <!-- HEADER NAVIGATION -->
    <?php include 'includes/header.html'; ?>
    <!-- OR for static HTML: -->
    <!-- <div id="header-container"></div> -->

    <!-- MAIN CONTENT -->
    <main id="main-content">
        <h1>Your Page Content Here</h1>
        <p>Add your content here...</p>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 Peerali Law. All rights reserved.</p>
    </footer>

    <!-- JAVASCRIPT -->
    <!-- If using static HTML include: -->
    <!--
    <script>
    fetch('includes/header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('header-container').innerHTML = data;
        });
    </script>
    -->

    <!-- Navigation JavaScript -->
    <script src="assets/js/navigation.js"></script>

</body>
</html>
```

---

## 🐛 Common Issues & Fixes

### Issue: Navigation doesn't appear
**Fix:** Check the file path to `header.html` is correct

### Issue: Icons don't show
**Fix:** Make sure Font Awesome CDN link is in `<head>`

### Issue: Fonts look wrong
**Fix:** Check Google Fonts link is in `<head>`

### Issue: Mobile menu doesn't work
**Fix:** Verify `navigation.js` is loaded and check browser console for errors

### Issue: On subfolder pages, navigation breaks
**Fix:** Use `../` before all paths (e.g., `../assets/css/navigation.css`)

---

## 📱 Test Checklist

Before going live, test these:

- [ ] Desktop: Hover over dropdowns - they should appear
- [ ] Desktop: Click "Practice Areas" - mega menu should appear
- [ ] Desktop: Click search icon - search overlay should open
- [ ] Desktop: Click language flags - they should be clickable
- [ ] Mobile: Click hamburger - menu should slide in from right
- [ ] Mobile: Click "About" - dropdown should expand
- [ ] Mobile: Click outside menu - menu should close
- [ ] Mobile: Press ESC key - menu should close
- [ ] All: Check current page is highlighted in navigation
- [ ] All: Scroll down - header should become sticky

---

## 🎨 Quick Customizations

### Change Header Background Color

```css
/* In navigation.css, find .site-header */
.site-header {
    background: #ffffff; /* Change this */
}
```

### Change Mobile Menu Slide Direction

```css
/* In navigation.css, find .mobile-menu */
.mobile-menu {
    right: 0;  /* Change to: left: 0; */
    transform: translateX(100%);  /* Change to: translateX(-100%); */
}
```

### Hide Top Bar

```css
/* In navigation.css, find .top-bar */
.top-bar {
    display: none !important;
}
```

### Change Link Hover Color

```css
/* In navigation.css, find .nav-link:hover */
.nav-link:hover {
    color: #YOUR_COLOR;
}
```

---

## 📚 Need More Help?

- **Full Documentation:** See `NAVIGATION-DOCUMENTATION.md`
- **Example Pages:** Check `index-example.html` and `practice-areas-example.html`
- **Main README:** See `README.md`

---

## ✅ You're Done!

Your navigation is now ready to use! 🎉

**Next Steps:**
1. Add your content to pages
2. Test on real devices (phone, tablet, desktop)
3. Deploy to your live server

**Pro Tip:** Keep the example files as reference when creating new pages.

---

## 🆘 Quick Reference

### File Paths for Root Pages (index.html, about-us.html, etc.)

```html
<link rel="stylesheet" href="assets/css/navigation.css">
<script src="assets/js/navigation.js"></script>
<?php include 'includes/header.html'; ?>
```

### File Paths for Subfolder Pages (practice-areas/brain-injury.html, etc.)

```html
<link rel="stylesheet" href="../assets/css/navigation.css">
<script src="../assets/js/navigation.js"></script>
<?php include '../includes/header.html'; ?>
```

### Contact Phone & Email (edit in header.html)

```html
Line ~25: <a href="tel:+12133334444">
Line ~28: <a href="mailto:info@peeralilaw.com">
```

### Brand Colors (edit in navigation.css)

```css
Line ~15: --primary-navy: #1e3a5f;
Line ~17: --accent-gold: #c5a572;
```

---

**That's it! Happy building! 🚀**
