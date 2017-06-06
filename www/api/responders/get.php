<?php include('../_connect.php');?>
<?php include('../../includes/helpers/short.php');?>
<?php 
	//-------------------------- ERRORS -------------------------//
	$error_core = array('No data passed', 'API key not passed', 'Invalid API key');
	$error_passed = array('List ID not passed', 'List does not exist');
	//-----------------------------------------------------------//
	
	//--------------------------- POST --------------------------//
	//api_key
	if(isset($_POST['api_key'])) $api_key = mysqli_real_escape_string($mysqli, $_POST['api_key']);
	else $api_key = null;
	
	//list_id
	if(isset($_POST['list_id'])) $list_id = short(mysqli_real_escape_string($mysqli, $_POST['list_id']), true);
	else $list_id = null;
	//-----------------------------------------------------------//
	
	//----------------------- VERIFICATION ----------------------//
	//Core data
	if($api_key==null && $list_id==null)
	{
		echo $error_core[0];
		exit;
	}
	if($api_key==null)
	{
		echo $error_core[1];
		exit;
	}
	else if(!verify_api_key($api_key))
	{
		echo $error_core[2];
		exit;
	}
	
	//Passed data
	if($list_id==null)
	{
		echo $error_passed[0];
		exit;
	}
	else
	{
		$q = 'SELECT id FROM lists WHERE id = '.$list_id;
		$r = mysqli_query($mysqli, $q);
		if (mysqli_num_rows($r) == 0) 
		{
			echo $error_passed[1]; 
			exit;
		}
	}
	//-----------------------------------------------------------//
	
	//-------------------------- QUERY --------------------------//
	
	$q = 'SELECT ares.list, ares.custom_field, ares.id, ares_e.time_condition, ares_e.from_email, ares_e.from_name, ares_e.reply_to, ares_e.title, ares_e.plain_text, ares_e.html_text FROM ares INNER JOIN ares_emails AS ares_e WHERE ares_e.ares_id = ares.id AND list = '.$list_id;
	$r = mysqli_query($mysqli, $q);
	if ($r)
	{
	    header('Content-Type: application/json');
	    echo json_encode(mysqli_fetch_all($r,MYSQLI_ASSOC));
	}
	//-----------------------------------------------------------//
?>