<?php
	if ( has_nav_menu( 'header_utility' ) ) :
		wp_nav_menu( array(
		    'theme_location' => 'header_utility',
		    'container'       => false,
		    'menu_class'      => 'nav pull-right',
		    'menu_id'         => ''
		) );
	endif;
?>