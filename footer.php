	</div><!-- .wrapper -->
	
</div><!-- .wrapper-inner -->
<a href="#" class="topScroll" aria-label="<?php esc_attr_e( 'Back to top', 'rams' ); ?>">
    <span aria-hidden="true"></span>
</a>

<div class="footer-wrapper" >
    <div class="footer-menu-inner">
<?php
if ( has_nav_menu( 'footermenu' ) ) {
    wp_nav_menu( array(

        'container' => '',
        'theme_location' => 'footermenu',
        'items_wrap' => '<ul class="%2$s">%3$s</ul>'

    ));
} ?>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>