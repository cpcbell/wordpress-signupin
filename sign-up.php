<?php
/*
Template Name: Sign Up 
*/

/**
 * @package WordPress
 * @subpackage Signinup 
 * @since Signinup 1.0
 */

if(isset(
		$_POST['user_email']
)){


	if ( !get_option('users_can_register') ) {
		wp_redirect( site_url('wp-login.php?registration=disabled') );
		exit();
	}

	$user_login = '';
	$user_email = '';
	$errors = null;

	if ( isset($_POST['user_email'] ) ) {

		$user_login = createUsernameFromEmail($_POST['user_email']);

		$user_email = $_POST['user_email'];

		$errors = register_new_user($user_login, $user_email);

		if ( !is_wp_error($errors) ) {

			$redirect_to = !empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
			wp_safe_redirect( $redirect_to );
			exit();
		}
		else{
			/**
			Could be custom error page
			wp_safe_redirect( 'error page' );
			exit();
			*/
		}
	}
}

get_header(); 


if($errors) print_r($errors);

echo join(array(
	'<div>',
	'<h1>Sign Up</h1>',
	signUpForm(),	
	'</div>',
	'<div>',
	$errors,
	'</div>',
	));

get_footer(); 

?>
