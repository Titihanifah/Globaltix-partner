<?php 

$product_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$token = oauth_get_token();
$result = json_decode(get_detail_by_id( $product_id, $token, 'ticket' ));

get_header();
echo '<div class="container">';
$detail_tickets = $result->data;
  echo '<h2>Ticket Details:</h2>';
  echo '<br><div class="row"><div>';
  echo '<p>name'.$detail_tickets->name.'<p>';
  echo '<p>variation name'.$detail_tickets->variation->name.'<p>';
  echo '<p>status '.$detail_tickets->status->name.'<p>';
  echo '<p>SKU '.$detail_tickets->SKU.'<p>';
  echo '<p>originalPrice '.$detail_tickets->originalPrice.'<p>';
  
  echo '<p>attraction '.$detail_tickets->attraction->title.'<p>';
echo '</div></div></div>';
