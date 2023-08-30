<aside class="sidebar" id="aside">
	<div class="sidebar__inner">
		<div class="sidebar__item">
			
			<?php if ($user->preview__image != false): ?>
				<img class="sidebar__header__image" src="<?php echo '../app/custmfolders/'.$user->dir_url.'/configs/'.$user->preview_image_url; ?>" alt="">
			<?php else: ?>
				<img class="sidebar__header__image" src="http://placehold.it/300x200" alt="">
			<?php endif; ?>
		</div>
		<div class="sidebar__item">
			<ul class="sidebar__list">
				<li class="sidebar__list__item user_ava">
					<?php if($user->ava): ?>
						<div class="avatar__image" style="background-image: url(<?php echo '../app/custmfolders/'.$user->dir_url.'/'; ?><?php echo escape($user->ava); ?>);"></div>
					<?php else: ?>
						<div class="avatar__image" style="background-image: url(images/icons/user.png);" ></div>
					<?php endif; ?>
					
					<?php if( $update ): ?>
						<span class="profile__edit__link" id="profile__edit">
							<i class="fas fa-pen"></i>
						</span>
					<?php endif; ?>
				</li>
				
				<li class="sidebar__list__item">
					<div class="info--gruop">
						<div class="info__item">
							<div class="info__name">
								<?php echo escape($user->fullname); ?> 
							</div>
							<div class="info__category">
								<?php echo escape($user->category); ?> 
							</div>
							<div class="info__category">
								
							</div>
						</div>
						<div class="socials">
							<?php if($user->instagram): ?>
							<a href="<?php echo $user->instagram; ?>" target="_blank">
								<img class="social__icon" src="../app/views/stockexchange/layout/images/icons/inst.png" alt="">	
							</a>
							<?php endif; ?>
							<?php if($user->gitHub): ?>
							<a href="<?php echo $user->gitHub; ?>" class="social__icon" target="_blank">
								<i class="fab fa-github"></i>
							</a>
							<?php endif; ?>
							<?php if($user->linkedin): ?>
							<a href="<?php echo $user->linkedin; ?>" target="_blank">
								<img class="social__icon" src="../app/views/stockexchange/layout/images/icons/linkedin.png" alt="">
							</a>
							<?php endif; ?>
							<?php if($user->facebook): ?>
							<a href="<?php echo $user->facebook; ?>" target="_blank">
								<img class="social__icon" src="../app/views/stockexchange/layout/images/icons/facebook.png" alt="">
							</a>
							<?php endif; ?>
						</div>
					</div>
				</li>
				<li class="sidebar__list__item">
					<?php if ( $user->about_user != ''  ): ?>
					<hr class="line__text">
					<p class="info__text" contenteditable="false">

						<?php echo escape($user->about_user); ?>

					</p>
				<?php endif; ?>
					<hr class="line__text">
					<?php if($cv == true): ?>
						<a href="http://localhost:8888/stockexchange/app/api/index.html?cv_hash=<?php echo $user->dir_url ?>" class="reg__link">CV</a>
					<hr class="line__text">
					<?php endif; ?>
				</li>
				<?php if($logged): ?>
				<li class="sidebar__list__item">
					<ul class="btn--gruop">
						<li class="btn--gruop__item">
							<a href="home/messanger/" class="btn btn--mnsd btn--mnsd--red" translation_slug="message">Message</a>
						</li>
						<?php if(!$update): ?>
							<?php if($friend != 1 && $progress == false): ?>
							<li class="btn--gruop__item">
								<button class="btn btn--mnsd btn--mnsd--blue" query-modal modal-call="request_frendship--modal" translation_slug="follow">Follow</button>
							</li>
							<?php elseif($progress == false && $friend == 1): ?>
								<button class="btn btn--mnsd btn--mnsd--green"><i class="fas fa-check"></i> <span translation_slug="friend">Friend</span></button>
							<?php endif; ?>

							<?php if($progress): ?>
								<li class="btn--gruop__item">
									<button class="btn btn--mnsd btn--mnsd--orange" translation_slug="in_progress">In proggress</button>
								</li>
							<?php endif; ?>
						<?php else: ?>
							<li class="btn--gruop__item">
								<button class="btn btn--mnsd btn--mnsd--blue" id="look_fllowers1"><span translation_slug="friends">Friends</span><i class="fas fa-user-friends"></i></button>
							</li>
						<?php endif; ?>

					</ul>
				</li>	

				<?php endif; ?>

			</ul>
		</div>
	</div>
</aside>

<?php 
    $pagination = true; 
    $pagination_last_item = $works_count; 
    $location = $users_url;
    $page_num = $page_num;

?>

<div class="user" style="margin-bottom: 30px;">
	<ul class="sidebar__list">
		<li class="sidebar__list__item">

					<?php if($user->ava): ?>
					
						<div class="avatar__image mobile" style="background-image:url(<?php echo '../app/custmfolders/'.$user->dir_url.'/'; ?><?php echo escape($user->ava); ?>);" ></div>
					<?php else: ?>
						<img class="avatar__image mobile" src="images/icons/user.png" alt="">
					<?php endif; ?>
				</li>
				<li class="sidebar__list__item">
					<div class="info--gruop">
						<div class="info__item">
							<div class="info__name">
								<?php echo escape($user->fullname); ?> 
							</div>
							<div class="info__category">
								<?php echo escape($user->category); ?> 
							</div>
							
						</div>
						<div class="socials">
							<?php if($user->instagram): ?>
							<a href="<?php echo $user->instagram; ?>" target="_blank">
								<img class="social__icon" src="../app/views/stockexchange/layout/images/icons/inst.png" alt="">	
							</a>
							<?php endif; ?>
							<?php if($user->gitHub): ?>
							<a href="<?php echo $user->gitHub; ?>" class="social__icon" target="_blank">
								<i class="fab fa-github"></i>
							</a>
							<?php endif; ?>
							<?php if($user->linkedin): ?>
							<a href="<?php echo $user->linkedin; ?>" target="_blank">
								<img class="social__icon" src="../app/views/stockexchange/layout/images/icons/linkedin.png" alt="">
							</a>
							<?php endif; ?>
							<?php if($user->facebook): ?>
							<a href="<?php echo $user->facebook; ?>" target="_blank">
								<img class="social__icon" src="../app/views/stockexchange/layout/images/icons/facebook.png" alt="">
							</a>
							<?php endif; ?>
						</div>
					</div>
				</li>
					<div class="accordion__header" accordion accordion-item="acc-info">Info<i class="fas fa-caret-right"></i></div>
						<div class="accordion" id="acc-info">
						<li class="sidebar__list__item">
							<?php if($user->about_user != ''): ?>
								<hr class="line__text">
								<p class="info__text" contenteditable="false">
									<?php echo escape($user->about_user); ?>

								</p>
							<?php endif; ?>

							<hr class="line__text">
							<?php if($cv == true): ?>
								<a href="http://localhost:8888/stockexchange/app/api/index.html?cv_hash=<?php echo $user->dir_url ?>" class="reg__link">CV</a>
							<hr class="line__text">
							<?php endif; ?>
						</li>
						<li class="sidebar__list__item ">
							<ul class="btn--gruop btn__gruop--accordion" style="display: flex;text-align: center;justify-content: center;">
								<li class="btn--gruop__item " style="margin-right: 20px;">
									<a href="home/messanger/" class="btn btn--mnsd btn--mnsd--red">Message</a>
								</li>
								<?php if(!$update): ?>
									<?php if($friend != 1 && $progress == false): ?>
										<li class="btn--gruop__item" style="margin-left: -10px; margin-top: 10px;">
											<button class="btn btn--mnsd btn--mnsd--blue" query-modal modal-call="request_frendship--modal">Follow</button>
										</li>
									<?php elseif($progress == false && $friend == 1): ?>
										<button class="btn btn--mnsd btn--mnsd--green"><i class="fas fa-check"></i> Friend</button>
									<?php endif; ?>
									<?php if($progress): ?>
								<li class="btn--gruop__item">
									<button class="btn btn--mnsd btn--mnsd--orange">In proggress</button>
								</li>
							<?php endif; ?>
								<?php else: ?>
									<li class="btn--gruop__item" style="margin-left: -10px; margin-top: 10px;">
										<button class="btn btn--mnsd btn--mnsd--blue" id="look_fllowers2">Followers<i class="fas fa-user-friends"></i></button>
									</li>
								<?php endif; ?>

							</ul>
						</li>
					</div>	
	</ul>
</div>

<?php if(count($posts) > 0): ?>

<?php endif; ?>
<h2 class="page__header no-index"><span translation_slug="posts">Posts</span>: </h2>
<div class="story no-index">

    <ul class="video__story" id="story">
        <?php if($update): ?>
        <li class=" story__item">
            <span class="preview add"></span>
            <a href="home/admin/" id="add__story"><div class="story__hover"></div></a>
             <div class="story__date">
            <i class="fas fa-plus-circle plus_story"></i>
        	</div>
        </li>
    <?php endif; ?>
    <?php if(count($posts) > 0): ?>
    <?php foreach( $posts as $post ):   ?>
        <li class="story__item" style="width: 175px; height: 250px;">
                <a href="home/post/<?php echo $post['post']->id; ?>/">
                    <img src="../app/custmfolders/posts/<?php echo $post['post']->image_path; ?>" class="preview" alt="">
                </a>
                <a href="home/post/<?php echo $post['post']->id;?>/"><div class="story__hover"></div></a>                  
                <div class="story__theme"><?php echo $post['post']->title; ?></div>
                <div class="story__date"><?php echo date('d.m.Y',strtotime($post['post']->date)); ?></div>
        </li>
    <?php endforeach; ?> 
    <?php endif; ?>       
    </ul>
</div>

<div class="works no-index">
<?php if($update): ?>
	<span id="addWork__link"><span translation_slug="add_work">Add Work </span> <i class="fas fa-plus-circle"></i> </span>
<?php endif; ?>

<?php if (count($works) > 0): ?>
	<h2 class="page__header"><span translation_slug="works">Works</span>: </h2>
<?php foreach($works as $work): ?>
    <div class="work">
    	<?php if(!$user_dir) { $dir = $work->user_dir; } else { $dir = $user_dir; }  ?>
        <div  class="work__image" style="background-image: url(<?php echo '../app/custmfolders/'.$dir.'/'.$work->image; ?>);"></div>
        <div class="work__content">
            <div class="work__author">
                <img src="<?php echo $work->user['ava']; ?>" class="work__author__ava" alt="">
                <ul class="work__author__info">
                    <li class="work__author__info__item"><?php echo $work->user['fullname']; ?></li>
                    <li class="work__author__info__item prof"><?php echo $work->user['category']; ?></li>
                </ul>
            </div>
            <h1 class="work__title"><?php echo $work->title; ?></h1>
            
            <div class="work__category">
                <span translation_slug="category">Category</span>: <?php echo $work->category; ?>
            </div>

            <div class="work__text">
                <?php echo $work->prev_text; ?>
            </div>

            <ul class="work__tags">
                <?php foreach(array_slice($work->tag, 0, 5) as $tag): ?>
                    <li class="work__tag"><?php echo $tag; ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="work__edit">
                <div class="work__look__item">
                    <i class="fas fa-thumbs-up" style="margin-right: 3px;"></i>  <?php echo $work->likes; ?>
                </div>
                <div class="work__look__item">
                    <i class="fas fa-thumbs-down" style="margin-right: 3px;"></i>  <?php echo $work->dislikes; ?>
                </div>
                <div class="work__look__item">
                    <i class="fas fa-eye" style="margin-right: 3px;"></i><?php echo $work->views; ?>
                </div>
                
            </div>
            <a href="home/work/<?php echo $work->id; ?>/"  class="work__link"><span translation_slug="look_work">Look work </span>&rang;</a>
        </div>

    </div>
<?php endforeach; ?>
<?php endif; ?>
</div>