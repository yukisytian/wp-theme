<?php get_header(); ?>
<section class="single-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-9">
				<?php
					if( have_posts() ){
						while( have_posts() ) { the_post();
							$featuredImage  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
							$author         = get_the_author();
							$category       = get_the_category();
							$parentCategory = $category ? $category[0]->name : '';
				?>
							<div class="post-item">
								<?php
									if( $featuredImage )
										echo "<img src='".$featuredImage."' alt='".get_the_title()."' class='img-fluid featured-image' />";
								?>
								<h1 class="post-title"><?php echo get_the_title(); ?></h1>
								<div class="post-author">
									Posted<?php echo $author ? " by <strong>" . $author . "</strong>" : ""; ?><?php echo $category ? " in <strong>" . $parentCategory . "</strong>" : ""; ?>
								</div>
								<div class="post-content default-content">
									<?php the_content(); ?>
								</div>
							</div>
				<?php
						}
					}
				?>

				<div class="next-prev-links">
					<?php previous_post_link( '%link', '<strong>Previous Post</strong>' ); ?>
					<?php next_post_link( '%link', '<strong>Next Post</strong>' ); ?>
				</div>

				<?php
	                if ( comments_open() || get_comments_number() ) {
	                    comments_template();
	                }
                ?>
			</div>
			<?php get_template_part( 'inc/sidebar' ); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>