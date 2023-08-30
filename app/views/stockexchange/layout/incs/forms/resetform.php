<form id="regester__form" class="search from--auth" action="home/reset/" method="post">
	
	<input type="password" id="password" name="password" class="input input--auth" placeholder="Enter your old password...">

	<input type="password" id="new__password" name="new__password" class="input input--auth" placeholder="Enter your new password...">

	<input type="password" id="new__password__again" name="new__password__again" class="input input--auth" placeholder="Enter your new password again...">

	<input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>">

	<input type="Submit" name="register__form" id="login--btn" class="btn btn--logreg" value="Save">
</form>
