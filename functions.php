<?php

if ( ! isset( $content_width ) )
	$content_width = 640;

add_editor_style();

add_theme_support( 'post-thumbnails' );

add_theme_support( 'automatic-feed-links' );

add_custom_background();

add_custom_image_header( '', 'bare_admin_header_style' );

if ( ! function_exists( 'bare_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 */
function bare_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

function register_bare_menus(){

register_nav_menus(
array(
'header-menu' => __( 'Header Menu' )
)
);
}
add_action( 'init', 'register_bare_menus' );

if ( function_exists('register_sidebar') ){
    	register_sidebar();
}

if ( ! function_exists( 'bare_comment' ) ) :

function bare_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	echo '<li ';
		comment_class();
	echo join(array(
		' id="li-comment-',
		$comment->comment_ID,
		'">',
		'<span>',
		$comment->comment_author,
		' said: </span>',
		$comment->comment_content,
		'</li>'
	));

}
endif;

if ( ! function_exists( 'bare_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
function bare_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bare' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bare' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bare' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'bare_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function bare_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'bare' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'bare' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

function createUsernameFromEmail($email){

	$user_name = str_replace('@','at',$email);

	$user_name = preg_replace('/[^A-Za-z0-9]/','', $email);

	return $user_name;
}

function signInForm(){

/**
		<input name="testcookie" value="1" type="hidden">
*/

return join(array('	
<form name="loginform" method="post">
	<p>
		<label for="user_login">Email<br>
		<input name="log" id="user_login" class="input" value="" size="20" tabindex="10" type="text"></label>
	</p>
	<p>
		<label for="user_pass">Password<br>
		<input name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" type="password"></label>
	</p>
	<p class="forgetmenot"><label for="rememberme"><input name="rememberme" id="rememberme" value="forever" tabindex="90" type="checkbox"> Remember Me</label></p>
	<p class="submit">
		<input name="wp-submit" id="wp-submit" value="Sign In" tabindex="100" type="submit">
		<input name="redirect_to" value="',
get_site_url(),
'" type="hidden">
	</p>
</form>'
));
	
}

function signUpForm(){

/**
something thought was necessary ?
		<input type="hidden" name="signup_form_id" value="995180375"><input type="hidden" id="_signup_form" name="_signup_form" value="6277daa196">		
		<p>
					<input id="signupblog" type="hidden" name="signup_for" value="user">
				</p>
		<input type="hidden" name="stage" value="validate-user-signup">
*/

return join(array('
<form method="post" action="',
get_site_url(),
'/sign-up/">
	<label for="user_email">Email&nbsp;Address:</label>
		<input name="user_email" type="text" id="user_email" value="" maxlength="200"><br>We send your registration email to this address. (Double-check your email address before continuing.)	
		<input name="redirect_to" value="',
get_site_url(),
'/sign-in/?message=1" type="hidden">

		<p class="submit"><input type="submit" name="submit" class="submit" value="Next"></p>
	</form>'
));

}


?>
