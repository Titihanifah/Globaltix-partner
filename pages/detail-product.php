<?php 

$product_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$token = oauth_get_token();

$products = get_product_by_api($token);
$detail_product = get_detail_product( $product_id, $token );

echo '<br>';
echo '<h5>'.$detail_product->name.'</h5><br>';
echo '<image style="width:200px;height:auto;" src="https://uat-api.globaltix.com/api/image?name='. $detail_product->image .'" />';
echo '<p>Merchant'.$detail_product->merchant->name.'</p><br>';
echo '<p>'.$detail_product->country.'</p><br>';
echo '<p>'.$detail_product->description.'</p><br>';
echo '<p>category : '.$detail_product->category.'</p><br>';
