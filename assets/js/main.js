/**
 * Main JavaScript file for Codegen Pro theme
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        initMobileMenu();
        initBackToTop();
        initPreloader();
        initSmoothScrolling();
        initHeaderScroll();
        initAnimations();
    });

    /**
     * Initialize mobile menu
     */
    function initMobileMenu() {
        const $mobileToggle = $('.mobile-menu-toggle');
        const $navigation = $('.main-navigation');

        $mobileToggle.on('click', function() {
            $(this).toggleClass('active');
            $navigation.toggleClass('active');
        });

        // Close mobile menu when clicking on a link
        $('.main-navigation a').on('click', function() {
            $mobileToggle.removeClass('active');
            $navigation.removeClass('active');
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-header').length) {
                $mobileToggle.removeClass('active');
                $navigation.removeClass('active');
            }
        });
    }

    /**
     * Initialize back to top button
     */
    function initBackToTop() {
        const $backToTop = $('#back-to-top');

        if ($backToTop.length) {
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 300) {
                    $backToTop.addClass('visible');
                } else {
                    $backToTop.removeClass('visible');
                }
            });

            $backToTop.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 600);
            });
        }
    }

    /**
     * Initialize preloader
     */
    function initPreloader() {
        const $preloader = $('#preloader');

        if ($preloader.length) {
            $(window).on('load', function() {
                $preloader.fadeOut(500, function() {
                    $(this).remove();
                });
            });
        }
    }

    /**
     * Initialize smooth scrolling for anchor links
     */
    function initSmoothScrolling() {
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && 
                location.hostname === this.hostname) {
                
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 600);
                    return false;
                }
            }
        });
    }

    /**
     * Initialize header scroll effects
     */
    function initHeaderScroll() {
        const $header = $('.site-header');
        let lastScrollTop = 0;

        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();

            // Add/remove scrolled class
            if (scrollTop > 50) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }

            // Hide/show header on scroll
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                $header.addClass('header-hidden');
            } else {
                $header.removeClass('header-hidden');
            }

            lastScrollTop = scrollTop;
        });
    }

    /**
     * Initialize scroll animations
     */
    function initAnimations() {
        // Intersection Observer for fade-in animations
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe all elements with fade-in-up class
            $('.fade-in-up').each(function() {
                observer.observe(this);
            });
        } else {
            // Fallback for browsers without Intersection Observer
            $('.fade-in-up').addClass('animate-in');
        }

        // Counter animation for stats
        animateCounters();
    }

    /**
     * Animate counters
     */
    function animateCounters() {
        $('.stat-item h3').each(function() {
            const $this = $(this);
            const text = $this.text();
            const number = text.match(/[\d,]+/);
            
            if (number) {
                const finalNumber = parseInt(number[0].replace(/,/g, ''));
                const suffix = text.replace(number[0], '');
                
                if (finalNumber > 0) {
                    $this.prop('Counter', 0).animate({
                        Counter: finalNumber
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            const formattedNumber = Math.ceil(now).toLocaleString();
                            $this.text(formattedNumber + suffix);
                        }
                    });
                }
            }
        });
    }

    /**
     * Initialize parallax effects
     */
    function initParallax() {
        if ($(window).width() > 768) {
            $(window).on('scroll', function() {
                const scrolled = $(this).scrollTop();
                const parallaxElements = $('.parallax');

                parallaxElements.each(function() {
                    const $this = $(this);
                    const speed = $this.data('speed') || 0.5;
                    const yPos = -(scrolled * speed);
                    $this.css('transform', 'translateY(' + yPos + 'px)');
                });
            });
        }
    }

    /**
     * Initialize form enhancements
     */
    function initForms() {
        // Add focus classes to form fields
        $('input, textarea, select').on('focus', function() {
            $(this).closest('.form-group').addClass('focused');
        }).on('blur', function() {
            if (!$(this).val()) {
                $(this).closest('.form-group').removeClass('focused');
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            const $form = $(this);
            let isValid = true;

            $form.find('[required]').each(function() {
                const $field = $(this);
                if (!$field.val().trim()) {
                    $field.addClass('error');
                    isValid = false;
                } else {
                    $field.removeClass('error');
                }
            });

            // Email validation
            $form.find('input[type="email"]').each(function() {
                const $field = $(this);
                const email = $field.val();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email && !emailRegex.test(email)) {
                    $field.addClass('error');
                    isValid = false;
                } else if (email) {
                    $field.removeClass('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                $form.find('.error').first().focus();
            }
        });
    }

    /**
     * Initialize lazy loading for images
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Initialize tooltips
     */
    function initTooltips() {
        $('[data-tooltip]').each(function() {
            const $this = $(this);
            const tooltipText = $this.data('tooltip');
            
            $this.on('mouseenter', function() {
                const $tooltip = $('<div class="tooltip">' + tooltipText + '</div>');
                $('body').append($tooltip);
                
                const offset = $this.offset();
                $tooltip.css({
                    top: offset.top - $tooltip.outerHeight() - 10,
                    left: offset.left + ($this.outerWidth() / 2) - ($tooltip.outerWidth() / 2)
                });
            }).on('mouseleave', function() {
                $('.tooltip').remove();
            });
        });
    }

    /**
     * Initialize modal functionality
     */
    function initModals() {
        // Open modal
        $('[data-modal]').on('click', function(e) {
            e.preventDefault();
            const modalId = $(this).data('modal');
            $('#' + modalId).addClass('active');
            $('body').addClass('modal-open');
        });

        // Close modal
        $('.modal-close, .modal-overlay').on('click', function() {
            $('.modal').removeClass('active');
            $('body').removeClass('modal-open');
        });

        // Close modal with ESC key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27) {
                $('.modal').removeClass('active');
                $('body').removeClass('modal-open');
            }
        });
    }

    /**
     * Initialize search functionality
     */
    function initSearch() {
        const $searchToggle = $('.search-toggle');
        const $searchForm = $('.search-form');

        $searchToggle.on('click', function(e) {
            e.preventDefault();
            $searchForm.toggleClass('active');
            if ($searchForm.hasClass('active')) {
                $searchForm.find('input[type="search"]').focus();
            }
        });

        // Close search when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-form, .search-toggle').length) {
                $searchForm.removeClass('active');
            }
        });
    }

    // Initialize additional features
    $(document).ready(function() {
        initParallax();
        initForms();
        initLazyLoading();
        initTooltips();
        initModals();
        initSearch();
    });

    // Window resize handler
    $(window).on('resize', function() {
        // Reinitialize parallax on resize
        if ($(window).width() <= 768) {
            $('.parallax').css('transform', 'none');
        }
    });

})(jQuery);
