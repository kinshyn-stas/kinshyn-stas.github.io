"use strict";

window.onload = function(){

    document.addEventListener('click', clickItemHandler);


    emulateSelector('.select_emulator');


    document.addEventListener('click', handlerClickLinks);


    resizeXWrapper();
};


function classMultiplyWrapper(Cls,parametrs){
    document.querySelectorAll(parametrs.selector).forEach((item) => {
        parametrs.item = item;
        new Cls(parametrs);
    })
};


function clickItemHandler(event){
    if(!event.target.closest('.click-item')) return;
    let item = event.target.closest('.click-item');
    if(item.getAttribute('href') && item.getAttribute('href') == '#') event.preventDefault();

    let obj = {
        'toggle': function(target){
            target.closest('.click-obj').classList.toggle('active');
        },

        'toggle-menu': function(target){
            let obj = target.closest('.click-obj');
            obj.classList.toggle('active');
            if(obj.classList.contains('active')){
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        },

        'remove': function(target){
            target.closest('.click-obj').remove();
        },

        'popup-open': function(target){
            if(!document.querySelector(target.dataset.label)) return;
            document.querySelector(target.dataset.label).classList.add('active');
        },

        'popup-close': function(target){
            if(target.dataset.label){
                document.querySelector(target.dataset.label).classList.remove('active')
            } else {
                target.closest('.popup_container').classList.remove('active');
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


function emulateSelector(select){
    let selects = document.querySelectorAll(select);

    selects.forEach((select) =>{
        select.hidden = true;

        let emul = document.createElement('div');
        emul.classList = "select";
        emul.onclick = ()=>emul.classList.toggle('active');
        emul.setAttribute('tabindex','1');
        emul.onblur = function(){
            this.classList.remove('active');
        };

        let tit = document.createElement('div');
        tit.classList = "select_option select_tit";
        tit.onclick = () => select.classList.toggle('active');
        emul.append(tit);

        let emulListOuter = document.createElement('div');
        emulListOuter.classList = "select_list_outer";
        emul.append(emulListOuter);

        let emulList = document.createElement('div');
        emulList.classList = "select_list";
        emulListOuter.append(emulList);

        select.querySelectorAll('option').forEach((item)=>{
            let option = document.createElement('div');
            option.classList = "select_option";
            option.innerHTML = item.innerHTML;
            option.dataset.value = item.value;

            option.onclick = ()=>{
                if(!emul.classList.contains('active')) return;
                select.value=option.dataset.value;
                tit.textContent = option.textContent;

                let evt = document.createEvent('HTMLEvents');
                evt.initEvent('change', true, true);
                select.dispatchEvent(evt);

                option.parentNode.querySelectorAll('.select_option').forEach((option)=>{
                    option.classList.remove('selected')
                });
                option.classList.add('selected');
            };

            if(item.selected){
                option.classList.add('selected');
                tit.textContent = item.textContent;
            } 
            if(item.dataset.default == 'true') option.classList.add('default');
            if(item.disabled) option.classList.add('disabled');
            emulList.append(option);
        });

        select.parentNode.append(emul);

        let heightStart = emul.querySelector('.select_option').offsetHeight;
        let heightEnd = 0;
        emul.querySelectorAll('.select_option').forEach((option)=>{
            heightEnd += option.offsetHeight;
        });
        //emul.style.height = heightStart + 'px';
        //emul.querySelector('.select_list').style.maxHeight = heightStart + 'px';
    })

    let z = 1;
    for(let i=selects.length - 1; i>=0; i--){
        selects[i].parentNode.querySelector('.select').style.zIndex = `${z}0`;
        z++;
    }
};


function handlerClickLinks(event){
    if(!(event.target.closest('a') && event.target.closest('a').href.split('#')[1])) return;
    let a = event.target.closest('a');
    event.preventDefault();
    let target = document.getElementById(`${a.href.split('#')[1]}`);
    if(!target) return;


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

            if(p>target.getBoundingClientRect().top + pageYOffset){
                p -= step;
            } else {
                clearInterval(int);
            }
        } else {
            if(p >= calculateHeight() - step) clearInterval(int);

            if(p<target.getBoundingClientRect().top + pageYOffset){
                p += step;
            } else {
                clearInterval(int);
            }
        }

        scrollTo(pageXOffset,p)
    }, 1);
};


function resizeXWrapper(func,event){
    if(!event){
        window.widthStart = window.innerWidth;
    } else {
        if(window.widthStart){
            if(window.widthStart != window.innerWidth){
                window.widthStart = window.innerWidth;
                func();
            }
        } else {
            window.widthStart = window.innerWidth;
        }
    }
};


window.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.filter_item-date_input').forEach(input => {
      var myDatepicker = input;

      var daysArr = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'St', 'Su'];
      var monthArr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      var monthLongArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var textToday = 'Today';
      var textClear = 'Clear';

      /*if(siteLocalization){
        if(siteLocalization == 'uk'){
            daysArr = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
            monthArr = ['Січ', 'Лют', 'Бер', 'Квіт', 'Трав', 'Черв', 'Лип', 'Серп', 'Вер', 'Жовт', 'Лист', 'Груд'];
            monthLongArr = ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'];
            textToday = 'Сьогодні';
            textClear = 'Очистити';
        } else if(siteLocalization == 'ru'){
            daysArr = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
            monthArr = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
            monthLongArr = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
            textToday = 'Сегодня';
            textClear = 'Очистить';
        }
      }*/

      myDatepicker.DatePickerX.init({
        mondayFirst      : true,
        format           : 'dd.mm.yyyy',
        minDate          : new Date(0, 0),
        maxDate          : new Date(9999, 11, 31),
        weekDayLabels    : daysArr,
        shortMonthLabels : monthArr,
        singleMonthLabels: monthLongArr,
        todayButton      : true,
        todayButtonLabel : textToday,
        clearButton      : true,
        clearButtonLabel : textClear,
      });
    });

    document.addEventListener('change', function(event){
        if(!event.target.closest('.filter_item-date_input')) return;

        let input = event.target.closest('.filter_item-date_input');
        let span = input.closest('.filter_item-date_content').querySelector('.filter_item-date_value');
        span.textContent = input.value;
    })
});