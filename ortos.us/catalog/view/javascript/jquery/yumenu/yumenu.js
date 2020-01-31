/*
 * YUMenu v1.0.7 Copyright © 2018, iDiY
 */

function ellipsis($hmenu) {
    if ($(window).width() >= 768) {
        $hmenu.each(function(i) {
            var menu_pos = $(this).offset(),
                menu_width = $(this).outerWidth(),
                menu_pos_right = menu_pos.left + menu_width,
                main_list = $(this).children('nav').children('ul');

            main_list.children('.item-ellipsis').remove();
            main_list.children().removeClass('hidden');

            main_list.children('li').each(function() {
                var item_pos = $(this).offset(),
                    item_width = $(this).outerWidth(),
                    item_pos_right = item_pos.left + item_width + 75;

                if (item_pos_right > menu_pos_right) {
                    $(this).addClass('outside');
                }
            });

            var $outside = main_list.children('li.outside');

            if ($outside.length) {
                main_list.append('<li class="single-list item-ellipsis"><div><a class="toggle"><span class="title"><i class="fa fa-ellipsis-h"></i></span></a></div></li>');

                var $outside_clone = $outside.clone(),
                $pos_wrapper = $outside_clone.children('ul').children('li').find('.img-top,.img-bottom');


                $pos_wrapper.each(function() {
                    var $list_lvl3 = $(this).children('ul');
                    $list_lvl3.appendTo($(this).parent());
                });

                $outside.removeClass('outside');
                $outside_clone.removeClass('multi-list').addClass('single-list').appendTo(main_list.children('.item-ellipsis')).wrapAll('<ul></ul>');

                $outside.addClass('hidden');
            }
            main_list.removeClass('list-overflow');
        });

        $hmenu.find('ul').aimMenu({
            submenuDirection: 'right',
            activate: function(item) {
                if ($(window).width() >= 768) {
                    var list = $(item).children('ul');

                    $(item).addClass('selected');
                    $(item).siblings('.selected').removeClass('selected');

                    list.addClass('list-active');

                    var menu_width = $hmenu.outerWidth(),
                        menu_pos = $hmenu.offset(),
                        menu_pos_left = menu_pos.left,
                        menu_pos_right = Math.round(menu_pos_left + menu_width),
                        list_width = list.outerWidth(),
                        list_pos = list.offset(),
                        list_pos_left = typeof list_pos !== 'undefined' ? list_pos.left : 0,
                        list_pos_right = Math.round(list_pos_left + list_width);

                    if ($(item).hasClass('single-list') || $(item).parents('.single-list').length) {
                        if (list_pos_right > menu_pos_right) {
                            list.addClass('to-down');
                        }
                    }

                    if ($(item).hasClass('multi-list') && $(item).not('.fw-list')) {
                        if (list_pos_right > menu_pos_right || list_pos_left < menu_pos_left) {
                            $(item).addClass('fw-list');
                        }
                    }
                }
            },
            deactivate: function(item){
                if ($(window).width() >= 768) {
                    $(item).removeClass('selected');
                    $(item).children('ul').removeClass('list-active to-down');
                }
            },
            exitMenu: function(list) {
                if ($(window).width() >= 768) {
                    var $active = $(list).find('selected');
                    $active.removeClass('selected');
                    $active.children('ul').removeClass('list-active');
                }
                return true;
            }
        });
    }
}

$(document).ready(function() {
    var $menu = $('.yum'),
        $header = $menu.children('div');

    $header.on('click',function() {
        var toggler = $(this),
            content = toggler.next();

        if (toggler.is('.minimized,.toggler') || $(window).width() < 768) {
            if (content.is(':visible')) {
                toggler.removeClass('extended');
                content.slideUp(400, function() {
                    toggler.addClass('minimized');
                });
            } else {
                if (content.outerHeight(true) == 0) {
                    var listh = content.show().find('.list-active').last().outerHeight(true);
                    if (listh > 0) {
                        content.height(listh).hide();
                    } else {
                        content.css('height', 'auto').hide();
                    }
                }

                toggler.addClass('extended');
                content.slideDown(400, function() {
                    toggler.removeClass('minimized');
                });
            }
        }
    });


    // Accordion Menu
    var $amenu = $('.amenu');

    $amenu.on('click', '.toggle', function(e) {
        e.preventDefault();

        var item = $(this).closest('li'),
            list = item.children('ul'),
            siblings = item.siblings('.selected'),
            siblings_list = siblings.children('ul'),
            $siblings_selected = siblings.find('.selected'),
            $siblings_selected_list = $siblings_selected.children('ul');

        if ($(window).width() < 768) {
            if (list.is(':hidden')) {
                var item_pos = item.offset(),
                    item_pos_top = item_pos.top;

                if (item.siblings('.selected-xs').length) {
                    var siblings_pos = item.siblings('.selected-xs').offset(),
                        siblings_pos_top = siblings_pos.top,
                        siblings_list_h = item.siblings('.selected-xs').children('ul').outerHeight(true);

                    if (siblings_pos_top < item_pos_top) {
                        $('html, body').animate({scrollTop:(item_pos_top-siblings_list_h)}, 300);
                    } else {
                        $('html, body').animate({scrollTop:item_pos_top}, 300);
                    }
                } else {
                    $('html, body').animate({scrollTop:item_pos_top}, 300);
                }
            }

            if (item.is('.selected')) {
                item.removeClass('selected');
            }

            item.toggleClass('selected-xs');
        }

        item.toggleClass('selected');
        list.slideToggle(300);

        siblings.removeClass('selected selected-xs');
        siblings_list.slideUp(300, function() {
            $siblings_selected.removeClass('selected selected-xs');
            $siblings_selected_list.hide();
        });
    });


    // Push Menu
    var $pmenu = $('.pmenu');

    $pmenu.on('click', '.toggle', function(e) {
        e.preventDefault();

        var item = $(this).closest('li'),
            sub = item.children('ul'),
            subh = sub.outerHeight(true),
            list = item.closest('.list-invisible'),
            listh = list.outerHeight(true),
            navlist = item.closest('nav'),
            $parents = $(item).parents('ul'),
            $siblings = $(item).siblings(),
            $siblingssub = $siblings.children('ul');

        sub.show();
        $siblingssub.hide();
        $(item).siblings('.more-wrapper').children('li').children('ul').hide();
        $(item).parent('.more-wrapper').siblings().children('ul').hide();

        if (item.is('.prev-list')) {
            list.addClass('list-action').removeClass('list-invisible').children('.selected').not('.prev-list').removeClass('selected');
            navlist.animate({'height': listh}, 200);
        } else {
            $parents.addClass('list-invisible list-action');
            navlist.animate({'height': subh}, 200);
        }
    });


    // Flyout Menu
    var $fmenu = $('.fmenu');

    $fmenu.on('click', '.toggle', function(e) {
        e.preventDefault();

        var item = $(this).closest('li'),
            list = item.children('ul'),
            siblings = item.siblings('.selected-xs'),
            siblings_list = siblings.children('ul'),
            $main_list = $fmenu.children('nav').children('ul'),
            $siblings_selected = siblings.find('.selected-xs'),
            $siblings_selected_list = $siblings_selected.children('ul');

        if ($(window).width() < 768) {
            var size = parseInt(item.css('font-size'),10),
                padding = parseInt(item.children('div').css('padding-left'),10);

            if (list.is(':hidden')) {
                var item_pos = item.offset(),
                    item_pos_top = item_pos.top;

                if (item.siblings('.selected-xs').length) {
                    var siblings_pos = item.siblings('.selected-xs').offset(),
                        siblings_pos_top = siblings_pos.top,
                        siblings_list_h = item.siblings('.selected-xs').children('ul').outerHeight(true);

                    if (siblings_pos_top < item_pos_top) {
                        $('html, body').animate({scrollTop:(item_pos_top-siblings_list_h)}, 300);
                    } else {
                        $('html, body').animate({scrollTop:item_pos_top}, 300);
                    }
                } else {
                    $('html, body').animate({scrollTop:item_pos_top}, 300);
                }
            }

            item.toggleClass('selected-xs');
            list.children().children('div').css('padding-left',(padding/size)+1+'em');

            list.slideToggle(300, function() {
                item.toggleClass('item-active');
                list.css('display','');
            });

            siblings.removeClass('selected selected-xs');
            siblings_list.slideUp(300, function() {
                siblings.removeClass('item-active');
                $siblings_selected.removeClass('selected-xs item-active');
                $siblings_selected_list.hide().css('display','');
            });
        } else {
            var main = item.closest('.list-item'),
                title = main.children('div').outerHeight(true),
                img = main.children('p').outerHeight(true),
                current = item.closest('ul').outerHeight(true),
                sub = list.outerHeight(true),
                prev = item.parent().closest('.list-moved').outerHeight(true);

            list.toggleClass('list-active');

            if (item.is('.prev-list')) {
                item.closest('.list-moved').removeClass('list-moved');

                if (current != prev) {
                    main.animate({'height': prev+title+img}, 200);
                }
            } else {
                if (item.parents().is('.multi-list')) {
                    list.show();
                    item.siblings().find('ul').css('display','');
                    item.closest('ul').not($main_list).addClass('list-moved');

                    if (current != sub) {
                        main.animate({'height': sub+title+img}, 200);
                    }
                }
            }
        }
    });

    $fmenu.each(function() {
        if ($(this).closest('#column-right').length) {
            $(this).addClass('to-left');
        }

        var $navlist = $(this).find('ul').not('.multi-list ul'),
            delay;

        function startTimeout(list) {
            delay = setTimeout(function(){
             $(list).children().children('.list-active').css({'max-height':'','overflow-y':''}).removeClass('list-active');
             $(list).children('.selected').removeClass('selected');
             $(list).children('.more-wrapper').children('.selected').removeClass('selected');
         }, 1000);
        }

        function stopTimeout() {
            clearTimeout(delay);
        }

        $navlist.aimMenu({
            submenuDirection: $(this).is('.to-left') ? 'left' : 'right',
            activate: function(item) {
                if ($(window).width() >= 768) {
                    var list = $(item).children('ul');
                    $(item).addClass('selected');
                    $(item).siblings('.selected').removeClass('selected').children('ul').removeClass('list-active to-down');
                    $(item).parent('.more-wrapper').siblings('.selected').removeClass('selected').children('ul').removeClass('list-active to-down');
                    list.addClass('list-active');

                    if ($(item).hasClass('single-list') || $(item).parents('.single-list').length) {
                        var container_width = container.width(),
                            container_pos = container.offset(),
                            container_pos_left = container_pos.left,
                            container_pos_right = container_pos_left + container_width,
                            list_width = list.outerWidth(),
                            list_pos = list.offset(),
                            list_pos_left = typeof list_pos !== 'undefined' ? list_pos.left : 0,
                            list_pos_right = list_pos_left + list_width;

                        if (list_pos_right > container_pos_right) {
                            list.addClass('to-down');
                        }
                    }

                    if ($(item).hasClass('multi-list')) {
                        $(item).siblings().children('ul').css({'max-height':'','overflow-y':''});

                        var window_height = $(window).height(),
                            window_top = $(window).scrollTop(),
                            list_height = list.outerHeight(true),
                            list_offset = list.offset(),
                            list_offset_top = typeof list_offset !== 'undefined' ? list_offset.top : 0,
                            list_window_top = list_offset_top - window_top,
                            outside = (list_window_top+list_height)-window_height;

                        if (outside > 0) {
                            var max_height = list_height-outside-30;
                            list.css({'max-height':max_height,'overflow-y':'auto'});
                        }
                    }
                }

                stopTimeout();
            },
            exitMenu: function(list) {
                startTimeout(list);
                return true;
            }
        });
    });


    // Horizontal Menu
    var $hmenu = $('.hmenu');

    ellipsis($hmenu);
    $(window).on('resize', function() {
        ellipsis($hmenu);
    });

    $hmenu.on('click', '.toggle', function(e) {
        e.preventDefault();

        var item = $(this).closest('li'),
            list = item.children('ul'),
            siblings = item.siblings('.selected-xs'),
            siblings_list = siblings.children('ul'),
            $siblings_selected = siblings.find('.selected-xs'),
            $siblings_selected_list = $siblings_selected.children('ul'),
            active_siblings = item.siblings('.selected'),
            $active_siblings_list = active_siblings.children('ul'),
            $active_children = active_siblings.find('.selected'),
            $active_children_list = $active_children.children('ul');

        if ($(window).width() < 768) {
            var size = parseInt(item.css('font-size'),10),
                padding = parseInt(item.children('div').css('padding-left'),10);

            if (list.is(':hidden')) {
                var item_pos = item.offset(),
                    item_pos_top = item_pos.top;

                if (item.siblings('.selected-xs').length) {
                    var siblings_pos = item.siblings('.selected-xs').offset(),
                        siblings_pos_top = siblings_pos.top,
                        siblings_list_h = item.siblings('.selected-xs').children('ul').outerHeight(true);

                    if (siblings_pos_top < item_pos_top) {
                        $('html, body').animate({scrollTop:(item_pos_top-siblings_list_h)}, 300);
                    } else {
                        $('html, body').animate({scrollTop:item_pos_top}, 300);
                    }
                } else {
                    $('html, body').animate({scrollTop:item_pos_top}, 300);
                }
            }

            item.toggleClass('selected-xs');

            list.children().children('div').css('padding-left',(padding/size)+1+'em');
            list.slideToggle(300, function() {
                item.toggleClass('item-active');
                list.css('display','');
            });

            siblings.removeClass('selected-xs');
            active_siblings.removeClass('selected');

            siblings_list.slideUp(300, function() {
                siblings.removeClass('item-active');
                $siblings_selected.removeClass('selected-xs item-active');
                $siblings_selected_list.hide().css('display','');
            });
        } else {
            if (list.is('.list-active')) {
                item.removeClass('selected');
            } else {
                item.addClass('selected');
            }

            active_siblings.removeClass('selected');
            $active_children.removeClass('selected');
            $active_siblings_list.removeClass('list-active');
            $active_children_list.removeClass('list-active');

            list.toggleClass('list-active');

            var menu_width = $hmenu.outerWidth(),
                menu_pos = $hmenu.offset(),
                menu_pos_left = menu_pos.left,
                menu_pos_right = Math.round(menu_pos_left + menu_width),
                list_width = list.outerWidth(),
                list_pos = list.offset(),
                list_pos_left = typeof list_pos !== 'undefined' ? list_pos.left : 0,
                list_pos_right = Math.round(list_pos_left + list_width);

            if ($(item).hasClass('single-list') || $(item).parents('.single-list').length) {
                if (list_pos_right > menu_pos_right) {
                    list.addClass('to-down');
                } else {
                    list.removeClass('to-down');
                }
            }

            if ($(item).hasClass('multi-list') && $(item).not('.fw-list')) {
                if (list_pos_right > menu_pos_right || list_pos_left < menu_pos_left) {
                    $(item).addClass('fw-list');
                }
            }

            if (item.parents().is('.multi-list')) {
                var parent = item.parent().outerHeight(true),
                    sub = list.outerHeight(true),
                    back = list.children('.prev-list'),
                    $main_list = $hmenu.children('nav').children('ul');

                if (item.is('.prev-list')) {
                    var data = item.data('list');

                    item.parents('.list-moved').last().animate({height:data}, 200);
                    item.closest('.list-moved').removeClass('list-moved');
                } else {
                    back.attr('data-list', parent);

                    list.show();
                    item.siblings().find('ul').css('display','');
                    item.closest('ul').not($main_list).addClass('list-moved');

                    if (parent != sub) {
                        item.parents('.list-moved').last().animate({'height': sub}, 200);
                    }
                }
            }
        }
    });


    //Amazon menu
    var $amazon = $('.ahmenu'),
        container = $amazon.closest('.container');

    $amazon.on('click', '.toggle', function(e) {
        e.preventDefault();

        var item = $(this).closest('li'),
            list = item.children('ul'),
            siblings = item.siblings('.selected-xs'),
            siblings_list = siblings.children('ul'),
            $siblings_selected = siblings.find('.selected-xs'),
            $siblings_selected_list = $siblings_selected.children('ul'),
            active_siblings = item.siblings('.selected'),
            $active_siblings_list = active_siblings.children('ul'),
            $active_children = active_siblings.find('.selected'),
            $active_children_list = $active_children.children('ul');

        if ($(window).width() < 768) {
            var size = parseInt(item.css('font-size'),10),
                padding = parseInt(item.children('div').css('padding-left'),10);

            if (list.is(':hidden')) {
                var item_pos = item.offset(),
                    item_pos_top = item_pos.top;

                if (item.siblings('.selected-xs').length) {
                    var siblings_pos = item.siblings('.selected-xs').offset(),
                        siblings_pos_top = siblings_pos.top,
                        siblings_list_h = item.siblings('.selected-xs').children('ul').outerHeight(true);

                    if (siblings_pos_top < item_pos_top) {
                        $('html, body').animate({scrollTop:(item_pos_top-siblings_list_h)}, 300);
                    } else {
                        $('html, body').animate({scrollTop:item_pos_top}, 300);
                    }
                } else {
                    $('html, body').animate({scrollTop:item_pos_top}, 300);
                }
            }

            item.toggleClass('selected-xs');

            list.children().children('div').css('padding-left',(padding/size)+1+'em');
            list.slideToggle(300, function() {
                item.toggleClass('item-active');
                list.css('display','');
            });

            siblings.removeClass('selected-xs');
            active_siblings.removeClass('selected');

            siblings_list.slideUp(300, function() {
                siblings.removeClass('item-active');
                $siblings_selected.removeClass('selected-xs item-active');
                $siblings_selected_list.hide().css('display','');
            });
        } else {
            if (list.is('.list-active')) {
                item.removeClass('selected');
            } else {
                item.addClass('selected');
            }

            active_siblings.removeClass('selected');
            $active_children.removeClass('selected');
            $active_siblings_list.removeClass('list-active');
            $active_children_list.removeClass('list-active');

            list.toggleClass('list-active');

            var container_width = container.width(),
                container_pos = container.offset(),
                container_pos_left = container_pos.left,
                container_pos_right = Math.round(container_pos_left + container_width),
                menu_width = $amazon.outerWidth(true),
                list_width = list.outerWidth(),
                list_pos = list.offset(),
                list_pos_left = typeof list_pos !== 'undefined' ? list_pos.left : 0,
                list_pos_right = Math.round(list_pos_left + list_width);

            if ($(item).hasClass('single-list') || $(item).parents('.single-list').length) {
                if (list_pos_right > container_pos_right) {
                    list.addClass('to-down');
                } else {
                    list.removeClass('to-down');
                }
            }

            if ($(item).hasClass('multi-list')) {
                if (list_pos_right > container_pos_right) {
                    list.outerWidth(container_width-menu_width);
                }
            }

            if (item.parents().is('.multi-list')) {
                var parent = item.parent().outerHeight(true),
                    sub = list.outerHeight(true),
                    back = list.children('.prev-list'),
                    $main_list = $amazon.children('nav').children('ul');

                if (item.is('.prev-list')) {
                    var data = item.data('list');

                    item.parents('.list-moved').last().animate({height:data}, 200);
                    item.closest('.list-moved').removeClass('list-moved');
                } else {
                    back.attr('data-list', parent);

                    list.show();
                    item.siblings().find('ul').css('display','');
                    item.closest('ul').not($main_list).addClass('list-moved');

                    if (parent != sub) {
                        item.parents('.list-moved').last().animate({'height': sub}, 200);
                    }
                }
            }
        }
    });

    $amazon.each(function() {
        var menu = $(this),
            $amazon_header = menu.children('div'),
            $amazon_lists = menu.find('ul');

        if (menu.closest('#column-right').length) {
            menu.addClass('to-left');
        }

        $amazon_header.on('click',function() {
            var toggler = $(this),
                content = toggler.next();

            if ($(window).width() >= 768) {
                if (content.is(':visible')) {
                    toggler.removeClass('extended');
                    setTimeout(function(){
                        content.removeClass('list-visible');
                    }, 500);
                } else {
                    content.addClass('list-visible');
                    setTimeout(function(){
                        toggler.addClass('extended');
                    }, 50);
                }
                content.css('display', '');
            }
        });

        var delay;

        function startTimeout(list) {
            delay = setTimeout(function(){
             $(list).children().find('.list-active').css({'max-height':'','min-height':'','overflow-y':'','width':''}).removeClass('list-active to-down');
             $(list).children('.selected').removeClass('selected');
         }, 1000);
        }

        function stopTimeout() {
            clearTimeout(delay);
        }

        $amazon_lists.aimMenu({
            submenuDirection: menu.is('.to-left') ? 'left' : 'right',
            activate: function(item) {
                if ($(window).width() >= 768) {
                    $(item).addClass('selected').children('ul').addClass('list-active');
                    $(item).siblings('.selected').removeClass('selected').find('.list-active').removeClass('list-active to-down');

                    var container_width = container.width(),
                        container_pos = container.offset(),
                        container_pos_left = container_pos.left,
                        container_pos_right = Math.round(container_pos_left + container_width),
                        menu_width = $amazon.outerWidth(true),
                        list = $(item).children('ul'),
                        list_width = list.outerWidth(),
                        list_pos = list.offset(),
                        list_pos_left = typeof list_pos !== 'undefined' ? list_pos.left : 0,
                        list_pos_right = Math.round(list_pos_left + list_width);

                    if ($(item).hasClass('single-list') || $(item).parents('.single-list').length) {
                        if (list_pos_right > container_pos_right) {
                            list.addClass('to-down');
                        }
                    }

                    if ($(item).hasClass('multi-list')) {
                        var window_height = $(window).height(),
                            window_top = $(window).scrollTop(),
                            menu_height = menu.children('nav').outerHeight(),
                            list_height = list.outerHeight(true),
                            list_offset = list.offset(),
                            list_offset_top = typeof list_offset !== 'undefined' ? list_offset.top : 0,
                            list_window_top = list_offset_top - window_top,
                            outside = (list_window_top+list_height)-window_height;

                        if ($(item).hasClass('multi-list')) {
                            if (list_pos_right > container_pos_right) {
                                list.outerWidth(container_width-menu_width);
                            }
                        }

                        $(item).children('ul').css('min-height', menu_height);
                        $(item).siblings().children('ul').css({'max-height':'','min-height':'','overflow-y':'','width':''});

                        if (outside > 0) {
                            var max_height = list_height-outside-30;
                            list.css({'max-height':max_height, 'overflow-y':'auto'});
                        }
                    }
                }
                stopTimeout();
            },
            exitMenu: function(list) {
                startTimeout(list);
                return true;
            }
        });
    });


    //Showcase
    var $sc = $('.showcase');

    $sc.on('click', '.toggle', function(e) {
        e.preventDefault();

        var item = $(this).closest('li'),
            list = item.children('ul'),
            $siblings = item.siblings(),
            $siblings_lists = $siblings.find('ul'),
            parent = item.parent().outerHeight(true),
            sub = list.outerHeight(true),
            back = list.children('.prev-list'),
            $main_list = $sc.children('nav').children('ul');

            list.toggleClass('list-active');

        if (item.is('.prev-list')) {
            var data = item.data('list');

            item.parents('.list-moved').last().animate({height:data}, 200);
            item.closest('.list-moved').removeClass('list-moved');
        } else {
            back.attr('data-list', parent);

            list.show();
            $siblings_lists.css('display','');
            item.closest('ul').not($main_list).addClass('list-moved');

            if (parent != sub) {
                item.parents('.list-moved').last().animate({'height': sub}, 200);
            }
        }
    });


    //More btn
    var $more_btn = $('.menu-more-btn');

    $more_btn.on('click', function(e) {
        e.preventDefault();

        var show_more = $(this).data('show-more');
        var hide_more = $(this).data('hide-more');

        if ($(this).prev().is(':hidden')) {
            $(this).find('a').text(hide_more);
        } else {
            $(this).find('a').text(show_more);
        }

        $(this).prev().slideToggle(300);
        $(this).closest('.pmenu').children('nav').css('height','auto');
    });

});