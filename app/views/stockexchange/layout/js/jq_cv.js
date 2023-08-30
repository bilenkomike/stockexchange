// custom select maker
function selectOption () {
	$('.cv__select__header').each(function() {
	$(this).click(function() {
		if($(this).children('i').hasClass('active')) {
			$(this).children('i').removeClass('active');
		}
		else {
			$(this).children('i').addClass('active');
		}
		$('#'+$(this).attr('for')).toggleClass('active');
	});	
});

$('.cv__select__list__option').each(function() {
	$(this).click(function() {
		$('[for="' + $(this).parent().attr('id') + '"]').children('i').removeClass('active');
		$(this).parent().removeClass('active');;
		val = $.trim($(this).text());
		$('[for="' + $(this).parent().attr('id') + '"]').children('.CVtext__header').children('.val').html(val);
		$('[name="' + $(this).parent().attr('id') + '"]').val(val);
	});
});

}

selectOption();

// cv skills select
$("#cvSkills").on('input', function(e){
    var selecteds = $(this).val();
    $('[skilloption]').each(function() {
    	if( selecteds == $(this).val() ) {

    		if(!$('#skills').val().includes(selecteds + '/')) {
	    		$('.skills').append(`<li class="skills__item" id="${$(this).val()}">${$(this).val()}<i class="fas fa-times"></i></li>
	    			<div class="cv__select__item cv__level__select" data-skills-select="${$(this).val().replace(' ','')}">
											<span class="cv__select__header" for="cv__skill__level__${$(this).val().replace(' ','')}"><span class="CVtext__header">Select level: <div class="val"></div></span><i class="fas fa-caret-right"></i></span>
											<div class="cv__select__list" id="cv__skill__level__${$(this).val().replace(' ','')}">
												<input type="hidden" name="cv__skill__level__${$(this).val().replace(' ','')}" value="">												
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
	    			`);
	    		$('#skills').val($('#skills').val() + $('#cvSkills').val() + '/');
    			
    		}
    		$('#cvSkills').val('');
    	}
    	selectOption();
    	removeSkill();
    	
    });
    
    
});

function removeSkill() {
	$('.skills__item').each(function() {
		$(this).click(function() {
			let select_name = $(this).attr('id').replace(' ','');

			$(`[data-skills-select=${select_name}]`).remove();

			$('#skills').val($('#skills').val().replace($(this).attr('id') + '/',''));
			$(this).remove();
		});
	});
}

removeSkill();

// skills block selector 

// cv add content to experience
$('[cv-action]').each(function() {

	$(this).click(function() {
		let this_type = $(this).attr('data-cv-content-type');
		let this_action = $(this).attr('cv-content-action');

		switch (this_type) {
			case 'education':
				if(!$(`[name=edit__Education_block]`).is(':checked')) {
					
				let input__education = $('#cv__education__ids').val();


				if ( this_action == 'save' ) {
					var idName;
					if ( input__education == '' ) {
						idName = 'e1';
					} 
					else {
						let lastE = input__education.lastIndexOf('e');
						let lastSlash = input__education.lastIndexOf('/');


						idName = `e${parseInt(input__education.substring(lastE + 1, lastSlash)) + 1}`;

					}
					$('#cv__education__ids').val($('#cv__education__ids').val() + idName + "/");

					let cv__schoolName = $('[name="cv__schoolName"]').val();
					let cv__schoolLocation = $('[name="cv__schoolLocation"]').val();

					// select date
					let cv__schoolYearStart = $('[name="School__year__start"]').val();
					let cv__schoolMonthStart = $('[name="School__month__start"]').val();

					let cv__schoolYearEnd = $('[name="School__year__end"]').val();
					let cv__schoolMonthEnd = $('[name="School__month__end"]').val();

					// content items
					let cv__schoolDescription = $('[name="cv__education__content"]').text();

					let input__string = `${cv__schoolName} || ${cv__schoolLocation} || ${cv__schoolMonthStart} -- ${cv__schoolYearStart} || ${cv__schoolMonthEnd} -- ${cv__schoolYearEnd} || ${cv__schoolDescription}` ;

					// schoolName  || schoolLocattion || schollMonthStart --  schoolYearStart 
					// ||  schollMonthEnd --  schoolYearEnd || schoolDescription
					$('.studies').append(`<div class="added__content__item" id="${idName}">
						<div class="added__content__item__info">
						<div class="added__content__item__header">${cv__schoolName}</div>
						<div class="added__content__item__info__locdate">
						<div class="studies__content__item__date">
						${cv__schoolMonthStart} ${cv__schoolYearStart} 
						- ${cv__schoolMonthEnd} ${cv__schoolYearEnd}</div>
						<div class="studies__content__item__location">
						<i class="fas fa-map-marker-alt"></i>
						${cv__schoolLocation}</div>
						</div></div>
						<input type="hidden" name="${idName}" value="${input__string}">
						<div class="added__content__item__actins">
						<div action-education data-action-education="edit" education_element_id="${idName}" class="added__content__item__actins__item">
						<i class="fas fa-pen"></i>
						</div>
						<div action-education data-action-education="remove" education_element_id="${idName}" class="added__content__item__actins__item">
						<i class="fas fa-trash-alt"></i></div></div></div>`);

					educationEvents();
				}

				$('[name="cv__schoolName"]').val('');
				$('[name="cv__schoolLocation"]').val('');

				// select date
				$('[name="School__year__start"]').val('');
				$('[name="School__month__start"]').val('');

				$('[name="School__year__end"]').val('');
				$('[name="School__month__end"]').val('');

				$('[nme=School__year__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				$('[name=School__month__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				$('[name=School__year__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				$('[name=School__month__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				
				// content items

				$('[name="cv__education__content"]').text('');
				$('[name="richTextField_education"]').contents().find('body').html('');
				}
				else {
					if(this_action == 'save') {
						let cv__schoolName = $('[name="cv__schoolName"]').val();
						let cv__schoolLocation = $('[name="cv__schoolLocation"]').val();

						// select date
						let cv__schoolYearStart = $('[name="School__year__start"]').val();
						let cv__schoolMonthStart = $('[name="School__month__start"]').val();

						let cv__schoolYearEnd = $('[name="School__year__end"]').val();
						let cv__schoolMonthEnd = $('[name="School__month__end"]').val();
						let date = `${cv__schoolMonthStart} ${cv__schoolYearStart} - ${cv__schoolMonthEnd} ${cv__schoolYearEnd}`;
						// content items
						let cv__schoolDescription = $('[name="cv__education__content"]').text();

						let input__string = `${cv__schoolName} || ${cv__schoolLocation} || ${cv__schoolMonthStart} -- ${cv__schoolYearStart} || ${cv__schoolMonthEnd} -- ${cv__schoolYearEnd} || ${cv__schoolDescription}` ;
						$(`[name=${$(`[name=edit__Education_block]`).val()}]`).val(input__string);

						
						$(`#${$(`[name=edit__Education_block]`).val()}`).children('.added__content__item__info').children('.added__content__item__info__locdate').children('.studies__content__item__date').html(date);
						$(`#${$(`[name=edit__Education_block]`).val()}`).children('.added__content__item__info').children('.added__content__item__header').html(cv__schoolName);
						$(`#${$(`[name=edit__Education_block]`).val()}`).children('.added__content__item__info').children('.added__content__item__info__locdate').children('.studies__content__item__location').html(`<i class="fas fa-map-marker-alt"></i>${cv__schoolLocation}`);
					}
					$(`[data-action-education="edit"]`).each(function() {
						$(this).show();
					});

					$(`[education_element_id=${$(`[name=edit__Education_block]`).val()}]`).each(function() {
						if($(this).is('[data-action-education="remove"]'))
						{
							$(this).show();

						}
					});
					$(`#${$(`[name=edit__Education_block]`).val()}`).removeClass('active');
					$(`[name=edit__Education_block]`).click();
					$(`[name=edit__Education_block]`).val('');

					$('[name="cv__schoolName"]').val('');
					$('[name="cv__schoolLocation"]').val('');

					// select date
					$('[name="School__year__start"]').val('');
					$('[name="School__month__start"]').val('');

					$('[name="School__year__end"]').val('');
					$('[name="School__month__end"]').val('');

					$('[name=School__year__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					$('[name=School__month__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					$('[name=School__year__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					$('[name=School__month__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					
					// content items

					$('[name="cv__education__content"]').text('');
					$('[name="richTextField_education"]').contents().find('body').html('');


					
				}

				break;
			case 'experience':
				if(!$(`[name=edit__Experience_block]`).is(':checked')) {
					
				let input__experience = $('#cv__exeprins__ids').val();


				if ( this_action == 'save' ) {
					var idNameE;
					if ( input__experience == '' ) {
						idNameE = 'exp1';
					} 
					else {
						let lastE = input__experience.lastIndexOf('exp');
						let lastSlash = input__experience.lastIndexOf('/');


						idNameE = `exp${parseInt(input__experience.substring(lastE + 3, lastSlash)) + 1}`;
						
					}
					$('#cv__exeprins__ids').val($('#cv__exeprins__ids').val() + idNameE + "/");

					let cv__companyName = $('[name="cv__companyName"]').val();
					let cv__companyLocation = $('[name="cv__companyLocation"]').val();
					let cv__companyPosition = $('[name="cv__companyPosition"]').val();
					// select date
					let cv__companyYearStart = $('[name="Company__year__start"]').val();
					let cv__companyMonthStart = $('[name="Company__month__start"]').val();

					let cv__companyYearEnd = $('[name="Company__year__end"]').val();
					let cv__companyMonthEnd = $('[name="Company__month__end"]').val();
					let date = `${cv__companyMonthStart} ${cv__companyYearStart} - ${cv__companyMonthStart} ${cv__companyYearStart}`;
					// content items
					let cv__companyDescription = $('[name="cv__experience__content"]').text();

					let input__strin = `${cv__companyName} -- ${cv__companyPosition} || ${cv__companyLocation} || ${cv__companyMonthStart} -- ${cv__companyYearStart} || ${cv__companyMonthEnd} -- ${cv__companyYearEnd} || ${cv__companyDescription}` ;

					// schoolName  || schoolLocattion || schollMonthStart --  schoolYearStart 
					// ||  schollMonthEnd --  schoolYearEnd || schoolDescription
					$('.previousexperience').append(`
						<div class="added__content__item" id="${idNameE}">
	<div class="added__content__item__info">
		<div class="added__content__item__header">${cv__companyName}</div>
		<div class="added__content__item__header position">${cv__companyPosition}</div>
		<div class="added__content__item__info__locdate">
			<div class="studies__content__item__date">
				${cv__companyMonthStart} ${cv__companyYearStart} 
					- ${cv__companyMonthEnd} ${cv__companyYearEnd}
			</div>
			<div class="studies__content__item__location">
				<i class="fas fa-map-marker-alt"></i>
					${cv__companyLocation}
			</div>
						
		</div>
	</div>
	<input type="hidden" name="${idNameE}" value="${input__strin}">
	<div class="added__content__item__actins">
		<div action-experience data-action-experience="edit" experience_element_id="${idNameE}" class="added__content__item__actins__item">
		<i class="fas fa-pen"></i>
	</div>
	<div action-experience data-action-experience="remove" experience_element_id="${idNameE}" class="added__content__item__actins__item">
		<i class="fas fa-trash-alt"></i>
	</div>
	</div>
</div>
`);

					experienceEvents();
				}

				$('[name="cv__companyName"]').val('');
				$('[name="cv__companyLocation"]').val('');
				$('[name="cv__companyPosition"]').val('');
				// select date
				$('[name="Company__year__start"]').val('');
				$('[name="Company__month__start"]').val('');

				$('[name="Company__year__end"]').val('');
				$('[name="Company__month__end"]').val('');

				$('[nme=Company__year__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				$('[name=Company__month__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				$('[name=Company__year__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				$('[name=Company__month__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				
				$('[nme=Company__year__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					
				$(`[for="Company__year__start"]`).children('.cv__select__header').children('.CVtext__header').children('.val').text('');
				$(`[data-val="Company__year__start"]`).html('');

				// content items

				$('[name="cv__experience__content"]').text('');
				$('[name="richTextField_experience"]').contents().find('body').html('');
				}
				else {
					if(this_action == 'save') {
						let cv__companyName = $('[name="cv__companyName"]').val();
						let cv__companyLocation = $('[name="cv__companyLocation"]').val();
						let cv__companyPosition = $('[name="cv__companyPosition"]').val();
						// select date
						let cv__companyYearStart = $('[name="Company__year__start"]').val();
						let cv__companyMonthStart = $('[name="Company__month__start"]').val();

						let cv__companyYearEnd = $('[name="Company__year__end"]').val();
						let cv__companyMonthEnd = $('[name="Company__month__end"]').val();
						let date = `${cv__companyMonthStart} ${cv__companyYearStart} - ${cv__companyMonthEnd} ${cv__companyYearEnd}`;
						// content items
						let cv__companyDescription = $('[name="cv__experience__content"]').text();

						// let input__strin = `${cv__schoolName} || ${cv__schoolLocation} || ${cv__schoolMonthStart} -- ${cv__schoolYearStart} || ${cv__schoolMonthEnd} -- ${cv__schoolYearEnd} || ${cv__schoolDescription}` ;
						let input__strin = `${cv__companyName} -- ${cv__companyPosition} || ${cv__companyLocation} || ${cv__companyMonthStart} -- ${cv__companyYearStart} || ${cv__companyMonthEnd} -- ${cv__companyYearEnd} || ${cv__companyDescription}` ;
						

					
						$(`[name=${$(`[name=edit__Experience_block]`).val()}]`).val(input__strin);

						
				
						$(`#${$(`[name=edit__Experience_block]`).val()}`).children('.added__content__item__info').children('.added__content__item__info__locdate').children('.studies__content__item__date').html(date);
						$(`#${$(`[name=edit__Experience_block]`).val()}`).children('.added__content__item__info').children('.added__content__item__header').html(cv__companyName);
						$(`#${$(`[name=edit__Experience_block]`).val()}`).children('.added__content__item__info').children('.added__content__item__header.position').html(cv__companyPosition);

						$(`#${$(`[name=edit__Experience_block]`).val()}`).children('.added__content__item__info').children('.added__content__item__info__locdate').children('.studies__content__item__location').html(`<i class="fas fa-map-marker-alt"></i>${cv__companyLocation}`);
					}
					$(`[data-action-experience="edit"]`).each(function() {
						$(this).show();
					});

					$(`[experience_element_id=${$(`[name=edit__Experience_block]`).val()}]`).each(function() {
						if($(this).is('[data-action-experience="remove"]'))
						{
							$(this).show();

						}
					});
					$(`#${$(`[name=edit__Experience_block]`).val()}`).removeClass('active');
					$(`[name=edit__Experience_block]`).click();
					$(`[name=edit__Experience_block]`).val('');

					$('[name="cv__companyName"]').val('');
					$('[name="cv__companyLocation"]').val('');
					$('[name="cv__companyPosition"]').val('');
					// select date
					$('[name="Company__year__start"]').val('');
					$('[name="Company__month__start"]').val('');

					$('[name="Company__year__end"]').val('');
					$('[name="Company__month__end"]').val('');

					$('[nme=Company__year__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					
					$(`[for="Company__year__start"]`).children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					$(`[data-val="Company__year__start"]`).html('');

					$('[name=Company__month__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');

					$('[name=Company__year__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					$('[name=Company__month__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text('');
					
					// content items

					$('[name="cv__experience__content"]').text('');
					$('[name="richTextField_experience"]').contents().find('body').html('');



				
			}
			break;
		} // switch - case close
	});
});





function educationEvents() {
	$('[action-education]').each(function() {
		$(this).click(function() {
			let action = $(this).attr('data-action-education');
			let element_id = $(this).attr('education_element_id');
			switch(action) {
				case 'remove':
					remove_elem_educ = element_id + '/';
					$('#cv__education__ids').val($('#cv__education__ids').val().replace(remove_elem_educ,""));
	
					$('#' + element_id).remove();
					break;
				case 'edit':
					$(`[data-action-education="edit"]`).each(function() {
						$(this).hide();
					});

					$(`#${element_id}`).toggleClass('active');
					$(`[name=edit__Education_block]`).click();
					$(`[name=edit__Education_block]`).val(element_id);
					
					$(`[education_element_id=${$(`[name=edit__Education_block]`).val()}]`).each(function() {
						if($(this).is('[data-action-education="remove"]'))
						{
							$(this).hide();

						}
					});

					elements = $(`[name=${element_id}]`).val().split(' || ');

					dateStart = elements[2].split(' -- ');
					dateEnd = elements[3].split(' -- '); // 1 - month , 2 - year



					// schoolName  || schoolLocattion || schollMonthStart --  schoolYearStart 
					// ||  schollMonthEnd --  schoolYearEnd || schoolDescription
					
					$('[name="cv__schoolName"]').val(elements[0]);
					$('[name="cv__schoolLocation"]').val(elements[1]);

					// select date
					$('[name="School__year__start"]').val(dateStart[1]);
					$('[name="School__month__start"]').val(dateStart[0]);

					$('[name="School__year__end"]').val(dateEnd[1]);
					$('[name="School__month__end"]').val(dateEnd[0]);

					$('[name=School__year__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateStart[1]);
					$('[name=School__month__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateStart[0]);
					$('[name=School__year__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateEnd[1]);
					$('[name=School__month__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateEnd[0]);
					
					// content items

					$('[name="cv__education__content"]').text(elements[4]);
					$('[name="richTextField_education"]').contents().find('body').html(elements[4]);



					break;
			}
		});
	});
}

educationEvents();


function experienceEvents() {
	$('[action-experience]').each(function() {
		$(this).click(function() {
			let action = $(this).attr('data-action-experience');
			let element_id = $(this).attr('experience_element_id');
			switch(action) {
				case 'remove':
					remove_elem_exp = element_id + '/';

					$('#cv__exeprins__ids').val($('#cv__exeprins__ids').val().replace(remove_elem_exp,""));
	
					$('#' + element_id).remove();
					break;
				case 'edit':
					$(`[data-action-experience="edit"]`).each(function() {
						$(this).hide();
					});

					$(`#${element_id}`).toggleClass('active');
					$(`[name=edit__Experience_block]`).click();
					$(`[name=edit__Experience_block]`).val(element_id);
					
					$(`[experience_element_id=${$(`[name=edit__Experience_block]`).val()}]`).each(function() {
						if($(this).is('[data-action-experience="remove"]'))
						{
							$(this).hide();

						}
					});

					elements = $(`[name=${element_id}]`).val().split(' || ');

					name_pos = elements[0].split(' -- ');
					dateStart = elements[2].split(' -- ');
					dateEnd = elements[3].split(' -- '); // 1 - month , 2 - year



					// schoolName  || schoolLocattion || schollMonthStart --  schoolYearStart 
					// ||  schollMonthEnd --  schoolYearEnd || schoolDescription


					$('[name="cv__companyName"]').val(name_pos[0]);
					$('[name="cv__companyLocation"]').val(elements[1]);
					$('[name="cv__companyPosition"]').val(name_pos[1]);


					// select date
					$('[name="Company__year__start"]').val(dateStart[1]);
					$('[name="Company__month__start"]').val(dateStart[0]);

					$('[name="Company__year__end"]').val(dateEnd[1]);
					$('[name="Company__month__end"]').val(dateEnd[0]);

					$('[name=Company__year__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateStart[1]);
					$('[name=Company__month__start]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateStart[0]);
					$('[name=Company__year__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateEnd[1]);
					$('[name=Company__month__end]').parent().parent().children('.cv__select__header').children('.CVtext__header').children('.val').text(dateEnd[0]);
					
					// content items

					$('[name="cv__experience__content"]').text(elements[4]);
					$('[name="richTextField_experience"]').contents().find('body').html(elements[4]);



					break;
			}
		});
	});
}

experienceEvents();


setTimeout(() => {
	if($('[name=cv__description__content]').text() != '' ) {
		$('[data-textarea="cv__description__content"]').contents().find('body').html($('[name=cv__description__content]').text());
	}
}, 100);






// check validation

//  - skills
//  skills levels


	$('#cv__form').submit(function(event) {
		event.preventDefault();
		var ckeck = true;
		if( $('[name=skills]').val() != '' ) {
			
			var strings = $('[name="skills"]').val().split('/');
			for( let i = 0 ; i < strings.length; i++ ) {
				if( strings[i] != '' ) {
					
					if( $('[name=cv__skill__level__' + strings[i].replace(' ','') +']').val() == '' ) {
						ckeck = false;
						
						$('.error').each(function () {
							$(this).hide();
						});
						$('[data-modal="modal--errors"]').addClass('selected');
						$(`[name=skills_levels__errors]`).show();
					}
				}
			}
		}
		if($('[name=cv__name]').val() == '' || $('[name=cv__surname]').val() == ''  ) {
			$('.error').each(function () {
				$(this).hide();
			});
			ckeck = false;
			$('[data-modal="modal--errors"]').addClass('selected');
			$(`[name=cv_name_surname_error]`).show();
		}
		if ($('[name=Byear]').val() == '' || $('[name=Bmonth]').val() == '' || $('[name=Bday]').val() == '') {
			$('.error').each(function () {
				$(this).hide();
			});
			ckeck = false;
			$('[data-modal="modal--errors"]').addClass('selected');
			$(`[name=cv_bith_day_error]`).show();
		}

		if($('[name=cv__profeccion]').val() == '' || $('[name=cv__email]').val() == '' || $('[name=cv__phone]').val() == '') {
			$('.error').each(function () {
				$(this).hide();
			});
			ckeck = false;
			$('[data-modal="modal--errors"]').addClass('selected');
			$(`[name=cv_prof_error]`).show();
		}
		if($('[name=cv__country]').val() == '' || $('[name=cv__address]').val() == '' || $('[name=cv__city]').val() == '') {
			$('.error').each(function () {
				$(this).hide();
			});
			ckeck = false;
			$('[data-modal="modal--errors"]').addClass('selected');
			$(`[name=cv_location__error]`).show();
		}

		if($('[name=cvGender]').val() == '') {
			$('.error').each(function () {
				$(this).hide();
			});
			ckeck = false;
			$('[data-modal="modal--errors"]').addClass('selected');
			$(`[name=cv_gender__error]`).show();
		}

		

 		var json;
		data = new FormData(this);

		if(ckeck == true) {
		$.ajax({
			type: 'POST',
			url: 'home/admin/',
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				json = jQuery.parseJSON(result);
				if ( json.status == 'ok' ) {
					$('[data-modal=modal--success--cv]').addClass('selected');
				}
				else {
					$('[data-modal="modal--errors"]').addClass('selected');
					
					$('.error').each(function () {
						$(this).hide();
					});
					$(`[name=${json.status}]`).show();
				}

			},
		});
		}
	});

