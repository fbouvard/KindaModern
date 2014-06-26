<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">

	<head>
	
		<?php get_template_part( 'header' ); ?>
		
		<?php wp_head(); ?>
	
	</head>
	
	<body>

		<header>
			<p class="single">
				<a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a>
				<span class="date">@&nbsp;<?php the_time('j M Y') ?></span>
			</p>
		</header>

		<?php get_template_part( 'loop' ); ?>
				
		<?php wp_footer();?>
	
	</body>

</html>