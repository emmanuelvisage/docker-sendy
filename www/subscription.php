<?php ini_set('display_errors', 0);?>
<?php 
	include('includes/config.php');
	//--------------------------------------------------------------//
	function dbConnect() { //Connect to database
	//--------------------------------------------------------------//
	    // Access global variables
	    global $mysqli;
	    global $dbHost;
	    global $dbUser;
	    global $dbPass;
	    global $dbName;
	    global $dbPort;
	    
	    // Attempt to connect to database server
	    if(isset($dbPort)) $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);
	    else $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
	
	    // If connection failed...
	    if ($mysqli->connect_error) {
	        fail();
	    }
	    
	    global $charset; mysqli_set_charset($mysqli, isset($charset) ? $charset : "utf8");
	    
	    return $mysqli;
	}
	//--------------------------------------------------------------//
	function fail() { //Database connection fails
	//--------------------------------------------------------------//
	    print 'Database error';
	    exit;
	}
	// connect to database
	dbConnect();
	
	include('includes/helpers/short.php');
	include('includes/helpers/locale.php');
?>
<?php 
	if(isset($_GET['f']))
	{
		$f = mysqli_real_escape_string($mysqli, short($_GET['f'], true));
		$data = json_decode(stripslashes($f));
		$brand = $data->{'brand'};
		$lid = $data->{'list'};
	}
	else
	{
		$brand = isset($_GET['i']) && is_numeric($_GET['i']) ? mysqli_real_escape_string($mysqli, $_GET['i']) : exit;
		$lid = isset($_GET['l']) ? mysqli_real_escape_string($mysqli, str_replace(' ', '', trim($_GET['l']))) : exit;
	}
	
	//Check if brand id and list id is valid and matching
	$q = 'SELECT * FROM lists WHERE app = '.$brand.' AND id = '.short($lid, true);
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) == 0)
	{
	     echo 'Subscription form does not exist.';
	     exit;
	}
	
	//Get brand logo
	$q = "SELECT app_name, from_email, brand_logo_filename FROM apps WHERE id = '$brand'";
	$r = mysqli_query($mysqli, $q);
	if ($r && mysqli_num_rows($r) > 0)
	{
	    while($row = mysqli_fetch_array($r))
	    {
	    	$from_email = explode('@', $row['from_email']);
			$get_domain = $from_email[1];
			$brand_logo_filename = $row['brand_logo_filename'];
	
			//Brand logo
			if($brand_logo_filename=='') $logo_image = 'https://www.google.com/s2/favicons?domain='.$get_domain;
			else $logo_image = APP_PATH.'/uploads/logos/'.$brand_logo_filename;
	    }  
	}
	
	//Set language
	$q_l = 'SELECT login.language FROM lists, login WHERE lists.id = '.short($lid, true).' AND login.app = lists.app';
	$r_l = mysqli_query($mysqli, $q_l);
	if ($r_l && mysqli_num_rows($r_l) > 0) while($row = mysqli_fetch_array($r_l)) $language = $row['language'];
	set_locale($language);
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="Shortcut Icon" type="image/ico" href="<?php echo APP_PATH;?>/img/favicon.png">
		<link rel="stylesheet" type="text/css" href="<?php echo APP_PATH;?>/css/subscription.css?2" />
		<script type="text/javascript" src="<?php echo APP_PATH;?>/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo APP_PATH;?>/js/jquery-migrate-1.1.0.min.js"></script>
		<title><?php echo _('Join our mailing list');?></title>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#name").focus();
			});
		</script>
	</head>
	<body>
		<div class="separator"></div>
		<div id="wrapper">
			<h2><img src="<?php echo $logo_image;?>" title=""/> <?php echo _('Join our mailing list');?></h2>
			<p>
				<form action="<?php echo APP_PATH;?>/subscribe" method="POST" accept-charset="utf-8" id="subscribe-form">
					
					<div>
						<label for="name"><?php echo _('Name');?></label>
						<input type="text" name="name" id="name"/>
					</div>
					
					<div>
						<label for="email"><?php echo _('Email');?></label>
						<input type="email" name="email" id="email"/>
					</div>
					
					<?php 
						$q = 'SELECT custom_fields FROM lists WHERE id = '.short($lid,true);
						$r = mysqli_query($mysqli, $q);
						if ($r)
						{
						    while($row = mysqli_fetch_array($r))
						    {
								$custom_fields = $row['custom_fields'];
						    } 
						    if($custom_fields!='')
						    {
						    	$custom_fields_array = explode('%s%', $custom_fields);
						    	foreach($custom_fields_array as $cf)
						    	{
						    		$cf_array = explode(':', $cf);
								    echo '
								    	<div>
											<label for="'.str_replace(' ', '', $cf_array[0]).'">'.$cf_array[0].'</label>
											<input type="text" name="'.str_replace(' ', '', $cf_array[0]).'" id="'.str_replace(' ', '', $cf_array[0]).'"/>
										</div>
									';
								}
						    } 
						}
					?>
					
					<input type="hidden" name="list" value="<?php echo $lid;?>"/>
					
					<a href="javascript:void(0)" title="" id="submit"><?php echo _('Sign up');?></a>
					
				</form>
				
				<script type="text/javascript">
					$("#subscribe-form").keypress(function(e) {
					    if(e.keyCode == 13) {
							e.preventDefault();
							$("#subscribe-form").submit();
					    }
					});
					$("#submit").click(function(e){
						e.preventDefault(); 
						$("#subscribe-form").submit();
					});
				</script>
			</p>
		</div>
	</body>
</html>