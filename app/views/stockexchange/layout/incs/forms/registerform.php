<form id="regester__form" class="from--auth" action="" method="post">
	<input type="hidden" name="login__form__submit" value="login__form">

	<input type="text" id="name" name="fullname" class="input input--auth" placeholder="Enter your name and surname ..." autocomplete="off">

	<input type="text" id="name" name="username" class="input input--auth" placeholder="Enter your username..." autocomplete="off">

	<input type="text" id="email" name="email" class="input input--auth" placeholder="Enter your email(example@stck.loc)..." autocomplete="off">

	<input type="text" id="confirm__email" name="confirm__email" class="input input--auth" placeholder="Enter your email to confirm(example@gmail.com)..." autocomplete="off">

	<input type="password" id="password" name="password" class="input input--auth" placeholder="Enter your password...">

	<input type="password" id="password__again" name="password__again" class="input input--auth" placeholder="Enter your password again...">

	<input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>">

	<input type="Submit" name="register__form" id="login--btn" class="btn btn--logreg" value="Register">
</form>

<div style="margin-top: 20px;text-align:center;">
<?php if($success == 'No success' || count($errors) > 0): ?>
	<p style="color:red;">Fill in all the inputs or check them </p>
<?php endif; ?>
<?php foreach($errors as $error): ?>
	<?php if($error == 'username already exists' ): ?>
		<p style="color:red;">User with such username already exists, choose another one, please!</p>
	<?php elseif($error == 'confirm__email already exists'): ?>
		<p style="color:red;">User with such confirm email already exists, choose another one, please!</p>
	<?php elseif($error == 'email already exists'): ?>
		<p style="color:red;">User with such email already exists, choose another one, please!</p>
	<?php elseif($error == 'password must be minimum of 6 characters'): ?>
		<p style="color:red;">Password must be at least 6 charecters, please try again!</p>
	<?php elseif($error == 'password__again must match password'): ?>
		<p style="color:red;">This password must match that password</p>
	<?php endif; ?>
<?php endforeach; ?>
</div>