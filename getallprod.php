<?php

require_once( 'lib/woocommerce-api.php' );
require_once( '/home/drool/public_html/wp-includes/query.php');
require_once( '/home/drool/public_html/wp-includes/class-wp-meta-query.php');

$consumer_key = $_POST["ck"]; // Add your own Consumer Key here
$consumer_secret = $_POST["cs"]; // Add your own Consumer Secret here
$pageNo = $_POST["page"];
$store_url = 'http://woo.getdrool.co/'; // Add the home URL to the store you want to connect to here

$options = array(
	'debug'           => true,
	'return_as_array' => false,
	'validate_url'    => true,
	'timeout'         => 30,
	'ssl_verify'      => false,
);

try {

	$client = new WC_API_Client( $store_url, $consumer_key, $consumer_secret, $options );
	$args = array(
        //'filter[limit]' => 6,
        'filter[orderby]' => 'meta_value_num',
        'filter[order]' => 'DESC',
        'filter[orderby_meta_key]' => 'total_sales',
        //'page' => $
        );

	
	$products = $client->products->get(null, $args);

	echo json_encode($products);
	

} catch ( WC_API_Client_Exception $e ) {

	echo $e->getMessage() . PHP_EOL;
	echo $e->getCode() . PHP_EOL;

	if ( $e instanceof WC_API_Client_HTTP_Exception ) {

		print_r( $e->get_request() );
		print_r( $e->get_response() );
	}
}
?>
