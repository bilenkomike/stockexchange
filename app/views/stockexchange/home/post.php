<section class="about">
	<div class="about_shortlinks">
		<a href="home/postpage/" class="about__link" id="returnBack" translate translation_slug="return">Return back</a>
		<span class="about__link"></span>
	</div>
	
	<h1 class="about__header"><?php echo ucfirst($post->title); ?></h1>
	<ul class="about__info">
		<li class="about__info__item"><time datetime="21.06.2020"></time><?php echo TimeDate::TimeDateFormat('d.m.Y H:i' ,$post->date); ?></li>
		<?php foreach($post_tags as $post_tag): ?>
			<li class="about__info__item"><?php echo $post_tag; ?></li>
		<?php endforeach; ?>
	</ul>
	<div class="about__content editor_result" id="about__content">
		<?php echo $post->content; ?>
		<script>const fonts = document.querySelectorAll('font');console.log(fonts); fonts.forEach(element => element.removeAttribute('color')); </script>
	</div>

	<hr class="about__under__line">
	<div class="about__author">
		<img src="../app/custmfolders/<?php echo $post->author->dir_url; ?>/<?php echo $post->author->ava; ?>" class="about__author__ava" alt="">
		<div class="about__author__info">
			<a class="about__author__name" href="home/person/<?php echo $post->author->id; ?>/">
				<?php echo $post->author->fullname; ?>
			</a>
			<div class="about__author__category">
				<?php echo $post->author->category; ?>
			</div>
		</div>
		
	</div>

	<hr class="about__under__line">

	<h1 class="interesting__header" translate translation_slug="interesting">
		Interesting to read

	</h1>
	<ul class="interesting">
		<?php foreach($post->interesting as $interesting): ?>
			<li class="interesting__item">
				<a href="home/post/<?php echo $interesting['id']; ?>/" class="interesting__item__header"><?php echo $interesting['title']; ?></a>
				<time class="interesting__item__time" datetime="21.06.2020"><?php echo(TimeDate::TimeDateFormat('d.m.Y',$interesting['date'])); ?></time>
			</li>
		<?php endforeach; ?>	
	</ul>

	<?php if($logged): ?>
	<hr class="about__under__line">
	<div class="leavecomment">
		

		<form action="home/post/<?php echo $post_id; ?>/" method="POST" class="form">
			<h1 class="form__header" translate translation_slug="leavecom" >
				Leave comment
			</h1>
			<textarea name="comment__text" translation_input translation_slug="leavecomf" class="input textarea" placeholder="Leave comment..." data-autoresize ></textarea>
			<button class="btn btn--mnsd btn--mnsd--blue" type="Submit" translation_slug="submit">Submit</button>
		</form>	
	
	</div>
	<?php endif; ?>
	<hr class="about__under__line">
	<h1 class="comment__header" translation_slug="сomments" >Comments</h1>
	<ul class="comments">
		<?php foreach( $post_comments as $post_comment ): ?>

		<li class="comment">
			<div class="comment__content">
				<div class="comment__about">
					<img src="<?php echo $post_comment['user']['ava_path']; ?>" class="comment__image" alt="">
					<div class="comment__info">
						<div class="comment__author"><?php echo $post_comment['user']['fullname']; ?></div>
						<div class="comment__date">
							<?php echo TimeDate::TimeDateFormat('H:i d.m.Y' ,$post_comment['comment_date']); ?> 
							
						</div>
					</div>
				</div>
				
				<div class="comment__text">
					<?php echo $post_comment['comment']; ?>			
				</div>
				<?php if($logged): ?>
				<span class="read--comm" answer__comment comment="<?php echo $post_comment['comment_id'] ?>" translation_slug="answer">

					Answer
				</span>
				<?php endif; ?>
				<?php if ($logged): ?>
				<form action="home/post/<?php echo $post_id; ?>/" id="<?php echo $post_comment['comment_id']; ?>" form__answer method="POST" class="form">
					<input type="hidden" name="PostId_commentId" value="<?php echo $post_id; ?>-<?php echo $post_comment['comment_id']; ?>">
					<textarea name="comment__text"  class="input textarea" placeholder="Leave comment..." data-autoresize translation_input translation_slug="leavecomf"></textarea>
					<button class="btn btn--mnsd btn--mnsd--blue" type="Submit" translation_slug="submit">Submit</button>
				</form>	
				<?php endif; ?>
			</div>
			<?php if($post_comment['reanswers'] != ""): ?>
			<ul class="comments">
				<?php foreach($post_comment['reanswers'] as $reanswer): ?>
					<li class="comment">
						<div class="comment__content">
							<div class="comment__about">
								<img src="<?php echo $reanswer['reanswer_user']['ava_path']; ?>" class="comment__image" alt="">
								<div class="comment__info">
									<div class="comment__author"><?php echo $reanswer['reanswer_user']['fullname']; ?></div>
									<div class="comment__date">
										<?php echo TimeDate::TimeDateFormat('d.m.Y H:i' ,$reanswer['reanswer_date']); ?>
									</div>
								</div>
							</div>
							
							<div class="comment__text">
								<?php echo $reanswer['reanswer_comment']; ?>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
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