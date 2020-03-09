<?php if ( is_active_sidebar( 'sidebar-widget' ) ){ ?>		
    <div class="col-12 col-lg-4 col-xl-3">
        <div class="page-sidebar">
            <?php dynamic_sidebar( 'sidebar-widget' ); ?>
        </div>
    </div>
<?php } ?>