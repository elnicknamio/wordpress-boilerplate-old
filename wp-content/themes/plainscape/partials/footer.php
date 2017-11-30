<footer class="footer">

	<?php if ( has_nav_menu( 'meta' ) ) : ?>

		<nav class="meta-navigation" role="navigation" aria-label="<?php esc_attr_e( 'meta navigation', TEXTDOMAIN ); ?>">

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'meta',
					'menu_id' => 'meta-menu',
					'container' => ''
				)
			);
			?>

		</nav>

	<?php endif; ?>

</footer>

<?php wp_footer(); ?>

</body>

</html>
