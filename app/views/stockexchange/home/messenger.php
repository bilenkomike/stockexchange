<aside class="mess__aside" id="mess__aside">
	<form action="" method="GET" class="messander__search__form">
			<input type="text" class="input search messanger__search" id="messanger__searh" translation_slug="search_by_name_surn" translation_input placeholder="Search by name and surname ...">
			<i class="fas fa-times message__search__clear"></i>
		</form>
		<ul class="mess__list">
			<?php if(!empty($chats)): ?>
			<?php foreach( $chats as $chat): ?>

				<li class="mess__list__item" data-chat="<?php echo $chat['hash']->hash; ?>">
					<div class="mess__list__item__user">
						<img src="<?php echo $chat['user']['ava']; ?>" class="mess__list__item__ava" alt="">
						<ul class="mess__list__item__info">
							<li class="mess__list__item__info__item">
								<?php echo $chat['user']['fullname']; ?>

							</li>
							<li class="mess__list__item__info__item">
								<?php echo substr(escape($chat['last_record']->message), 0,8) . '...'; ?>
							</li>
							
						</ul>
					</div>
					<ul class="mess__list__item__info">
						<li class="mess__list__item__info__item op-5">
							<div class="user__ativity <?php if($chat['user']['activity'] != 0) { echo 'active'; } ?>" data-checkactivity checkactivity-id="<?php echo $chat['user']['id']; ?>"></div>
						</li>
						<li class="mess__list__item__info__item delete__chat">
							<i class="fas fa-trash-alt"></i>
						</li>
						
					</ul>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
			
		</ul>
</aside>


<div class="messanger">
	<header class="messanger__header" id="messanger__header">
		<div class="messanger__header__content" id="messanger__header__content">
			<i class="fas fa-arrow-left messanger__header__arrow__back"></i>
			<img src="http://placehold.it/55" class="messanger__header__ava"  alt="">
			<div class="messanger__header__name">
				Mike Bilenko
			</div>
			<div class="user__ativity" id="chat__user__activity" data-checkactivity checkactivity-id=""></div>
		</div>
	</header>
	<section>
	<section class="messanger__content">
		<div class="chat">
			<ul id="chat" data-chat__id="">
				
			</ul>
			<div class="lorem"></div>
		</div>
			
	</section>
	<div class="messanger__form">
		<div id="messanger__imgload" class="messanger__imgload" >
			<!-- <div class="mess__img">
				<span class="mess__img__cross"><i class="far fa-times-circle"></i></span>
				<img src="http://placehold.it/100" style="width: 100px; height: 100px; margin: 7px;" hspace="15" alt="">
			</div> -->
		</div>
		<form action="home/messanger/" class="message__form" id="messge__form" >
			<span id="much__photos" query-modal modal-call="much__photos" style="display: none;"></span>
			<textarea type="text" class="input message__input message__textarea textarea" id="message" data-autoresize placeholder="Enter the message" disabled translation_slug="enter_the_mess" translation_input></textarea>
			<!-- <input type="hidden" name="img_path"> -->
			<div class="btn--gruop message__btn__gruop">
				<button class="btn message__btn" id="send__message__btn" disabled name="send"><i class="fas fa-paper-plane"></i></button>
				<button type="button" class="btn message__btn message__btn--add" id="append_to_mess" query-modal modal-call="content-append-image-to-messanger"><i class="fas fa-paperclip" disabled></i></button>
			</div>
			
		</form>
	</div>
		</section>
</div>