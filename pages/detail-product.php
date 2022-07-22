<?php 

$product_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$token = oauth_get_token();
$result = json_decode(get_detail_by_id( $product_id, $token ));

get_header();

if( $result->success == true ) {
  $detail_products = $result->data;
  if( is_array($detail_products)) {
    foreach( $detail_products as $product ) {
      echo '<h5>'.$product->name.'</h5><br>';
      echo '<p>'.$product->description.'</p><br>';
      $image = '<image style="width:200px;height:auto;" src="https://uat-api.globaltix.com/api/image?name='. $product->image .'" />';
      echo $product->image != NULL ? $image : '';
      echo '<br>';
      if( ! empty( $product->ticketType ) ) {
        $ticketType = $product->ticketType;
        echo '<h6>Ticket Type: <br></h6>';
        foreach( $ticketType as $ticket ) {
          $permalink = site_url('/tickettype/?id='.$ticket->id);
          echo '<a href="'.$permalink.'">- ID '.$ticket->id.' Name '.$ticket->name.' SKU '.$ticket->sku.'</a><br>';
        }
      }
      
      echo '<br>======================<br>';
    }
  } else {
echo '<pre>';
    var_dump($detail_products);
    echo '<h5>'.$detail_products->name.'</h5><br>';
    echo '<p>'.$detail_products->description.'</p><br>';
    echo '<p>'.$detail_products->termsAndConditions.'</p>';
    $image = '<image style="width:200px;height:auto;" src="https://uat-api.globaltix.com/api/image?name='. $detail_products->image .'" /><br>';
    echo $detail_products->image != NULL ? $detail_products->image : '';
    echo '<br>';
    if( ! empty( $detail_products->ticketType ) ) {
      $ticketType = $detail_products->ticketType;
      echo '<h6>Ticket Type: <br></h6>';
      foreach( $ticketType as $ticket ) {
        $permalink = site_url('/tickettype/?id='.$ticket->id);
        echo '<a href="'.$permalink.'">- ID '.$ticket->id.' Name '.$ticket->name.' SKU '.$ticket->sku.'</a><br>';
      }
    }      
  }
  
  // echo '<image style="width:200px;height:auto;" src="https://uat-api.globaltix.com/api/image?name='. $detail_product->image .'" />';
  // echo '<p>Merchant ID '.$detail_product->merchant->id.'</p><br>';
  // echo '<p>Merchant '.$detail_product->merchant->name.'</p><br>';
  // echo '<p>'.$detail_product->country.'</p><br>';
} else {
  $error_message = ( $result->error->message != "" ) ? $result->error->message : str_replace("."," ",$result->error->code);
  echo ' "'. $error_message.'"';
}
