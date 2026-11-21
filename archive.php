<?php get_header(); ?>

<div class="content">

	<div class="page-title">
			
		<div class="section-inner">

			<h4><?php if ( is_day() ) : ?>
				<?php printf( esc_html__( 'Date: %s', 'rams' ), esc_html( get_the_date() ) ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Month: %s', 'rams' ), '' . get_the_date( _x( 'F Y', 'F = Month, Y = Year', 'rams' ) ) ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Year: %s', 'rams' ), '' . get_the_date( _x( 'Y', 'Y = Year', 'rams' ) ) ); ?>
			<?php elseif ( is_category() ) : ?>
				<?php printf( esc_html__( 'Category: %s', 'rams' ), esc_html( single_cat_title( '', false ) ) ); ?>
			<?php elseif ( is_tag() ) : ?>
				<?php printf( esc_html__( 'Tag: %s', 'rams' ), esc_html( single_tag_title( '', false ) ) ); ?>
			<?php elseif ( is_author() ) : ?>
				<?php printf( esc_html__( 'Author: %s', 'rams' ), esc_html( get_the_author_meta( 'display_name', get_queried_object_id() ) ) ); ?>
			<?php else : ?>
				<?php _e( 'Archive', 'rams' ); ?>
			<?php endif; ?>
			
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
			if ( "1" < $wp_query->max_num_pages ) : ?>
			
				<span><?php printf( __('(page %s of %s)', 'rams'), $paged, $wp_query->max_num_pages ); ?></span>
			
			<?php endif; ?></h4>
			
			<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
					echo wp_kses_post( apply_filters( 'tag_archive_meta', '<div class="tag-meta">' . $tag_description . '</div>' ) );
			?>
		
		</div> <!-- /section-inner -->
		
	</div> <!-- /page-title -->
	
	<?php if ( have_posts() ) : ?>
	
		<?php rewind_posts(); ?>
			
		<div class="posts" id="posts">
			
			<?php while ( have_posts() ) : the_post(); ?>
						
				<?php get_template_part( 'content', get_post_format() ); ?>
				
			<?php endwhile; ?>
							
		</div> <!-- /posts -->
		
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
			
			<div class="archive-nav">
			
				<div class="section-inner">
			
					<?php echo get_next_posts_link( '&laquo; ' . __('Older posts', 'rams')); ?>
							
					<?php echo get_previous_posts_link( __('Newer posts', 'rams') . ' &raquo;'); ?>
					
					<div class="clear"></div>
				
				</div>
				
			</div> <!-- /post-nav archive-nav -->
							
		<?php endif; ?>
				
	<?php endif; ?>

</div> <!-- /content -->

<?php get_footer(); ?>