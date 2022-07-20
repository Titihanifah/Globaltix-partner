<?php
/**
 * Hook 
 */

// add_action( 'init', 'setup_pages' );
  add_action( 'template_redirect', 'plugin_is_page', 10 );

