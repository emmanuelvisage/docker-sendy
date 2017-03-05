<?php include('../functions.php');?>
<?php include('../login/auth.php');?>
<?php 
	$api_key = str_makerand(20, 20, true, false, true);
	
	$q = 'UPDATE login SET api_key = "'.$api_key.'" WHERE id = '.get_app_info('userID');
	$r = mysqli_query($mysqli, $q);
	if ($r) echo $api_key;
	else echo "failed";
?>