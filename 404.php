<?php get_header(); ?>
<section class="page-not-found" style="background-color: <?php echo get_theme_mod( 'error_page_bg_color' );?>;">
    <a href="<?php echo get_site_url(); ?>/" class="back-to-home"><i class="far fa-long-arrow-alt-left"></i> back to home</a>
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <h1>404</h1>
                <?php echo get_theme_mod( 'error_page' ); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>