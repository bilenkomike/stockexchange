<?php 
	$db = Db::getInstance();
	$lang = Session::get('lang');
	$user = new User;
	$pages = $db->results($db->get('translations'));
	$translations = array();
	foreach( $pages as $page ) {
		$translations[$page->slug] = $page->translation;
	}



?>

<aside class="mobile__sidebar" id="mobileNav">
	<div class="mobile__sidebar__content" id="mobileContent">
		<nav class="mobile__nav">
			<div class="nav__urls">
				<ul class="nav__list mobile">
					<li class="nav__item mobile">
						<a class="nav__link" translate translation_slug="home" href="home/index/"><?php echo json_decode($translations['home'], true)[$lang]; ?>
						</a>
					</li>
					<li class="nav__item mobile" >
						<a class="nav__link" translate translation_slug="works" href="home/works/"><?php echo json_decode($translations['works'], true)[$lang]; ?></a>
					</li>
					<li class="nav__item mobile">
						<?php //print_arr($translations); ?>
						<a href="home/users/" class="nav__link" translate translation_slug="users"><?php echo json_decode($translations['users'], true)[$lang]; ?></a>
					</li>
					<?php if ($user->isLoggedIn()): ?>
						<li class="nav__item mobile">
                   			<a class="nav__link" translate translation_slug="profile" href="home/person/<?php echo $user->data()->id; ?>/">Profile</a>
	                	</li>
	                	<li class="nav__item mobile">
							<a class="nav__link"  translate translation_slug="messanger" href="home/messanger/"><?php echo json_decode($translations['messanger'], true)[$lang]; ?></a>
						</li>
						<li class="nav__item mobile">
	                    	<a class="nav__link" id="back" href="home/admin/" translate translation_slug="admin"><?php echo json_decode($translations['admin'], true)[$lang]; ?></a>
	                	</li>
		                <li class="nav__item mobile">
	                    	<a class="nav__link" id="back" href="home/logout/" translate translation_slug="logout"><?php echo json_decode($translations['logout'], true)[$lang]; ?></a>
	                	</li>

                	<?php endif; ?>
                	<?php if(!$user->isLoggedIn()): ?>
                	<li class="nav__item mobile">
	                   	<a class="nav__link" id="back" href="home/login/" translate translation_slug="login"><?php echo json_decode($translations['login'], true)[$lang]; ?></a>
	                </li>
	           	 	<?php endif; ?>
	                <li class="nav__item mobile">
						<a href="home/about/"  translate translation_slug="about" class="nav__link"><?php echo json_decode($translations['about'], true)[$lang]; ?></a>
					</li>
	                <li class="nav__item mobile">
						<span class="nav__link" data-changebgcolor data-attr="b"><i class="fas fa-adjust"></i></span>
					</li>
					<?php foreach($db->results($db->get('languages')) as $key=> $lang): ?>
						<?php if($lang->id == $_SESSION['lang']) {$active = 'active';} else {
							$active = '';
						}  ?>
						<li class="nav__item mobile lang">
							<span class="nav__link <?php echo $active; ?> languages" data-lang="<?php echo $lang->lang; ?>" id="lang-<?php echo $lang->lang; ?>"><img src="../app/views/<?php echo $template_name; ?>/layout/images/icons/<?php echo $lang->lang_image;?>" height="15"
									width="20" alt=""><?php echo strtoupper($lang->lang); ?>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</nav>
	</div>
</aside>

