<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">

	<head>
	
		<?php get_template_part( 'header'); ?>
	
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/style.404.css"/>
	
		<?php wp_head(); ?>
	
		<script language="javascript">setTimeout("window.location='<?php bloginfo( 'url' ); ?>'",4000);</script>
	
	</head>

	<body>

		<header>
			<h1><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<p><b>Erreur 404</b> | Redirection en cours <span class="firstdot">.</span><span class="seconddot">.</span><span class="thirddot">.</span></p>
		</header>

		<?php wp_footer();?>
	
	</body>

</html>