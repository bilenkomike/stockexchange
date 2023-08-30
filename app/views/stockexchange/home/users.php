<div class="filter">
   <div class="filter__header" id="filter">
       <span translation_slug="filter">Filter</span>:<i class="fas fa-caret-right"></i>
   </div>
    <div class="filter__inner">
        <div class="filter__inner__content">
        <?php foreach( $filters as $filterName => $filterValues ): ?>
            <div class="filter__inner__header" translation_slug="<?php echo $filterName; ?>"><?php echo $filterName; ?></div>

            <ul class="category__filter">
                <?php foreach( $filterValues as $filterValue ): ?>
                    <?php if( $filterName == 'categories' ): ?>
                        <li class="category__filter__item" filter_item="users" filter_by="category" filter_id="<?php echo $filterValue->id; ?>">
                            <span class="filter__link"><?php echo $filterValue->category_name; ?></span>
                        </li>
                    <?php else: ?>
                        <li class="category__filter__item" filter_item="users" filter_by="prof" filter_id="<?php echo $filterValue->id; ?>">
                            <span class="filter__link"><?php echo $filterValue->prof_name; ?></span>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="users__table">
<ul class="users__table__inner">
    
   <?php foreach ($users as $user): ?>
      <li class="users__table__item" data-link="home/person/<?php echo $user->id; ?>/">
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
</div>


<script>
   var users = document.querySelectorAll('.users__table__item');


   for ( let i = 0; i < users.length; i++ ) {
      users[i].addEventListener('click', function () {
         window.location.href = users[i].getAttribute('data-link');
      });
   }
</script>
