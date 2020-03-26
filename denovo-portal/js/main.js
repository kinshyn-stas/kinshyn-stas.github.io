"use strict";

window.onload = function(){

    document.addEventListener('click', clickItemHandler);


    emulateSelector('.select_emulator');


    document.addEventListener('click', handlerClickLinks);


    resizeXWrapper();

    classMultiplyWrapper(calendarInputEmulate, {
        selector: '.filter_item-date_content',
    })
};


function classMultiplyWrapper(Cls,parametrs){
    document.querySelectorAll(parametrs.selector).forEach((item) => {
        parametrs.item = item;
        new Cls(parametrs);
    })
};


class calendarInputEmulate{
    constructor(params){
        this.params = params;
        this.parent = params.item;
        this.container = this.parent.closest('.filter_item-date');
        this.filter = this.container.closest('.filter');
        this.input = this.parent.querySelector('.filter_item-date_input');
        this.text = this.parent.querySelector('.filter_item-date_value');
        this.date = new Date();

        this.handlerClick = this.handlerClick.bind(this);
        this.container.addEventListener('click', this.handlerClick);
    }

    handlerClick(event){
        if(event.target.classList.contains('filter_item-date_input')){
            this.createCalendar();
        }

        if(event.target.closest('.calendar_header_close')){
            this.calendar.remove();
        }

        if(event.target.closest('.calendar_header_item')){
            let item = event.target.closest('.calendar_header_item');
            let list = item.closest('.calendar_header_list');
            let value;

             if(list.classList.contains('active')){
                 if(event.target.closest('.calendar_header_month')){
                    value = +item.dataset.value;
                    if(value == this.date.getMonth()) return;
                    this.date = new Date(this.date.getFullYear(),value,1);
                } else if(event.target.closest('.calendar_header_year')){
                    value = +item.textContent;
                    if(value == this.date.getFullYear()) return;
                    this.date = new Date(value,this.date.getMonth(),1);
                }      
                    
                this.calendarBody.remove();
                this.calendarFooter.remove();
                this.createCalendarBody();
                this.createCalendarFooter();
                item.classList.add('active');
                list.classList.remove('active');
            } else {
                item.classList.remove('active');
                list.classList.add('active');
            }
        }

        if(event.target.closest('.calendar_header_arrow')){
            let target = event.target.closest('.calendar_header_arrow');
            if(target.classList.contains('calendar_header_arrow-left')){
                this.date = new Date(this.date.getFullYear(),this.date.getMonth() - 1,1);
            } else if(target.classList.contains('calendar_header_arrow-right')){
                this.date = new Date(this.date.getFullYear(),this.date.getMonth() + 1,1);
            }

            this.calendarHead.querySelector('.calendar_header_month').querySelector('.calendar_header_item.active').classList.remove('active');
            this.calendarHead.querySelector('.calendar_header_month').querySelectorAll('.calendar_header_item')[this.date.getMonth()].classList.add('active');
            this.calendarBody.remove();
            this.calendarFooter.remove();
            this.createCalendarBody();
            this.createCalendarFooter();
        }

        if(event.target.closest('.calendar_body_day-full')){
            let target = event.target.closest('.calendar_body_day-full').querySelector('span');
            this.calendar.querySelectorAll('.calendar_body_day.active').forEach(item => item.classList.remove('active'));
            target.classList.add('active');
            this.date.setDate(+target.dataset.value);

            let month = this.date.getMonth();
            if(month<10) month = `0${month}`;
            let date = this.date.getDate();
            if(date<10) date = `0${date}`;
            let value = `${date}.${month}.${this.date.getFullYear()}`;
            this.input.value = value;
            this.text.textContent = value;
            this.calendar.remove();
        }

        if(event.target.closest('.calendar_footer_item')){
            let target = event.target.closest('.calendar_footer_item').querySelector('span');
            let diff = +target.dataset.value;

            let date2 = new Date();
            let date1 = new Date(date2.getFullYear(),date2.getMonth() - diff,date2.getDate());

            let month1 = date1.getMonth();
            if(month1<10) month1 = `0${month1}`;
            let day1 = date1.getDate();
            if(day1<10) day1 = `0${day1}`;
            let value1 = `${day1}.${month1}.${date1.getFullYear()}`;

            let month2 = date2.getMonth();
            if(month2<10) month2 = `0${month2}`;
            let day2 = date2.getDate();
            if(day2<10) day2 = `0${day2}`;
            let value2 = `${day2}.${month2}.${date2.getFullYear()}`;

            let item1 = this.filter.querySelectorAll('.filter_item-date')[0];
            item1.querySelector('.filter_item-date_input').value = value1;
            item1.querySelector('.filter_item-date_value').textContent = value1;

            let item2 = this.filter.querySelectorAll('.filter_item-date')[1];
            item2.querySelector('.filter_item-date_input').value = value2;
            item2.querySelector('.filter_item-date_value').textContent = value2;
            this.calendar.remove();
        }
    }

    createCalendar(){
        this.calendar = document.createElement('div');
        this.calendar.classList = 'calendar';
        this.calendar.setAttribute('tabindex','1');

        this.createCalendarHeader();
        this.createCalendarBody();
        this.createCalendarFooter();

        this.container.append(this.calendar);

        let blurFlag = false;
        calendarBlurHandler = calendarBlurHandler.bind(this);
        document.addEventListener('click', calendarBlurHandler);
        
        function calendarBlurHandler(event){
            if(event.target.closest('.calendar')) return;
            if(blurFlag){
                this.calendar.remove();
                document.removeEventListener('click', calendarBlurHandler);
            } 
            blurFlag = true;            
        }
    }

    createElement(params){
        let tag = 'div';
        if(params.tag) tag = params.tag;
        this[params.name] = document.createElement(tag);
        this[params.name].classList = params.class;
        if(params.html) this[params.name].innerHTML = params.html;
        params.parent.append(this[params.name]);
    }

    createCalendarHeader(){
        this.createElement({
            name: 'calendarHead',
            class: 'calendar_header',
            parent: this.calendar,
        });

        this.createElement({
            name: 'calendarHeadPanel',
            class: 'calendar_header_panel',
            parent: this.calendarHead,
        });

        this.createElement({
            name: 'calendarHeadArrowLeft',
            class: 'calendar_header_arrow calendar_header_arrow-left',
            tag: 'a',
            html: `<svg width="17" height="9" viewBox="0 0 17 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 4.5H1M1 4.5L4.5 1M1 4.5L4.5 8" stroke="#F56107"/></svg>`,
            parent: this.calendarHeadPanel,
        });

        this.createElement({
            name: 'calendarHeadMonth',
            class: 'calendar_header_month',
            html: `<div class="calendar_header_list">
                <a class="calendar_header_item" data-value='0'>Січ</a>
                <a class="calendar_header_item" data-value='1'>Лют</a>
                <a class="calendar_header_item" data-value='2'>Бер</a>
                <a class="calendar_header_item" data-value='3'>Кві</a>
                <a class="calendar_header_item" data-value='4'>Тра</a>
                <a class="calendar_header_item" data-value='5'>Чер</a>
                <a class="calendar_header_item" data-value='6'>Лип</a>
                <a class="calendar_header_item" data-value='7'>Сер</a>
                <a class="calendar_header_item" data-value='8'>Вер</a>
                <a class="calendar_header_item" data-value='9'>Жов</a>
                <a class="calendar_header_item" data-value='10'>Лис</a>
                <a class="calendar_header_item" data-value='11'>Гру</a>
            </div>`,
            parent: this.calendarHeadPanel,
        });

        this.calendarHeadMonth.querySelectorAll('.calendar_header_item')[this.date.getMonth()].classList.add('active');

        this.createElement({
            name: 'calendarHeadYear',
            class: 'calendar_header_year',
            html: `<div class="calendar_header_list">
                <a class="calendar_header_item">${new Date().getFullYear()}</a>
                <a class="calendar_header_item">${new Date().getFullYear() - 1}</a>
                <a class="calendar_header_item">${new Date().getFullYear() - 2}</a>
                <a class="calendar_header_item">${new Date().getFullYear() - 3}</a>
                <a class="calendar_header_item">${new Date().getFullYear() - 4}</a>
                <a class="calendar_header_item">${new Date().getFullYear() - 5}</a>
            </div>`,
            parent: this.calendarHeadPanel,
        });

        this.createElement({
            name: 'calendarHeadArrowRight',
            class: 'calendar_header_arrow calendar_header_arrow-right',
            tag: 'a',
            html: `<svg width="17" height="9" viewBox="0 0 17 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 4.5H16M16 4.5L12.5 1M16 4.5L12.5 8" stroke="#F56107"/></svg>`,
            parent: this.calendarHeadPanel,
        });

        this.createElement({
            name: 'calendarHeadClose',
            class: 'calendar_header_close',
            html: `<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 11L11 1M11 11L1 1" stroke="#20262E" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
            parent: this.calendarHead,
        });
    }

    createCalendarBody(){
        this.createElement({
            name: 'calendarBody',
            class: 'calendar_body',
            parent: this.calendar,
        });

        this.createElement({
            name: 'calendarBodyPanel',
            class: 'calendar_body_panel',
            html: `<div class="calendar_body_panel_box">
                <div class="calendar_body_panel_item">Пн</div>  
                <div class="calendar_body_panel_item">Вт</div>  
                <div class="calendar_body_panel_item">Ср</div>  
                <div class="calendar_body_panel_item">Чт</div>  
                <div class="calendar_body_panel_item">Пт</div>  
                <div class="calendar_body_panel_item">Сб</div>  
                <div class="calendar_body_panel_item">Нд</div>  
            </div>`,
            parent: this.calendarBody,
        });

        this.createElement({
            name: 'calendarBodyDays',
            class: 'calendar_body_days',
            parent: this.calendarBody,
        });

        let date = this.date;
        let year = date.getFullYear();
        let month = date.getMonth();
        let firstDay = new Date(year,month,1).getDay();
        if(!firstDay) firstDay = 7;
        let lastDay = new Date(year,month + 1,-1).getDate();

        for(let i=0; i<firstDay - 1; i++){
            this.createElement({
                name: 'calendarBodyDay',
                class: 'calendar_body_day calendar_body_day-empty',
                parent: this.calendarBodyDays,
            })
        }

        for(let i=1; i<=lastDay+1; i++){            
            this.createElement({
                name: 'calendarBodyDay',
                class: 'calendar_body_day calendar_body_day-full',
                html: `<span data-value="${i}">${i}</span>`,
                parent: this.calendarBodyDays,
            })
        }
    }

    createCalendarFooter(){
        this.createElement({
            name: 'calendarFooter',
            class: 'calendar_footer',
            parent: this.calendar,
        });

        this.createElement({
            name: 'calendarFooterText',
            class: 'calendar_footer_text',
            html: 'Показати за період',
            parent: this.calendarFooter,
        });

        this.createElement({
            name: 'calendarFooterBox',
            class: 'calendar_footer_box',
            parent: this.calendarFooter,
        });

        this.createElement({
            name: 'calendarFooterItem',
            class: 'calendar_footer_item',
            tag: 'a',
            html: `<span data-value='3'>3 місяці</span>`,
            parent: this.calendarFooterBox,
        });

        this.createElement({
            name: 'calendarFooterItem',
            class: 'calendar_footer_item',
            tag: 'a',
            html: `<span data-value='6'>6 місяців</span>`,
            parent: this.calendarFooterBox,
        });

        this.createElement({
            name: 'calendarFooterItem',
            class: 'calendar_footer_item',
            tag: 'a',
            html: `<span data-value='12'>12 місяців</span>`,
            parent: this.calendarFooterBox,
        });
    }
}


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

        'number_control': function(target){
            let parent = target.closest('.click-obj');
            let input = parent.querySelector('input');
            let value = parseInt(input.value);
            let label = +target.dataset.label
            if(isNaN(value) || value === undefined) value = 0;
            if(label){
                value++;
            } else {
                value--;
            }
            if(value < 0) value = 0;
            input.value = value;
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

        'open-lightbox': function(target){
            if(document.body.clientWidth<769) return;
            target.classList.add('lightbox_target')
            let container = document.createElement('div');
            container.classList = 'lightbox_container click-obj';
            container.innerHTML = `<div class="lightbox_background"></div>
                                <div class="lightbox">
                                    <div class="lightbox_close click-item" data-action="remove">        
                                        <i class="fa fa-times"></i>
                                    </div>
                                    <div class="lightbox_arrow lightbox_arrow-left click-item" data-action="switch_lightbox" data-direction="-1">
                                        <i class="fa fa-arrow-left"></i>
                                    </div>
                                    <div class="lightbox_arrow lightbox_arrow-right click-item" data-action="switch_lightbox" data-direction="1">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                    <img class="active" src="${target.src}" alt="" />
                                </div>`

            document.body.append(container);
        },

        'switch_lightbox': function(target){
            let lightbox = target.closest('.lightbox');
            let img = lightbox.querySelector('img');
            let arr = document.querySelector('.lightbox_target').closest('.lightbox_box').querySelectorAll('.lightbox_item img');
            let direction = target.dataset.direction;

            for(let i=0; i<arr.length; i++){
                if(arr[i].classList.contains('lightbox_target')){
                    arr[i].classList.remove('lightbox_target');
                    let n = i + +direction;
                    if(n >= arr.length) n = 0;
                    if(n < 0) n = arr.length - 1;
                    arr[n].classList.add('lightbox_target');
                    img.src = arr[n].src;
                    img.classList.remove('active');
                    setTimeout(()=>img.classList.add('active'), 0)
                    break;
                }
            }
        },

        'video-start': function(target){
            let obj = target.closest('.click-obj');
            obj.classList.add('active');
            let video = obj.querySelector('video');
            video.play();
        },

        'video-stop': function(target){
            let obj = target.closest('.click-obj');
            obj.classList.remove('active');
            target.pause();
        },

        'add-comment': function(target){
            let comment = document.getElementById('doc-comment');
            if(target.closest('.doc-comments_item')){
                target.closest('.doc-comments_item').append(comment);
            } else {
                target.closest('.doc-comments').querySelector('.doc-comments_header').after(comment);
            }
            comment.classList.remove('hidden');
            target.classList.add('gray');
        },

        'close-comment': function(target){
            let comment = target.closest('.doc-comment')
            comment.classList.add('hidden');
            comment.querySelector('textarea').value = '';
            document.querySelectorAll('.doc-comment_bottom_panel_item').forEach(item => item.classList.remove('gray'));
            document.querySelectorAll('.doc-comments_add').forEach(item => item.classList.remove('gray'));
        },

        'show-comments': function(target){
            let box = target.closest('.doc-comments_item');
            if(box.nextElementSibling.classList.contains('doc-comments_box')){
                target.classList.toggle('collapse');
                box.nextElementSibling.classList.toggle('collapsed');
            }
        },

        'search-open': function(target){
            document.querySelector('.doc-header_box').classList.add('hidden');
            document.querySelector('.doc-header_search').classList.add('active');
        },

        'search-close': function(target){
            document.querySelector('.doc-header_box').classList.remove('hidden');
            document.querySelector('.doc-header_search').classList.remove('active');
        },

        'table-row_toggle': function(target){
            target.closest('.table_row').classList.toggle('active');
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


function tableItemLimitedTextSize(){
    document.querySelectorAll('.table_item-stroke').forEach(item => {
        let h = 0;
        let l = 0;
        let text = [];
        findHeight(item);

        if(h>l){
            text = item.textContent.split(''); 
                      
            for(let i = text.length; i>0; i--){
                text = item.textContent.split('');
                text.pop();
                item.textContent = text.join('');

                findHeight(item);
                if(h<=l){
                    let last;
                    t();

                    item.textContent = text.join('');

                    function t(){
                        last = text[text.length - 4];
                        if(!last) return;
                        if(last == ' '){
                            text.pop();
                            t();
                        } else {
                            text.splice(-4,4,'...');
                        }                        
                    };

                    break;
                };
            }            
        };

        function findHeight(item){
            h = parseFloat(getComputedStyle(item).height);
            l = parseFloat(getComputedStyle(item).lineHeight) * 2;  
            
        };
    });
};
tableItemLimitedTextSize();


/*window.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.filter_item-date_input').forEach(input => {
      var myDatepicker = input;
      var siteLocalization = 'uk';

      var daysArr = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'St', 'Su'];
      var monthArr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      var monthLongArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var textToday = 'Today';
      var textClear = 'Clear';

      if(siteLocalization){
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
      }

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
});*/