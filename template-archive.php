<?php

/* Template Name: Archive Template */

get_header(); ?>

<div class="content">						

	<?php if ( have_posts( )) : while( have_posts() ) : the_post(); ?>

		<div <?php post_class( 'post single' ); ?>>
		
			<div class="post-inner section-inner thin">
	
				<div class="post-header">
																										
					<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
														
				</div><!-- .post-header -->
			   				        			        		                
				<div class="post-content">
											                                        
					<?php the_content(); ?>
					
					<div class="clear"></div>
					
					<div class="archive-container">
				
						<h3><?php _e( 'Posts', 'rams' ); ?></h3>
											            
			            <ul class="posts-archive-list">

							<?php 

							$archive_posts = get_posts( array( 
								'post_status'		=> 'publish',
								'post_type'			=> 'post',
								'posts_per_page' 	=> -1,
							) );

							foreach( $archive_posts as $archive_post ) : ?>
								<li>
									<a href="<?php echo esc_url( get_permalink( $archive_post ) ); ?>"><?php echo esc_html( get_the_title( $archive_post ) ); ?> <span>(<?php  echo esc_html( get_the_date( '', $archive_post ) );  ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>

						</ul>
			            			            
			            <h3><?php _e( 'Categories', 'rams' ); ?></h3>
			            
			            <?php wp_list_categories('title_li='); ?>
			            
			            <h3><?php _e( 'Tags', 'rams' ); ?></h3>
			            
			            <ul>
							<?php
							$tags = get_tags();
							if ( ! is_wp_error( $tags ) ) {
								foreach ( $tags as $tag ) {
									$tag_url = get_tag_link( $tag->term_id );
									if ( is_wp_error( $tag_url ) ) {
										continue;
									}

									printf(
										'<li><a href="%s" title="%s">%s</a></li>',
										esc_url( $tag_url ),
										esc_attr( sprintf( __( 'View all posts in %s', 'rams' ), $tag->name ) ),
										esc_html( $tag->name )
									);
								}
							}
							?>
			            </ul>
			            
			            <h3><?php _e( 'Contributors', 'rams' ); ?></h3>
		            	
		            	<ul>
		            		<?php wp_list_authors(); ?> 
		            	</ul>
		            	
		            	<h3><?php _e( 'Archives by Year', 'rams' ); ?></h3>
		            	
		            	<ul>
		            	    <?php wp_get_archives( 'type=yearly' ); ?>
		            	</ul>
		            	
		            	<h3><?php _e( 'Archives by Month', 'rams' ); ?></h3>
		            	
		            	<ul>
		            	    <?php wp_get_archives( 'type=monthly' ); ?>
		            	</ul>
		            
			            <h3><?php _e( 'Archives by Day', 'rams' ); ?></h3>
			            
			            <ul>
			                <?php wp_get_archives( 'type=daily' ); ?>
			            </ul>
		        
		            </div><!-- .archive-container -->
										
				</div>
            
			</div><!-- .post-inner -->

		</div><!-- .post -->
		
		<?php if ( comments_open() ) : ?>
			
			<div class="comments-container">
				
				<div class="comments-inner section-inner thin">
				
					<?php comments_template( '', true ); ?>
				
				</div>
			
			</div><!-- .comments-container -->
		
		<?php endif; ?>
			
	<?php endwhile; 

	else: ?>

		<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "rams" ); ?></p>

	<?php endif; ?>
	
</div><!-- .content -->
								
<?php get_footer(); ?>