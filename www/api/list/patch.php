<?php include('../_connect.php');?>
<?php include('../../includes/helpers/short.php');?>
<?php

    function array_map_callback($a)
    {
      global $mysqli;

      return mysqli_real_escape_string($mysqli, $a);
    }

    function array_split_semicolon($custom_field)
    {
      $splited = explode(':',$custom_field);

      return $splited[0];
    }

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
    $list = isset($_POST['list']) ? short(mysqli_real_escape_string($mysqli, $_POST['list']),true) : null;
    $custom_fields = isset($_POST['custom_fields']) ? array_map('array_map_callback', $_POST['custom_fields']) : null;


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
    if(!isset($list) || empty($list) || !isset($custom_fields) || count($custom_fields)==0) {
        echo 'Some fields are missing.';
        exit;
    }

    //retrieve custom fields structure
    $q = 'SELECT custom_fields FROM lists WHERE id='.$list;
    $r = mysqli_query($mysqli, $q);

    if (mysqli_num_rows($r) == 0)
    {
        echo "list does not exist.";
        exit;
    }
    $first_row = mysqli_fetch_array($r);
    $custom_fields_structure = $first_row['custom_fields'];
    $custom_fields_structure_array = explode('%s%', $custom_fields_structure);
    $custom_fields_structure_array = array_map("array_split_semicolon", $custom_fields_structure_array);

    $updates = array();
    foreach($custom_fields as $custom_field_and_value) {
        list($custom_field, $update_value) = explode('|', $custom_field_and_value);
        $index_update = array_search($custom_field, $custom_fields_structure_array);
        if($index_update !== false) {
            $updates[$index_update] = $update_value;
        }
    }

    //retrieve custom fields from list
    $q = 'SELECT id,custom_fields FROM subscribers WHERE list='.$list;
    $r = mysqli_query($mysqli, $q);
    if (mysqli_num_rows($r) == 0)
    {
        echo "list does not exist.";
        exit;
    }
    $update_query = 'UPDATE subscribers SET custom_fields = (CASE id';
    $all_subs = array();
    while($row = mysqli_fetch_array($r)) {
        $current_custom_fields_values_array = explode('%s%',$row['custom_fields']);
        foreach($updates as $index => $update) {
            $current_custom_fields_values_array[$index] = $update;
        }
        $update_query.= ' WHEN '.$row['id'].' THEN "'.implode('%s%',$current_custom_fields_values_array).'"';
        array_push($all_subs,$row['id']);
    }

    $update_query.=' END) WHERE id IN('.implode(',',$all_subs).')';

    $custom_fields=$custom_fields_string_array[0];

    //update subscribers
    $r = mysqli_query($mysqli, $update_query);
    if ($r)
    {
        if($return_boolean=='true'){
            echo true;
            exit;
        }
    }
    else {
        if($return_boolean=='true'){
            echo 'Update query failed';
            echo $update_query;
        }
    }



?>
