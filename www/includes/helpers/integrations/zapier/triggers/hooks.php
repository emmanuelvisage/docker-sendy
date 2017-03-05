<?php 
	ini_set('display_errors', 0);
	include('../../../../../includes/config.php');
	include('../../../../../api/_connect.php');
	include('../../../../../includes/helpers/short.php');
?>
<?php 
	//Get api_key via GET
	$api_key = mysqli_real_escape_string($mysqli, $_GET['api_key']);
	
	//Get data POSTed by Zapier's "Scripting" https://zapier.com/developer/builder/app/46944/scripting
	$target_url = $_POST['url'];
	$event = $_POST['event'];
	$list = short(mysqli_real_escape_string($mysqli, $_POST['list']), true);
	$brand = is_numeric($_POST['brand']) ? $_POST['brand'] : 0;
	
	//Verify API key
	if(!verify_api_key($api_key)) //if incorrect,
	{
		header('HTTP/ 400 Your API key is incorrect');
		echo '{"message":"Your API key is incorrect."}';
		exit;
	}
	
	//If it's a 'unsubscribe' Zapier call, DELETE record from db
	if(isset($_GET['unsubscribe']))
	{
		//Get the webhook_id to delete zapier hook from database
		$webhook_id = is_numeric($_GET['webhook_id']) ? $_GET['webhook_id'] : 0;
		
		//Delete Zapier subscription
		$q = 'DELETE FROM zapier WHERE id = "'.$webhook_id.'"';
		$r = mysqli_query($mysqli, $q);
		if (!$r)
		{
		    header('HTTP/ 400 Unable to unsubscribe from hook.');
			echo '{"message":"Unable to unsubscribe from hook."}';
			exit; 
		}
	}
	//If it's a 'subscribe' Zapier call, INSERT record into db
	else
	{
		//Store Zapier subscription values
		
		//If Zapier event is a 'New Subscriber' or 'New Unsubscriber' event
		if($event=='new_user_subscribed' || $event=='new_user_unsubscribed')
			$q = 'INSERT INTO zapier (subscribe_endpoint, event, list) VALUES ("'.$target_url.'", "'.$event.'", "'.$list.'")';
		
		//If Zapier event is a 'New Campaign Sent'
		if($event=='new_campaign_sent')
			$q = 'INSERT INTO zapier (subscribe_endpoint, event, app) VALUES ("'.$target_url.'", "'.$event.'", "'.$brand.'")';
			
		$r = mysqli_query($mysqli, $q);
		if (!$r)
		{
		    header('HTTP/ 400 Unable to subscribe to hook.');
			echo '{"message":"Unable to subscribe to hook."}';
			exit; 
		}
		else
		{
			$inserted_id = mysqli_insert_id($mysqli);
			echo '{"id": '.$inserted_id.'}';
		}
	}
?>