<?php
/**
 * Intgrated data using API GlobalTix
 */
$GLOBALS['base_url_api'] = 'https://uat-api.globaltix.com/api';
function oauth_get_token() {
	$url = 'https://uat-api.globaltix.com/api/auth/login';
 
  $body = ('{"username": "reseller@globaltix.com","password": "12345"}');
  
  $options = [
      'method'      => 'POST',
      'headers'     => [
          'Content-Type' => 'raw',
      ],
      'body'        => $body,
      'data_format' => 'body'
      
  ];
  
  $response = wp_remote_post( $url, $options );

  $body_response     = wp_remote_retrieve_body( $response );
  $data = json_decode( $body_response );
// TODO: disini dikasih kondisi kalo timeout, mungkin bisa pakai try catch
  
  if ( is_wp_error( $response ) ) {
      $error_message = $response->get_error_message();
      $message = "Something went wrong: $error_message <br>";
      return $message;
  } else {
      if( 1 == $data->success && '' != $data->data->access_token ) {
        return $data->data->access_token;
      }      
  }
}

function get_product_by_api( $token ) {
    $hal = isset( $_GET['hal'] ) ? (int) $_GET['hal'] : 1;
    $searchText = isset( $_GET['searchText'] ) ? sanitize_text_field( $_GET['searchText'] ) : '';

    $url = 'https://uat-api.globaltix.com/api/product/list?countryId=1&cityIds=all&categoryIds=all&searchText='.$searchText.'&page='.$hal.'&lang=en';
    $auth = 'Bearer '.$token;
    
    $headers = array(
      'Authorization' => $auth,
    );
		$response = wp_remote_get(
			$url,
			array(
				'timeout' => 120,
				'headers' => $headers,
			)
		);
    $body = wp_remote_retrieve_body( $response );
    $result = json_decode( $body );

    if ( is_wp_error( $response ) ) {
      $error_message = $response->get_error_message();     
    } 
    $error_message = 'error, data not founds.';
    if( $result && $result->data > 0 ) return  $result->data; else return $error_message;
}

function get_detail_by_id( $id, $token, $type = 'product' ) {
  // $url = 'https://uat-api.globaltix.com/api/product/info?id='.$product_id.'&lang=en';
  $url = $GLOBALS['base_url_api'];
  if( $type == 'ticket' ) {
    $url .= '/ticketType/get?id='.$id.'&fromResellerId=';
  } else {
    $url .= '/product/options?id='.$id.'&lang=en';
  }


 

  $auth = 'Bearer '.$token;
    
  $headers = array(
    'Authorization' => $auth,
  );
  $response = wp_remote_get(
    $url,
    array(
      'timeout' => 120,
      'headers' => $headers,
    )
  );


  $body = wp_remote_retrieve_body( $response );
  $result = json_decode( $body );

  if ( is_wp_error( $response ) ) {
    $error_message = $response->get_error_message();
    
  }
  if( $result ) return wp_json_encode($result);
}

