<?php

function filter_add_view_of_the_content( $content ) { 

  $page_archive_product_id = get_option( 'page_archive_product_id' );

  if ( is_page( 'products' ) ) :
  $token = oauth_get_token();

  $products = get_product_by_api($token);
  get_header();
  ?>

  <div style="width: 90%;">
  <?php
    if( $products > 1 ) :
  echo '<h3>'.count($products).' data founds.';
      foreach( $products as $key => $product ){
        $permalink = site_url('/products/?id='.$product->id);

        echo '<div style="width 33%;">';     
        echo '<br>';
        echo '<h4><a href="'.$permalink.'">'.($key+1) .'- ('. $product->id . ') ' . $product->name. '</a></h4><br>';
        echo 'Price ' . $product->originalPrice. '<br>';
        echo '<image style="width:200px;height:auto;" src="https://uat-api.globaltix.com/api/image?name='. $product->image .'" />';
        echo '<br>';
        echo '</div>';

      }
    else:
      echo 'Error '.$products;
    endif;
    ?>
  </div>

  <?php
  endif;
  return ob_get_clean();
}