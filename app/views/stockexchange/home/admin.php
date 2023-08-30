<!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->
<header class="admin__header">
	<div class="burger admin__burger" id="admin__nav__burger">
		<span class="burgermenu">fr</span>
		<span class="burgermenu">d</span>
		<span class="burgermenu">sfg</span>
	</div>
	<ul class="nav admin__nav">
		<li class="nav__item">
			<button class="btn nav__link admin__nav__btn" translate translation_slug="friends" data-page="1">friends</button>
		</li>
		<li class="nav__item">
			<button class="btn nav__link admin__nav__btn" translate translation_slug="works" data-page="2">works</button>
		</li>
		<li class="nav__item">
			<button class="btn nav__link admin__nav__btn" translate translation_slug="posts" data-page="3">posts</button>
		</li>
		<li class="nav__item">
			<button class="btn nav__link admin__nav__btn" translate translation_slug="cv" data-page="4">CV</button>
		</li>
		<li class="nav__item">
			<button class="btn nav__link admin__nav__btn" translate translation_slug="settings" data-page="5">Settings</button>
		</li>
		<li class="nav__item">
			<button class="btn nav__link admin__nav__btn" translate translation_slug="files" data-page="6">Files</button>
		</li>
	</ul>
	
</header>
<main class="admin__main" style="margin-top: 200px; ">
	<div class="admin__content" data-page__open="1">

		<ul class="breadcrumbs">
			<li class="breadcrumb  active friends__breadcrumb" id="fr-all" >
				All
			</li>
			<li class="breadcrumb friends__breadcrumb" id="fr-request">
				Requests
			</li>
			<li class="breadcrumb friends__breadcrumb" id="fr-declined">
				Declined
			</li>
		</ul>


		<div class="friends active" data-id="fr-all">
			
			<?php if( count($user->data()->friends) > 0 ): ?>
				<?php foreach($user->data()->friends as $friend):  ?>
					<div class="friend">
						<div class="friend__content">
							<div class="friend__ava">
							   
								<?php if($friend->ava): ?>
							               <img src="../app/custmfolders/<?php echo $friend->dir_url; ?>/<?php echo $friend->ava; ?>" class="friend__image" alt="">
							            <?php else:?>
							               <img class="friend__image" src="images/icons/user.png" alt="">
            							<?php endif; ?>
								<!-- <img src="../app/custmfolders/<?php echo $friend->dir_url; ?>/<?php echo $friend->ava; ?>" alt="" class="friend__image"> -->
							</div>
							<div class="friend__info">
								<div class="friend__name">
									<?php echo $friend->fullname; ?>
								</div>
								<ul class="friend__work">
									<li class="friend__work__item">
										<?php echo $friend->category; ?>
									</li>
									<li class="friend__work__item">
										<?php echo $friend->prof; ?>
									</li>
								</ul>
							</div>
							<div class="friend__actions">
								<span data-request="<?php echo $friend->id ?>" fr-actionable data-action="remove" class="friend__action remove">
										Remove friend
								</span>
								<a class="friend__action read" href="home/person/<?php echo $friend->id; ?>/">
									go over
								</a>
							</div>
						</div>		
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<!-- ./all friends -->
		</div>

		<div class="friends" data-id="fr-request">
			<?php if( count($requests) > 0 ): ?>
				<?php foreach($requests as $request): ?>
					<div class="friend">
						<div class="friend__content">
							<div class="friend__ava">
							     
								<?php if($request->from_user->ava): ?>
							               <img src="<?php echo $request->from_user->ava; ?>" class="friend__image" alt="">
							            <?php else:?>
							               <img class="friend__image" src="images/icons/user.png" alt="">
            							<?php endif; ?>
							</div>
							<div class="friend__info">
								<div class="friend__name">
									<?php echo $request->from_user->fullname; ?>
								</div>
								<ul class="friend__work">
									<li class="friend__work__item">
										<?php echo $request->from_user->category; ?>
									</li>
									<li class="friend__work__item">
										<?php echo $request->from_user->prof; ?>
									</li>
								</ul>
							</div>
							<div class="friend__actions">
								<div class="request">
									<span class="friend__action add" fr-actionable data-action="accept" data-request="<?php echo $request->from_user->id; ?>">
										Accept friend
									</span>
									<span class="friend__action remove" fr-actionable data-action="decline" data-request="<?php echo $request->from_user->id; ?>">
										Decline request
									</span>
								</div>
								<a class="friend__action read" href="home/person/<?php echo $request->from_user->id; ?>/">
									read
								</a>
							</div>
						</div>		
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		<!-- ./requesets__friends -->
		</div>
		<div class="friends" data-id="fr-declined">
			<?php if( count($declined) > 0 ): ?>
				<?php foreach($declined as $decline): ?>
					<div class="friend">
						<div class="friend__content">
							<div class="friend__ava">
								<?php if($friend->ava): ?>
							               <img src="../app/custmfolders/<?php echo $friend->dir_url; ?>/<?php echo $friend->ava; ?>" class="friend__image" alt="">
							            <?php else:?>
							               <img class="friend__image" src="images/icons/user.png" alt="">
            							<?php endif; ?>
							</div>
							<div class="friend__info">
								<div class="friend__name">
									<?php echo $decline->to_user->fullname; ?>
								</div>
								<ul class="friend__work">
									<li class="friend__work__item">
										<?php echo $decline->to_user->category; ?>
									</li>
									<li class="friend__work__item">
										<?php echo $decline->to_user->prof; ?>
									</li>
								</ul>
							</div>
							<div class="friend__actions">
								<span class="friend__action add" fr-actionable data-action="send" data-request="<?php echo $decline->to_user->id; ?>">
									Send request again
								</span>
								<a class="friend__action read" href="home/person/<?php echo $decline->to_user->id; ?>/">
									Go over
								</a>
							</div>
						</div>		
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

	</div>
	<div class="admin__content" data-page__open="2">
		<!-- works -->
		<ul class="breadcrumbs">
			<li class="breadcrumb  active works__breadcrumb" id="works-all">
				All
			</li>
			<li class="breadcrumb works__breadcrumb" id="works-request">
				Add
			</li>
		</ul>
		<div class="workss active" data-id="works-all">
			<?php //print_arr($works); ?>
			<?php foreach($works as $work): ?>
    <div class="work">
       <?php if(!$user_dir) { $dir = $work->user_dir; } else { $dir = $user_dir; }  ?>
        <div  class="work__image" style="background-image: url(<?php echo '../app/custmfolders/'.$dir.'/'.$work->image; ?>);"></div>
        <div class="work__content">
            <h1 class="work__title"><?php echo $work->title; ?></h1>
            <div class="work__category">
                Category: <?php echo $work->category; ?>
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
		<div class="work__look__item ">
			<i class="fas fa-thumbs-down" style="margin-right: 3px;"></i>  <?php echo $work->dislikes; ?>
		</div>
		<div class="work__look__item ">
			<i class="fas fa-eye" style="margin-right: 3px;"></i><?php echo $work->views; ?>
		</div>

            	<span wrk-actionabe data-action="edit" data-wrkid="<?php echo $work->id; ?>" class="work__edit__item">
            		<i class="fas fa-edit"></i>
            	</span>
            	<span wrk-actionabe data-action="remove" data-wrkid="<?php echo $work->id; ?>" class="work__edit__item">
            		<i class="fas fa-trash"></i>
            	</span>
            	
            </div>
            <a href="home/work/<?php echo $work->id; ?>/" class="work__link">Look work &rang;</a>
        </div>

    </div>
<?php endforeach; ?>
		</div>

	<div class="workss" data-id="works-request">
		<div class="works__add__form">
		<form action="home/admin/" class="workForm" method="POST" id="workForm" enctype="multipart/form-data">
		<div class="form__columns">
                    <input type="hidden" name="editWork" value="">
                    <div class="work__add__from--column">
			<div class="work__add__form__item">
				<img src="https://via.placeholder.com/380x550" id="imgWork" class="work__preview" alt="">
                    		<div class="work__preview__hover">
                    			<div class="work__preview__hover__content">
                    				<input type="file" id="workImage" name="workImage__preview">
                    				<label class="workLodImage" for="workImage"><i class="fas fa-file-import"></i></label>
                    			</div>
                    		</div>
			</div>                   		

                    </div><!--./work add form column-->


                    <div class="work__add__from--column">
                    	<input type="text" name="workName" autocomplete="off" class="input search" placeholder="Work name...">
                    	

                    	<input type="text" name="workCategory" class="input search" placeholder="Category..." list="workcategories">
                    	<datalist id="workcategories">
                    		<?php foreach( $categories as $category ): ?>
                    			<option value="<?php echo $category->category_name; ?>">
                    		<?php endforeach; ?>
                    	</datalist>

                    	<input type="text" name="" id="inputforWorkTags" multiple class="input search" placeholder="Tag..." list="workTags">
                    	
                    	<datalist id="workTags">
                    		<?php foreach( $tags as $tag ): ?>
                    			<option workoptions value="<?php echo $tag->tag; ?>">
                    		<?php endforeach; ?>
                    	</datalist>

                    	<ul class="workTags">
                    		<!-- <li class="workTags__item" id="IT">#IT </li> -->
                    	</ul>

                    	<input type="hidden" id="worktags" name="worktags">
                    	

                    	<textarea class="work__desc__area" name="WorkDesc" data-autoresize id="" cols="1" rows="1" placeholder="Work description"></textarea>

                    	<div class="work__choose__file">
                    		<div class="work__choose__file__item">
                    			<input class="Workradio" type="radio" id="work__url__type1" name="fileType" value="url">
                    			<label class="workChackbox" for="work__url__type1">
                    				<span class="workChackboxTick">✔</span>
                    			</label>
                    			<label for="work__url__type"> 
                    				<input type="text" name="workLink" class="input search" placeholder="Url to your work...">
                    			</label>
                    		</div>
                    		<div class="work__choose__file__item" >
                    			<input class="Workradio" type="radio" id="work__url__type2" name="fileType" value="file">
                    			<label class="workChackbox" for="work__url__type2">
                    				<span class="workChackboxTick">✔</span>
                    			</label>
                    			<label for="work__url__type"> 
                    				<input type="file" id="workZip" name="workZip" accept=".rar, .zip, .7z,">
                    				<label for="workZip"><span class="btn btn--mnsd btn--mnsd--blue" style="margin-top: 20px; white-space: width: 90%;max-width: 220px; cursor:pointer;">Load zip file of your work <i class="fas fa-hand-point-down"></i></span></label>
                    			</label>
                    		</div>
                    		
                    		

                    	</div>
                    	<!--./work add form column-->                    	
                    </div>
                    </div><!--./form__columns-->

                    		<textarea style="display: none;" name="work__content" id="work__content"></textarea>
                            <div class="richTextButtons">
                            	<!-- next previous action -->
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="undo"><i
                                        class="fas fa-undo"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="redo"><i
                                        class="fas fa-redo"></i></button>
                            	<!-- styles -->

                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="bold"><i
                                        class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="italic"><i
                                        class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="underline"><i
                                        class="fas fa-underline"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="strikeThrough"><i
                                        class="fas fa-strikethrough"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="justifyLeft"><i
                                        class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="justifyCenter"><i
                                        class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="justifyRight"><i
                                        class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd" data-cmd="justifyFull"><i
                                        class="fas fa-align-justify"></i></button>
                                
                                        <!-- lists -->
                                <button type="button" class="btn btn--textCommand execcmd"
                                    data-cmd="insertUnorderedList"><i class="fas fa-list-ul"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd"
                                    data-cmd="insertOrderedList"><i class="fas fa-list-ol"></i></button>


                                <button type="button" class="btn btn--textCommand execlink" data-cmd="createLink"><i
                                        class="fas fa-link"></i></button>
                                <select class="btn btn--textCommand select" data-cmd="formatBlock">
                                    <option value="H2">H1</option>
                                    <option value="H3">H2</option>
                                    <option value="H4">H3</option>
                                </select>
                                <button type="button" class="btn btn--textCommand" query-modal
                                    modal-call="content-append-modal"><i class="fas fa-file-image"></i></button>
                            </div>
                            <iframe id="richTextField" data-width="150ch" style="width: 100%; height: 1000px;" class="b mail__content--textfield"
                                name="richTextField" data-textarea="work__content">
                            </iframe>

                    <button class="btn btn--mnsd btn--mnsd--blue" type="submit" id="workSubmit" style="margin-top: 10px;">Add work</button>
                </form>
			</div>
		</div>	
	</div>

	<div class="admin__content" data-page__open="3">
		<ul class="breadcrumbs">
			<li class="breadcrumb  active posts__breadcrumb" id="posts-all">
				All
			</li>
			<li class="breadcrumb posts__breadcrumb" id="posts-request">
				Add
			</li>

		</ul>

		<div class="posts active" data-id="posts-all">
			<?php foreach ( $posts as $post ): ?>
				<div class="post" data-id="<?php echo $post->id; ?>">
					
					<div class="post__left">
						<h1 class="post__header">
							<?php echo $post->title; ?>
						</h1>
						<div class="post__info">
							<time datetime="2021.10.01 13:15:00" class="post__date" ><?php echo TimeDate::TimeDateFormat('Y.m.d H:i:s',$post->date); ?></time>
							<?php foreach($post->tags as $tag): ?>
								<div class="post__info__item"><?php echo $tag; ?></div>
							<?php endforeach; ?>

						</div>
					</div>
					<div class="post__right">
						<div class="post__info">
							<div class="post__info__item">
								<i class="fas fa-eye" style="margin-right: 3px;"></i>  <?php echo $post->views; ?>
							</div>
						</div>
						<div class="post__actions">
							<span pst-actionabe data-action="edit" data-pstid="<?php echo $post->id; ?>" class="post__action__link">
            							<i class="fas fa-edit"></i>
            						</span>
            						<span pst-actionabe data-action="remove" data-pstid="<?php echo $post->id; ?>" class="post__action__link">
            							<i class="fas fa-trash"></i>
            						</span>
						</div>
					</div>
					
				</div>
			<?php endforeach; ?>
			
		</div>
		<div class="posts" data-id="posts-request">
			<div class="posts__add__form">
		<form action="home/admin/" class="postForm" method="POST" id="postForm" enctype="multipart/form-data">
					<div class="form__columns">
                    <input type="hidden" name="editPost" value="">
                    <div class="post__add__from--column">
			<div class="post__add__form__item">
				<img src="https://via.placeholder.com/175x200" id="imgPost" class="post__preview" style="" alt="">
                    		<div class="post__preview__hover">
                    			<div class="post__preview__hover__content" >
                    				<input type="file" id="postImage" name="postImage__preview">
                    				<label class="postLodImage" for="postImage"><i class="fas fa-file-import"></i></label>
                    			</div>
                    		</div>
			</div>                   		

                    </div><!--./work add form column-->


                    <div class="post__add__from--column">
                    	<input type="text" name="postName" autocomplete="off" class="input search" placeholder="Post title...">
                    	<input type="text" name="" id="inputforPostTags" multiple class="input search" placeholder="Tag..." list="postTags">
                    	<datalist id="postTags">
                    		<?php foreach( $tags as $tag ): ?>
                    			<option postoptions value="<?php echo $tag->tag; ?>">
                    		<?php endforeach; ?>
                    	</datalist>

                    	<ul class="postTags">
                    		<!-- <li class="postTags__item" id="IT">#IT </li> -->
                    	</ul>

                    	<input type="hidden" id="posttags" name="posttags">
                    	<!--./work add form column-->

                    	
                    </div>
                    </div><!--./form__columns-->



                    		<textarea style="display: none;" name="post__content" id="post__content"></textarea>
                            <div class="richTextButtons">
                            	<!-- next previous action -->
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="undo"><i
                                        class="fas fa-undo"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="redo"><i
                                        class="fas fa-redo"></i></button>
                            	<!-- styles -->

                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="bold"><i
                                        class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="italic"><i
                                        class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="underline"><i
                                        class="fas fa-underline"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="strikeThrough"><i
                                        class="fas fa-strikethrough"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="justifyLeft"><i
                                        class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="justifyCenter"><i
                                        class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="justifyRight"><i
                                        class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2" data-cmd="justifyFull"><i
                                        class="fas fa-align-justify"></i></button>
                                
                                        <!-- lists -->
                                <button type="button" class="btn btn--textCommand execcmd2"
                                    data-cmd="insertUnorderedList"><i class="fas fa-list-ul"></i></button>
                                <button type="button" class="btn btn--textCommand execcmd2"
                                    data-cmd="insertOrderedList"><i class="fas fa-list-ol"></i></button>


                                <button type="button" class="btn btn--textCommand execlink2" data-cmd="createLink"><i
                                        class="fas fa-link"></i></button>
                                <select class="btn btn--textCommand select2" data-cmd="formatBlock">
                                    <option value="H2">H1</option>
                                    <option value="H3">H2</option>
                                    <option value="H4">H3</option>
                                </select>
                                <button type="button" class="btn btn--textCommand" query-modal
                                    modal-call="content-append-modal2"><i class="fas fa-file-image"></i></button>
                            </div>
                            <iframe id="richTextField2" data-width="150ch" style="width: 100%; height: 1000px;" class="b mail__content--textfield"
                                name="richTextField2" data-textarea="post__content">
                            </iframe>



                    <textarea style="display: none;" name="" id="post__content"></textarea>
                   
                    <button class="btn btn--mnsd btn--mnsd--blue" type="submit" id="postSubmit" style="margin-top: 10px;">Add post</button>
                </form>
			</div>
		</div>
	</div>
	<div class="admin__content" data-page__open="4">
		<div class="cv">
			<form action="home/admin/" id="cv__form" method="POST" enctype="multipart/form-data">
				
				<h1 class="cv__header">
					Update your CV
				</h1>
				<div class="cv__content">
					<div class="cv__content__item">
						<div class="cv__personal">
							<div class="cv__personal__item">
								<input type="file" name="cv__ava">
								 <?php if($user->data()->ava): ?>
							               <img src="../app/custmfolders/<?php echo $user->data()->dir_url; ?>/<?php echo $user->data()->ava; ?>" class="cv__image" alt="">
							               <input type="hidden" name="cv__ava" value="http://localhost:8888/stockexchange/app/custmfolders/<?php echo $user->data()->dir_url; ?>/<?php echo $user->data()->ava; ?>">
							            <?php endif; ?>

							</div>
							<div class="cv__personal__item">
								<div class="cv__input__gruop">
									<input type="text" id="cvName" name="cv__name" class="input search cv__input" placeholder="Your name..." value="<?php echo $cv->name; ?>">
								</div>
								<div class="cv__input__gruop">
									<input type="text" id="cvSurname" name="cv__surname" class="input search cv__input" placeholder="Your surname..." value="<?php echo $cv->surname; ?>">
								</div>

								<div class="cv__input__gruop">
									<input type="text" id="cvPatronymic" name="cv__patronymic" class="input search cv__input" placeholder="Your patronymic..." value="<?php echo $cv->patronymic; ?>">
								</div>
								<div class="cv__input__gruop">
									<input type="tel" id="cvTelephone" name="cv__phone" class="input search cv__input" placeholder="Your telephone number..." value="<?php echo $cv->phone; ?>">
								</div>
								
								<div class="cv__select birth__select">
									<!-- date -->
									<input type="hidden" name="cv__date__birth">
									<!-- date -->
									<div class="cv__birth">
									<div class="cv__select__item">
										<span class="cv__select__header" for="Byear"><span class="CVtext__header">Year of birth:<div class="val"><?php echo $cv->birth__year; ?></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="Byear">
											<input type="hidden" name="Byear" value="<?php echo $cv->birth__year; ?>">
											<div class="cv__select__list__option">
												
											</div>
											<?php for ( $i = date('Y') ; $i >= 1980; $i--): ?>
											<div class="cv__select__list__option">
												<?php echo $i; ?>
											</div>
											<?php endfor; ?>
										</div>
									</div>
									<div class="cv__select__item">
										<span class="cv__select__header" for="Bmonth"><span class="CVtext__header">Month of birth:<div class="val"><?php echo $cv->birth__month; ?></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="Bmonth">
											<input type="hidden" name="Bmonth" value="<?php echo $cv->birth__month; ?>">
											<div class="cv__select__list__option">
												
											</div>
											<?php $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
												foreach ( $months as $month ):
											?>

											<div class="cv__select__list__option">
												<?php echo $month; ?>
											</div>
											<?php endforeach; ?>
										</div>
									</div>
									<div class="cv__select__item">
										<span class="cv__select__header" for="Bday"><span class="CVtext__header">Day of birth: <div class="val"><?php echo $cv->birth__day; ?></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="Bday">
											<input type="hidden" name="Bday" value="<?php echo $cv->birth__day; ?>">
											<div class="cv__select__list__option">
												
											</div>
											<?php for($i = 1; $i <= 31; $i++): ?>
												<div class="cv__select__list__option">
													<?php echo $i; ?>
												</div>
											<?php endfor; ?>
										</div>
									</div>
									</div>
								</div>
								
								
							</div>
						</div><!--./cv personal-->
						<div class="cv__personal">
							<div class="cv__personal__item">
								<div class="cv__select">
								<div class="cv__select__item">
											<span class="cv__select__header" for="cv__lang"><span class="CVtext__header">Lang: <div class="val"><?php echo strtoupper($cv->lang); ?></div></span><i class="fas fa-caret-right"></i></span>
											<div class="cv__select__list" id="cv__lang">
										<input type="hidden" name="cv__lang" value="<?php echo strtoupper($cv->lang); ?>">
										<?php foreach($langs as $lang): ?>
											<div class="cv__select__list__option">
													<?php echo strtoupper($lang->lang); ?>
											</div>
										<?php endforeach; ?>
									</div>
								</div>

								<div class="cv__select__item" >
											<span class="cv__select__header" for="cvGender"><span class="CVtext__header">Gender: <div class="val"><?php echo $cv->gender; ?></div></span><i class="fas fa-caret-right"></i></span>
											<div class="cv__select__list" id="cvGender">
												<input type="hidden" name="cvGender" value="<?php echo $cv->gender; ?>">
												<div class="cv__select__list__option">
													
												</div>
												
												<div class="cv__select__list__option">
													Male
												</div>
												<div class="cv__select__list__option">
													Female
												</div>
											</div>
										</div>
							</div>
							</div>
						</div>
					</div>
					<div class="cv__content__item">
						<div class="cv__personal">
							<div class="cv__personal__item">
								<div class="cv__input__gruop">
									<!-- <label for="cvEmail" class="cv__input__header">Email:</label> -->
									<input autocomplete="off" type="email" id="cvEmail" name="cv__email" class="input search cv__input" placeholder="Your Email..." value="<?php echo $cv->email; ?>">
								</div>
								<div class="cv__input__gruop">
									<!-- <label for="cvCountry" class="cv__input__header">Country:</label> -->
									<input autocomplete="off" type="text" name="cv__country" id="cvCountry" class="input search cv__input" placeholder="Your Country..." value="<?php echo $cv->country; ?>">
								</div>
								<div class="cv__input__gruop">

									<!-- <label for="cvAddress" class="cv__input__header">Address:</label> -->
									<input autocomplete="off" type="adress" id="cvAddress" name="cv__address" class="input search cv__input" placeholder="Your Address..." value="<?php echo $cv->adress; ?>">
								</div>
								<div class="cv__input__gruop">
									
									<!-- <label for="cvLinkedin" class="cv__input__header">Linkedin:</label> -->
									<input autocomplete="off" type="url" id="cvLinkedin" name="cv__linkedin__link" class="input search cv__input" placeholder="Your Linkedin url..." value="<?php echo $cv->linkedin__link; ?>">
								</div>
								<div class="cv__input__gruop">
									
									<!-- <label for="cvPinterest" class="cv__input__header">Facebook:</label> -->
									<input autocomplete="off" type="url" id="cvFacebook" name="cv__facebook__link" class="input search cv__input" placeholder="Your Facebook..." value="<?php echo $cv->fb__link; ?>">
								</div>
								

							</div>
							<div class="cv__personal__item">
								<div class="cv__input__gruop">
									<!-- <label for="cvCity" class="cv__input__header">City:</label> -->
									<input type="text" id="cvCity" name="cv__city" class="input search cv__input" placeholder="Your City..." value="<?php echo $cv->city; ?>">
								</div>
								<!-- <div class="cv__input__gruop">
									<label for="cvCity" class="cv__input__header">City:</label>
									<input type="text" id="cvCity" class="input search cv__input" placeholder="Your City...">
								</div> -->
								<div class="cv__input__gruop">
									
									<!-- <label for="cvPstCd" class="cv__input__header">Postal Code:</label> -->
									<input autocomplete="off" type="adress" id="cvPstCd" name="cv__postal" class="input search cv__input" placeholder="Your Postal Code..." value="<?php echo $cv->postal__code; ?>">
								</div>
								<div class="cv__input__gruop">
									<!-- <label for="cvCity" class="cv__input__header">City:</label> -->
									<input type="text" id="cv__profeccion" name="cv__profeccion" class="input search cv__input" placeholder="Your Proffesion..." value="<?php echo $cv->proffecion ?>">
								</div>
								<div class="cv__input__gruop">
									
									<!-- <label for="cvInstagram" class="cv__input__header">Instagram:</label> -->
									<input autocomplete="off" type="url" id="cvInstagram" name="cv__instagram__link" class="input search cv__input" placeholder="Your Instagram url..." value="<?php echo $cv->instagram__link; ?>">
								</div>
								<div class="cv__input__gruop">
									
									<!-- <label for="cvInstagram" class="cv__input__header">Git hab:</label> -->
									<input autocomplete="off" type="url" id="cvInstagram" class="input search cv__input" name="cv__githab__link" placeholder="Your GitHub..." value="<?php echo $cv->githab__link; ?>">
								</div>
								<div class="cv__input__gruop">
									<div class="cv__select cv__select__gender">
										
									</div>
								</div>

							</div>
						</div>
						<div class="cv__input__gruop">
							<div class="cv__personal">
								<div class="cv__personal__item">
									<div class="cv__input__gruop">
										<?php $skill_levels = json_decode($cv->skills_level,true); ?>
										
										<input autocomplete="off" type="url" id="cvSkills" name="cv__skill__select" class="input search cv__input" placeholder="Your Skills..." list="skills__options">
										<datalist id="skills__options">
											<?php foreach( $tags as $tag ): ?>
                    							<option skilloption value="<?php echo $tag->tag; ?>">
                    						<?php endforeach; ?>
										</datalist>

										<ul class="skills">
											<?php if(count($cv->skills) > 0): ?>
												<?php foreach($cv->skills as $skill): ?>
													<li class="skills__item" id="<?php echo $skill; ?>">
														<?php echo $skill; ?><i class="fas fa-times" aria-hidden="true"></i>

													</li>
													<div class="cv__select__item cv__level__select" data-skills-select="<?php echo str_replace(' ','',$skill); ?>">
											<span class="cv__select__header" for="cv__skill__level__<?php echo str_replace(' ','',$skill); ?>"><span class="CVtext__header">Select level: <div class="val"><?php echo $skill_levels[$skill]; ?></div></span><i class="fas fa-caret-right"></i></span>
											<div class="cv__select__list" id="cv__skill__level__<?php echo str_replace(' ','',$skill); ?>">
												<input type="hidden" name="cv__skill__level__<?php echo str_replace(' ','',$skill); ?>" value="<?php echo $skill_levels[$skill]; ?>">												
												<div class="cv__select__list__option">
													1
												</div>
												<div class="cv__select__list__option">
													2
												</div>
												<div class="cv__select__list__option">
													3
												</div>
												<div class="cv__select__list__option">
													4
												</div>
											</div>
										</div>

												<?php endforeach; ?>
											<?php endif; ?>
				                    	</ul>

				                    	<input type="hidden" id="skills" name="skills" value="<?php echo $cv->skills_urls; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="cv__input__gruop">
							<label for="" class="cv__input__header">Short Description of yourself:</label>
				             <textarea style="display: none;" name="cv__description__content" id="cv__description__content"><?php echo $cv->description; ?></textarea>
                            <div class="richTextButtons">
                            	<!-- next previous action -->
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="undo"><i
                                        class="fas fa-undo"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="redo"><i
                                        class="fas fa-redo"></i></button>
                            	<!-- styles -->

                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="bold"><i
                                        class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="italic"><i
                                        class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="underline"><i
                                        class="fas fa-underline"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="strikeThrough"><i
                                        class="fas fa-strikethrough"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="justifyLeft"><i
                                        class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="justifyCenter"><i
                                        class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="justifyRight"><i
                                        class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc" data-cmd="justifyFull"><i
                                        class="fas fa-align-justify"></i></button>
                                
                                        <!-- lists -->
                                <button type="button" class="btn btn--textCommand execcmdDesc"
                                    data-cmd="insertUnorderedList"><i class="fas fa-list-ul"></i></button>
                                <button type="button" class="btn btn--textCommand execcmdDesc"
                                    data-cmd="insertOrderedList"><i class="fas fa-list-ol"></i></button>
                            </div>
                            <iframe id="richTextField_description" data-width="150ch" style="width: 100%; height: 250px;" class="b mail__content--textfield"
                                name="richTextField_description" data-textarea="cv__description__content">
                            </iframe>					
						</div>


					</div><!--./cv__content__item-->




					<!-- main content beggin  -->
					<div class="cv__content__gruop">
						<h1 class="cv__gruop__header" id="studie__content">
							Education
							<input type="hidden" id="cv__education__ids" name="cv__education__ids" value="<?php echo $cv->educ_urls; ?>"> <!-- value = e1/e2/e17/ -->
						</h1>
						<div class="cv__gruop__content">
							<div class="cv__gruop__content__item studies__content">
								<div class="studies">
									<!-- ${cv__schoolName} || ${cv__schoolLocation} || ${cv__schoolMonthStart} -- ${cv__schoolYearStart} || ${cv__schoolMonthEnd} -- ${cv__schoolYearEnd} || ${cv__schoolDescription} -->
									<?php if(count($cv->education) > 0 ): ?>
										<?php foreach($cv->education as $educId => $educ): ?>
										
										<div class="added__content__item" id="<?php echo $educId; ?>">
											<div class="added__content__item__info">
												<div class="added__content__item__header">	
													<?php echo $educ['name']; ?>
												</div>
												<div class="added__content__item__info__locdate">
												<div class="studies__content__item__date">
												<?php echo $educ['start__date'][0]; ?> 
												 <?php echo $educ['start__date'][1]; ?>
												- <?php echo $educ['end__date'][0]; ?>  <?php echo $educ['end__date'][1]; ?></div>
												<div class="studies__content__item__location">	
													<i class="fas fa-map-marker-alt"></i>
													<?php echo $educ['location']; ?>
													
												</div>
												</div>
											</div>
											<input type="hidden" name="<?php echo $educId; ?>" value="<?php echo $educ['name'] . " || " . $educ['location'] . " || " . $educ['start__date'][0] . " -- " . $educ['start__date'][1] . " || " . $educ['end__date'][0] . " -- " . $educ['end__date'][1] . " || " . $educ['description']; ?>">
											<div class="added__content__item__actins">
											<div action-education data-action-education="edit" education_element_id="<?php echo $educId; ?>" class="added__content__item__actins__item">
											<i class="fas fa-pen"></i>
											</div>
											<div action-education data-action-education="remove" education_element_id="<?php echo $educId; ?>" class="added__content__item__actins__item">
											<i class="fas fa-trash-alt"></i></div></div>
										</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								
								
							<div class="cv__forms" data-studies="yes">


							<div class="cv__studies__form">
								<h1 class="studies__header">Add Education</h1>
								<form action="" id="education">
									<div class="cv__personal">
									<div class="cv__personal__item">
										<div class="cv__input__gruop">
											<!-- <label for="cvEmail" class="cv__input__header">School Name:</label> -->
											<input autocomplete="off" type="text" id="cvEmail" name="cv__schoolName" class="input search cv__input" placeholder="School Name...">
										</div>
										<div class="cv__select">
											<div class="cv__select__item">
										<span class="cv__select__header" for="School__month__start"><span class="CVtext__header"> Month From:<div class="val"></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="School__month__start">
											<input type="hidden" name="School__month__start" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
												foreach ( $months as $month ):
											?>

											<div class="cv__select__list__option">
												<?php echo $month; ?>
											</div>
											<?php endforeach; ?>
										</div>
									</div>
										<div class="cv__select__item">
										<span class="cv__select__header" for="School__year__start"><span class="CVtext__header">Year From:<div class="val"></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="School__year__start">
											<input type="hidden" name="School__year__start" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php for ( $i = date('Y') ; $i >= 1980; $i--): ?>
											<div class="cv__select__list__option">
												<?php echo $i; ?>
											</div>
											<?php endfor; ?>
										</div>
									</div>
									

									
									</div>
									</div>
									<div class="cv__personal__item">
										<div class="cv__input__gruop">
											<!-- <label for="cvEmail" class="cv__input__header">School Location:</label> -->
											<input autocomplete="off" type="text" id="cvEmail" name="cv__schoolLocation" class="input search cv__input" placeholder="Your School location...">
										</div>
										<div class="cv__select">
											<div class="cv__select__item">
										<span class="cv__select__header" for="School__month__end"><span class="CVtext__header">Select month:<div class="val"></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="School__month__end">
											<input type="hidden" name="School__month__end" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
												foreach ( $months as $month ):
											?>

											<div class="cv__select__list__option">
												<?php echo $month; ?>
											</div>
											<?php endforeach; ?>
										</div>
									</div>
										<div class="cv__select__item">
										<span class="cv__select__header" for="School__year__end">
											<span class="CVtext__header">Select year:
												<div class="val"></div>
											</span>
											<i class="fas fa-caret-right"></i>
										</span>
										<div class="cv__select__list" id="School__year__end">
											<input type="hidden" name="School__year__end" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php for ( $i = date('Y') ; $i >= 1980; $i--): ?>
											<div class="cv__select__list__option">
												<?php echo $i; ?>
											</div>
											<?php endfor; ?>
										</div>
									</div>
									
									
									</div>
									</div>
								</div>
								<label for="" class="cv__input__header">Short Description of your self:</label>
							<!-- <textarea style="display: none;" name="cv__description__content" id="cv__description__content"></textarea> -->
				             <textarea style="display: none;" name="cv__education__content" id="cv__education__content"></textarea>
                            <div class="richTextButtons">
                            	<!-- next previous action -->
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="undo"><i
                                        class="fas fa-undo"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="redo"><i
                                        class="fas fa-redo"></i></button>
                            	<!-- styles -->

                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="bold"><i
                                        class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="italic"><i
                                        class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="underline"><i
                                        class="fas fa-underline"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="strikeThrough"><i
                                        class="fas fa-strikethrough"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="justifyLeft"><i
                                        class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="justifyCenter"><i
                                        class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="justifyRight"><i
                                        class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc" data-cmd="justifyFull"><i
                                        class="fas fa-align-justify"></i></button>
                                
                                        <!-- lists -->
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc"
                                    data-cmd="insertUnorderedList"><i class="fas fa-list-ul"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandEduc execcmdEduc"
                                    data-cmd="insertOrderedList"><i class="fas fa-list-ol"></i></button>
                            </div>
                            <iframe id="richTextField_education" data-width="150ch" style="width: 100%; height: 250px;" class="b mail__content--textfield"
                                name="richTextField_education" data-textarea="cv__education__content">
                            </iframe>	
                            <input type="checkbox" style="display: none;" name="edit__Education_block" value="">
								<div class="cv__button__gruop">
									<button type="button" class="btn cv__button cv__button--red" cv-action data-cv-content-type="education" cv-content-action="remove">Clear</button>
									<button type="button" class="btn cv__button cv__button--green" cv-action data-cv-content-type="education" cv-content-action="save">Save</button>

								</div>
								</form>
									
								
							</div>							
							<!--./form add to cv-->


							</div>
						</div>
						</div>
					</div>


					<!-- main content beggin  -->
					<div class="cv__content__gruop">
						<h1 class="cv__gruop__header" id="studie__content">
							Previous experience
							<input type="hidden" id="cv__exeprins__ids" name="cv__exeprins__ids" value="<?php echo $cv->exper_urls; ?>"> <!-- value = exp1/exp2/exp17/ -->
						</h1>
						<div class="cv__gruop__content">
							<div class="cv__gruop__content__item studies__content">
								<div class="previousexperience">
									<?php if(count($cv->experience) > 0): ?>
										<?php foreach($cv->experience as $keye => $exper): ?>
											<div class="added__content__item" id="<?php echo $keye; ?>">
												<div class="added__content__item__info">
													<div class="added__content__item__header"><?php echo $exper['nameCompany']; ?></div>
													<div class="added__content__item__header position"><?php echo $exper['positionCompany']; ?></div>
													<div class="added__content__item__info__locdate">
														<div class="studies__content__item__date">
															<?php echo $exper['start__dateCompany'][0]; ?>

															<?php echo $exper['start__dateCompany'][1]; ?>
																- <?php echo $exper['end__dateCompany'][0]; ?> <?php echo $exper['end__dateCompany'][1]; ?>
														</div>
														<div class="studies__content__item__location">
															<i class="fas fa-map-marker-alt"></i>
																<?php echo $exper['locationCompany']; ?>
														</div>
																	
													</div>
												</div>
												<input type="hidden" name="<?php echo $keye; ?>" value=" <?php echo $exper['nameCompany'] . " -- " . $exper['positionCompany'] . " || " . $exper['locationCompany'] ." || " . $exper['start__dateCompany'][0] . " -- " . $exper['start__dateCompany'][1] ." || " . $exper['end__dateCompany'][0] . " -- " . $exper[
												'end__dateCompany'][1] ." || " . $exper['descriptionCompany']; ?> ">
												<div class="added__content__item__actins">
													<div action-experience data-action-experience="edit" experience_element_id="<?php echo $keye; ?>" class="added__content__item__actins__item">
													<i class="fas fa-pen"></i>
												</div>
												<div action-experience data-action-experience="remove" experience_element_id="<?php echo $keye; ?>" class="added__content__item__actins__item">
													<i class="fas fa-trash-alt"></i>
												</div>
												</div>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								
								
							<div class="cv__forms" data-studies="yes">


							<div class="cv__studies__form">
								<h1 class="studies__header">Add Work Experience</h1>
								<form action="" id="education">
									<div class="cv__personal">
									<div class="cv__personal__item">
										<div class="cv__input__gruop">
											<!-- <label for="cvCompName" class="cv__input__header">Company Name:</label> -->
											<input autocomplete="off" type="text" id="cvCompName" name="cv__companyName" class="input search cv__input" placeholder="Company Name...">
										</div>
										
									</div>
									<div class="cv__personal__item">
										<div class="cv__input__gruop">
											<!-- <label for="cvCompLocation" class="cv__input__header">Company Location:</label> -->
											<input autocomplete="off" type="text" id="cvCompLocation" name="cv__companyLocation" class="input search cv__input" placeholder="Company location...">
										</div>

									</div>
								</div>
								<div class="cv__personal">
									<div class="cv__personal__item">
										<div class="cv__input__gruop">
											
											<input autocomplete="off" type="text" id="cvCompPosition" name="cv__companyPosition" class="input search cv__input" placeholder="Position in Company...">
										</div>
									</div>
								</div>

								<div class="cv__personal">
									<div class="cv__personal__item">
										<div class="cv__select">
											<div class="cv__select__item">
										<span class="cv__select__header" for="Company__month__start"><span class="CVtext__header">Month From:<div class="val"></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="Company__month__start">
											<input type="hidden" name="Company__month__start" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
												foreach ( $months as $month ):
											?>

											<div class="cv__select__list__option">
												<?php echo $month; ?>
											</div>
											<?php endforeach; ?>
										</div>
									</div>
										<div class="cv__select__item">
										<span class="cv__select__header" for="Company__year__start"><span class="CVtext__header">Year From:<div data-val="Company__year__start" class="val"></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="Company__year__start">
											<input type="hidden" name="Company__year__start" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php for ( $i = date('Y') ; $i >= 1980; $i--): ?>
											<div class="cv__select__list__option">
												<?php echo $i; ?>
											</div>
											<?php endfor; ?>
										</div>
									</div>
									</div>
									</div>
									<div class="cv__personal__item">
										<div class="cv__select">
											<div class="cv__select__item">
										<span class="cv__select__header" for="Company__month__end"><span class="CVtext__header">Month to:<div class="val"></div></span><i class="fas fa-caret-right"></i></span>
										<div class="cv__select__list" id="Company__month__end">
											<input type="hidden" name="Company__month__end" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
												foreach ( $months as $month ):
											?>

											<div class="cv__select__list__option">
												<?php echo $month; ?>
											</div>
											<?php endforeach; ?>
										</div>
									</div>
										<div class="cv__select__item">
										<span class="cv__select__header" for="Company__year__end">
											<span class="CVtext__header">Year to:
												<div class="val"></div>
											</span>
											<i class="fas fa-caret-right"></i>
										</span>
										<div class="cv__select__list" id="Company__year__end">
											<input type="hidden" name="Company__year__end" value="">
											<div class="cv__select__list__option">
												
											</div>
											<?php for ( $i = date('Y') ; $i >= 1980; $i--): ?>
											<div class="cv__select__list__option">
												<?php echo $i; ?>
											</div>
											<?php endfor; ?>
										</div>
									</div>
									
									
									</div>
									</div>


								</div>


								<label for="" class="cv__input__header">Short Description of Work you was working on:</label>
							<!-- <textarea style="display: none;" name="cv__description__content" id="cv__description__content"></textarea> -->
				             <textarea style="display: none;" name="cv__experience__content" id="cv__experience__content"></textarea>
                            <div class="richTextButtons">
                            	<!-- next previous action -->
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="undo"><i
                                        class="fas fa-undo"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="redo"><i
                                        class="fas fa-redo"></i></button>
                            	<!-- styles -->

                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="bold"><i
                                        class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="italic"><i
                                        class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="underline"><i
                                        class="fas fa-underline"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="strikeThrough"><i
                                        class="fas fa-strikethrough"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="justifyLeft"><i
                                        class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="justifyCenter"><i
                                        class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="justifyRight"><i
                                        class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper" data-cmd="justifyFull"><i
                                        class="fas fa-align-justify"></i></button>
                                
                                        <!-- lists -->
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper"
                                    data-cmd="insertUnorderedList"><i class="fas fa-list-ul"></i></button>
                                <button type="button" class="btn btn--textCommand btn--textCommandExper execcmdExper"
                                    data-cmd="insertOrderedList"><i class="fas fa-list-ol"></i></button>
                            </div>
                            <iframe id="richTextField_experience" data-width="150ch" style="width: 100%; height: 250px;" class="b mail__content--textfield"
                                name="richTextField_experience" data-textarea="cv__experience__content">
                            </iframe>	
                            <input type="checkbox" style="display: none;" name="edit__Experience_block" value="">
								<div class="cv__button__gruop">
									<button type="button" class="btn cv__button cv__button--red" cv-action data-cv-content-type="experience" cv-content-action="remove">Clear</button>
									<button type="button" class="btn cv__button cv__button--green" cv-action data-cv-content-type="experience" cv-content-action="save">Save</button>
								</div>
								</form>
									
								
							</div>							
							<!--./form add to cv-->


							</div>
						</div>
						</div>
					</div>


					<button type="submit" id="cv__save__button" class="btn btn--mnsd btn--mnsd--blue">Save</button>
				</div>

			</form>
		</div>
	</div>
	<!-- profile -->
	<div class="admin__content" data-page__open="5">
		<form action="home/admin/" method="POST" id="profile__form" enctype="multipart/form-data">
		<h1 class="page__title">Profile</h1>
		<div class="profile">

			<div class="profile__left">
				<input type="text" name="username" autocomplete="off" class="input" placeholder="User name ..." value="<?php echo escape($user->data()->username); ?>">

				<input type="text" autocomplete="off" class="input" placeholder="Name and Surname ..." value="<?php echo escape($user->data()->fullname); ?>" name="fullname">

				<input type="text" autocomplete="off" class="input" placeholder="Email ..." name="email" value="<?php echo escape($user->data()->email); ?>">

				<input type="text"  autocomplete="off" name="prof" placeholder="Proffession ..." list="profs" class="input" value="<?php echo escape($user->data()->prof); ?>">

				<datalist id="profs">
					<?php foreach($profs as $prof): ?>
						<option value="<?php echo escape($prof->prof_name);?>">
					<?php endforeach; ?>
				</datalist>

				<input type="text" autocomplete="off" class="input" placeholder="Work category ..." name="category" value="<?php echo escape($user->data()->category); ?>" list="categories">
				<datalist id="categories"> 
					<?php foreach($categories as $category): ?>
						<option value="<?php echo escape($category->category_name); ?>">
					<?php endforeach; ?>
				</datalist>

				<input type="hidden" autocomplete="off" name="token" value="<?php echo Token::generate(); ?>">
				
				<span style="display: none;" id="AboutUser"></span>
				<!-- data-autoresize -->
				<textarea type="text" name="about__user" autocomplete="off" data-autoresize  class="input textarea" placeholder="Short description of yourself..."><?php echo escape($user->data()->about_user); ?></textarea>
				<input type="text" name="linkedin" autocomplete="off" placeholder="linkegin url..." class="input" value="<?php echo escape($user->data()->linkedin); ?>">
				<input type="text" name="facebook" autocomplete="off" placeholder="Facebook url..." class="input" value="<?php echo escape($user->data()->facebook); ?>">
				<input type="text" name="instagram" autocomplete="off" placeholder="Instagram url..." class="input" value="<?php echo escape($user->data()->instagram); ?>">
				<input type="text" name="gitHub" autocomplete="off" class="input" placeholder="Git hub url..." value="<?php echo escape($user->data()->gitHub); ?>">
				<a href="home/reset/" class="reg__link" style="margin-top: 20px;">Change password</a>
				<a href="http://localhost:8888/stockexchange/app/api/index.html?cv_hash=<?php echo $user->data()->dir_url; ?>" class="reg__link" target="_blank" style="margin-top: 20px;">Look your cv</a>
			</div><!--/.profile__left-->

		<div class="profile__right">
			<?php if(empty(escape($user->data()->ava))):?>
			    <div style="background-image: url(images/icons/user.png);" class="avatar"></div>
			
			<?php else: ?>
				<div style="background-image: url(<?php echo '../app/custmfolders/'.$user->data()->dir_url.'/'; ?><?php echo escape($user->data()->ava); ?>);" class="avatar"></div>
			<?php endif; ?>

			<input type="file" name="avatar" id="btn--loadavater">
			<label class="btn btn--mnsd btn--mnsd--black" style="max-width: 150px;white-space: nowrap; margin: 0 60px;" for="btn--loadavater">Upload avatar</label>

			<br>

			<label for="" class="loader__profile__preview">Load your preview image:</label>
			<?php if(!$user->data()->preview__image):?>
				<img src="https://via.placeholder.com/150" class="sidebar__header__image" alt="">
			<?php else: ?>
				<img src="<?php echo '../app/custmfolders/'.$user->data()->dir_url.'/configs/' . $user->data()->preview_image_url; ?>" class="sidebar__header__image" alt="">
			<?php endif; ?>

			<input type="file" name="preview__image" id="btn--loadpreview">
			<label class="btn btn--mnsd btn--mnsd--black" style="max-width: 150px;white-space: nowrap; margin: 0 60px;" for="btn--loadpreview">Upload preview</label>
		</div>
		<button class="btn btn--mnsd btn--mnsd--blue" style="margin: 15px auto;" type="Submit" name="save__profile" value="save__profile">SAVE</button><br>
		
	</div>
	</form>
	</div>
	<!-- ./profile -->
	<div class="admin__content" data-page__open="6">
		<div class="page__title">File Mannager</div>
		<!-- directory contents -->

		<header class="file__manager__header">
			<div class="file__manager__filter">
				
			</div>

			<form action="home/admin/" method='POST' enctype="multipart/form-data" id="imageloadformmanager"> 
				<input type="file" id="uploadImageManager" name="uploadImageManager[]" multiple accept="image/*">
				<label class="upload" for="uploadImageManager">
					upload new file
				</label>

				<button type="Sunmit"><i class="fas fa-upload"></i></button>
			</form>
			<button class="btn" id="file__manager__error__modal" style="font-size: 0; width: 0; display: none;"  query-modal modal-call="file__manager__error__modal" query-modal >Error</button>
		</header>
		
		<ul class="file__list">
			<li class="file__list__spliter today" >
				Today
			</li>
			<?php 
			$trues = array();
			function comparedates($date1, $date2) {

				if( $date1 == $date2 ) {
					return $trues[] = true;
				}
				else {
					return $trues[] = false;
				}
			}
			$now = array(date('d'), date('m'), date('Y'));

			foreach( $files as $key => $file ): ?>
				<?php $date = explode('.', $key); ?>
				<?php $b = array_map('comparedates', $now, $date); ?>
				<?php if(!in_array(0,$b)): ?>

					
				<?php else: ?>
					<li class="file__list__spliter">
						<?php echo $key; ?>
					</li>
				<?php endif; ?>
				<?php foreach($file as $id => $image): ?>

					<li class="file <?php echo (((int)$id + 1) % 2 == 0 ) ? 'next' : ''; ?>">
						<div class="file__content">
							<i class="fas fa-image"></i>
							<img src="<?php echo $image['path']; ?>" style="width: 1.5rem;" alt="">
							<?php echo $image['name']; ?>
						</div>
						<div class="file__actions">
							<textarea id="<?php echo $image['path']; ?>" style="height: 0; border:0; background-color: transparent; resize: none; overflow: hidden; line-height: 0; font-size: 0;">
								<?php echo $image['path']; ?>
							</textarea>
							
							<i class="fas fa-copy" copy data-copy="<?php echo $image['path']; ?>"></i>
							
						</div>

					</li>

					
				<?php endforeach; ?>
			<?php endforeach; ?>

			<script>
				function copyText() {
					var copy = document.querySelectorAll('[copy]');
					copy.forEach(elem => {
						elem.addEventListener('click', function() {
							var select = document.getElementById(this.getAttribute('data-copy'));
							select.select();
							document.execCommand("copy");
						});
					});

				}

				copyText();
								

				
			</script>
					
		</ul>
	</div>
</main>







