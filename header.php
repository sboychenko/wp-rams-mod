<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta http-equiv="Content-type" content="text/html;charset=<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/favicon.ico' ); ?>">
        <link rel="shortcut apple-touch-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/apple-touch-icon.png' ); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/favicon-32x32.png' ); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/favicon-16x16.png' ); ?>">
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		}
		?>

		<div class="sidebar bg-mint">

			<div class="sidebar-inner">
                <div class="menu-wrapper">

                    <?php if ( get_theme_mod( 'rams_logo' ) ) : ?>

                        <a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>' rel='home'>
                            <img src='<?php echo esc_url( get_theme_mod( 'rams_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>'>
                        </a>

                    <?php elseif ( get_bloginfo( 'description' ) || get_bloginfo( 'title' ) ) : ?>

                        <h1 class="blog-title">
                            <?php echo get_avatar( 'serg.boychenko@gmail.com', 100, '', 'ME' ); ?>
                            <span>[<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'title' ) ); ?></a>]</span>
                        </h1>

                    <?php endif; ?>

                    <a class="nav-toggle hidden" title="<?php esc_attr_e( 'Click to view the navigation', 'rams' ); ?>" href="#">

                        <div class="bars">

                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>

                            <div class="clear"></div>

                        </div>

                        <p>
                            <span class="menu"><?php _e('Menu','rams') ?></span>
                            <span class="close"><?php _e('Close','rams') ?></span>
                        </p>

                    </a>

                    <ul class="main-menu">

                        <?php if ( has_nav_menu( 'primary' ) ) {

						$nav_menu_args = array(
							'container' 		=> '',
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'primary'
						);
						wp_nav_menu( $nav_menu_args );

					} else {

						$list_pages_args = array(
							'container' 	=> '',
							'title_li' 		=> ''
						);
						wp_list_pages( $list_pages_args );

					} ?>

                     </ul>
                    <div class="push"></div>
                </div>

				<p class="credits">
                    <span>
                    <a href="https://t.me/sboychenko_life" target="_blank" rel="noopener" aria-label="Telegram"><span class="rams-social-icon rams-icon-telegram" aria-hidden="true"></span></a>
                    <a href="https://www.instagram.com/_sboychenko_" target="_blank" rel="noopener" aria-label="Instagram"><span class="rams-social-icon rams-icon-instagram" aria-hidden="true"></span></a>
                    <a href="https://www.youtube.com/@sboychenko_life" target="_blank" rel="noopener" aria-label="YouTube"><span class="rams-social-icon rams-icon-square-youtube" aria-hidden="true"></span></a>
                    <a href="https://linkedin.com/in/sboychenko" target="_blank" rel="noopener" aria-label="LinkedIn"><span class="rams-social-icon rams-icon-linkedin" aria-hidden="true"></span></a>
                    <a href="https://github.com/sboychenko" target="_blank" rel="noopener" aria-label="GitHub"><span class="rams-social-icon rams-icon-github" aria-hidden="true"></span></a>
                    </span>
                    <br/><br/><br/>
                    &copy; <?php echo date("Y"); ?> | Sergei Boichenko
				</p>

				 <div class="clear"></div>

			</div><!-- .sidebar-inner -->

		</div><!-- .sidebar -->

		<ul class="mobile-menu bg-dark hidden">

			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( $nav_menu_args );
			} else {
				wp_list_pages( $list_pages_args );
			}
			?>

			<li class="credits_mobile">
                <span>
                    <a href="https://t.me/sboychenko_life" target="_blank" rel="noopener" aria-label="Telegram"><span class="rams-social-icon rams-icon-telegram" aria-hidden="true"></span></a>
                    <a href="https://www.instagram.com/_sboychenko_" target="_blank" rel="noopener" aria-label="Instagram"><span class="rams-social-icon rams-icon-instagram" aria-hidden="true"></span></a>
                    <a href="https://www.youtube.com/@sboychenko_life" target="_blank" rel="noopener" aria-label="YouTube"><span class="rams-social-icon rams-icon-square-youtube" aria-hidden="true"></span></a>
                    <a href="https://linkedin.com/in/sboychenko" target="_blank" rel="noopener" aria-label="LinkedIn"><span class="rams-social-icon rams-icon-linkedin" aria-hidden="true"></span></a>
                    <a href="https://github.com/sboychenko" target="_blank" rel="noopener" aria-label="GitHub"><span class="rams-social-icon rams-icon-github" aria-hidden="true"></span></a>
                </span>
            </li>
		 </ul>

		<div class="wrapper" id="wrapper">

			<div class="section-inner wrapper-inner">