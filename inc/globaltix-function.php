<?php

function check_is_page_exist_by_slug($page_slug) {

    $page = get_page_by_path( $page_slug , OBJECT );

    if ( isset($page) ) {
      return true;
    } else {
      return false;
    }
}

function setup_pages() {
  $page_guid = site_url() . "/products";
  $products_page  = array( 
    'post_title'     => 'Products',
    'post_type'      => 'page',
    'post_name'      => 'products',
    'post_content'   => '',
    'post_status'    => 'publish',
    'comment_status' => 'closed',
    'ping_status'    => 'closed',
    'post_author'    => 1,
    'menu_order'     => 0,
    'guid'           => $page_guid 
  );

  if( check_is_page_exist_by_slug( 'products' ) == false ) {
    $page_id = wp_insert_post( $products_page, FALSE );
    update_option( 'page_archive_product_id', $page_id, 'yes' );
  }
  

  $ticket_page_guid = site_url() . "/tickettype";
  $ticket_page  = array( 
    'post_title'     => 'TicketType',
    'post_type'      => 'page',
    'post_name'      => 'tickettype',
    'post_content'   => '',
    'post_status'    => 'publish',
    'comment_status' => 'closed',
    'ping_status'    => 'closed',
    'post_author'    => 1,
    'menu_order'     => 0,
    'guid'           => $ticket_page_guid 
  );
  
  if( check_is_page_exist_by_slug( 'tickettype' ) == false ) {
    $ticket_id = wp_insert_post( $ticket_page, FALSE );
    update_option( 'page_ticket_type_id', $ticket_id, 'yes' );
  }

}

function plugin_is_page() {
    $page = get_page_by_path( 'products' , OBJECT );
    $tickettype = get_page_by_path( 'tickettype' , OBJECT );

    if( isset($page) && is_page( 'products' ) && isset($_GET['id'] ) ) {
      require GLOBALTIX_PATH . '/pages/detail-product.php';
    } else if ( isset($page) && is_page( 'products' ) ) {
      require GLOBALTIX_PATH . '/pages/products.php';
    } else if( isset($tickettype) && is_page( 'tickettype' ) ){      
      require GLOBALTIX_PATH . '/pages/tickettype.php';
    }
}

