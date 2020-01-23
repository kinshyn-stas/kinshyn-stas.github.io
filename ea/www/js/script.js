jQuery(function($) {
  $(document).ready(function() {
    /* BODY CLASS */
    $("body").addClass($("main").attr("class"));
    if ($("#preloader").length) {
      $("body").addClass("preloadOn");
      setTimeout(function(){
        $("body").removeClass("preloadOn");
      }, 5000);
    }
    /*-----------------------------------------------------------------
      Detect device mobile
    -------------------------------------------------------------------*/
    var isMobile = false;
    if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('html').addClass('touch');
        isMobile = true;
    } else {
        $('html').addClass('no-touch');
        isMobile = false;
    }
    // BURGER MENU
    $(".nav-menu-toggler").on("click", function(event) {
        $("header.main-header, header.main-header .nav-menu-toggler").toggleClass("open");
        event.preventDefault();
    });
    // SVG INLINE IMAGES
    $('body img').each(function() {
      var $img = $(this);
      var imgID = $img.attr('id');
      var imgClass = $img.attr('class');
      var imgURL = $img.attr('src');
      $.get(imgURL, function(data) {
        var $svg = $(data).find('svg');
        if (typeof imgID !== 'undefined') {
          $svg = $svg.attr('id', imgID);
        }
        if (typeof imgClass !== 'undefined') {
          $svg = $svg.attr('class', imgClass + ' replaced-svg');
        }
        $svg = $svg.removeAttr('xmlns:a');
        if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
          $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
        }
        $img.replaceWith($svg);
      }, 'xml');
    });
    // SIDE HEADER
    $(window).scroll(function(){
      var curr_position = $(window).scrollTop();
      if (curr_position > 100 ) {
        $('.logo-block a').addClass('scrolled');
      } else {
        $('.logo-block a').removeClass('scrolled');
      }
    });
    // SCROLL ANIMATION
    $("body").on("click", ".home-mainblock a.btn-bfline", function(event) {
      var id = $(this).attr('href'),
        top = $(id).offset().top - 1;
      $('body,html').animate({
        scrollTop: top,
        easing: "swing"
      }, 1200);
      event.preventDefault();
    });
    /*-----------------------------------------------------------------
      VIEWPORT / ANIMATION
    -------------------------------------------------------------------*/
    if ($(window).width() > 992) {
      // SECTIONs
      $('section, header .side-nav, .imgWrap').addClass("hidden").viewportChecker({
        classToAdd: 'visible',
        classToRemove: 'hidden',
        offset: 10,
        invertBottomOffset: true,
        repeat: false,
        callbackFunction: function(elem, action){},
        scrollHorizontal: false
      });
      // HOME MAIN BLOCK
      $('header .logo-block, header .button-block, header .soc_block, .home-mainblock .frontblock-heading, .project-page .bg-block').addClass("animated fadeInUp");
      $('.homepage header .logo-block, .homepage header .button-block, .homepage header .soc_block, .home-mainblock .frontblock-heading').css("animation-delay", "6s");
      // fadeInUp
      $('section:not(.home-mainblock) .frontblock-heading, .price-list>div, .service-list>div, footer .logo, footer .contacts, .filter-list, .project-info .info-block, .project-info .info-more, .project-nav a').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInUp',
        classToRemove: 'hidden'
      });
      // fadeInLeft
      $('.btn-aftline, section:not(.home-mainblock) .btn-bfline').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInLeft',
        classToRemove: 'hidden'
      });
      // fadeInRight
      $('h3, footer .bottom-line, .work-item .info-part').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInRight',
        classToRemove: 'hidden'
      });
      // for filter
      $('.work-item .info-part, .work-item .imgWrap').attr("data-vp-offset", "-500");
      // Closing the menu by Esc
      $(document).on('keyup', function(e) {
          if (e.keyCode === 27) $('.nav-menu-toggler').click();
      });
    }
    if ($(window).width() <= 992) {
      $(".home-workblock .head-line .col-lg-4").appendTo(".home-workblock .work-list");
      $(".work-block .work-list .work-item").each(function(){
        $($(this).find(".more:last-child")).appendTo($(this));
      });
    }
    /*-----------------------------------------------------------------
      PAGINATION
    -------------------------------------------------------------------*/
    if ($("body").hasClass("project-page")) {
      var projects = ["freakdays", "inveriaevents", "sklyanka", "legerium", "selfinvest", "c3", "nashformat"];
      var url = document.URL,
          shortUrl=url.substring(0,url.lastIndexOf("/"));
      var urlpathname = window.location.pathname;
      var currPathUrl = urlpathname.substr(urlpathname.lastIndexOf('/') + 1);
      for (var i = 0; i < projects.length; i++) {
        if (projects[i] == currPathUrl) {
          if (i > 0 && i < (projects.length - 1)) {
            var PrevUrl = projects[i - 1];
            var NextUrl = projects[i + 1];
          } else if (i == 0) {
            var PrevUrl = projects[projects.length - 1];
            var NextUrl = projects[i + 1];
          } else if (i == (projects.length - 1)) {
            var PrevUrl = projects[i - 1];
            var NextUrl = projects[0];
          }
          var PrevHref = shortUrl + "/" + PrevUrl;
          var NextHref = shortUrl + "/" + NextUrl;
          $(".project-nav a.btnarrprev").attr("href", PrevHref);
          $(".project-nav a.btnarrnext").attr("href", NextHref);
        }
      }
    }
    /*-----------------------------------------------------------------
      WORK FILTER
    -------------------------------------------------------------------*/
    $('.filter-list .filter-item a').on("click", function(event) {
    	var filter = $(this).attr("data-cat");
    	filterList(filter);
      $(this).parents(".filter-list").find('.filter-item.active').removeClass("active");
      $(this).parent(".filter-item").addClass("active");
      event.preventDefault();
    });
    function filterList(value) {
    	var list = $(".work-list .work-item");
      var filterlist = $(".filter-list .filter-item");
      $(list).addClass("deactive");
    	if (value == "All") {
    		$(".work-list").find(".work-item").each(function() {
          $(this).removeClass("deactive");
    		});
    	} else {
    		$(".work-list").find(".work-item[data-itemcat*=" + value + "]").each(function() {
          $(this).removeClass("deactive");
    		});
    	}
    }
    // Hovered link
    $('.menu-list__item').on('mouseenter', function(){
        $('.menu-list').addClass('has-hovered-link');
    });
    $('.menu-list__item').on('mouseleave', function(){
        $('.menu-list').removeClass('has-hovered-link');
    });
    // CALLBACK BACK
    $('.callbackpage .backbtn').on('click', function(e){
      e.preventDefault();
      window.history.go(-1);
      return false;
    });
    /*-----------------------------------------------------------------
      Cursor
    -------------------------------------------------------------------*/
    var $circleCursor = $('.cursor');
    function moveCursor(e) {
	    var t = e.clientX + "px",
            n = e.clientY + "px";
	    TweenMax.to($circleCursor, .2, {
            left: t,
            top: n,
	        ease: 'Power1.easeOut'
        });
    }
    $(window).on('mousemove', moveCursor);
    function zoomCursor(e) {
      $(this).css("z-index", "10001");
	    TweenMax.to($circleCursor, .1, {
        scale: 4,
        ease: 'Power1.easeOut'
      });
    }
    $('a, .zoom-cursor').on('mouseenter', zoomCursor);
    function defaultCursor(e) {
      $(this).css("z-index", "inherit");
	    TweenLite.to($circleCursor, .1, {
        scale: 1,
        ease: 'Power1.easeOut'
      });
    }
    $('a, .zoom-cursor').on('mouseleave', defaultCursor);
  });
});
