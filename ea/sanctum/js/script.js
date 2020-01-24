jQuery(function($) {
  $(document).ready(function() {
    // SVG INLINE IMAGES
    $('body img').each(function(){
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
        $.get(imgURL, function(data) {
            var $svg = $(data).find('svg');
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
            $svg = $svg.removeAttr('xmlns:a');
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
            $img.replaceWith($svg);
        }, 'xml');
    });
    // SCROLL ANIMATION
    // $(".press_btn").on("click", function(event) {
    //   event.preventDefault();
    //   var id = $(this).attr('href'),
    //     top = $(id).offset().top - 90;
    //     if ($(window).width() <= 992) {
    //       top = $(id).offset().top - 60;
    //     }
    //   $('body,html').animate({
    //     scrollTop: top,
    //     easing: "swing"
    //   }, 1200);
    // });
    // CUR NAV ITEM
    var currPageUrl = window.location.href;
    $(".main-header .nav-list .nav-item").each(function(){
      var navitemUrl = $(".nav-item__url", this).attr("href");
      if (currPageUrl == navitemUrl) {
        $(this).addClass("current");
      }
    });
    // CHEK PAGE HEAD IMG
    if ($(window).width() >= 993) {
      if (!($(".bg-container").css("background-image") == "none")) {
        var currBgImg = $(".bg-container").css("background-image");
        currBgImg = 'linear-gradient(180deg, rgba(227, 155, 202, 0.7) 20%, rgba(88, 152, 201, 0.2) 60%), ' + currBgImg;
        $(".bg-container").css("background-image", currBgImg);
        $(".bg-container, .page-header-block").addClass("addCircle");
        $(".main-header").addClass("lastWhite");
      }
    }
    // RESIZE MAP - CONTACTS PAGE
    if ($(".contactspage")) {
      var mapWidth = $(".contactspage .map-block #map").width();
      $(".contactspage .map-block #map").css("height", mapWidth);
    }
    // FIXED HEADER
    // if ($(window).width() > 992) {
    //   $(window).scroll(function(){
    //     var curr_position = $(window).scrollTop();
    //     if (curr_position > 150 ) {
    //       $('.site-header').addClass('fixhead');
    //     } else {
    //       $('.site-header').removeClass('fixhead');
    //     }
    //   });
    // }
    // MENU
    if ($(window).width() <= 992) {
      $(".main-header__navbtn a.nav-icon").on("click", function(e) {
        $("body, header.main-header, .main-header__navbtn a.nav-icon").toggleClass("open");
        e.preventDefault();
      });
      $(".main-header .main-nav .nav-item .nav-item__url").on("click", function() {
        $("body, header.main-header, .main-header__navbtn a.nav-icon").removeClass("open");
      });
    }

    // SLIDERS
    if ($('.any-slider')) {
      if (parseInt($('.any-slider .slide-item').length) > 1) {
        // Home slider
        $('.home-slider').slick({
          dots: true,
          arrows: false,
          infinite: true,
          speed: 500,
          slidesToShow: 1,
          fade: true,
          cssEase: 'linear'
        });
      }
    }
    // SKROLL BLOCKS
    if ($('.scroll-frame')) {
      $('.scroll-frame').each(function(i){
        var $frame = $(this);
        $(this).attr("id", "scrollFrame-" + i);
        var frameId = "#" + $(this).attr("id");
    		var $wrap  = $(frameId).parent();
    		$(frameId).sly({
    			horizontal: 1,
    			itemNav: 'basic',
    			smart: 1,
    			activateOn: 'click',
    			mouseDragging: 1,
    			touchDragging: 1,
    			releaseSwing: 1,
    			startAt: 0,
    			scrollBar: $wrap.find('.frame-scrollbar'),
    			scrollBy: 1,
    			speed: 1000,
    			elasticBounds: 1,
    			easing: 'easeOutExpo',
    			dragHandle: 1,
    			dynamicHandle: 1,
    			clickBar: 1
    		});
      });
    }
    // CUSTOM POPUP
    function EventPopup(event) {
      $("body, .custom-popup").toggleClass("openpop");
      event.preventDefault();
    }
    $(".custom-popup .pop-close, .adv-item .btn, .playbtn-block .playbtn, .openformbtn").on("click", EventPopup);
    // ADV SETUP
    if ($(".advantages-block")) {
      function openAdv(event) {
        if ($(window).width() >= 993) {
          $(".custom-popup .btn-nav").show();
        }
        $(this).parents(".adv-item").addClass("activeItem");
        $(".custom-popup").addClass("clonedCont");
        event.preventDefault();
      }
      function replaceContent() {
        $(".custom-popup .pop-content").empty();
        $(".adv-item.activeItem .adv-item__content").clone().appendTo(".custom-popup .pop-content").hide().fadeIn('slow');;
        $(".custom-popup .pop-content .adv-item__content .btn").remove();
      }
      function closeCloned(event) {
        $(".custom-popup .pop-content").empty();
        $(".custom-popup").removeClass("clonedCont");
        $(".adv-item.activeItem").removeClass("activeItem");
        event.preventDefault();
      }
      function nextAdvItem(event) {
        $(".advantages-block__inner .adv-item").each(function(i){
          if ($(this).hasClass("activeItem") && $(this).next().length) {
            $(this).removeClass("activeItem").next().addClass("activeItem");
            replaceContent();
            return false;
          } else if ($(this).hasClass("activeItem") && !$(this).next().length) {
            $(this).removeClass("activeItem");
            $(".advantages-block__inner .adv-item:first-child").addClass("activeItem");
            replaceContent();
            return false;
          }
        });
        event.preventDefault();
      }
      function prevAdvItem(event) {
        $(".advantages-block__inner .adv-item").each(function(i){
          if ($(this).hasClass("activeItem") && $(this).prev().length) {
            $(this).removeClass("activeItem").prev().addClass("activeItem");
            replaceContent();
            return false;
          } else if ($(this).hasClass("activeItem") && !$(this).prev().length) {
            $(this).removeClass("activeItem");
            $(".advantages-block__inner .adv-item:last-child").addClass("activeItem");
            replaceContent();
            return false;
          }
        });
        event.preventDefault();
      }
      $(".adv-item .btn").on("click", openAdv);
      $(".adv-item .btn").on("click", replaceContent);
      if ($(window).width() >= 993) {
        $(".custom-popup .btn.btn-nav-next").on("click", nextAdvItem);
        $(".custom-popup .btn.btn-nav-prev").on("click", prevAdvItem);
      }
      $(".custom-popup .pop-close").on("click", closeCloned);
    }
    // PLAY VIDEO (About us)
    if ($(".playbtn-block") && $(window).width() >= 993) {
      function showVideo() {
        $(".custom-popup .pop-content").empty();
        $(".playbtn-block .videoblk").clone().appendTo(".custom-popup .pop-content").hide().fadeIn('slow');
      }
      $(".playbtn-block .playbtn").on("click", showVideo);
    }
    // POPUP CONTACTS
    if ($(".openformbtn")) {
      function showForm() {
        $(".custom-popup .pop-content").empty();
        $(".popupFormBlock .popupForm").clone().appendTo(".custom-popup .pop-content").hide().fadeIn('slow');
      }
      $(".openformbtn").on("click", showForm);
      // on submit
      function showFormThank(event) {
        event.preventDefault();
        $(".custom-popup .pop-content").empty();
        $(".popupFormBlock .tnkMessage").clone().appendTo(".custom-popup .pop-content").hide().fadeIn('slow');
      }
      $(".custom-popup .popupForm #inlineform button").on("click", showFormThank);
    }
  })
});
