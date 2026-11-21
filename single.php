<?php get_header(); ?>

<div class="content">
											        
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php $post_format = get_post_format(); ?>
				
			<?php if ( $post_format == 'gallery' ) : ?>
			
				<div class="featured-media">	
	
					<?php rams_flexslider('post-image'); ?>
					
				</div> <!-- /featured-media -->
			
			<?php elseif ( ! post_password_required() && has_post_thumbnail() ) : ?>
					
				<div class="featured-media">
		
					<?php the_post_thumbnail('post-image'); ?>
					
				</div> <!-- /featured-media -->
					
			<?php endif; ?>
			
			<div class="post-inner">
				
				<div class="post-header">
													
					<p class="post-date">
					
						<a href="<?php the_permalink(); ?>" title="<?php the_time('h:i'); ?>"><?php the_time(get_option('date_format')); ?></a>
						
					</p>
											
					<h1 class="post-title"><?php the_title(); ?></h1>
															
				</div> <!-- /post-header -->
				    
			    <div class="post-content">
			    
			    	<?php the_content(); ?>
			    
			    </div> <!-- /post-content -->
			    
			    <div class="clear"></div>
			
			</div> <!-- /post-inner -->
			
			<?php 
		    	$args = array(
					'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:','rams' ) . '</span>',
					'after'            => '</p>',
					'link_before'      => '<span>',
					'link_after'       => '</span>',
					'separator'        => '',
					'pagelink'         => '%',
					'echo'             => 1
				);
	    	
	    		wp_link_pages($args); 
			?>
			
			<div class="post-meta">
			
				<a class="post-meta-toggle" href="#" title="<?php esc_attr_e('Show information about the post','rams') ?>">
				
					<div class="post-meta-toggle-inner">
				
						<div class="bars">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
					
						<p><?php _e('Post meta','rams')?></p>
						
						<div class="clear"></div>
					
					</div>
					
				</a> <!-- /post-meta-toggle -->
				
				<div class="post-meta-inner">
				
					<p><strong><?php _e('Author','rams'); ?></strong><?php the_author_posts_link(); ?></p>
					
					<p class="post-meta-date"><strong><?php _e('Posted','rams'); ?></strong><a href="<?php the_permalink(); ?>"><?php the_date(get_option('date_format')); ?><span> &mdash; <?php the_time(get_option('time_format')); ?></span></a></p>
					
					<?php if (has_category()) : ?>
					
						<p><strong><?php _e('Categories','rams'); ?></strong><?php the_category(', '); ?></p>
					
					<?php endif; ?>
					
					<?php if (has_tag()) : ?>
							
						<p><strong><?php _e('Tags','rams'); ?></strong><?php the_tags('#', ', #'); ?></p>
					
					<?php endif; ?>
					
					<?php
						$prev_post = get_previous_post();
						$next_post = get_next_post();
						
						if (!empty( $next_post ) || !empty( $prev_post )):
						
					?>
					
						<div class="post-nav">
							
							<?php
							if (!empty( $next_post )): ?>
								
								<p>
									<strong><?php _e('Next', 'rams'); ?></strong>
									<a class="post-nav-newer" title="<?php echo esc_attr( __( 'Next post', 'rams' ) . ': ' . get_the_title( $next_post ) ); ?>" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
										<?php echo esc_html( get_the_title( $next_post ) ); ?>
									</a>
								</p>
						
							<?php endif;
															
							if (!empty( $prev_post )): ?>
							
								<p>
									<strong><?php _e('Previous', 'rams'); ?></strong>
									<a class="post-nav-older" title="<?php echo esc_attr( __( 'Previous post', 'rams' ) . ': ' . get_the_title( $prev_post ) ); ?>" href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
										<?php echo esc_html( get_the_title( $prev_post ) ); ?>
									</a>
								</p>
						
							<?php endif; ?>
							
							<div class="clear"></div>
																							
						</div> <!-- /post-nav -->
					
					<?php endif; ?>
				
				</div> <!-- /post-meta-inner -->
			
			</div> <!-- /post-meta -->
																                                    	        	        
		</div> <!-- /post -->
				
		<div class="comments-container">
							
			<?php comments_template( '', true ); ?>
			
		</div> <!-- /comments-container -->
									                        
   	<?php endwhile; else: ?>

		<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "rams"); ?></p>
	
	<?php endif; ?>    

</div> <!-- /content -->
		
<?php get_footer(); ?>