<?php 	
	//'new_user_subscribed' event function
	function zapier_trigger_new_user_subscribed($name, $email, $list)
	{
		global $mysqli;
		
		$q = 'SELECT subscribe_endpoint FROM zapier WHERE list = '.$list.' AND event = "new_user_subscribed"';
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) > 0)
		{
			//Split name into 'First name' and 'Last name'
		    $full_name_array = explode(" ", $name);
		    $first_name = $full_name_array[0];
		    $last_name = '';
		    for($i=1;$i<count($full_name_array);$i++)
			    $last_name .= $full_name_array[$i]." ";
				    
		    while($row = mysqli_fetch_array($r))
		    {
				$subscribe_endpoint = $row['subscribe_endpoint'];
				
				//POST Trigger to Zapier
				$postdata = http_build_query(
				    array(
				    'name' => $name,
				    'first_name' => $first_name,
				    'last_name' => $last_name,
				    'email' => $email,
				    'list' => short($list)
				    )
				);
				$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
				$context  = stream_context_create($opts);
				$result = file_get_contents($subscribe_endpoint, false, $context);
				if($result=='')
				{
					$q = 'DELETE FROM zapier WHERE subscribe_endpoint = "'.$subscribe_endpoint.'"';
					mysqli_query($mysqli, $q);
				}
		    }  
		}
	}
	
	//'new_user_unsubscribed' event function
	function zapier_trigger_new_user_unsubscribed($name, $email, $list)
	{
		global $mysqli;
		
		$q = 'SELECT subscribe_endpoint FROM zapier WHERE list = '.$list.' AND event = "new_user_unsubscribed"';
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) > 0)
		{
			//Split name into 'First name' and 'Last name'
			$full_name_array = explode(" ", $name);
		    $first_name = $full_name_array[0];
		    $last_name = '';
		    for($i=1;$i<count($full_name_array);$i++)
			    $last_name .= $full_name_array[$i]." ";
			    
		    while($row = mysqli_fetch_array($r))
		    {
				$subscribe_endpoint = $row['subscribe_endpoint'];
				
				//POST Trigger to Zapier
				$postdata = http_build_query(
				    array(
				    'name' => $name,
				    'first_name' => $first_name,
				    'last_name' => $last_name,
				    'email' => $email,
				    'list' => short($list)
				    )
				);
				$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
				$context  = stream_context_create($opts);
				$result = file_get_contents($subscribe_endpoint, false, $context);
				if($result=='')
				{
					$q = 'DELETE FROM zapier WHERE subscribe_endpoint = "'.$subscribe_endpoint.'"';
					mysqli_query($mysqli, $q);
				}
		    }  
		}
	}
	
	//'new_campaign_sent' event function
	function zapier_trigger_new_campaign_sent($subject, $from_name, $from_email, $reply_to, $sent, $webversion, $brand)
	{
		global $mysqli;
		
		$q = 'SELECT subscribe_endpoint FROM zapier WHERE app = '.$brand.' AND event = "new_campaign_sent"';
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) > 0)
		{
		    while($row = mysqli_fetch_array($r))
		    {
				$subscribe_endpoint = $row['subscribe_endpoint'];
				
				//POST Trigger to Zapier
				$postdata = http_build_query(
				    array(
				    'subject' => $subject,
				    'from_name' => $from_name,
				    'from_email' => $from_email,
				    'reply_to' => $reply_to,
				    'sent' => $sent,
				    'webversion' => $webversion
				    )
				);
				$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
				$context  = stream_context_create($opts);
				$result = file_get_contents($subscribe_endpoint, false, $context);
				if($result=='')
				{
					$q = 'DELETE FROM zapier WHERE subscribe_endpoint = "'.$subscribe_endpoint.'"';
					mysqli_query($mysqli, $q);
				}
		    }  
		}
	}
?>