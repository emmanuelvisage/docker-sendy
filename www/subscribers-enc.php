<?php include('includes/functions.php');?>
<?php include('includes/helpers/short.php');?>
<?php
	//IDs
	$lid = (isset($_GET['l_enc'])) ? mysqli_real_escape_string($mysqli, short($_GET['l_enc'],true)) : exit;

    unset($_GET['l_enc']);
    $_GET['l'] = $lid;
    $qs = http_build_query($_GET);

    if( isset($_SERVER['HTTPS'] ) ) {
      header('Location: https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/subscribers?'.$qs);
    }
    else{
      header('Location: http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/subscribers?'.$qs);
    }

?>
