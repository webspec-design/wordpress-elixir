(function ( $ ) { //inline jQuery plugin to match height of elements
    $.fn.match_height = function(userOptions, callback) {
        var defaults = {
            mode:'maximum'
        };
        var options = $.extend({}, defaults, userOptions);
                var height = 0;
        if(options.mode == 'maximum') {
            height = 0;
        } else {
            height = this.first().outerHeight(false);
        }
        this.each(function() {
            $(this).css('height', 'auto');
            if(options.mode == 'maximum') {
                if($(this).outerHeight(false) > height) {
                    height = $(this).outerHeight(false);
                }
            } else if(options.mode == 'minimum') {
                if($(this).outerHeight(false) < height) {
                    height = $(this).outerHeight(false);
                }
            }
        });
        this.each(function() {
            $(this).outerHeight(height);
        });
        if(typeof callback == 'function') {
            callback.call(this);
        }
        return this;
    };
}( jQuery ));
