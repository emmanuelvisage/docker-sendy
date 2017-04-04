<?php include('../_connect.php');?>
<?php include('../../includes/helpers/short.php');?>
<?php

    $error_core = array('No data passed', 'API key not passed', 'Invalid API key');

    /********************************/
    //Get userID
    $q = 'SELECT id FROM login ORDER BY id ASC LIMIT 1';
    $r = mysqli_query($mysqli, $q);
    if ($r) while($row = mysqli_fetch_array($r)) $userID = $row['id'];
    $new_list_name = mysqli_real_escape_string($mysqli, $_POST['list_name']);
    $app = 1;
    /********************************/

    $return_boolean = strip_tags(mysqli_real_escape_string($mysqli, $_POST['boolean'])); //compulsory

    //api_key
    $api_key = isset($_POST['api_key']) ? mysqli_real_escape_string($mysqli, $_POST['api_key']) : null;
    $parent_list = isset($_POST['parent_list']) ? short(mysqli_real_escape_string($mysqli, $_POST['parent_list']),true) : null;


    //----------------------- VERIFICATION ----------------------//
    //Core data
    if($api_key==null && $from_name==null && $from_email==null && $reply_to==null && $subject==null && $plain_text==null && $html_text==null && $list_ids==null)
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

    $custom_fields_string_array = array();
    //retrieve custom fields from parent list
    $q = 'SELECT custom_fields FROM lists WHERE id='.$parent_list;
    $r = mysqli_query($mysqli, $q);

    if (mysqli_num_rows($r) == 0)
    {
        echo "Parent list does not exist.";
        exit;
    }
    else while($row = mysqli_fetch_array($r)) array_push($custom_fields_string_array, $row['custom_fields']);

    $custom_fields=$custom_fields_string_array[0];

    //add new list
    $q = 'INSERT INTO lists (app, userID, name, custom_fields, parent_list) VALUES ('.$app.', '.$userID.', "'.$new_list_name.'","'.$custom_fields.'", '.$parent_list.')';
    $r = mysqli_query($mysqli, $q);
    if ($r)
    {
        $listID = short(mysqli_insert_id($mysqli));
        if($return_boolean=='true'){
                echo $listID;
                exit;
        }
    }



?>
