/*!
 * ============================================
 * PEERALI LAW - MAIN JAVASCRIPT
 * Global utilities and interactions
 * Pure vanilla JavaScript (ES6+)
 * ============================================
 */

(function() {
    'use strict';

    /* ============================================
       SMOOTH SCROLL FOR ANCHOR LINKS
       ============================================ */
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');

                // Skip if href is just "#"
                if (targetId === '#' || !targetId) {
                    return;
                }

                const target = document.querySelector(targetId);

                if (target) {
                    e.preventDefault();

                    // Get header height for offset
                    const header = document.querySelector('.site-header');
                    const headerHeight = header ? header.offsetHeight : 0;

                    // Calculate target position
                    const targetPosition = target.offsetTop - headerHeight - 20;

                    // Smooth scroll to target
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL hash without jumping
                    if (history.pushState) {
                        history.pushState(null, null, targetId);
                    }
                }
            });
        });
    }

    /* ============================================
       CURRENT YEAR IN FOOTER
       ============================================ */
    function updateCopyrightYear() {
        const currentYearElements = document.querySelectorAll('.current-year');
        const currentYear = new Date().getFullYear();

        currentYearElements.forEach(element => {
            element.textContent = currentYear;
        });
    }

    /* ============================================
       LAZY LOADING IMAGES
       ============================================ */
    function initLazyLoading() {
        // Check if Intersection Observer is supported
        if ('IntersectionObserver' in window) {
            const images = document.querySelectorAll('img[data-src]');

            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;

                        // Load srcset if available
                        if (img.dataset.srcset) {
                            img.srcset = img.dataset.srcset;
                        }

                        // Remove data attributes
                        img.removeAttribute('data-src');
                        img.removeAttribute('data-srcset');

                        // Add loaded class
                        img.classList.add('loaded');

                        // Stop observing this image
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for browsers that don't support Intersection Observer
            const images = document.querySelectorAll('img[data-src]');
            images.forEach(img => {
                img.src = img.dataset.src;
                if (img.dataset.srcset) {
                    img.srcset = img.dataset.srcset;
                }
            });
        }
    }

    /* ============================================
       FAQ ACCORDION
       ============================================ */
    function initFAQAccordion() {
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const isActive = faqItem.classList.contains('active');

                // Close all FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });

                // Open clicked item if it wasn't active
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            });
        });
    }

    /* ============================================
       FORM VALIDATION
       ============================================ */
    function initFormValidation() {
        const forms = document.querySelectorAll('form[data-validate]');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous error messages
                this.querySelectorAll('.error-message').forEach(msg => msg.remove());
                this.querySelectorAll('.error').forEach(field => field.classList.remove('error'));

                let isValid = true;

                // Validate required fields
                const requiredFields = this.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        showError(field, 'This field is required');
                    } else if (field.type === 'email' && !isValidEmail(field.value)) {
                        isValid = false;
                        showError(field, 'Please enter a valid email address');
                    } else if (field.type === 'tel' && !isValidPhone(field.value)) {
                        isValid = false;
                        showError(field, 'Please enter a valid phone number');
                    }
                });

                // If valid, submit form
                if (isValid) {
                    // You can add AJAX submission here
                    this.submit();
                }
            });
        });
    }

    function showError(field, message) {
        field.classList.add('error');

        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = 'var(--error-red)';
        errorDiv.style.fontSize = 'var(--font-size-sm)';
        errorDiv.style.marginTop = 'var(--spacing-1)';
        errorDiv.textContent = message;

        field.parentElement.appendChild(errorDiv);
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function isValidPhone(phone) {
        const re = /^[\d\s\-\(\)]+$/;
        return re.test(phone) && phone.replace(/\D/g, '').length >= 10;
    }

    /* ============================================
       ANIMATIONS ON SCROLL
       ============================================ */
    function initScrollAnimations() {
        if ('IntersectionObserver' in window) {
            const animatedElements = document.querySelectorAll('[data-animate]');

            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, {
                threshold: 0.1
            });

            animatedElements.forEach(element => {
                animationObserver.observe(element);
            });
        }
    }

    /* ============================================
       EXTERNAL LINKS
       ============================================ */
    function initExternalLinks() {
        const links = document.querySelectorAll('a[href^="http"]');
        const currentDomain = window.location.hostname;

        links.forEach(link => {
            const linkDomain = new URL(link.href).hostname;

            if (linkDomain !== currentDomain) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');

                // Add external link icon (optional)
                if (!link.querySelector('.external-icon')) {
                    const icon = document.createElement('i');
                    icon.className = 'fas fa-external-link-alt external-icon';
                    icon.style.fontSize = '0.8em';
                    icon.style.marginLeft = '0.25rem';
                    link.appendChild(icon);
                }
            }
        });
    }

    /* ============================================
       COOKIE CONSENT (Basic Implementation)
       ============================================ */
    function initCookieConsent() {
        // Check if user has already accepted cookies
        if (localStorage.getItem('cookieConsent') === 'accepted') {
            return;
        }

        // Create cookie banner
        const banner = document.createElement('div');
        banner.className = 'cookie-consent';
        banner.innerHTML = `
            <div class="cookie-content">
                <p>We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>
                <button class="btn btn-primary btn-small cookie-accept">Accept</button>
            </div>
        `;

        // Add styles
        banner.style.cssText = `
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--primary-navy);
            color: white;
            padding: 1rem;
            z-index: 9999;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        `;

        const content = banner.querySelector('.cookie-content');
        content.style.cssText = `
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            max-width: 1280px;
            margin: 0 auto;
            flex-wrap: wrap;
        `;

        document.body.appendChild(banner);

        // Handle accept button
        const acceptBtn = banner.querySelector('.cookie-accept');
        acceptBtn.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'accepted');
            banner.remove();
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
        initSmoothScroll();
        updateCopyrightYear();
        initLazyLoading();
        initFAQAccordion();
        initFormValidation();
        initScrollAnimations();
        // initExternalLinks(); // Uncomment if you want external link icons
        // initCookieConsent(); // Uncomment if you want cookie consent banner
    }

    // Initialize
    init();

})();
