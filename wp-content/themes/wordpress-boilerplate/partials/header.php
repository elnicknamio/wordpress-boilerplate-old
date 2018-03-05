<header class="header" role="banner">

	<?php if ( has_nav_menu( 'main' ) ) : ?>

		<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false"></button>

		<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'main navigation', TEXTDOMAIN ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main',
					'menu_id' => 'main-menu',
					'container' => ''
				)
			);
			?>
		</nav>

	<?php endif; ?>

</header>
