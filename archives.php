<?php
/*
Template Name: Archives
*/
?>

<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">

	<head>
	
		<?php get_template_part( 'header' ); ?>
		
		<?php wp_head(); ?>
	
	</head>

	<body>
	
		<?php the_post(); ?>

		<?php get_template_part( 'title' ); ?>
		
		<section>
			<?php km_custom_archive(); ?>
		</section>
		
		<?php get_template_part( 'footer' ); ?>
		
		<?php wp_footer();?>
	
	</body>

</html>