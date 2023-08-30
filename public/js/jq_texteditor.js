var richText = $('[name=richTextField]');

if(richText.length > 0) {


    richText.each(function() {
    $(this).contents().prop('designMode','on');
    $(this).contents().find('body').prop('spellcheck',false);
    $(this).contents().find("body").css({'display':'block',
                                                    'background-color': '#171717',//$('body').css('background-color'),
                                                    'color': '#fff',//$('body').css('color'),
                                                    'word-wrap':'break-word',
                                                    'overflow-x':'hidden',
                                                    'width': '100%',
                                                    'max-width':$('[name=richTextField]').attr('data-width'),
                                                });
    $('select option').css({ 'border':'0'});
    $('option').css({'background-color':'#202020', 'border':'0'});

    var showingSourceCode = false;
    var isinEditMode = true;
    const edit_buttons = $('.btn--textCommand');

    $(this).contents().find("body").addClass('b');
    editor_id = $(this).attr('id');
    edit_buttons.each(function(item) {
        $(this).click(function() {
            cmd = $(this).attr('data-cmd');
            if($(this).hasClass('execcmd')) {
                console.log(editor_id);
                document.getElementById(editor_id).contentWindow.document.execCommand(cmd, false, null);
            }
            else if($(this).hasClass('execlink')) {
                // 
                document.getElementById(editor_id).contentWindow.document.execCommand(cmd, false, prompt('Enter Url:', 'https://'));
            }
            else if($(this).hasClass('color')) {
                $(this).change(function() {
                    document.getElementById(editor_id).contentWindow.document.execCommand(cmd, false, $(this).val());  
                });
            }
            else if($(this).hasClass('arg')) {
                var arg = $(this).attr('data-arg');
                document.getElementById(editor_id).contentWindow.document.execCommand(cmd, false, arg);  
            }
            else if($(this).hasClass('select')) {
                var arg = $(this).val();
                document.getElementById(editor_id).contentWindow.document.execCommand(cmd, false, arg);  
            }
        });
    });
    $('#submit__form__append__image__content').click(function(e) {

        e.preventDefault();
        $('.selected__image.active').each(function(){
            document.getElementById("richTextField").contentWindow.document.execCommand('insertHTML', false, '<img src="' + $(this).attr('data-image-src') + '" style="max-width: 500px;" alt="">');
            $(this).removeClass('active');
        });

        $('[data-id="modal__close"]').each(function() {
            $(this).click();
        });

        $('#select__image__form')[0].reset();

    });
    });
    

    $("[name=richTextField]").each(function() {
        $(this).contents().on('input',function() {

            $('[name="work__content"]').text($(this).contents().find('body').html());
        });
    });
}


// // second rich

var richText2 = $('[name=richTextField2]');
$(document).ready( () => {
    $("[name=richTextField2]").each(function() {
      $(this).contents().find("body").focus();  
    })
} );

if(richText2.length > 0) {


    richText2.each(function() {
    $(this).contents().prop('designMode','on');
    $(this).contents().find('body').prop('spellcheck',false);
    $(this).contents().find("body").css({'display':'block',
                                                    'background-color': '#171717',//$('body').css('background-color'),
                                                    'color': '#fff',//$('body').css('color'),
                                                    'word-wrap':'break-word',
                                                    'overflow-x':'hidden',
                                                    'width': '100%',
                                                    'max-width':$('[name=richTextField]').attr('data-width'),
                                                });
    $('select option').css({ 'border':'0'});
    $('option').css({'background-color':'#202020', 'border':'0'});

    var showingSourceCode = false;
    var isinEditMode = true;
    const edit_buttons_post = $('.btn--textCommand');

    $(this).contents().find("body").addClass('b');
    editor_id_Post = $(this).attr('id');
    edit_buttons_post.each(function(item) {
        $(this).click(function() {
            cmd = $(this).attr('data-cmd');
            if($(this).hasClass('execcmd2')) {
                document.getElementById(editor_id_Post).contentWindow.document.execCommand(cmd, false, null);
            }
            else if($(this).hasClass('execlink2')) {
                // 
                document.getElementById(editor_id_Post).contentWindow.document.execCommand(cmd, false, prompt('Enter Url:', 'https://'));
            }
            else if($(this).hasClass('arg2')) {
                var arg = $(this).attr('data-arg');
                document.getElementById(editor_id_Post).contentWindow.document.execCommand(cmd, false, arg);  
            }
            else if($(this).hasClass('select2')) {
                var arg = $(this).val();
                document.getElementById(editor_id_Post).contentWindow.document.execCommand(cmd, false, arg);  
            }
        });
    });
    $('#submit__form__append__image__content2').click(function(e) {

        e.preventDefault();
        $('.selected__image.active').each(function(){
            document.getElementById("richTextField2").contentWindow.document.execCommand('insertHTML', false, '<img src="' + $(this).attr('data-image-src') + '" style="max-width: 500px;" alt="">');
            $(this).removeClass('active');
        });

        $('[data-id="modal__close"]').each(function() {
            $(this).click();
        });

        $('#select__image__form2')[0].reset();
    });
    });
    

    $("[name=richTextField2]").each(function() {
        $(this).contents().on('input',function() {

            $('[name="post__content"]').text($(this).contents().find('body').html());
        });
    });


}


// description editor

var richText_description = $('#richTextField_description');

$(document).ready( () => {
    richText_description.each(function() {
      $(this).contents().find("body").focus();  
    })
} );

if(richText_description.length > 0) {


    richText_description.each(function() {
    $(this).contents().prop('designMode','on');
    $(this).contents().find('body').prop('spellcheck',false);
    $(this).contents().find("body").css({'display':'block',
                                        'background-color': '#171717',//$('body').css('background-color'),
                                        'color': '#fff',//$('body').css('color'),
                                        'word-wrap':'break-word',
                                        'overflow-x':'hidden',
                                        'width': '100%',
                                        'max-width':$('[name=richTextField]').attr('data-width'),
                                                });
    const edit_buttonsDesc = $('.execcmdDesc');


    $(this).contents().find("body").addClass('b');
    editor_id_desc = $(this).attr('id');
    edit_buttonsDesc.each(function(item) {
        $(this).click(function() {
            cmd = $(this).attr('data-cmd');
            if($(this).hasClass('execcmdDesc')) {
                document.getElementById(editor_id_desc).contentWindow.document.execCommand(cmd, false, null);
            }
        });
    });
    });
    

    $("[name=richTextField_description]").each(function() {
        $(this).contents().on('input',function() {

            $('[name="cv__description__content"]').text($(this).contents().find('body').html());
        });
    });


}

// education editor
var richText_education = $('[name=richTextField_education]');
$(document).ready( () => {
    richText_education.each(function() {
      $(this).contents().find("body").focus();  
    })
} );

if(richText_education.length > 0) {


    richText_education.each(function() {
    $(this).contents().prop('designMode','on');
    $(this).contents().find('body').prop('spellcheck',false);
    $(this).contents().find("body").css({'display':'block',
                                                    'background-color': '#171717',//$('body').css('background-color'),
                                                    'color': '#fff',//$('body').css('color'),
                                                    'word-wrap':'break-word',
                                                    'overflow-x':'hidden',
                                                    'width': '100%',
                                                    'max-width':$('[name=richTextField]').attr('data-width'),
                                                });
    const edit_buttonsEduc = $('.btn--textCommandEduc');

    $(this).contents().find("body").addClass('b');
    editor_id_educ = $(this).attr('id');
    edit_buttonsEduc.each(function(item) {
        $(this).click(function() {
            cmd = $(this).attr('data-cmd');
            if($(this).hasClass('execcmdEduc')) {
                document.getElementById(editor_id_educ).contentWindow.document.execCommand(cmd, false, null);
            }
        });
    });
    });
    

    $("[name=richTextField_education]").each(function() {
        $(this).contents().on('input',function() {

            $('#cv__education__content').text($(this).contents().find('body').html());
        });
    });


}


// education editor
var richText_experience = $('[name=richTextField_experience]');
$(document).ready( () => {
    richText_experience.each(function() {
      $(this).contents().find("body").focus();  
    })
} );

if(richText_experience.length > 0) {


    richText_experience.each(function() {
    $(this).contents().prop('designMode','on');
    $(this).contents().find('body').prop('spellcheck',false);
    $(this).contents().find("body").css({'display':'block',
                                                    'background-color': '#171717',//$('body').css('background-color'),
                                                    'color': '#fff',//$('body').css('color'),
                                                    'word-wrap':'break-word',
                                                    'overflow-x':'hidden',
                                                    'width': '100%',
                                                    'max-width':$('[name=richTextField]').attr('data-width'),
                                                });
    const edit_buttonsExper = $('.btn--textCommandExper');

    $(this).contents().find("body").addClass('b');
    editor_id_exp = $(this).attr('id');
    edit_buttonsExper.each(function(item) {
        $(this).click(function() {
            cmd = $(this).attr('data-cmd');
            if($(this).hasClass('execcmdExper')) {
                document.getElementById(editor_id_exp).contentWindow.document.execCommand(cmd, false, null);
            }
        });
    });
    });
    

    $("[name=richTextField_experience]").each(function() {
        $(this).contents().on('input',function() {

            $('#cv__experience__content').text($(this).contents().find('body').html());
        });
    });


}










