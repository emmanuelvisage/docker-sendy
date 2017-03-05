<?php 
	ini_set('display_errors', 0);
	include('../../../../../includes/config.php');
	include('../../../../../api/_connect.php');
	include('../../../../../includes/helpers/short.php');
?>
<?php 	
	//-------------------------------------------------------//
	//						TRIGGERS						 //
	//-------------------------------------------------------//
		
	//GET 'list' value
	$api_key = mysqli_real_escape_string($mysqli, $_GET['api_key']);
	$your_sendy_installation_url = mysqli_real_escape_string($mysqli, $_GET['your_sendy_installation_url']);
	$event = mysqli_real_escape_string($mysqli, $_GET['event']);
	
	//Verify API key
	if(!verify_api_key($api_key)) //if incorrect,
	{
		header('HTTP/ 400 Your API key is incorrect');
		echo '{"message":"Your API key is incorrect."}';
		exit;
	}
	
	//If Zapier event is a 'New Subscriber' or 'New Unsubscriber' event
	if($event=='new_user_subscribed' || $event=='new_user_unsubscribed')
	{
		//GET 'list' variable value
		$list = mysqli_real_escape_string($mysqli, $_GET['list']);
		$unsubscribed = $event=='new_user_unsubscribed' ? '1' : '0';
		
		//Check if list ID exists
		$q = 'SELECT app FROM lists WHERE id = '.short($list, true);
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) == 0)
		{
		    header('HTTP/ 400 Incorrect list ID or list does not exist.');
			echo '{"message":"Incorrect list ID or list does not exist."}';
			exit;
		}
		
		$q = 'SELECT id, name, email FROM subscribers WHERE list = '.short($list, true).' AND unsubscribed = '.$unsubscribed.' ORDER BY id DESC LIMIT 1';
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) > 0)
		{
			$output = '[';
		    while($row = mysqli_fetch_array($r))
		    {		
			    //Split name into 'First name' and 'Last name'		
			    $full_name = $row['name'];
			    $full_name_array = explode(" ", $full_name);
			    $first_name = $full_name_array[0];
			    $last_name = '';
			    for($i=1;$i<count($full_name_array);$i++)
				    $last_name .= $full_name_array[$i]." ";
			    
				$output .= '
				{
				  "name": "'.$full_name.'",
				  "first_name": "'.$first_name.'",
				  "last_name": "'.$last_name.'",
				  "email": "'.$row['email'].'",
				  "list": "'.$list.'"
				}
				';
		    }
		    $output .= ']';
		    echo $output;
		}
		else
		{
			if($event=='new_user_subscribed')
			{
				header('HTTP/ 200 No subscribers found in your list. Please add at least one subscriber in your list.');
				echo '{"message":"No subscribers found in your list. Please add at least one subscriber in your list."}';
			}
			else
			{
				header('HTTP/ 200 No subscribers found in your list marked as unsubscribed. Please add at least one subscriber in your list marked as unsubscribed.');
				echo '{"message":"No subscribers found in your list marked as unsubscribed. Please add at least one subscriber in your list marked as unsubscribed."}';
			}
			exit; 
		}
	}
	
	//If Zapier event is a 'New Campaign Sent'
	else if($event=='new_campaign_sent')
	{
		//GET 'brand' variable value
		$brand = mysqli_real_escape_string($mysqli, $_GET['brand']);
		
		//Check if brand ID exists
		$q = 'SELECT userID FROM apps WHERE id = '.$brand;
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) == 0)
		{
		    header('HTTP/ 400 Incorrect brand ID or brand does not exist.');
			echo '{"message":"Incorrect brand ID or brand does not exist."}';
			exit;
		}
		
		$q = 'SELECT title, from_name, from_email, reply_to, sent, id, app FROM campaigns WHERE app = '.$brand.' AND sent != "" ORDER BY id DESC LIMIT 1';
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) > 0)
		{
			$webversion = '';
				    
			$output = '[';
		    while($row = mysqli_fetch_array($r))
		    {				
				$output .= '
				{
				  "subject": "'.$row['title'].'",
				  "from_name": "'.$row['from_name'].'",
				  "from_email": "'.$row['from_email'].'",
				  "reply_to": "'.$row['reply_to'].'",
				  "sent": "'.strftime("%a, %b %d, %Y, %I:%M%p", $row['sent']).'",
				  "webversion": "'.$your_sendy_installation_url.'/w/'.short($row['id']).'"
				}
				';
		    }
		    $output .= ']';
		    echo $output;
		}
		else
		{
			header('HTTP/ 200 No campaigns found in your brand. Please have at least one sent campaign in your brand.');
			echo '{"message":"No campaigns found in your brand. Please have at least one sent campaign in your brand."}';
			exit; 
		}
	}
?>