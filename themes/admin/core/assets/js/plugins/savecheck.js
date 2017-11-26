/**
 * Created by Keith Larson AYC on 2/26/2016.
 */

(function($){
    /**
     *
     * Shows a confirmation box when the user tries to leave the page.
     *
     * @param message   {String}    The message to display
     */
    $.fn.savecheck = function(message){
        // add are you sure
        $(window).bind('beforeunload', function(){
            return message;
        });
        // but allow the save all changes button to go through
        this.click(function() {
            $(window).unbind('beforeunload');
        });
    }
})(jQuery);