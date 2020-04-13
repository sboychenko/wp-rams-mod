	</div><!-- .wrapper -->
	
</div><!-- .wrapper-inner -->
<a href="#" class="topScroll" style="display: block;">
    <i class="fa fa-angle-up"></i>
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