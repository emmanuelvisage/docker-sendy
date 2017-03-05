<?php 
	ini_set('display_errors', 0);
	include('../../../../../includes/config.php');
	include('../../../../../api/_connect.php');
	include('../../../../../includes/helpers/short.php');
?>
<?php 
	//-------------------------------------------------------//
	//					DYNAMIC DROPDOWNS					 //
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
	
	//DYNAMIC DROP DOWN (brands)
	else if($event=='brands')
	{		
		$q = 'SELECT id, app_name FROM apps';
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) > 0)
		{
			$output = '[';
		    while($row = mysqli_fetch_array($r))
		    {
			    $id = $row['id'];
			    $app_name = $row['app_name'];
			    $output .= '{"id": "'.$id.'", "title": "'.$app_name.'"},';
		    }  
		    $output = rtrim($output, ",");		
			$output .= ']';
		}
		else
		{
			header('HTTP/ 400 No brands found. Please create at least one brand in your Sendy installation for selection.');
			echo '{"message":"No brands found. Please create at least one brand in your Sendy installation for selection."}';
			exit;
		}
		
		echo $output;
	}
	
	//DYNAMIC DROP DOWN (lists)
	else if($event=='lists')
	{
		$brand_id = is_numeric($_GET['brand_id']) ? $_GET['brand_id'] : '';
		
		//Check if user selected a brand using a previous drop down menu
		if($brand_id=='')
		{
			header('HTTP/ 400 Please select a brand from the \'Brand\' drop down menu.');
			echo '{"message":"Please select a brand from the \'Brand\' drop down menu"}';
			exit;
		}
		
		$q = 'SELECT id, name FROM lists WHERE app = '.$brand_id;
		$r = mysqli_query($mysqli, $q);
		if ($r && mysqli_num_rows($r) > 0)
		{
			$output = '[';
		    while($row = mysqli_fetch_array($r))
		    {
			    $id = short($row['id']);
			    $list_name = $row['name'];
			    $output .= '{"id": "'.$id.'", "title": "'.$list_name.'"},';
		    }  
		    $output = rtrim($output, ",");		
			$output .= ']';
		}
		else
		{
			header('HTTP/ 400 No lists found in this brand. Please create at least one list in the brand for selection.');
			echo '{"message":"No lists found in this brand. Please create at least one list in the brand for selection"}';
			exit;
		}
		
		echo $output;
	}
?>