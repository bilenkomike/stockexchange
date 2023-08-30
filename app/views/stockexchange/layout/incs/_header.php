<?php
$db = Db::getInstance();
$user = new User;
$langs = $db->results($db->get('languages'));

$lang = Session::get('lang');


$pages = $db->results($db->get('translations'));
$translations = array();
	foreach( $pages as $page ) {
		$translations[$page->slug] = $page->translation;
	}
?>



<header class="header st" id="header">
	<div class="header__left">
		<div class="burger" id="nav__burger">
			<span class="burgermenu">fr</span>
			<span class="burgermenu">d</span>
			<span class="burgermenu">sfg</span>
		</div>
		<div class="header header__mobile">
			<?php include 'forms/searchform.php'; ?>
			<span class="nav__link" data-changebgcolor data-attr="b"><i class="fas fa-adjust"></i></span>
		</div>
		<nav class="nav">
			<div class="nav__urls">
				<ul class="nav__list">
					<li class="nav__item">
						<a class="nav__link" translate translation_slug="home" id="home" href="home/index/"><?php echo json_decode($translations['home'], true)[$lang]; ?></a>
						<li class="nav__item" >
							<a class="nav__link" translate translation_slug="works" href="home/works/"><?php echo json_decode($translations['works'], true)[$lang]; ?></a>
						</li>
						<li class="nav__item">
							<a href="home/users/" class="nav__link"  translate translation_slug="users"><?php echo json_decode($translations['users'], true)[$lang]; ?></a>
						</li>
						<?php if ($user->isLoggedIn()): ?>
						<li class="nav__item">
							<a class="nav__link"  translate translation_slug="messanger" href="home/messanger/"><?php echo json_decode($translations['messanger'], true)[$lang]; ?></a>
						</li>
						
						
						<li class="nav__item">
                   			<a class="nav__link" translate translation_slug="profile" href="home/person/<?php echo $user->data()->id; ?>/">Profile</a>
	                	</li>
						<li class="nav__item">
                   			<a class="nav__link" translate translation_slug="admin"  href="home/admin/"><?php echo json_decode($translations['admin'], true)[$lang]; ?></a>
	                	</li>
						
					<?php endif; ?>
					<li class="nav__item">
							<a href="home/about/"  translate translation_slug="about" class="nav__link"><?php echo json_decode($translations['about'], true)[$lang]; ?></a>
						</li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="header__right">
		<nav class="nav">
			<ul class="nav__list">
				<?php if(!$user->isLoggedIn()): ?>
	                <li class="nav__item">
	                   	<a class="nav__link" id="back" href="home/login/" translate translation_slug="login"><?php echo json_decode($translations['login'], true)[$lang]; ?></a>
	                </li>
	           		<?php endif; ?>
				<?php if($user->isLoggedIn()): ?>
                	<li class="nav__item">
                    	<a class="nav__link" id="back" href="home/logout/" translate translation_slug="logout"><?php echo json_decode($translations['logout'], true)[$lang]; ?></a>
                	</li>
                <?php endif;  ?>
				<li class="nav__item">

					<div class="nav__link has-subnav" id="lang__selector"  href="#">
						<?php if(empty($lang)){ echo json_decode($translations['language'], true)[$lang];} else { 
							foreach( $langs as $langa) {
								if ( $langa->id == $lang) {
									echo "<img src='../app/views/$template_name/layout/images/icons/$langa->lang_image' height='15'
								width='20' alt=''>".strtoupper($langa->lang);
								}
							} }?></div><span class="icon"><i class="fas fa-caret-down"></i>
					</span>
					<ul class="subnav" id="">
						<?php foreach($langs as $key => $lang): ?>
							<li class="lang">
								<span class="subnav__link" data-lang="<?php echo $lang->lang; ?>" id="lang-<?php echo $lang->lang; ?>"><img src="../app/views/<?php echo $template_name; ?>/layout/images/icons/<?php echo $lang->lang_image;?>" height="15"
								width="20" alt=""><?php echo strtoupper($lang->lang); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li class="nav__item">
					<span href="" class="nav__link" data-changebgcolor data-attr="b"><i class="fas fa-adjust"></i></span>
				</li>
				<?php include 'forms/searchform.php'; ?>	
			</ul>
		</nav>	
	</div>
</header><!--/.header-->
