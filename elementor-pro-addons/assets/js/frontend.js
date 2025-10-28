/**
 * Elementor Pro Addons Frontend JavaScript
 */

(function($) {
    'use strict';

    var ElementorProAddons = {
        init: function() {
            this.initTestimonialCarousel();
            this.initAnimations();
        },

        initTestimonialCarousel: function() {
            $('.epa-testimonial-carousel').each(function() {
                var $carousel = $(this);
                var settings = $carousel.data('swiper-settings');
                
                if (typeof Swiper !== 'undefined') {
                    new Swiper($carousel[0], settings);
                }
            });
        },

        initAnimations: function() {
            // Animate elements on scroll
            if (typeof IntersectionObserver !== 'undefined') {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('epa-animated');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                // Observe elements
                $('.epa-info-box-wrapper, .epa-pricing-table, .epa-team-member').each(function() {
                    observer.observe(this);
                });
            }

            // Counter animation for pricing tables
            $('.epa-pricing-table-integer-part').each(function() {
                var $this = $(this);
                var countTo = parseInt($this.text().replace(/[^\d]/g, ''));
                
                if (countTo > 0) {
                    $this.prop('Counter', 0).animate({
                        Counter: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            var formatted = Math.ceil(now);
                            if ($this.text().includes('.')) {
                                formatted = (Math.ceil(now * 100) / 100).toFixed(2);
                            }
                            $this.text(formatted);
                        }
                    });
                }
            });
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        ElementorProAddons.init();
    });

    // Re-initialize on Elementor frontend init (for preview mode)
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/epa-testimonial-carousel.default', function($scope) {
            var $carousel = $scope.find('.epa-testimonial-carousel');
            var settings = $carousel.data('swiper-settings');
            
            if (typeof Swiper !== 'undefined' && settings) {
                new Swiper($carousel[0], settings);
            }
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/epa-pricing-table.default', function($scope) {
            var $counter = $scope.find('.epa-pricing-table-integer-part');
            var countTo = parseInt($counter.text().replace(/[^\d]/g, ''));
            
            if (countTo > 0) {
                $counter.prop('Counter', 0).animate({
                    Counter: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function(now) {
                        var formatted = Math.ceil(now);
                        if ($counter.text().includes('.')) {
                            formatted = (Math.ceil(now * 100) / 100).toFixed(2);
                        }
                        $counter.text(formatted);
                    }
                });
            }
        });
    });

})(jQuery);
