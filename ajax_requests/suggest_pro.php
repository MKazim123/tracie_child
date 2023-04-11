<?php

add_action( 'wp_ajax_suggest_pro_action', 'suggest_pro_funt' );
add_action( 'wp_ajax_nopriv_suggest_pro_action', 'suggest_pro_funt' );
function suggest_pro_funt(){

    global $reg_errors;
    global $wpdb;
    $reg_errors = new WP_Error;
    $signUpError = "";
    $user_ID = get_current_user_id();
    $fullname = $_POST['name'] ? $_POST['name'] : "";
    $useremail = $_POST['email'] ? $_POST['email'] : "";
    $profession = $_POST['profession'] ? $_POST['profession'] : "";
    $location = $_POST['location'] ? $_POST['location'] : "";
    $phone = $_POST['phone'] ? $_POST['phone'] : "";

    if(empty( $fullname ) || empty( $useremail ) || empty($profession) || empty($location) || empty($phone)){
        $reg_errors->add('field', 'Required form field is missing');
    }    
    if ( 6 > strlen( $fullname ) ){
        $reg_errors->add('username_length', 'Username too short. At least 6 characters is required' );
    }
    if ( !is_email( $useremail ) ){
        $reg_errors->add( 'email_invalid', 'Email id is not valid!' );
    }

    if (is_wp_error( $reg_errors )){ 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $signUpError.='<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }

    if ( 1 > count( $reg_errors->get_error_messages() ) ){

        $data_return_from_query = $wpdb->insert("prof_suggest", array(
			"user_id" => $user_ID,
			"name" => $fullname,
			"email" => $useremail,
			"profession" => $profession,
			"phone" => $phone,
			"location" => $location
		));
		if($data_return_from_query ==  1){
			echo "success" . "|" . "Thank you, Professional request submitted.";
		}
		else{
            $signUpError = '<p style="color:#FF0000; text-aling:left;"><strong>ERROR</strong>: Sorry for inconvinience! There seems to be a problem<br /></p>';
            echo "error" . "|" . $signUpError;
		}

        
    }
    else{
        echo "error" . "|" . $signUpError;
    }

    die();
}


?>