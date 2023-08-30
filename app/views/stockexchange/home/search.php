<?php $pagination_last_item = 0; ?>
<h2 class="serch__page__title"><span translation_slug="results_for" >Results for</span>:<span class="serch__page__title__result">≪<?php echo $search; ?>≫</span></h2>
<div class="searches">
   <?php foreach($searches as $key => $s): ?>
      <?php if ($key == 'users'): ?>        
         <?php if (count($s) > 0): ?>
            <h2 class="page__header"> <span translation_slug="users">Users</span>:</h2>
            <?php foreach( $s as $user ): ?>
               <div class="search__item users">
                  <img src="../app/custmfolders/<?php echo $user->dir_url; ?>/<?php echo $user->ava; ?>" class="search__image" alt="">
                  <div class="search__content">
                     <div class="search__title"><?php echo $user->fullname; ?></div>
                       <div class="search__after__content">
                           <div class="search__after__content__left users">
                              <?php if($user->category != ''): ?>
                                 <div class="search__tag">
                                    <?php echo $user->category; ?>
                                 </div>
                              <?php endif; ?>
                              <?php if ($user->prof != ''): ?>
                                 <div class="search__tag">
                                    <?php echo $user->prof; ?>
                                 </div>
                              <?php endif; ?>
                           </div>
                           <div class="search__after__content__right">
                              <a href="home/person/<?php echo $user->id; ?>" class="search__link"><span translation_slug="go_over" >go over</span>&rang;</a>
                           </div>
                        </div>
                     </div>
               </div>
            <?php endforeach; ?>
         <?php endif; ?>
      
     <?php elseif($key == 'works'): ?>
        <?php if (count($s) > 0): ?>
            <h2 class="page__header" >
                <span translation_slug="works">Works</span>:
            </h2>
            <?php foreach($s as $work): ?>
                <div class="search__item">
                    <div class="search__content ">
                        <div class="search__title">
                            <?php echo $work->title; ?>
                        </div>
                        <div class="search__text">
                            <?php echo $work->prev_text; ?>
                        </div>
                        <div class="search__after__content">
                            <div class="search__after__content__left">
                                <div class="search__date">
                                    <time datetime="21.06.2020"><?php echo TimeDate::TimeDateFormat('d.m.Y', $work->date); ?></time>
                                </div>
                                <?php if($work->category != ''): ?>
                                    <div class="search__tag">
                                       <?php echo $work->category; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="search__after__content__right">
                                <a href="home/work/<?php echo $work->id; ?>/" class="search__link"><span translation_slug="go_over" >go over</span>&rang;</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
   <!-- works -->
    <?php endif; ?><!-- if count works > 0 -->
    <?php elseif($key == 'posts'): ?>
        <?php if(count($s) > 0):  ?>
            <h2 class="page__header" >
                <span translation_slug="posts">Posts</span>:
            </h2>
            <?php  foreach($s as $post):  ?>
                <div class="search__item">
                    <div class="search__content">
                        <div class="search__title"><?php echo $post->title; ?></div>
                        <div class="search__after__content">
                            <div class="search__after__content__left">
                               <div class="search__date">
                                  <time datetime="21.06.2020"><?php echo TimeDate::TimeDateFormat('d.m.Y', $post->date); ?></time>
                               </div>
                               <?php foreach($post->tags as $tag):  ?>
                                   <div class="search__tag">
                                      <?php echo $tag; ?>
                                   </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="search__after__content__right">
                               <a href="home/post/<?php echo $post->id; ?>/" class="search__link"><span translation_slug="go_over" >go over</span>&rang;</a>
                            </div>

                         </div>
                    </div>
                </div>
        <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
</div>