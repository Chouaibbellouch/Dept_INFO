<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bosa Education Hub 1.0.0
 */
?>

<?php
	$stickyClass = "col-12";
	if( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid-thumbnail' ) == 'grid-thumbnail' ){
			$stickyClass = "col-sm-6 grid-thumbnail";
			if( !is_active_sidebar( 'right-sidebar') ){
				$stickyClass = "col-sm-6 col-lg-4 grid-thumbnail";
			}
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid-thumbnail' ) == 'grid-thumbnail' ){
			$stickyClass = "col-sm-6 grid-thumbnail";
			if( !is_active_sidebar( 'left-sidebar') ){
				$stickyClass = "col-sm-6 col-lg-4 grid-thumbnail";
			}
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid-thumbnail' ) == 'grid-thumbnail' ){
			$stickyClass = "col-sm-6 col-lg-4 grid-thumbnail";
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid-thumbnail' ) == 'grid-thumbnail' ){
			$stickyClass = "col-sm-6 col-lg-6 grid-thumbnail";
			if( !is_active_sidebar( 'left-sidebar') && !is_active_sidebar( 'right-sidebar') ){
				$stickyClass = "col-sm-6 col-lg-4 grid-thumbnail";
			}
		}
	}
	if( get_theme_mod( 'disable_sidebar_blog_page', false ) && get_theme_mod( 'archive_post_layout', 'grid-thumbnail' ) == 'grid-thumbnail' ){
		$stickyClass = "col-sm-6 col-lg-4 grid-thumbnail";
	}

	$class = '';
	if(!has_post_thumbnail()){
		$class = 'no-thumbnail';
	}

?>

<div class="<?php echo esc_attr( $stickyClass );?>">
	<?php if( $args[ 'on_full' ] == true ){ ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( $class ) ?> >
			<?php if ( has_post_thumbnail() ) : ?>
		        <figure class="featured-image">
		            <a href="<?php the_permalink(); ?>">
		                <?php 
		                $grid_list_size 		= 'bosa-420-300';
		                $render_post_image_size = get_theme_mod( 'render_post_image_size', '' );
		                if ( !empty( $render_post_image_size ) ){
		                	$grid_list_size = $render_post_image_size;
		                }
		                bosa_image_size( $grid_list_size ); ?>
		            </a>
		        </figure><!-- .recent-image -->
			<?php endif; ?>
		    <div class="entry-content">
		    	<header class="entry-header">
					<?php 
						if( !get_theme_mod( 'hide_category', false ) ){
							bosa_entry_header();
						}
						if( !get_theme_mod( 'hide_post_title', false ) ){
							the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
						}
					?>

				</header><!-- .entry-header -->
				<div class="entry-meta">
		           <?php bosa_entry_footer(); ?>
		        </div><!-- .entry-meta -->
				
				<?php if ( !get_theme_mod( 'hide_blog_page_excerpt', false ) || !get_theme_mod( 'hide_post_button', true ) ){ ?>
			        <div class="entry-text">
						<?php
							if ( !get_theme_mod( 'hide_blog_page_excerpt', false ) ){
								$excerpt_length = get_theme_mod( 'post_excerpt_length', 15 );
								bosa_excerpt( $excerpt_length , true );
							}
						?>
						<?php 
							if( !get_theme_mod( 'hide_post_button', true ) ){
								$post_btn_defaults = array(
									array(
										'blog_btn_type' 		=> 'button-text',
										'blog_btn_bg_color'		=> '#EB5A3E',
										'blog_btn_border_color'	=> '#1a1a1a',
										'blog_btn_text_color'	=> '#1a1a1a',
										'blog_btn_hover_color'	=> '#086abd',
										'blog_btn_text' 		=> '',
										'blog_btn_radius'		=> 0,
									),		
								);
								$post_button = get_theme_mod( 'blog_page_button_repeater', $post_btn_defaults );
								if( !empty( $post_button ) && is_array( $post_button ) ){ ?>
									<div class="button-container">
										<?php
										  	$count = 0.2;
						            		foreach( $post_button as $value ){
												if( !empty( $value['blog_btn_text'] ) ){ ?>
													<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $value['blog_btn_type'] ); ?>">
														<?php 
															echo esc_html( $value['blog_btn_text'] );
														?>
													</a>
													<?php
									                $count = $count + 0.2;
									            }
								        	}
								        ?>
								    </div>
								    <?php
						        }
							}
						?>	
					</div>
				<?php } ?>
			</div><!-- .entry-content -->
		</article><!-- #post-->
	<?php }elseif( $args[ 'on_small' ] == true ){ ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( $class . ' list-post' ) ?> >
			<?php if ( has_post_thumbnail() ) : ?>
		        <figure class="featured-image">
		            <a href="<?php the_permalink(); ?>">
		                <?php 
		                $render_grid_thumbnail_image_size 	= get_theme_mod( 'render_grid_thumbnail_image_size', 'thumbnail' );
		                bosa_image_size(  $render_grid_thumbnail_image_size ); ?>
		            </a>
		        </figure><!-- .recent-image -->
			<?php endif; ?>
		    <div class="entry-content">
		    	<header class="entry-header">
					<?php 
						if( !get_theme_mod( 'hide_category', false ) ){	
							bosa_entry_header();
						}
						if( !get_theme_mod( 'hide_post_title', false ) ){
							the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
						}
					?>

				</header><!-- .entry-header -->
				<div class="entry-meta">
		           <?php bosa_education_hub_grid_thumbnail_date(); ?>
		        </div><!-- .entry-meta -->
				
				<?php if ( !get_theme_mod( 'hide_blog_page_excerpt', false ) || !get_theme_mod( 'hide_post_button', true ) ){ ?>
			        <div class="entry-text">
						<?php
							if ( !get_theme_mod( 'hide_blog_page_excerpt', false ) ){
								if ( !get_theme_mod( 'disable_excerpt_thumbnail', true ) ){
									$excerpt_length = get_theme_mod( 'post_excerpt_length', 15 );
									bosa_excerpt( $excerpt_length , true );
								}
							}
						?>
						<?php 
							if( !get_theme_mod( 'hide_post_button', true ) ){
								if( !get_theme_mod( 'disable_button_thumbnail', true ) ){
									$post_btn_defaults = array(
										array(
											'blog_btn_type' 		=> 'button-text',
											'blog_btn_bg_color'		=> '#EB5A3E',
											'blog_btn_border_color'	=> '#1a1a1a',
											'blog_btn_text_color'	=> '#1a1a1a',
											'blog_btn_hover_color'	=> '#086abd',
											'blog_btn_text' 		=> '',
											'blog_btn_radius'		=> 0,
										),		
									);
									$post_button = get_theme_mod( 'blog_page_button_repeater', $post_btn_defaults );
									if( !empty( $post_button ) && is_array( $post_button ) ){ ?>
										<div class="button-container">
											<?php
											  	$count = 0.2;
							            		foreach( $post_button as $value ){
													if( !empty( $value['blog_btn_text'] ) ){ ?>
														<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $value['blog_btn_type'] ); ?>">
															<?php 
																echo esc_html( $value['blog_btn_text'] );
															?>
														</a>
														<?php
										                $count = $count + 0.2;
										            }
									        	}
									        ?>
									    </div>
									    <?php
							        }
								}
							}
						?>	
					</div>
				<?php } ?>
			</div><!-- .entry-content -->
		</article><!-- #post-->
	<?php } ?>
</div>
