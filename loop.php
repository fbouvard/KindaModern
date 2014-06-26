<section>
	<ul>
		<?php
			while ( have_posts() ) : the_post();
		?>
		<li class="content">
			<article>
				<h2>
					<a href="<?php the_permalink(); ?>" target="_blank">
						<?php echo km_prevent_widow(get_the_title()) ?>
					</a>
				</h2>
				<?php echo km_get_meta() ?>
				<?php the_content('',FALSE,''); ?>
			</article>
		</li>
		<?php endwhile; ?>
	</ul>
</section>