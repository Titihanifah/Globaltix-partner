<?php
/**
 * Hook 
 */

/* action hook */
add_action( 'template_redirect', 'plugin_is_page', 10 );

/* filter hook */
add_filter( 'the_content', 'filter_add_view_of_the_content', 10 );


