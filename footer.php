	</main>
	<?php if( !is_404() && !is_page_template( 'templates/template-thank-you.php' ) ) { ?>
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="copyright-text">
							<!-- DON'T REMOVE THE PHP DATE / AUTO UPDATE PER YEAR -->
							&copy; <?php echo date('Y'); ?> <?php echo get_theme_mod( 'copyright' ); ?>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<?php } ?>
	<?php wp_footer(); ?>
</body>
</html>