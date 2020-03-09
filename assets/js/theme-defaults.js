$( document ).ready( function(){
    $( window ).on( 'load', function(){
        mobileMenuAlignment(); // MOBILE MENU DYNAMIC MARGIN & PADDING
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