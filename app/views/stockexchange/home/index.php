<?php 
    $pagination = true; 
    $pagination_last_item = $works_count; 
    $location = $users_url;
    $page_num = $page_num;

?>
<?php if(count($users) > 0): ?>

<h2 class="page__header" ><span translation_slug="users" >Users</span>: </h2>
<ul class="users__table index">
   <?php foreach ($users as $user): ?>
      <li class="users__table__item index" data-link="home/person/<?php echo $user->id; ?>/" style="">
         <a href="home/person/<?php echo $user->id; ?>/">
            <?php if($user->ava): ?>
               <img src="../app/custmfolders/<?php echo $user->dir_url; ?>/<?php echo $user->ava; ?>" class="users__avatar" alt="">
            <?php else:?>
               <img class="users__avatar" src="images/icons/user.png" alt="">
            <?php endif; ?>
        </a>
            
            <a class="users__name" href="home/person/<?php echo $user->id; ?>/"><?php echo $user->fullname; ?></a>
            <div class="users__work__category">
               <?php echo $user->category; ?>
            </div>
            <div class="users__prof">
               <?php echo $user->prof; ?>
            </div>
      </li>
   <?php endforeach; ?>
</ul>

<?php endif; ?>
<?php if (count($posts) > 0): ?>
<h2 class="page__header"><span translation_slug="posts">Posts</span>: </h2>
<div class="story" style="  overflow-x: auto;">
    <ul class="video__story" id="story">
    <?php foreach( $posts as $post ):   ?>
        <li class="story__item" style="width: 175px; height: 250px;">
                <a href="home/post/<?php echo $post->id; ?>">
                    <img src="../app/custmfolders/posts/<?php echo $post['post']->image_path; ?>" class="preview" alt="">
                </a>
                <a href="home/post/<?php echo $post['post']->id;?>/"><div class="story__hover"></div></a>                  
                <div class="story__theme"><?php echo $post['post']->title; ?></div>
                <div class="story__date"><?php echo date('d.m.Y',strtotime($post['post']->date)); ?></div>
                
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if(count($works) > 0): ?>

<h2 class="page__header" style="margin-top: 30px;" ><span translation_slug="works">Works</span>: </h2>
<div class="works">
<?php foreach($works as $work): ?>
    <div class="work">
       <?php $dir = $work->user_dir; ?>
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
            

            <ul class="work__tags">
                <?php foreach(array_slice($work->tag, 0, 5) as $tag): ?>
                    <li class="work__tag"><?php echo $tag; ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="home/work/<?php echo $work->id; ?>/" class="work__link"><span translation_slug="look_work">Look work</span> &rang;</a>
        </div>

    </div>
<?php endforeach; ?>
</div>

<?php endif; ?>

<script>
   var users = document.querySelectorAll('.users__table__item');


   for ( let i = 0; i < users.length; i++ ) {
      users[i].addEventListener('click', function () {
         window.location.href = users[i].getAttribute('data-link');
      });
   }

</script>