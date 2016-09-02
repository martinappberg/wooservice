<?php

require_once( 'lib/woocommerce-api.php' );
$consumer_key = $_POST["ck"]; // Add your own Consumer Key here
$consumer_secret = $_POST["cs"]; // Add your own Consumer Secret here
$store_url = 'http://woo.getdrool.co/'; // Add the home URL to the store you want to connect to here

$options = array(
	'debug'           => true,
	'return_as_array' => false,
	'validate_url'    => false,
	'timeout'         => 30,
	'ssl_verify'      => false,
);

try {

	$client = new WC_API_Client( $store_url, $consumer_key, $consumer_secret, $options );
	$categories = $client->products->get('categories');
	echo json_encode($categories);
	

} catch ( WC_API_Client_Exception $e ) {

	echo $e->getMessage() . PHP_EOL;
	echo $e->getCode() . PHP_EOL;

	if ( $e instanceof WC_API_Client_HTTP_Exception ) {

		print_r( $e->get_request() );
		print_r( $e->get_response() );
	}
}
?>



