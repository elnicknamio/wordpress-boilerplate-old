<?php
get_template_part( 'partials/head' );

get_template_part( 'partials/header' );

the_post();
?>

<main id="main" class="site-main" role="main">

	<h1><?php the_title() ?></h1>

	<?php the_content() ?>

</main> <!-- .main -->

<?php
get_template_part( 'partials/footer' );
