/**
 * Elementor Pro Addons Admin JavaScript
 */

(function($) {
    'use strict';

    var ElementorProAddonsAdmin = {
        init: function() {
            this.bindEvents();
        },

        bindEvents: function() {
            // Widget toggle
            $(document).on('change', '.epa-widget-card input[type="checkbox"]', this.toggleWidget);
            
            // Enable/Disable all buttons
            $(document).on('click', '#epa-enable-all', this.enableAllWidgets);
            $(document).on('click', '#epa-disable-all', this.disableAllWidgets);
        },

        toggleWidget: function() {
            var $checkbox = $(this);
            var $card = $checkbox.closest('.epa-widget-card');
            var widget = $checkbox.data('widget');
            var enabled = $checkbox.is(':checked');

            // Add loading state
            $card.addClass('loading');

            // Send AJAX request
            $.ajax({
                url: epaAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'toggle_widget',
                    widget: widget,
                    enabled: enabled,
                    nonce: epaAjax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        ElementorProAddonsAdmin.showNotification(response.data.message, 'success');
                    } else {
                        ElementorProAddonsAdmin.showNotification(epaAjax.strings.error, 'error');
                        // Revert checkbox state
                        $checkbox.prop('checked', !enabled);
                    }
                },
                error: function() {
                    ElementorProAddonsAdmin.showNotification(epaAjax.strings.error, 'error');
                    // Revert checkbox state
                    $checkbox.prop('checked', !enabled);
                },
                complete: function() {
                    // Remove loading state
                    $card.removeClass('loading');
                }
            });
        },

        enableAllWidgets: function(e) {
            e.preventDefault();
            $('.epa-widget-card input[type="checkbox"]').each(function() {
                if (!$(this).is(':checked')) {
                    $(this).prop('checked', true).trigger('change');
                }
            });
        },

        disableAllWidgets: function(e) {
            e.preventDefault();
            $('.epa-widget-card input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    $(this).prop('checked', false).trigger('change');
                }
            });
        },

        showNotification: function(message, type) {
            type = type || 'success';
            
            var iconClass = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-triangle';
            
            var $notification = $('<div class="epa-notification ' + type + '">' +
                '<div class="epa-notification-content">' +
                    '<i class="epa-notification-icon ' + iconClass + '"></i>' +
                    '<span class="epa-notification-message">' + message + '</span>' +
                '</div>' +
            '</div>');

            $('body').append($notification);

            // Show notification
            setTimeout(function() {
                $notification.addClass('show');
            }, 100);

            // Hide notification after 3 seconds
            setTimeout(function() {
                $notification.removeClass('show');
                setTimeout(function() {
                    $notification.remove();
                }, 300);
            }, 3000);
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        ElementorProAddonsAdmin.init();
    });

})(jQuery);
