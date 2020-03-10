// DEFAULT SLIDES
var sliders = document.querySelectorAll( '.slider' );
if ( sliders.length > 0 ) {
    $.each( sliders, function ( index, value ) {
        var sliderItems       = $( value ).data( 'items' ),
            sliderAutoPlay    = $( value ).data( 'autoplay' ),
            sliderLoop        = $( value ).data( 'loop' ),
            sliderSpeed       = $( value ).data( 'slide-speed' ) ? $( value ).data( 'slide-speed' ) : "300" , // slide change transition speed
            sliderTransition  = $( value ).data( 'time-before-slide' ) ? $( value ).data( 'time-before-slide' ) + "000" : "8000", // autoplay slide change transition speed
            slideCount        = $( value ).data( 'slide-count' ) ? $( value ).data( 'slide-count' ) : 'page', // number of slides to show in one click
            centerSlides      = $( value ).data( 'center-slides' ), // center the slides
            controls          = $( value ).data( 'controls' ), // enable next prev buttons
            sliderNav         = $( value ).data( 'slider-nav' ), // enable slider nav dots
            mouseDrag         = $( value ).data( 'mousedrag' ), // enable mouse drag
            edgePadding       = $( value ).data( 'edge-padding' ), // outside space -- panghatak sa elements
            autoWidth         = $( value ).data( 'auto-width' ), // auto width items
            startIndex        = $( value ).data( 'start-index' ), // slider start
            responsiveOptions = $( value ).data( 'responsive-options' );

        var slider = tns( {
            container: value,
            items: sliderItems,
            autoplay: sliderAutoPlay,
            startIndex: startIndex, // slider start
            loop: sliderLoop,
            speed: sliderSpeed, // slide change transition speed
            mouseDrag: mouseDrag, // enable mouse drag
            center: centerSlides, // center the slides
            edgePadding: edgePadding, // outside space -- panghatak sa elements
            autoWidth: autoWidth, // auto width items
            slideBy: slideCount, // number of slides to show in one click
            controls: controls, // enable next prev buttons
            controlsPosition: 'bottom', // position of the prev next buttons
            nav: sliderNav, // enable slider nav dots
            navPosition: 'bottom', // position of the nav dots
            autoplayPosition: 'bottom', // autoplay button position
            autoplayButtonOutput: false, // hide autoplay button
            autoplayTimeout: sliderTransition, // autoplay slide change transition speed
            responsive: responsiveOptions // responsive options declared
        } );
    } )
}

$( document ).ready( function(){
    $( window ).on( 'load', function(){
        mobileMenuAlignment(); // MOBILE MENU DYNAMIC MARGIN & PADDING

        // SITE LOADER
        if ( $( "body" ).hasClass( 'site-is-loading' ) ) {
            $( ".site-loader" ).css( "opacity", 0 );
            setTimeout( function(){
                $( "body" ).removeClass( 'site-is-loading' );
                $( ".site-loader" ).remove();
            }, 300 );
        }
    } );

    $( window ).on( 'resize', function(){
        mobileMenuAlignment(); // MOBILE MENU DYNAMIC MARGIN & PADDING
    } );

    // HAMBURGER MENU
    var HamburgerMenu = $( "[data=mobile-menu-trigger]" );
    var McBar1 = HamburgerMenu.find( "b:nth-child(1)" );
    var McBar2 = HamburgerMenu.find( "b:nth-child(2)" );
    var McBar3 = HamburgerMenu.find( "b:nth-child(3)" );
    HamburgerMenu.click( function( e ) {
        e.preventDefault();
        $( this ).toggleClass( "active" );
        $( '#mobile-menu' ).toggleClass( "active" );

        if ( HamburgerMenu.hasClass( "active" ) ) {
            McBar1.velocity({ top: "50%" }, {duration: 200, easing: "swing"});
            McBar3.velocity({ top: "50%" }, {duration: 200, easing: "swing"})
                        .velocity({rotateZ:"90deg"}, {duration: 800, delay: 200, easing: [500,20] });
            HamburgerMenu.velocity({rotateZ:"135deg"}, {duration: 800, delay: 200, easing: [500,20] });
        } else {
            $( '#mobile-menu .menu li.menu-item-has-children' ).removeClass( "active" );
            HamburgerMenu.velocity("reverse");
            McBar3.velocity({rotateZ:"0deg"}, {duration: 200, easing: [500,20] })
                        .velocity({ top: "100%" }, {duration: 300, easing: "swing"});
            McBar1.velocity("reverse", {delay: 300});
        }
    } );

    // MOBILE MENU ADD ARROW
    $( "#mobile-menu .menu li.menu-item-has-children" ).append( "<div class='dropdown-arrow'></div>" );
    $( "#mobile-menu .menu li.menu-item-has-children .sub-menu" ).prepend( "<li class='back-arrow'><i class='fal fa-long-arrow-left'></i> Back</li>" );
    $( "body" ).on( "click", "#mobile-menu .dropdown-arrow, #mobile-menu .back-arrow", function(){
        $( this ).closest( ".menu-item" ).toggleClass( "active" );
    } );

    // SIDEBAR WIDGET MENU
    $( ".page-sidebar .widget_nav_menu .menu .menu-item-has-children" ).append( "<div class='dropdown-arrow'></div>" );
    $( "body" ).on( "click", ".page-sidebar .widget_nav_menu .dropdown-arrow", function(){
        $( this ).closest( ".menu-item" ).toggleClass( "active" );
        if ( $( this ).closest( ".menu-item" ).hasClass( "active" ) ) {
            $( this ).siblings( ".sub-menu" ).slideDown();
        } else {
            $( this ).siblings( ".sub-menu" ).slideUp();
        }
    } );

    // MOBILE MENU DYNAMIC MARGIN & PADDING
    function mobileMenuAlignment() {
        var headerHeight = $( "#header" ).outerHeight();

        // mobile menu
        $( "#mobile-menu" ).css( 'margin-top', headerHeight );
        $( "#mobile-menu .mobile-menu-wrap" ).css( 'padding-bottom', headerHeight );
        $( "#mobile-menu .menu .sub-menu" ).css( 'margin-top', headerHeight );
    }
} );