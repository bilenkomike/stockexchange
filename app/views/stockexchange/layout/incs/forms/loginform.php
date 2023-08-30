<form method="POST" id="login__form" action="" class="from--auth">
	
	<input type="text" id="email" name="email" class="input input--auth" placeholder="Enter your email..." autocomplete="off">

	<input type="password" id="password" name="password" class="input input--auth" placeholder="Enter your password...">
	<label for="remember" id="remember--input" class="input--remember">
		<span class="input--remember--checked" id="input--remember--checked"></span>
		<input type="checkbox" name="remember" id="remember" class="input--checkbox">Remember
	</label>
	<input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>">
	<input type="Submit" name="login__form" id="login--btn" class="btn btn--logreg" value="Log in">
</form>
<div style="margin-top: 20px;text-align:center;">
<?php if($success == 'No success' || count($errors) > 0): ?>
	<p style="color:red;">Check your password and email! Somthning wrong hapened</p>
<?php endif; ?>

</div>