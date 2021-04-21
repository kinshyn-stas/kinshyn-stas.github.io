"use strict";

$(document).ready(function(){
    $('.mer_slider').on('init', function(event, slick){
      $(this).parents('.mer_content').find('.slide_counter_all').text(slick.$slides.length);
    });

    $('.mer_slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
      $(this).parents('.mer_content').find('.slide_counter_current').text(nextSlide + 1);
      $(this).parents('.mer_content').find('.mer_label').removeClass('active');
      $(this).parents('.mer_content').find(`.mer_label_wrapper:nth-child(${nextSlide + 1}) .mer_label`).addClass('active');
    });

    $('.mer_slider').slick({
        infinite: true,
        dots: true,
    });


    $('.vl_slider').on('init', function(event, slick){
      $(this).parents('.vl_block').find('.slide_counter_all').text(slick.$slides.length);
    });

    $('.vl_slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
      $(this).parents('.vl_block').find('.slide_counter_current').text(nextSlide + 1);
    });

    $('.vl_slider').slick({
        infinite: true,
        slidesToShow: 2,
        variableWidth: true,
        responsive: [
        {
          breakpoint: 769,
          settings: {
            slidesToShow: 1,
            variableWidth: false,
          }
        }]
    });
    

    $('.pd_slider').slick({
        infinite: true,
        slidesToShow: 4,
        responsive: [
        {
          breakpoint: 769,
          settings: {
            slidesToShow: 2
          }
        }]
    });


    $('.gr_box').slick({
        infinite: false,
        slidesToShow: 4,
        responsive: [
        {
          breakpoint: 1101,
          settings: {
            infinite: true,
            slidesToShow: 2
          }
        }]
    });


    $('.com_bottom_box').slick({
        infinite: true,
        slidesToShow: 3,
        variableWidth: true,
        arrows: false,
        responsive: [
        {
          breakpoint: 1101,
          settings: {
            slidesToShow: 2,        
          }
        },
        {
          breakpoint: 769,
          settings: {
            slidesToShow: 1,            
            variableWidth: false,
          }
        }]
    });
});


window.onload = function(){
    document.addEventListener('click', clickItemHandler);

    document.addEventListener('mouseover', mouseMenuHandler);

    document.querySelectorAll('.mer_labels').forEach(block => {
        if(block.querySelector('.mer_labels_box').children.length < 5) block.classList.remove('harmonic');
    });

    changerHeaderClass();
    document.addEventListener('scroll',changerHeaderClass);
};


function clickItemHandler(event){
    if(!event.target.closest('.click-item')) return;
    let item = event.target.closest('.click-item');
    let parent;
    if(event.target.closest('.click-obj')) parent = event.target.closest('.click-obj');

    let obj = {
        'toggle': function(target){
            parent.classList.toggle('active');
        },

        'popup-open': function(target){
            if(target.dataset.label){
                document.querySelector(target.dataset.label).classList.add('active');
            } else {
                console.log('укажите селектор требуемого элемента в data-label нажимаемой кнопки')
            }
        },

        'popup-submit': function(target){
            let p1 = target.closest('.popup_container');
            p1.querySelectorAll('input,textarea').forEach(i => {
                i.value = '';
            });
            p1.classList.remove('active');

            if(target.dataset.label){
                document.querySelector(target.dataset.label).classList.add('active');
            }
        },

        'menu-toggle': function(target){
            document.querySelector('.header_block').classList.toggle('active');
        },

        'slick-label': function(target){
            let arr = Array.from(target.parentNode.parentNode.children);

            if(document.documentElement.clientWidth <= 768){
                arr.forEach(item => item.querySelector('.mer_label').classList.remove('active'));
                target.classList.add('active');
            } else {
                let n;
                arr.forEach((item,i) => {
                    if(item.querySelector('.mer_label') === target) n = i;
                });
                let dots = target.closest(target.dataset.label).querySelector('.slick-dots');
                dots.children[n].click();                
            }
        },

        'slick-arrow': function(target){
            let p = target.closest(target.dataset.label);
            if(target.classList.contains('slide_arrow-left')){
                p.querySelector('.slick-prev').click();
            } else {
                p.querySelector('.slick-next').click();
            }
        },

        'tab-change': function(target){
            if(target.classList.contains('active')) return;
            let n = 0;
            parent.querySelectorAll('.com_tabs_label').forEach((item,i) => {
                item.classList.remove('active');
                if(item === target) n = i;
            });
            target.classList.add('active');

            parent.querySelectorAll('.com_tabs_tab').forEach((item,i) => {
                item.classList.remove('active');
                if(i === n) item.classList.add('active');
            });
        },
    }

    if(item.dataset.action){
        let actions = item.dataset.action.split(' ');
        actions.forEach(action => obj[action](item));
    } else {
        obj['toggle'](item);
    }
};


function mouseMenuHandler(event){
    if(event.target.closest('.header_nav_list_item')){
        let target = event.target.closest('.header_nav_list_item');
        document.querySelectorAll('.header_nav_list_item').forEach(item => item.classList.remove('active'))
        target.classList.add('active')

        let img;
        console.log()
        if(target.dataset.src && document.querySelector('.header_nav_right_img')){
            img = document.querySelector('.header_nav_right_img');
            img.classList.remove('active');
            img.src = target.dataset.src;
            img.classList.add('active');
        }
    }

    if(event.target.closest('.header_nav_list_item_list_item')){
        let target = event.target.closest('.header_nav_list_item_list_item');
        document.querySelectorAll('.header_nav_list_item_list_item').forEach(item => item.classList.remove('active'))
        target.classList.add('active');
    }
};


function changerHeaderClass(){
    document.querySelectorAll('.header_block').forEach(header => {
        let flag = false;

        if(!pageYOffset){
            document.querySelectorAll('.main-block').forEach(block => {
                if(block.classList.contains('pr_block')){
                    let b = block.getBoundingClientRect();
                    if(b.top <= 0 && b.bottom >= header.getBoundingClientRect().height){
                        flag = true;
                    }
                }
            })            
        }

        if(flag){
            header.classList.add('transparent');
        } else {
            header.classList.remove('transparent');
        }
    })
};