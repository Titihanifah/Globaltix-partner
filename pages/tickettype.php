<?php 

function filter_add_view_of_the_content( $content ) { 

  $ticket_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
  $token = oauth_get_token();
  $result = json_decode(get_detail_by_id( $ticket_id, $token, 'ticket' ));
  get_header();
  
    echo '<br><div class=""><div>';
  
  if( $ticket_id != 0 ) {
    $detail_tickets = $result->data;
    echo '<h3>Ticket Details:</h3>';
    echo '<p>name :'.$detail_tickets->name.'<p>';
    echo '<p>variation : '.$detail_tickets->variation->name.'<p>';
    echo '<p>status : '.$detail_tickets->status->name.'<p>';
    echo '<p>SKU : '.$detail_tickets->SKU.'<p>';
    echo '<p>originalPrice : '.$detail_tickets->originalPrice.'<p>';    
    echo '<p>attraction : '.$detail_tickets->attraction->title.'<p>';
    echo '</div>';
  }
  echo '</div>';
  echo '<a href="'.site_url('/products').'" class="btn btn-primary">Back to Products</a>';
  echo '</div>';

  return ob_get_clean();
}