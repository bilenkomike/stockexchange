<?php 
/**
 * @package Stockexchange
 **/

$template_name = 'stockexchange';

$dir = '../app/views/viewsfunctions/';
if(is_dir($dir)) {
	
	if($foulder = opendir($dir)) {
		while($file = readdir($foulder)) {
			if($file == '.' || $file == '..')
				continue;

			require_once $dir.$file;
		}
	}
}

$title = 'Stockexchange';


if (!Session::get('lang')) {
    Session::put('lang','1');
}

?>



<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- icons -->
		<script src="https://kit.fontawesome.com/ca8e93f7df.js" crossorigin="anonymous"></script>
	<!-- /.icons -->

	<!-- fonts -->
	<link rel="preconnect" href="http://fonts.gstatic.com">
		<!-- Ubuntu -->
		<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<!-- /.fonts -->

	<base href="http://localhost:8888/stockexchange/public/">

	<link rel="shortcut icon" href="../app/views/<?php echo $template_name; ?>/layout/images/icons/mainicon.svg">


<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/slideout/1.0.1/slideout.min.js"></script> -->

	<?php stck_load_reset_style(); ?>
	<?php stck_load_style($template_name); ?>

	<title><?php echo $title; ?></title>
</head>
<body class="b">
	
	<?php get_header($template_name); ?>
	<?php get_sidebars($template_name, ['mobile_nav']); ?>
	<div class="page" id="page">
		<div class="container" id="container">
			<!-- <main class="content"> -->
				<?php echo $content; ?>

			<!-- </main> -->
			<?php
			$pagination = true;
				if($pagination) {
					require_once 'incs/_pagination.php';
				}
			?>
		</div>
	</div><!--/.page-->
<div class="modal" modal data-modal="content-append-image-to-messanger">
    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>
    	<div class="modal__content__inner">
	    	<form style="display: block; text-align: center;" method="POST" id="select__image__form">
	    		<div class="select__images__content" id="message__images__content">
	    		</div>
			    <button type="submit" id="submit__form__append__image__message" style="margin: 10px auto;" id="loadimagebtn" class="btn btn--mnsd btn--mnsd--blue" >Submit</button>
	    	</form>
    	</div>
    </div>
</div>

<div class="modal" modal data-modal="content-append-modal">
    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>
    	<div class="modal__content__inner">
	    	<form style="display: block; text-align: center;" method="POST" id="select__image__form">
	    		<div class="select__images__content">
	    		</div>
			    <button type="submit" id="submit__form__append__image__content" style="margin: 10px auto;" id="loadimagebtn" class="btn btn--mnsd btn--mnsd--blue" >Submit</button>
	    	</form>
    	</div>
    </div>
</div>

<div class="modal" modal data-modal="content-append-modal2">
    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>
    	<div class="modal__content__inner">
	    	<form style="display: block; text-align: center;" method="POST" id="select__image__form2">
	    		<div class="select__images__content">
	    		</div>
			    <button type="submit" id="submit__form__append__image__content2" style="margin: 10px auto;" id="loadimagebtn" class="btn btn--mnsd btn--mnsd--blue">Submit</button>
	    	</form>
    	</div>
    </div>
</div>

<div class="modal" modal data-modal="request_frendship--modal" >

    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>
    	<form action="home/friendship/<?php echo explode('/',$_SERVER['REQUEST_URI'])[count(explode('/',$_SERVER['REQUEST_URI']))-2]; ?>" method="POST" id="request__friendshipForm">
    		<label for="request__friendship">Are you sure you want to request for following?</label>
    		<button class="btn btn--mnsd btn--mnsd--blue" id="request__friendship" style="margin: 10px auto;" style="margin:10px auto;">Yes</button>
    	</form>
    </div>
</div>

<div class="modal" modal data-modal="much__photos" >

    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>

    	You can load only one image per message. Do you understand id?
    	<button type="button" data-id="modal__close" class="btn btn--mnsd btn--mnsd--blue" style="margin:10px auto;">OK <i class="fas fa-thumbs-up"></i></button>

    	
    </div>
</div>

<div class="modal" modal data-modal="file__manager__error__modal">

    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>

    	Please choose another name to your image or chose some images
    	<button type="button" data-id="modal__close" class="btn btn--mnsd btn--mnsd--blue" style="margin:10px auto;">OK <i class="fas fa-thumbs-up"></i></button>

    	
    </div>
</div>



<div class="modal" modal data-modal="modal--success--cv">

    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>

    	<p style="text-align: center; color: green;font-size: 20px;font-weight: 500;">Your CV was succesfully saved</p>
    	<button type="button" data-id="modal__close" class="btn btn--mnsd btn--mnsd--blue" style="margin:10px auto;">OK <i class="fas fa-thumbs-up"></i></button>

    	
    </div>
</div>

<div class="modal" modal data-modal="modal--errors">

    <div class="modal__content">
    	<button type="button" data-id="modal__close" class="btn btn--modal--close"><i class="fas fa-times"></i></button>

    	<h1 style="text-align: center; font-size: 28px;" class="errors__header">Errors</h1>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="error_educ">Fill in please education</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="error_exper">Fill in please previuos experience</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="skills_levels__errors">
    		Check all skills levels 
    	</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="error_cv_lang">
    		Please select CV language
    	</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="error__skills">
    		Please select your skills
    	</p>

    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="cv_name_surname_error">
    		Please fill in your name and surname
    	</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="cv_bith_day_error">
    		Please fill in your day of birth
    	</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="cv_prof_error">
    		Please fill in your proffecion, email, phone number 
    	</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="cv_location__error">
    		Please fill in your current country, city, adress
    	</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="cv_gender__error">
    		Please select your gender
    	</p>
    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="post_submit_error">
    		Please fill in all inputs such as post name, post tags, post preview image, post content!
    	</p>

    	<p class="error" style="color: red; font-weight: 500; font-size: 18px; text-align: center;" name="work_submit_error">
    		Please fill in all inputs such as work name, work tags, work preview image, work content, work preview text, work category, work type!
    	</p>


    	

    	<button type="button" data-id="modal__close"  class="btn btn--mnsd btn--mnsd--blue" style="margin:10px auto;">OK <i class="fas fa-thumbs-up"></i></button>

    	
    </div>
</div>

<span id="show__image" query-modal modal-call="story--modal"></span>

<div class="modal" modal data-modal="story--modal" >

    <div class="modal__content--story">
    	<img src="" id="storyImage" alt="">
    </div>
</div>


	
	<?php stck_load_scripts($template_name); ?>
</body>
</html>