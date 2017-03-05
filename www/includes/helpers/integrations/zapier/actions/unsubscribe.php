<?php 
	//Get raw body POSTed by Zapier
	if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
	
	//Format JSON data
	$obj = json_decode($HTTP_RAW_POST_DATA);
	$list = $obj->{'list'};
	$email = $obj->{'email'};
	$app_path = $_GET['your_sendy_installation_url'];
	
	//Subscribe
	$postdata = http_build_query(
	    array(
	    'email' => $email,
	    'list' => $list,
	    'boolean' => 'true'
	    )
	);
	$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
	$context  = stream_context_create($opts);
	$result = file_get_contents($app_path.'/unsubscribe', false, $context);
?>