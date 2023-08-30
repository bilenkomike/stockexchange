<section class="about">
	<div class="about_shortlinks">
		<a href="home/postpage/" class="about__link" id="returnBack" translation_slug="return">Return back</a>
		<span class="about__link" query-modal modal-call="share-modal"></span>
	</div>
	<h1 class="about__header"><?php echo ucfirst($work->title); ?></h1>
	<div class="about__category"><span translation_slug="category">Category</span> : <?php echo $work->category; ?> </div>
	<ul class="about__info">
		
		<li class="about__info__item"><time datetime="21.06.2020"><?php echo TimeDate::TimeDateFormat('d.m.Y H:i:s',$work->date); ?> </time></li>
		<?php foreach( $work->tags as $tag ): ?>
			<li class="about__info__item"><?php echo $tag; ?></li>
		<?php endforeach; ?>
	</ul>

	<div class="about__content editor_result" id="about__content" >
		<?php echo $work->full_content; ?>
		<script>const fonts = document.querySelectorAll('font');console.log(fonts); fonts.forEach(element => element.removeAttribute('color')); </script>
	</div>
	<iframe src="" frameborder="0">
		<?php echo htmlspecialchars($work->full_content); ?>	
	</iframe>
	

<!-- 	<iframe name="viewpost"   id="post__content" class="about__content" style="display: block; padding-left: -10px; width: 560px; overflow: none; color: #f2f2f2;">

	</iframe> -->
	


	<?php if($logged): ?>
	<hr class="about__under__line">
	<div class="work__actions work__view" style="margin: 25px auto;">
		<span translation_slug="rate_work">Rate the work, please</span>:
		<div class="work__actions__item" likes-dislikes wwork-id='<?php echo $work->id; ?>' data-like="+" style="margin-right:15px;">
		    <i class="far <?php if($work->liked == 1) {echo 'fas'; } ?>  fa-thumbs-up"></i><span id="likes"><?php echo $work->likes; ?></span>
		</div>
		<div class="work__actions__item" likes-dislikes wwork-id='<?php echo $work->id; ?>' data-like="-" style="margin-left:15px;">
		    <i class="far <?php if($work->liked != '' && $work->liked == 0 ) {echo 'fas'; } ?> fa-thumbs-down"></i><span id="dislikes"><?php echo $work->dislikes; ?></span>
		</div>

	</div>
	<hr class="about__under__line">
	
	<a href="<?php echo $work->link; ?>" class="about__url" target="_blank" <?php if($work->site == 0){ echo 'download="'.$work->link.'"';} ?> style="margin: 25px auto;"><span translation_slug="see_work">To see work click here</span> <i class="far fa-hand-point-down"></i></a>
	<?php endif; ?>
	<hr class="about__under__line">
	<div class="about__author">

		<img src="../app/custmfolders/<?php echo $work->author->dir_url; ?>/<?php echo $work->author->ava; ?>" class="about__author__ava" alt="">
		<div class="about__author__info">
			<a class="about__author__name" href="home/person/<?php echo $work->author->id; ?>/">
				<?php echo $work->author->fullname; ?>
			</a>
			<div class="about__author__category">
				<?php echo $work->author->category; ?>
			</div>
		</div>
		
	</div>

	<hr class="about__under__line">

	<h1 class="interesting__header" translation_slug="interesting">
		Interesting to read
	</h1>
	<ul class="interesting">
		<?php foreach($work->interesting as $interesting): ?>
			<li class="interesting__item">
				<a href="home/work/<?php echo $interesting['id']; ?>/" class="interesting__item__header"><?php echo $interesting['title']; ?></a>
				<time class="interesting__item__time" datetime="21.06.2020"><?php echo(TimeDate::TimeDateFormat('d.m.Y',$interesting['date'])); ?></time>
			</li>
		<?php endforeach; ?>	
	</ul>
</section>
<?php 
	$pagination = false; 
	$pagination_last_item = 0; 
	$location = '';
	$page_num = 0;
?>