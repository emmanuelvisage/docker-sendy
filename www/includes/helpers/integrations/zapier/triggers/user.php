<?php 
	ini_set('display_errors', 0);
	include('../../../../../includes/config.php');
	include('../../../../../api/_connect.php');
?>
<?php 
	//GET variables sent by Zapier
	$api_key = mysqli_real_escape_string($mysqli, $_GET['api_key']);
	
	//Verify API key
	if(!verify_api_key($api_key)) //if incorrect,
	{
		header('HTTP/ 400 Your API key is incorrect');
		echo '{"message":"Your API key is incorrect."}';
	}
?>