<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">

	<?php if ( have_posts() ) : ?>

	<head>
	
		<?php get_template_part( 'header' ); ?>
		
		<?php wp_head(); ?>
	
	</head>
	
	<body>

		<?php get_template_part( 'title' ); ?>

		<?php get_template_part( 'loop' ); ?>
	
		<nav>	
			<?php theme_pagination(); ?>
		</nav>
	
		<?php get_template_part( 'footer' ); ?>
		
		<?php wp_footer();?>
	
	</body>

	<?php else : get_template_part( 'no-result' ); ?>
		
	<?php endif; ?>

</html>