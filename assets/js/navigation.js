/*!
 * ============================================
 * PEERALI LAW - NAVIGATION JAVASCRIPT
 * Professional law firm navigation system
 * Pure vanilla JavaScript (ES6+)
 * ============================================
 */

(function() {
    'use strict';

    /* ============================================
       DOM ELEMENTS
       ============================================ */
    const elements = {
        // Header
        header: document.getElementById('siteHeader'),

        // Mobile Menu
        mobileMenuToggle: document.getElementById('mobileMenuToggle'),
        mobileMenu: document.getElementById('mobileMenu'),
        mobileMenuOverlay: document.getElementById('mobileMenuOverlay'),
        mobileMenuClose: document.getElementById('mobileMenuClose'),
        mobileDropdownToggles: document.querySelectorAll('.mobile-dropdown-toggle'),

        // Search
        searchToggle: document.getElementById('searchToggle'),
        searchOverlay: document.getElementById('searchOverlay'),
        searchClose: document.getElementById('searchClose'),
        searchInput: document.getElementById('searchInput'),

        // Language Switcher
        langButtons: document.querySelectorAll('.lang-btn'),
        mobileLangButtons: document.querySelectorAll('.mobile-lang-btn'),

        // Navigation Links
        navLinks: document.querySelectorAll('.nav-link, .dropdown-link, .mega-menu-link'),
        mobileNavLinks: document.querySelectorAll('.mobile-nav-link, .mobile-dropdown-link')
    };

    /* ============================================
       STICKY HEADER
       ============================================ */
    function initStickyHeader() {
        let lastScrollTop = 0;
        const scrollThreshold = 100;

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Add/remove scrolled class
            if (scrollTop > scrollThreshold) {
                elements.header?.classList.add('scrolled');
            } else {
                elements.header?.classList.remove('scrolled');
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, { passive: true });
    }

    /* ============================================
       MOBILE MENU
       ============================================ */
    function initMobileMenu() {
        // Open mobile menu
        elements.mobileMenuToggle?.addEventListener('click', openMobileMenu);

        // Close mobile menu
        elements.mobileMenuClose?.addEventListener('click', closeMobileMenu);
        elements.mobileMenuOverlay?.addEventListener('click', closeMobileMenu);

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.body.classList.contains('menu-open')) {
                closeMobileMenu();
            }
        });

        // Prevent body scroll when menu is open
        function openMobileMenu() {
            elements.mobileMenu?.classList.add('active');
            elements.mobileMenuOverlay?.classList.add('active');
            elements.mobileMenuToggle?.classList.add('active');
            document.body.classList.add('menu-open');
        }

        function closeMobileMenu() {
            elements.mobileMenu?.classList.remove('active');
            elements.mobileMenuOverlay?.classList.remove('active');
            elements.mobileMenuToggle?.classList.remove('active');
            document.body.classList.remove('menu-open');
        }

        // Close menu when clicking on a link (except dropdown toggles)
        elements.mobileNavLinks.forEach(link => {
            if (!link.classList.contains('mobile-dropdown-toggle')) {
                link.addEventListener('click', closeMobileMenu);
            }
        });
    }

    /* ============================================
       MOBILE DROPDOWN ACCORDION
       ============================================ */
    function initMobileDropdowns() {
        elements.mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                const dropdownId = this.getAttribute('data-dropdown');
                const dropdownMenu = document.getElementById(`dropdown-${dropdownId}`);

                // Toggle current dropdown
                this.classList.toggle('active');
                dropdownMenu?.classList.toggle('active');

                // Close other dropdowns (optional - comment out for multiple open dropdowns)
                elements.mobileDropdownToggles.forEach(otherToggle => {
                    if (otherToggle !== this) {
                        otherToggle.classList.remove('active');
                        const otherDropdownId = otherToggle.getAttribute('data-dropdown');
                        const otherDropdownMenu = document.getElementById(`dropdown-${otherDropdownId}`);
                        otherDropdownMenu?.classList.remove('active');
                    }
                });
            });
        });
    }

    /* ============================================
       SEARCH OVERLAY
       ============================================ */
    function initSearchOverlay() {
        // Open search
        elements.searchToggle?.addEventListener('click', openSearch);

        // Close search
        elements.searchClose?.addEventListener('click', closeSearch);
        elements.searchOverlay?.addEventListener('click', function(e) {
            if (e.target === elements.searchOverlay) {
                closeSearch();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.body.classList.contains('search-open')) {
                closeSearch();
            }
        });

        function openSearch() {
            elements.searchOverlay?.classList.add('active');
            document.body.classList.add('search-open');

            // Focus on search input after animation
            setTimeout(() => {
                elements.searchInput?.focus();
            }, 300);
        }

        function closeSearch() {
            elements.searchOverlay?.classList.remove('active');
            document.body.classList.remove('search-open');
        }
    }

    /* ============================================
       ACTIVE PAGE DETECTION
       ============================================ */
    function initActivePageDetection() {
        const currentPath = window.location.pathname;
        const currentPage = currentPath.split('/').pop() || 'index.html';

        // Desktop navigation
        elements.navLinks.forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath === currentPage || linkPath === currentPath) {
                link.classList.add('active');

                // Also mark parent dropdown as active
                const parentDropdown = link.closest('.has-dropdown');
                if (parentDropdown) {
                    const parentLink = parentDropdown.querySelector('.nav-link');
                    parentLink?.classList.add('active');
                }
            }
        });

        // Mobile navigation
        elements.mobileNavLinks.forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath === currentPage || linkPath === currentPath) {
                link.classList.add('active');

                // Open parent dropdown if inside one
                const parentDropdown = link.closest('.mobile-dropdown-menu');
                if (parentDropdown) {
                    parentDropdown.classList.add('active');
                    const dropdownId = parentDropdown.id.replace('dropdown-', '');
                    const toggle = document.querySelector(`[data-dropdown="${dropdownId}"]`);
                    toggle?.classList.add('active');
                }
            }
        });
    }

    /* ============================================
       LANGUAGE SWITCHER
       ============================================ */
    function initLanguageSwitcher() {
        // Desktop language switcher
        elements.langButtons.forEach(button => {
            button.addEventListener('click', function() {
                const lang = this.getAttribute('data-lang');
                switchLanguage(lang);

                // Update active state
                elements.langButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Mobile language switcher
        elements.mobileLangButtons.forEach(button => {
            button.addEventListener('click', function() {
                const lang = this.getAttribute('data-lang');
                switchLanguage(lang);

                // Update active state
                elements.mobileLangButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        function switchLanguage(lang) {
            const currentPath = window.location.pathname;

            if (lang === 'es') {
                // Switch to Spanish
                if (!currentPath.startsWith('/es/')) {
                    // Remove leading slash and add /es/ prefix
                    const newPath = '/es/' + currentPath.replace(/^\//, '');
                    window.location.href = newPath;
                }
            } else if (lang === 'en') {
                // Switch to English (remove /es/ prefix)
                if (currentPath.startsWith('/es/')) {
                    const newPath = currentPath.replace(/^\/es\//, '/');
                    window.location.href = newPath;
                }
            }
        }
    }

    /* ============================================
       SMOOTH SCROLL FOR ANCHOR LINKS
       ============================================ */
    function initSmoothScroll() {
        // Select all anchor links with hash
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');

                // Skip if it's just "#"
                if (targetId === '#' || !targetId) {
                    e.preventDefault();
                    return;
                }

                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();

                    // Close mobile menu if open
                    if (document.body.classList.contains('menu-open')) {
                        elements.mobileMenu?.classList.remove('active');
                        elements.mobileMenuOverlay?.classList.remove('active');
                        elements.mobileMenuToggle?.classList.remove('active');
                        document.body.classList.remove('menu-open');
                    }

                    // Smooth scroll to target
                    const headerHeight = elements.header?.offsetHeight || 0;
                    const targetPosition = targetElement.offsetTop - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL hash
                    history.pushState(null, null, targetId);
                }
            });
        });
    }

    /* ============================================
       DROPDOWN HOVER FOR DESKTOP
       ============================================ */
    function initDesktopDropdowns() {
        // Desktop dropdowns are handled by CSS :hover
        // This function can add additional JS enhancements if needed

        const dropdownItems = document.querySelectorAll('.has-dropdown');

        dropdownItems.forEach(item => {
            let timeoutId;

            // Add slight delay to prevent accidental triggers
            item.addEventListener('mouseenter', function() {
                clearTimeout(timeoutId);
                this.querySelector('.nav-link')?.setAttribute('aria-expanded', 'true');
            });

            item.addEventListener('mouseleave', function() {
                timeoutId = setTimeout(() => {
                    this.querySelector('.nav-link')?.setAttribute('aria-expanded', 'false');
                }, 100);
            });
        });
    }

    /* ============================================
       KEYBOARD NAVIGATION
       ============================================ */
    function initKeyboardNavigation() {
        // Allow keyboard navigation through dropdowns
        const dropdownToggles = document.querySelectorAll('.nav-link[aria-haspopup="true"]');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('keydown', function(e) {
                // Open dropdown on Enter or Space
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const parent = this.closest('.has-dropdown');
                    const dropdown = parent?.querySelector('.dropdown-menu, .mega-menu');

                    if (dropdown) {
                        const isExpanded = this.getAttribute('aria-expanded') === 'true';
                        this.setAttribute('aria-expanded', !isExpanded);

                        // Focus first link in dropdown
                        if (!isExpanded) {
                            const firstLink = dropdown.querySelector('a');
                            firstLink?.focus();
                        }
                    }
                }

                // Close dropdown on Escape
                if (e.key === 'Escape') {
                    this.setAttribute('aria-expanded', 'false');
                    this.focus();
                }
            });
        });
    }

    /* ============================================
       SEARCH FORM ENHANCEMENT
       ============================================ */
    function initSearchEnhancements() {
        const searchForm = document.querySelector('.search-form');
        const searchInput = document.getElementById('searchInput');

        if (searchForm && searchInput) {
            // Prevent empty searches
            searchForm.addEventListener('submit', function(e) {
                const query = searchInput.value.trim();

                if (!query) {
                    e.preventDefault();
                    searchInput.focus();
                    return false;
                }
            });

            // Clear search on ESC key
            searchInput?.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                }
            });
        }
    }

    /* ============================================
       CLICK OUTSIDE TO CLOSE DROPDOWNS
       ============================================ */
    function initClickOutside() {
        document.addEventListener('click', function(e) {
            // Close desktop dropdowns when clicking outside
            if (!e.target.closest('.has-dropdown')) {
                const dropdowns = document.querySelectorAll('.nav-link[aria-expanded="true"]');
                dropdowns.forEach(dropdown => {
                    dropdown.setAttribute('aria-expanded', 'false');
                });
            }
        });
    }

    /* ============================================
       RESIZE HANDLER
       ============================================ */
    function initResizeHandler() {
        let resizeTimer;

        window.addEventListener('resize', function() {
            // Clear timeout
            clearTimeout(resizeTimer);

            // Set timeout to run after resizing ends
            resizeTimer = setTimeout(function() {
                const width = window.innerWidth;

                // Close mobile menu if resizing to desktop
                if (width >= 1024 && document.body.classList.contains('menu-open')) {
                    elements.mobileMenu?.classList.remove('active');
                    elements.mobileMenuOverlay?.classList.remove('active');
                    elements.mobileMenuToggle?.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
            }, 250);
        });
    }

    /* ============================================
       PERFORMANCE OPTIMIZATION
       ============================================ */
    function optimizePerformance() {
        // Add loading class to body until page is fully loaded
        window.addEventListener('load', function() {
            document.body.classList.add('page-loaded');
        });

        // Lazy load images in navigation if any
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.dataset.src || img.src;
            });
        }
    }

    /* ============================================
       ACCESSIBILITY ENHANCEMENTS
       ============================================ */
    function initAccessibility() {
        // Add skip to content link
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.className = 'skip-to-content';
        skipLink.textContent = 'Skip to main content';
        document.body.insertBefore(skipLink, document.body.firstChild);

        // Announce page changes to screen readers
        const pageTitle = document.title;
        const announcement = document.createElement('div');
        announcement.setAttribute('role', 'status');
        announcement.setAttribute('aria-live', 'polite');
        announcement.setAttribute('aria-atomic', 'true');
        announcement.className = 'sr-only';
        announcement.textContent = `Page loaded: ${pageTitle}`;
        document.body.appendChild(announcement);

        // Remove announcement after it's been read
        setTimeout(() => {
            announcement.remove();
        }, 1000);
    }

    /* ============================================
       INITIALIZATION
       ============================================ */
    function init() {
        // Check if DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAll);
        } else {
            initAll();
        }
    }

    function initAll() {
        console.log('🚀 Peerali Law Navigation System Initialized');

        // Initialize all modules
        initStickyHeader();
        initMobileMenu();
        initMobileDropdowns();
        initSearchOverlay();
        initActivePageDetection();
        initLanguageSwitcher();
        initSmoothScroll();
        initDesktopDropdowns();
        initKeyboardNavigation();
        initSearchEnhancements();
        initClickOutside();
        initResizeHandler();
        optimizePerformance();
        initAccessibility();

        console.log('✅ All navigation features loaded successfully');
    }

    // Start initialization
    init();

    /* ============================================
       EXPOSE PUBLIC API (OPTIONAL)
       ============================================ */
    window.PeeraliNavigation = {
        version: '1.0.0',
        closeMobileMenu: function() {
            elements.mobileMenu?.classList.remove('active');
            elements.mobileMenuOverlay?.classList.remove('active');
            elements.mobileMenuToggle?.classList.remove('active');
            document.body.classList.remove('menu-open');
        },
        closeSearch: function() {
            elements.searchOverlay?.classList.remove('active');
            document.body.classList.remove('search-open');
        },
        openSearch: function() {
            elements.searchOverlay?.classList.add('active');
            document.body.classList.add('search-open');
            setTimeout(() => {
                elements.searchInput?.focus();
            }, 300);
        }
    };

})();
