<?php

function filter_add_view_of_the_content( $content ) { 

  $page_archive_product_id = get_option( 'page_archive_product_id' );

  if ( is_page( 'products' ) ) {
  $token = oauth_get_token();

  $products = get_product_by_api($token);
  get_header();
  ?>

  <div style="width: 90%; margin-left:auto; margin-right:auto">
  <?php
    if( $products > 1 ) {
      echo '<h3 style="text-align:center">'.count($products).' data founds</h3>';
      foreach( $products as $key => $product ){
        $permalink = site_url('/products/?id='.$product->id);

        echo '<div style="width 70%; text-align:center;">';     
        echo '<br>';
        // ($key+1) .'- ('. $product->id . ')
        echo '<h5><a href="'.$permalink.'">' . $product->name. '</a></h5>';
        echo '<image style="width:350px;height:auto; margin:15px 0" src="https://uat-api.globaltix.com/api/image?name='. $product->image .'" /><br>';
        echo '<h6>Price ' . $product->originalPrice. '</h6>';
        echo '<br>';
        echo '</div>';

      }
    } else {
      echo 'Error '.$products;
    }
  echo '</div>';
  }
  return ob_get_clean();
}