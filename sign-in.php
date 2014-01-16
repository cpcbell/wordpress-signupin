<?php
/*
Template Name: Sign In 
*/

/**
 * @package WordPress
 * @subpackage Signinup 
 * @since Signinup 1.0
 */

if(isset($_POST['log'])){

	$user_name = createUsernameFromEmail($_POST['log']);

	$_POST['log'] = $user_name;

	$user = wp_signon();

	if ( is_wp_error($user) ){

   		$message = $user->get_error_message();
	}
	else{
		wp_redirect( home_url() ); exit;	
	}
}

$message = null;

if(isset($_REQUEST['message'])){

	switch($_REQUEST['message']){

		case '1':

			$message = 'You will get an email soon with your initial password.';
		break;
	}
}

get_header(); 

/**
Display the Sign In Form
*/
echo join(array(
	'<div>',
	'<div class="message">',
	$message,
	'</div>',
	'<h1>Sign In</h1>',
	signInForm(),	
	'</div>',
	));

/**
Display the Sign Up Form
*/

echo join(array(
	'<div>',
	'<h1>Sign Up</h1>',
	signUpForm(),	
	'</div>',
	));

get_footer(); 

?>
