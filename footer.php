<footer>
	<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
		<input type="text" autocorrect="off" autocapitalize="off" name="s" value="Recherche" onblur="if (this.value == ''){this.value = 'Recherche';}" onfocus="if (this.value == 'Recherche'){this.value = '';}" onclick="this.select();" />
	</form>
	<?php echo km_get_copyright() ?>
	<p><a href="http://fr.wordpress.org">Wordpress</a> + <a href="http://francoisbouvard.com/kindamodern">KindaModern</a></p>
</footer>