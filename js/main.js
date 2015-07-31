$(function () {
	banner: "'use strict';\n";

	(function () {
		$('.js-main-slider').bxSlider({
			mode: 'fade',
			auto: true,
			pager: false
		});
	}());
    $('a').click(function(){
        $(this).css({'textDecoration':'none'});
    });
    /*Select*/
    
	/*Placeholder*/
  	

	/*Popup form*/
	$('.popup-open').click(function(event){
		var $popup = $(this).attr('href');
                ClearForm($($popup).find('form'));
		$($popup).fadeIn();
		if($($popup).find('.popup-form').height()>$(window).height()) {
			$($popup).addClass('popupAuto');
		}
		event.preventDefault();
		$('body').addClass('overflow-none');
	})
	$(window).resize(function(){
		$('.popup-form').each(function(){
			if($(this).height()>$(window).height()) {
				$(this).parent().addClass('popupAuto');
			}
			else { $(this).parent().removeClass('popupAuto'); }
		})
	})

	$('.popup-form .close').click(function(event){
		$(this).parent().parent().fadeOut();
		$('body').removeClass('overflow-none');
		$(this).parent().find('form').trigger( 'reset' );
		$(this).parent().find('.text-error').remove();
		$(this).parent().find('.error').removeClass('error');
		event.preventDefault();
	})


	/*Top menu*/
	$('header ul li').each(function(){
		if($(this).hasClass('active')) {
			$(this).parent().addClass('navAct');
		}
	})

	function headerHav() {
		if($(document).scrollTop() > $('header').height()) {
			$('header').css('padding-bottom',$('header nav').height());
			$('header nav').addClass('fixed');
			$('header nav').fadeIn();
		}
		else { $('header nav').removeClass('fixed'); $('header, header nav').removeAttr('style'); }
	}
	$(window).scroll(function(){
		headerHav();
	})


	/*fancy box*/
	if($(".fancybox").length) {
		$(".fancybox").fancybox();
	}

	/*fancy box event*/
	if($(".fancybox-event").length) {
		$(".fancybox-event").fancybox({
			padding: [40,15,40,15],
			afterLoad: function () {
		        $(".fancybox-overlay").addClass("spEv");
		    }
		});
	}

	/*error*/
	if($(".error-wrapper").length) { 
		var dtW = $(window).height()-$('header').height()-$('footer').height()-33;
		if(dtW > $(".error-wrapper-inr").height()) {
			$(".error-wrapper").css('min-height', dtW )
			$(".error-wrapper").addClass('widthR');
		}
	}
    $(window).resize(function(){
        if($(".error-wrapper").length) {
            var dtW = $(window).height()-$('header').height()-$('footer').height()-33;
            if(dtW > $(".error-wrapper-inr").height()) {
                $(".error-wrapper").css('min-height', dtW )
                $(".error-wrapper").addClass('widthR');
            }
        }
    });
	/*select*/
	if($("#style-select, #style-select1, #style-select2").length) {
	    $(document).click(function(event){
		  	if($(event.target).closest(".sbSelector").length || $(event.target).closest("#style-select").length ) 
		   	return;
		   $("#style-select, #style-select1, #style-select2").selectbox("close");
            $('.filter .filter-left ul>li').removeClass('active');
		    event.stopPropagation();
		});
	}
    $('.filter .filter-right>ul>li').click(function(event){
        $(this).toggleClass('active');
        event.preventDefault();
    });
    $(' .paginations .year-list li.active a, #logo1, ul.parrent-nav li.active:not(.parent-active) a, ul.sub-nav li.active a').click(function(event){		
		event.preventDefault();		
    });
    $('.filter .filter-left ul>li').click(function(event){
        $('.filter .filter-left ul>li').removeClass('active');
        $(this).toggleClass('active');
        event.preventDefault();
    });
    
    /*seo-text-hide*/
    $('.seo-text').click(function(){
        if($(this).hasClass('active')){
            $(this).animate({'height':'250px'}, 500).removeClass('active');
        }else{
            $(this).animate({'height':'100%'}, 500).addClass('active');
        }
    });
    
});
$(function () {
    $("#style-select, #style-select1, #style-select2").selectbox();
});
$(document)
        .on('change', '#style-select, #style-select1', function(){
            var parent_id = $(this).find('option:first').attr('value');
            var selected_id = $(this).val();
            $('#'+parent_id+' input[type=hidden]').attr('disabled', 'disabled').val('');    
            if(parent_id != selected_id && $('#'+parent_id+' #'+selected_id).val() != 'Y'){                   
                $('#'+parent_id+' #'+selected_id).removeAttr('disabled').val('Y');
            }
            $("#style-select, #style-select1, #style-select2").attr('disabled', 'disabled');
            $(this).parents('form').submit();
            return false;
        })
        .on('change', '#style-select2', function(){
            var parent_id = $(this).find('option:first').attr('value');    
            $('#'+parent_id+'_min').attr('disabled', 'disabled').val('');
            $('#'+parent_id+'_max').attr('disabled', 'disabled').val('');
            if($(this).val() != parent_id){
                var re = /\s*\_\s*/;
                var values = $(this).val().split(re);                
                $('#'+parent_id+'_min').removeAttr('disabled').val(values[0]);
                $('#'+parent_id+'_max').removeAttr('disabled').val(values[1]);
            }
            $("#style-select, #style-select1, #style-select2").attr('disabled', 'disabled');
            $(this).parents('form').submit();
            return false;
        })
        .on('click', '#style-select3 li a', function(){
            var parent_id = $(this).parents('ul:first').attr('id');
            var selected_id = $(this).attr('data-value');                
            if(parent_id != selected_id && $('#'+parent_id+' #'+selected_id).val() != 'Y'){                   
                $('#'+parent_id+' #'+selected_id).removeAttr('disabled').val('Y');
            }else if($('#'+parent_id+' #'+selected_id).val() == 'Y'){
                $('#'+parent_id+' #'+selected_id).attr('disabled', 'disabled').val('')
            }
            $("#style-select, #style-select1, #style-select2").attr('disabled', 'disabled');
            $(this).parents('form').submit();
            return false;
        });
function PrepareInputBeforeSubmit($obj){       
    $obj.find('input[name=product_id]').val($('#product_id').attr('data-product-id'));    
}
function ClearForm($obj){      
    $obj.parent().find('.append-form').remove();
    $obj.show();
    $objInput = $obj.find('input, textarea');
    $objInput.each(function(){
        if($(this).attr('data-placeholder')){
            if($(this).attr('data-placeholder') == $(this).val()){
                $(this).val('');
            }
        }        
    });
}
$(document)
        .on('focusin', '.placeholder-1, .placeholder-2, .placeholder-3, .placeholder-4, .placeholder-5, .placeholder-6, .placeholder-7, .placeholder-8', function () {
            if($(this).attr('placeholder') == $(this).attr('data-placeholder')){
                $(this).attr('placeholder', ''); 
            }
        })
        .on('focusout', '.placeholder-1, .placeholder-2, .placeholder-3, .placeholder-4, .placeholder-5, .placeholder-6, .placeholder-7, .placeholder-8', function () {
            if($(this).attr('placeholder') == ''){
                $(this).attr('placeholder', $(this).attr('data-placeholder'));
            }
        });
$(document)         
        .on('submit', '#popup-3 form', function () {                        
            $.fancybox.showLoading();            
            PrepareInputBeforeSubmit($(this));
            $(this).ajaxSubmit({
                cache: false,
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                success: function (data) {            
                    re = /successText/i;
                    if(data.match(re)){
                        $('#popup-3 form').hide();
                    }
                    $('#popup-3 form').before(data);
                    $.fancybox.hideLoading();
                }
            });
            return false;
        })
        .on('submit', '#popup-2 form', function () {                        
            $.fancybox.showLoading();            
            PrepareInputBeforeSubmit($(this));
            $(this).ajaxSubmit({
                cache: false,
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                success: function (data) {                    
                    re = /successText/i;
                    if(data.match(re)){
                        $('#popup-2 form').hide();
                    }
                    $('#popup-2 form').before(data);
                    $.fancybox.hideLoading();
                }
            });
            return false;
        })
        .on('submit', '#popup-1 form', function () {                        
            $.fancybox.showLoading();            
            PrepareInputBeforeSubmit($(this));
            $(this).ajaxSubmit({
                cache: false,
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                success: function (data) {                        
                    re = /successText/i;
                    if(data.match(re)){
                        $('#popup-1 form').hide();
                    }
                    $('#popup-1 form').before(data);
                    $.fancybox.hideLoading();
                }
            });
            return false;
        });