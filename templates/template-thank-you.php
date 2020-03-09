<?php
	// Template Name: Thank You
	get_header();
?>
<section class="thank-you-section" style="background-color: <?php echo get_theme_mod( 'thankyou_bg_color' );?>;">
    <a href="<?php echo get_site_url(); ?>/" class="back-to-home"><i class="far fa-long-arrow-alt-left"></i> back to home</a>
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12">
				<?php
					if( have_posts() ) {
						while( have_posts() ) { the_post();
							the_content();
						}
					}
				?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>