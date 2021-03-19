"use strict";

$(document).ready(function(){
    $('.mer_slider').on('init', function(event, slick){
      $('.mer_content .slide_counter_all').text(slick.$slides.length);
    });

    $('.mer_slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
      $('.mer_content .slide_counter_current').text(nextSlide + 1);
      $('.mer_label').removeClass('active');
      $(`.mer_label_wrapper:nth-child(${nextSlide + 1}) .mer_label`).addClass('active');
    });

    $('.mer_slider').slick({
        infinite: true,
        dots: true,
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
});


window.onload = function(){
    document.addEventListener('click', clickItemHandler);

    document.addEventListener('mouseover', mouseMenuHandler);
};


function functionMultiplyWrapper(func){
    try{
        func();
    } catch(err){
        console.log(err);
    }
};


function classMultiplyWrapper(Cls,parametrs){
    document.querySelectorAll(parametrs.selector).forEach((item) => {
        try{
            parametrs.item = item;
            new Cls(parametrs);
        } catch(err){
            console.log(err);
        }
    })
};


function clickItemHandler(event){
    if(!event.target.closest('.click-item')) return;
    let item = event.target.closest('.click-item');
    //if(item.getAttribute('href') && item.getAttribute('href') == '#') event.preventDefault();
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

        'menu-toggle': function(target){
            document.querySelector('.header_block').classList.toggle('active');
        },

        'slick-label':  function(target){
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

        'slick-arrow':  function(target){
            let p = target.closest(target.dataset.label);
            if(target.classList.contains('slide_arrow-left')){
                p.querySelector('.slick-prev').click();
            } else {
                p.querySelector('.slick-next').click();
            }
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
    if(event.target.closest('.header_nav_list_item-trigger')){
        document.querySelectorAll('.header_nav_list_item-trigger').forEach(item => item.classList.remove('active'))
        event.target.closest('.header_nav_list_item-trigger').classList.add('active')
    }

    if(event.target.closest('.header_nav_list_item_list_item')){
        let target = event.target.closest('.header_nav_list_item_list_item');
        document.querySelectorAll('.header_nav_list_item_list_item').forEach(item => item.classList.remove('active'))
        target.classList.add('active');
        if(target.dataset.src && document.querySelector('.header_nav_right_img')){
            let img = document.querySelector('.header_nav_right_img');
            img.classList.remove('active');
            img.src = target.dataset.src;
            img.classList.add('active');
        }
    }
};