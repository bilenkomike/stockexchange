<?php 
    $pagination = true; 
    $pagination_last_item = $works_count; 
    $location = $users_url;
    $page_num = $page_num;

?>

<div class="filter">
   <div class="filter__header" id="filter">
       <span translate translation_slug="filter">Filter</span>:<i class="fas fa-caret-right"></i>
   </div>
    <div class="filter__inner">
        <div class="filter__inner__content">
        <?php foreach( $filters as $filterName => $filterValues ): ?>

            <div class="filter__inner__header" translation_slug="<?php echo $filterName; ?>"><?php echo $filterName; ?></div>

            <ul class="category__filter">
                <?php foreach( $filterValues as $filterValue ): ?>
                    <?php if( $filterName == 'categories' ): ?>
                        <li class="category__filter__item" filter_item="works" filter_by="category" filter_id="<?php echo $filterValue->id; ?>">
                            <span class="filter__link"><?php echo $filterValue->category_name; ?></span>
                        </li>
                    <?php else: ?>
                        <li class="category__filter__item" filter_by="proffesions">
                            <span class="filter__link"><?php echo $filterValue->prof_name; ?></span>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="works" style="width: 100%;">
    <?php //print_arr($_SERVER['HTTP_HOST']); ?>
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
            <a href="home/work/<?php echo $work->id; ?>/" class="work__link"><span translation_slug="look_work">Look work</span> &rang;</a>
        </div>

    </div>
<?php endforeach; ?>
</div>
