<?php
/**
 * Intgrated data using API GlobalTix
 */

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
    $url = 'https://uat-api.globaltix.com/api/product/list?countryId=1&cityIds=all&categoryIds=all&searchText=&page=1&lang=en';
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
    if( $result ) return $result->data;
}

function get_detail_product( $product_id, $token ) {
  $url = 'https://uat-api.globaltix.com/api/product/info?id='.$product_id.'&lang=en';

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
  if( $result ) return $result->data;
}

