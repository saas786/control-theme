<?php

		// SET UP PAGINATION
		// Display posts from the current page or set the 'paged' parameter to 1 
		$paged = 1;  
		if ( get_query_var('paged') ) $paged = get_query_var('paged');  
		if ( get_query_var('page') ) $paged = get_query_var('page');

		// SET UP POST QUERY
		$original_query = $query;
		$query = null;

		$args = array (
			'paged' => $paged,
			'post_type' => 'post',			
		);

		$query = new WP_Query( $args );

		if( $query->have_posts() ): 

		// continue with loop					
		while( $query->have_posts() ): $query->the_post();

?>

<article class="post group">

		<?php if(has_post_thumbnail()) : ?>
		<div class="post-thumb">	
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<div class="post-excerpt">

			<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<div class="date"><?php the_date('jS F Y'); ?></div>

			<?php the_excerpt(); ?>

			<a href="<?php the_permalink(); ?>">Read Full Story</a> &bull; 
			<?php if (get_comments_number() > 0 ) : ?>
				<?php comments_number( 'No comments', '1 comment', '% comments' ); ?>
			<?php endif; ?>

		</div><!-- .post-excerpt -->

</article><!-- .post -->

<?php 
		endwhile; 

		// pagination
		astro_pagination();

		endif; 

		$query = $original_query;
		wp_reset_postdata();
?>