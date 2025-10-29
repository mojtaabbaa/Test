/**
 * Codegen Pro Main Scripts
 * 
 * @package Codegen_Pro
 * @version 2.0.0
 */

(function($) {
    'use strict';
    
    // Main object
    var CodegenPro = {
        
        /**
         * Initialize
         */
        init: function() {
            this.bindEvents();
            this.initAnimations();
            this.initCounters();
            this.initSmoothScroll();
            this.initBackToTop();
            this.initMobileMenu();
        },
        
        /**
         * Bind events
         */
        bindEvents: function() {
            $(window).on('scroll', this.onScroll.bind(this));
            $(window).on('resize', this.onResize.bind(this));
            $(document).on('click', '.mobile-menu-toggle', this.toggleMobileMenu);
            $(document).on('click', '.back-to-top', this.scrollToTop);
        },
        
        /**
         * Initialize animations
         */
        initAnimations: function() {
            // Intersection Observer for animations
            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate');
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });
                
                // Observe elements with animation classes
                $('.animate-on-scroll').each(function() {
                    observer.observe(this);
                });
            }
        },
        
        /**
         * Initialize counters
         */
        initCounters: function() {
            $('.counter').each(function() {
                var $this = $(this);
                var countTo = $this.attr('data-count');
                
                if (countTo) {
                    $({ countNum: $this.text() }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    });
                }
            });
        },
        
        /**
         * Initialize smooth scroll
         */
        initSmoothScroll: function() {
            $('a[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top - 80
                        }, 1000);
                        return false;
                    }
                }
            });
        },
        
        /**
         * Initialize back to top button
         */
        initBackToTop: function() {
            var $backToTop = $('.back-to-top');
            
            if ($backToTop.length) {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 300) {
                        $backToTop.fadeIn();
                    } else {
                        $backToTop.fadeOut();
                    }
                });
            }
        },
        
        /**
         * Initialize mobile menu
         */
        initMobileMenu: function() {
            // Mobile menu functionality will be added here
        },
        
        /**
         * Toggle mobile menu
         */
        toggleMobileMenu: function() {
            $('.mobile-menu').toggleClass('active');
            $('.mobile-menu-toggle').toggleClass('active');
            $('body').toggleClass('menu-open');
        },
        
        /**
         * Scroll to top
         */
        scrollToTop: function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        },
        
        /**
         * On scroll event
         */
        onScroll: function() {
            var scrollTop = $(window).scrollTop();
            
            // Header scroll effect
            if (scrollTop > 100) {
                $('.site-header').addClass('scrolled');
            } else {
                $('.site-header').removeClass('scrolled');
            }
            
            // Parallax effect
            $('.parallax').each(function() {
                var $this = $(this);
                var speed = $this.data('speed') || 0.5;
                var yPos = -(scrollTop * speed);
                $this.css('transform', 'translateY(' + yPos + 'px)');
            });
        },
        
        /**
         * On resize event
         */
        onResize: function() {
            // Handle resize events
        }
    };
    
    // Initialize when document is ready
    $(document).ready(function() {
        CodegenPro.init();
    });
    
    // Expose to global scope
    window.CodegenPro = CodegenPro;
    
})(jQuery);

/**
 * Elementor Frontend Handlers
 */
jQuery(window).on('elementor/frontend/init', function() {
    
    // Hero Widget Handler
    elementorFrontend.hooks.addAction('frontend/element_ready/codegen-hero.default', function($scope) {
        // Hero specific JavaScript
        var $hero = $scope.find('.codegen-hero');
        if ($hero.length) {
            $hero.addClass('animate-fade-in-up');
        }
    });
    
    // Stats Widget Handler
    elementorFrontend.hooks.addAction('frontend/element_ready/codegen-stats.default', function($scope) {
        var $counters = $scope.find('.counter');
        
        if ($counters.length && 'IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var $counter = jQuery(entry.target);
                        var countTo = $counter.attr('data-count');
                        var duration = $counter.attr('data-duration') || 2000;
                        
                        if (countTo && !$counter.hasClass('counted')) {
                            $counter.addClass('counted');
                            
                            jQuery({ countNum: 0 }).animate({
                                countNum: countTo
                            }, {
                                duration: parseInt(duration),
                                easing: 'swing',
                                step: function() {
                                    $counter.text(Math.floor(this.countNum));
                                },
                                complete: function() {
                                    $counter.text(countTo);
                                }
                            });
                        }
                        
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });
            
            $counters.each(function() {
                observer.observe(this);
            });
        }
    });
    
    // Testimonials Widget Handler
    elementorFrontend.hooks.addAction('frontend/element_ready/codegen-testimonials.default', function($scope) {
        var $slider = $scope.find('.testimonials-slider');
        
        if ($slider.length && typeof Swiper !== 'undefined') {
            new Swiper($slider[0], {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                }
            });
        }
    });
    
    // Process Steps Widget Handler
    elementorFrontend.hooks.addAction('frontend/element_ready/codegen-process-steps.default', function($scope) {
        var $steps = $scope.find('.process-step');
        
        if ($steps.length && 'IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry, index) {
                    if (entry.isIntersecting) {
                        setTimeout(function() {
                            entry.target.classList.add('animate');
                        }, index * 200);
                    }
                });
            }, {
                threshold: 0.3
            });
            
            $steps.each(function() {
                observer.observe(this);
            });
        }
    });
    
    // Models Widget Handler
    elementorFrontend.hooks.addAction('frontend/element_ready/codegen-models.default', function($scope) {
        var $models = $scope.find('.model-card');
        
        $models.on('mouseenter', function() {
            $(this).addClass('hovered');
        }).on('mouseleave', function() {
            $(this).removeClass('hovered');
        });
    });
    
    // Pricing Widget Handler
    elementorFrontend.hooks.addAction('frontend/element_ready/codegen-pricing.default', function($scope) {
        var $toggle = $scope.find('.pricing-toggle');
        var $cards = $scope.find('.pricing-card');
        
        if ($toggle.length) {
            $toggle.on('change', function() {
                var isAnnual = $(this).is(':checked');
                $cards.each(function() {
                    var $card = $(this);
                    var monthlyPrice = $card.data('monthly-price');
                    var annualPrice = $card.data('annual-price');
                    var $price = $card.find('.price-amount');
                    
                    if (isAnnual && annualPrice) {
                        $price.text(annualPrice);
                        $card.addClass('annual');
                    } else if (monthlyPrice) {
                        $price.text(monthlyPrice);
                        $card.removeClass('annual');
                    }
                });
            });
        }
    });
});

