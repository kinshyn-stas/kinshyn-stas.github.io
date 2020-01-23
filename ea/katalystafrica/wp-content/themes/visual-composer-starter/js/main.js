(function( $ ) {
    $('.navbar-toggler').on('click', function(){
     	if($('#navbarSupportedContent').hasClass('show')){
     		$('.home #header').css({
			    'background-color'	: 'transparent',
			    'width'				: '100%',
			    'transition'		: '0.35s'
		    });
     	}else{
     		$('.home #header').css({
			    'background-color'	: '#ffffff',
			    'width'				: '100%',
			    'transition'		: '0.35s'
		    });
     	}
    });
})( window.jQuery );