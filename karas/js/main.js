"use strict";

window.onload = function(){
    document.addEventListener('click', clickItemHandler);

    document.addEventListener('click', handlerClickLinks);

    document.querySelectorAll('.buy_item_body_list').forEach(list => {
        list.querySelectorAll('.info').forEach((info,i,arr) => {
            info.style.zIndex = arr.length - i;
        })
    });

    headerStroke();
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
    }

    if(item.dataset.action){
        let actions = item.dataset.action.split(' ');
        actions.forEach(action => obj[action](item));
    } else {
        obj['toggle'](item);
    }
};

function handlerClickLinks(event){
    if(!(event.target.closest('a') && event.target.closest('a').href.split('#')[1])) return;
    let a = event.target.closest('a');
    event.preventDefault();
    let target = document.getElementById(`${a.href.split('#')[1]}`);
    if(!target) return;

    let hh = document.querySelector('.header-main').offsetHeight;

    function calculateHeight(){
        return Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight
        );
    }

    let p = pageYOffset;
    let step = 10;
    let direction = false;

    if(pageYOffset > target.getBoundingClientRect().top + pageYOffset){
        direction = true;
    }

    let int = setInterval(()=>{
        if(direction){
            if(p <= step) clearInterval(int);

            if(p>target.getBoundingClientRect().top + pageYOffset - hh){
                p -= step;
            } else {
                clearInterval(int);
            }
        } else {
            if(p >= calculateHeight() - step) clearInterval(int);

            if(p<target.getBoundingClientRect().top + pageYOffset - hh){
                p += step;
            } else {
                clearInterval(int);
            }
        }

        scrollTo(pageXOffset,p)
    }, 1);
};


function headerStroke(){
    document.querySelectorAll('.ticker_container').forEach(parent => {
        let line = parent.querySelector('.ticker_box');
        let items = [];
        let item = parent.querySelector('.ticker_text');
        let parentWidth = parent.offsetWidth;
        let itemWidth = item.clientWidth + 1;

        let c = Math.floor(parentWidth / itemWidth) * 3;
        if(parentWidth < itemWidth) c = 3;
        for(let i = 0; i<c; i++){
            items.push(item.cloneNode(true));
        }

        line.innerHTML = '';
        items.forEach(item => {
            item.style.minWidth = `${itemWidth}px`;
            line.append(item);
        });
        line.style.minWidth = `${itemWidth * items.length}px`;
    })
};