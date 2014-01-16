<?php
/*
Template Name: Sign Out 
*/

/**
 * @package WordPress
 * @subpackage signinup 
 * @since signinup 1.0
 */

wp_logout();
wp_redirect(get_site_url());
exit();

?>
