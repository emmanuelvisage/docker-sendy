<?php 
	//Get raw body POSTed by Zapier
	if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
	
	//Format JSON data
	$obj = json_decode($HTTP_RAW_POST_DATA);
	$from_name = $obj->{'from_name'};
	$from_email = $obj->{'from_email'};
	$reply_to_email = $obj->{'reply_to_email'};
	$subject = $obj->{'subject'};
	$html_text = $obj->{'html_text'};
	$plain_text = $obj->{'plain_text'};
	$query_string = $obj->{'query_string'};
	$send_campaign = $obj->{'send_campaign'};
	$brand = $obj->{'brand'};
	$lists = $obj->{'lists'};
	
	//GET variables
	$api_key = $_GET['api_key'];
	$app_path = $_GET['your_sendy_installation_url'];
	$type = $_GET['type'];
	
	//If it's a 'Draft' type of action
	if($type=='draft')
	{
		//Create draft campaign
		$postdata = http_build_query(
		    array(
		    'api_key' => $api_key,
		    'from_name' => $from_name,
		    'from_email' => $from_email,
		    'reply_to' => $reply_to_email,
		    'subject' => $subject,
		    'html_text' => $html_text,
		    'plain_text' => $plain_text,
		    'query_string' => $query_string,
		    'send_campaign' => '0',
		    'json' => '1',
		    'brand_id' => $brand
		    )
		);
		$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
		$context  = stream_context_create($opts);
		$result = file_get_contents($app_path.'/api/campaigns/create.php', false, $context);
		$data = json_decode($result);
		
		//Return error message if creation of campaign is unsuccessful
		if($data->status=='Campaign created')
		{			
			$campaign_id = $data->campaign_id;
			$define_recipients_url = "$app_path/send-to?i=$brand&c=$campaign_id";
			$edit_newsletter_url = "$app_path/edit?i=$brand&c=$campaign_id";
			
			//Return data about this new campaign
			echo '{"campaign_id":"'.$campaign_id.'", "define_recipients_url":"'.$define_recipients_url.'", "edit_newsletter_url":"'.$edit_newsletter_url.'"}';	
		}
		else
		{
			header("HTTP/ 400 $result");
			echo '{"message":"'.$result.'"}';
			exit;
		}
	}
?>