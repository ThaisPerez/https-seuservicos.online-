(function($) {
    // Mascaras
    jQuery('.moeda').mask('000.000.000.000.000,00', {reverse: true});
    jQuery('.telefone').focus(function() {
        jQuery(this).maskbrphone({
            useDdd           : true,
            useDddParenthesis: true,
            dddSeparator     : ' ',
            numberSeparator  : '-'
        });
    });
})(jQuery);