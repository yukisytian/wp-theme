<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<?php
				if ( have_posts() ) {
					while ( have_posts() ) { the_post();
						the_title( "<h3>", "</h3>" );
					}
				}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>