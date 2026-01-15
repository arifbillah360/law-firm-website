/*!
 * ============================================
 * PEERALI LAW - FOOTER JAVASCRIPT
 * Footer interactions and back-to-top button
 * Pure vanilla JavaScript (ES6+)
 * ============================================
 */

(function() {
    'use strict';

    /* ============================================
       BACK TO TOP BUTTON
       ============================================ */
    function initBackToTop() {
        const backToTopBtn = document.getElementById('back-to-top');

        if (!backToTopBtn) {
            return;
        }

        // Show/hide button based on scroll position
        function toggleBackToTop() {
            const scrollThreshold = 300;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > scrollThreshold) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        }

        // Scroll to top smoothly
        function scrollToTop(e) {
            e.preventDefault();

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Event listeners
        window.addEventListener('scroll', toggleBackToTop, { passive: true });
        backToTopBtn.addEventListener('click', scrollToTop);

        // Initial check
        toggleBackToTop();
    }

    /* ============================================
       FOOTER ANIMATIONS
       ============================================ */
    function initFooterAnimations() {
        const footer = document.querySelector('.site-footer');

        if (!footer) {
            return;
        }

        // Animate footer elements when they come into view
        if ('IntersectionObserver' in window) {
            const footerColumns = footer.querySelectorAll('.footer-column');

            const footerObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            footerColumns.forEach(column => {
                column.style.opacity = '0';
                column.style.transform = 'translateY(20px)';
                column.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                footerObserver.observe(column);
            });
        }
    }

    /* ============================================
       SOCIAL MEDIA LINK TRACKING
       ============================================ */
    function initSocialTracking() {
        const socialLinks = document.querySelectorAll('.social-link');

        socialLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const platform = this.getAttribute('aria-label') || 'Unknown';

                // Track social media click (integrate with your analytics)
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'social_click', {
                        'social_platform': platform,
                        'event_category': 'Social Media',
                        'event_label': platform
                    });
                }

                // Log to console for debugging
                console.log('Social media click:', platform);
            });
        });
    }

    /* ============================================
       FOOTER NEWSLETTER FORM (if applicable)
       ============================================ */
    function initNewsletterForm() {
        const newsletterForm = document.querySelector('.newsletter-form');

        if (!newsletterForm) {
            return;
        }

        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value.trim();

            // Basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                showMessage(this, 'Please enter a valid email address', 'error');
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.textContent;
            submitBtn.textContent = 'Subscribing...';
            submitBtn.disabled = true;

            // Send AJAX request (replace with your endpoint)
            fetch('/wp-json/peerali-law/v1/newsletter/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(this, 'Thank you for subscribing!', 'success');
                    emailInput.value = '';
                } else {
                    showMessage(this, data.message || 'An error occurred. Please try again.', 'error');
                }
            })
            .catch(error => {
                showMessage(this, 'An error occurred. Please try again.', 'error');
                console.error('Newsletter subscription error:', error);
            })
            .finally(() => {
                submitBtn.textContent = originalBtnText;
                submitBtn.disabled = false;
            });
        });
    }

    function showMessage(form, message, type) {
        // Remove existing messages
        const existingMessage = form.querySelector('.form-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        // Create new message
        const messageDiv = document.createElement('div');
        messageDiv.className = `form-message ${type}`;
        messageDiv.textContent = message;
        messageDiv.style.cssText = `
            padding: 0.75rem;
            margin-top: 1rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            ${type === 'success' ? 'background: #d4edda; color: #155724; border: 1px solid #c3e6cb;' : ''}
            ${type === 'error' ? 'background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;' : ''}
        `;

        form.appendChild(messageDiv);

        // Remove message after 5 seconds
        setTimeout(() => {
            messageDiv.style.opacity = '0';
            messageDiv.style.transition = 'opacity 0.3s ease';
            setTimeout(() => messageDiv.remove(), 300);
        }, 5000);
    }

    /* ============================================
       FOOTER CONTACT LINK TRACKING
       ============================================ */
    function initContactTracking() {
        const phoneLinks = document.querySelectorAll('a[href^="tel:"]');
        const emailLinks = document.querySelectorAll('a[href^="mailto:"]');

        phoneLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Track phone click
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'phone_click', {
                        'event_category': 'Contact',
                        'event_label': 'Footer Phone',
                        'phone_number': this.getAttribute('href')
                    });
                }
                console.log('Phone click:', this.getAttribute('href'));
            });
        });

        emailLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Track email click
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'email_click', {
                        'event_category': 'Contact',
                        'event_label': 'Footer Email',
                        'email': this.getAttribute('href')
                    });
                }
                console.log('Email click:', this.getAttribute('href'));
            });
        });
    }

    /* ============================================
       FOOTER WIDGET COLLAPSE (Mobile)
       ============================================ */
    function initFooterWidgetCollapse() {
        // Only apply on mobile
        if (window.innerWidth > 768) {
            return;
        }

        const footerTitles = document.querySelectorAll('.footer-title');

        footerTitles.forEach(title => {
            // Make titles clickable
            title.style.cursor = 'pointer';
            title.style.userSelect = 'none';

            // Add toggle icon
            const icon = document.createElement('i');
            icon.className = 'fas fa-chevron-down';
            icon.style.cssText = 'float: right; transition: transform 0.3s ease;';
            title.appendChild(icon);

            // Get the content to toggle
            const column = title.parentElement;
            const content = Array.from(column.children).filter(child => child !== title);

            // Initially collapse on mobile
            content.forEach(el => {
                el.style.display = 'none';
            });

            // Toggle on click
            title.addEventListener('click', function() {
                const isExpanded = icon.style.transform === 'rotate(180deg)';

                content.forEach(el => {
                    el.style.display = isExpanded ? 'none' : 'block';
                });

                icon.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        });
    }

    /* ============================================
       INITIALIZE ALL FUNCTIONS
       ============================================ */
    function init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                runInit();
            });
        } else {
            runInit();
        }
    }

    function runInit() {
        initBackToTop();
        initFooterAnimations();
        initSocialTracking();
        initNewsletterForm();
        initContactTracking();
        // initFooterWidgetCollapse(); // Uncomment if you want collapsible footer widgets on mobile
    }

    // Initialize
    init();

    // Re-initialize on window resize (for responsive behavior)
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Re-run mobile-specific functions if needed
        }, 250);
    });

})();
