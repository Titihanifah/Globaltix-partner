<?php
function setup_pages() {
  $page_guid = site_url() . "/products";
  $products_page  = array( 'post_title'     => 'Products',
    'post_type'      => 'page',
    'post_name'      => 'products',
    'post_content'   => '',
    'post_status'    => 'publish',
    'comment_status' => 'closed',
    'ping_status'    => 'closed',
    'post_author'    => 1,
    'menu_order'     => 0,
    'guid'           => $page_guid );

  $page_id = wp_insert_post( $products_page, FALSE );
  update_option( 'page_archive_product_id', $page_id, yes );

}

function plugin_is_page() {
    $page = get_page_by_path( 'products' , OBJECT );

    if( isset($page) && is_page( 'products' ) && isset($_GET['id']) ) {
      require GLOBALTIX_PATH . '/pages/detail-product.php';
    }else if ( isset($page) && is_page( 'products' ) ) {
        require GLOBALTIX_PATH . '/pages/products.php';
    }

    
}