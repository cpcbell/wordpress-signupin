<?php

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
'sign-up/">
	<label for="user_email">Email&nbsp;Address:</label>
		<input name="user_email" type="text" id="user_email" value="" maxlength="200"><br>We send your registration email to this address. (Double-check your email address before continuing.)	
		<input name="redirect_to" value="',
get_site_url(),
'" type="hidden">

		<p class="submit"><input type="submit" name="submit" class="submit" value="Next"></p>
	</form>'
));

}

?>
