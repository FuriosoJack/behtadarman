;(function($, window, document, undefined){
    $( window ).on( 'elementor:init', function() {
        if( typeof elementorPro == 'undefined' ) {
            elementor.hooks.addFilter( 'editor/style/styleText', function( css, view ){
                let model = view.getEditModel(),
                ElementCSS = model.get( 'settings' ).get( 'custom_css' );

                if ( ElementCSS ) {
                    css += ElementCSS.replace( /selector/g, '.elementor-element.elementor-element-' + view.model.id );
                }

                return css;
            });
        }
    } );
})(jQuery, window, document);