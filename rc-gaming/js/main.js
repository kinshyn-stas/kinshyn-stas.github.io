"use strict";

window.onload = function(){

    document.addEventListener('click', clickItemHandler);


    emulateSelector('.select_emulator');


    document.addEventListener('click', handlerClickLinks);


    resizeXWrapper();


    classMultiplyWrapper(Curier,{
        selector: '#faceAnim',
    });


    changeOpacity('.anim-opacity');


    checkSubmit();


    document.addEventListener('input',validatePhone);

    new classMultiplyWrapper(FormValidate, {
        selector: '.form_validate',
    });


    hiddenScrollAside('.menu_content_tabs-scroll');
    window.addEventListener('resize',() => hiddenScrollAside('.menu_content_tabs-scroll'));


    //document.addEventListener('change', addMenuProduct);

    //document.addEventListener('change', changeMenuProductWeight);


    new Alphabet();


    new menuOrder();


    new classMultiplyWrapper(Slider, {
        selector: '.vars_slider',
        navigationArrows: true,
        infinity: true,
        multiDisplay: {
            desktop: 4,
            touch: 4,
            mobile: 1,
            marginRight: {
                desktop: 24,
                touch: 24,
                mobile: 12,
            },
            multiShift: true,
        }
    });


    lazyLoadIframe('.lazyIframe');


    document.addEventListener('click', function(event){
        if(!event.target.closest('.header_soc_item') && !event.target.closest('.contact_soc_item')) return;
        dataLayer.push({
            'event': 'GAevent',
            'eventCategory': 'Button-click',
            'eventAction': 'Social'
        })
    });

    document.addEventListener('click', function(event){
        if(!event.target.closest('.click-item')) return;
        let target = event.target.closest('.click-item');
        if(!(target.dataset.action == 'popup-open')) return;
        dataLayer.push({
            'event': 'GAevent',
            'eventCategory': 'Button-click',
            'eventAction': 'Popup-open'
        })
    });
};


class Alphabet{
    constructor(){
        if(!document.querySelector('.menu_alphabet')) return;
        this.container = document.querySelector('.menu_alphabet');
        this.list = this.container.querySelector('.menu_alphabet_list');
        this.letters = this.list.querySelectorAll('.menu_alphabet_item');
        this.buttonLeft = this.container.querySelector('.menu_alphabet_button-left');
        this.buttonRight = this.container.querySelector('.menu_alphabet_button-right');

        this.content = this.container.closest('.menu_container').querySelector('.menu_content');
        this.contentTabs = this.content.querySelectorAll('.menu_content_tab');

        this.container.addEventListener('click', this.clickHandler.bind(this));
    }

    clickHandler(event){
        if(event.target.closest('.menu_alphabet_item')){
            let target = event.target.closest('.menu_alphabet_item');
            if(target.classList.contains('active')) return;
            this.letters.forEach(item => item.classList.remove('active'));
            target.classList.add('active');

            this.contentTabs.forEach(tab => {
                if(!tab.classList.contains('active')) return;
                let letters = tab.querySelectorAll('.menu_content_tab_letter');
                letters.forEach(item => item.classList.remove('active'));

                for(let i = 0; i <= letters.length - 1; i++){
                    let i1 = target.textContent[0];
                    let i2 = letters[i].querySelector('.menu_content_tab_letter_title span').textContent[0];

                    if(i1 <= i2){
                        letters[i].classList.add('active');
                        this.scrollToElement(tab.closest('.scroll-emul_content'),letters[i]);
                        break;
                    }

                    if(i >= letters.length - 1){
                        letters[letters.length - 1].classList.add('active');
                        this.scrollToElement(tab.closest('.scroll-emul_content'),letters[letters.length - 1]);
                        break;
                    }
                }
            });
        };

        if(event.target.closest('.menu_alphabet_button')){
            let target = event.target.closest('.menu_alphabet_button');
            let direction = 0;
            if(target.classList.contains('menu_alphabet_button-right')) direction = 1;
            let w = this.list.clientWidth * 2 / 3;
            let wFull = 0;
            this.letters.forEach(item => {
                wFull += parseFloat(getComputedStyle(item).width);
                wFull += parseFloat(getComputedStyle(item).marginRight);
                wFull += parseFloat(getComputedStyle(item).marginLeft);
            });
            let t = parseFloat(getComputedStyle(this.list).left);
            let r = 0;

            this.container.classList.add('menu_alphabet-left');
            this.container.classList.add('menu_alphabet-right');

            if(direction){
                r = t - w;
                if(r < w - wFull){
                    this.container.classList.remove('menu_alphabet-right');
                    r = w - wFull;
                } 
            } else {
                r = t + w;
                if(r > 0){
                    this.container.classList.remove('menu_alphabet-left');
                    r = 0;
                }
            }
            this.list.style.left = `${r}px`;
        }
    }

    scrollToElement(parent,target){                    
        let p = parent.scrollTop;
        let step = 10;
        let direction = false;
        let container = parent.querySelector('.menu_content_tab.active');
        let h = 0;
        let letters = container.querySelectorAll('.menu_content_tab_letter');
        for(let i = 0; i < letters.length - 1; i++){
            if(letters[i] == target) break;
            h += parseFloat(getComputedStyle(letters[i]).height);
            h += parseFloat(getComputedStyle(letters[i]).marginBottom);
            h += parseFloat(getComputedStyle(letters[i]).marginTop);
        }
        if(!h && h != 0) return;

        if(parent.scrollTop > h){
            direction = true;
        }

        let int = setInterval(()=>{
            if(direction){               
                if(p <= step){
                    parent.scrollTop = 0;
                    clearInterval(int);
                } 

                if(p > h){
                    p -= step;
                } else {
                    p = h;
                    clearInterval(int);
                }
            } else {      
                if(p >= container.clientHeight - step){
                    parent.scrollTop = container.clientHeight;
                    clearInterval(int); 
                }   

                if(p < h){
                    p += step;
                } else {
                    p = h;
                    clearInterval(int);
                }
            }

            parent.scrollTop = p;
        }, 1);
    }
};

class menuOrder{
    constructor(){
        if(!document.querySelector('.menu_block')) return;
        this.block = document.querySelector('.menu_block');
        this.buttonNumber = this.block.querySelector('.menu_button_number');
        this.form = document.querySelector('#orderForm');
        this.formInput = this.form.querySelector('.popup_form_order_input');
        this.formInputText = this.form.querySelector('.popup_form_number_input_n');
        this.items = this.block.querySelectorAll('.menu_content_tab_letter_item');
        this.result = [];

        this.clickHandler = this.clickHandler.bind(this);
        this.changeHandler = this.changeHandler.bind(this);
        this.block.addEventListener('click', this.clickHandler);
        this.block.addEventListener('change', this.changeHandler);
        this.prepare();
    }

    prepare(){
        this.items.forEach(item => {
            item.querySelector('.menu_content_tab_letter_item_calc_num_i').value = 0;
            item.querySelector('.menu_content_tab_letter_item_i').checked = false;
        });
        this.checkAllFields();
    }

    clickHandler(event){
        if(event.target.closest('.menu_content_tab_letter_item_butt')){
            let target = event.target.closest('.menu_content_tab_letter_item_butt');
            let direction = 0;
            if(target.dataset.direction) direction = +target.dataset.direction;
            let v = 1;
            if(target.dataset.value) v = +target.dataset.value;

            let inputWeight = target.closest('.menu_content_tab_letter_item_calc').querySelector('.menu_content_tab_letter_item_calc_num_i');
            let inputFlag = target.closest('.menu_content_tab_letter_item').querySelector('.menu_content_tab_letter_item_i');

            if(direction){
                if(!inputFlag.checked) inputFlag.checked = true;
                inputWeight.value = parseInt((+inputWeight.value + v) * 10) / 10;
            } else {                
                inputWeight.value = parseInt((+inputWeight.value - v) * 10) / 10;
                if(inputWeight.value <= 0){
                    inputWeight.value = 0;
                    inputFlag.checked = false;
                }
            }

            this.checkAllFields();
        }
    }

    changeHandler(event){
        if(event.target.closest('.menu_content_tab_letter_item_calc_num_i')){
            let inputWeight = event.target.closest('.menu_content_tab_letter_item_calc_num_i');
            let inputFlag = inputWeight.closest('.menu_content_tab_letter_item').querySelector('.menu_content_tab_letter_item_i');
            if(+inputWeight.value<=0){
                inputWeight.value = 0;
                inputFlag.checked = false;
            } else {
                inputFlag.checked = true;
            }

            this.checkAllFields();
        }

        if(event.target.closest('.menu_content_tab_letter_item_i')){
            let inputFlag = event.target.closest('.menu_content_tab_letter_item_i');
            let inputWeight = inputFlag.closest('.menu_content_tab_letter_item').querySelector('.menu_content_tab_letter_item_calc_num_i');
            if(inputFlag.checked){
                inputWeight.value = 1;
            } else {
                inputWeight.value = 0;
            }

            this.checkAllFields();
        }
    }

    checkAllFields(){
        this.result = [];
        this.items.forEach(item => {
            let inputFlag = item.querySelector('.menu_content_tab_letter_item_i');
            let inputWeight = item.querySelector('.menu_content_tab_letter_item_calc_num_i');
            let inputUnits = item.querySelector('.menu_content_tab_letter_item_calc_num_t').textContent;
            let itemName = item.querySelector('.menu_content_tab_letter_item_name_text').textContent;

            if(inputFlag.checked){
                this.result.push(`${itemName} : ${inputWeight.value}${inputUnits}`)
            }
        });

        this.buttonNumber.textContent = this.result.length;
        this.formInputText.textContent = this.result.length;
        this.formInput.value = this.result.join(', ');
        if(this.result.length){
            this.buttonNumber.classList.add('active');
        } else {
            this.buttonNumber.classList.remove('active');
            this.formInput.value = '';
        }
    }
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

        'switch-content': function(target){
            if(target.classList.contains('active')) return;
            let parent = target.closest('.menu_content_outer');
            parent.querySelectorAll('.menu_content_panel_item').forEach(item => item.classList.remove('active'));
            target.classList.add('active');
            parent.querySelectorAll('.menu_content_tab').forEach(item => item.classList.remove('active'));
            parent.querySelector(target.dataset.label).classList.add('active');
            parent.querySelector(target.dataset.label).style.animationName = 'animation_tab';
            hiddenScrollAside('.menu_content_tabs-scroll');
        },

        'switch-container': function(target){
            if(target.classList.contains('active')) return;
            let parent = target.closest('.menu_block');
            parent.querySelectorAll('.menu_switch_item').forEach(item => item.classList.remove('active'));
            target.classList.add('active');
            parent.querySelectorAll('.menu_container').forEach(item => item.classList.remove('active'));
            parent.querySelector(target.dataset.label).classList.add('active');
            parent.querySelector(target.dataset.label).style.animationName = 'animation_tab';
            let switcher = target.closest('.menu_switch_box').classList.toggle('switch');
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

            if(p>target.getBoundingClientRect().top + pageYOffset - 88){
                p -= step;
            } else {
                clearInterval(int);
            }
        } else {
            if(p >= calculateHeight() - step) clearInterval(int);

            if(p<target.getBoundingClientRect().top + pageYOffset - 88){
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


class Curier{
    constructor(params){
        this.container = params.item;
        this.cloud = this.container.querySelector('#faceCloud');
        this.bushes = this.container.querySelector('#faceBushes');
        this.ground = this.container.querySelector('#faceGround');
        this.man = this.container.querySelector('#faceMan');

        this.mouseMove = this.mouseMove.bind(this);
        document.addEventListener('mousemove', this.mouseMove);
    }

    mouseMove(event){
        let screenWidth = window.innerWidth;
        let screenHeight = window.innerHeight;

        let x = event.screenX;
        let y = event.screenY;

        move(this.cloud,14,8);
        move(this.bushes,5,4);
        move(this.ground,3,2);
        move(this.man,20,10);

        function move(item,maxW,maxH){
            let dX = ((x / screenWidth) * maxW) - (maxW/2);
            if(dX < (0 - (maxW/2))) dX = -maxW/2;
            if(dX > (0 + (maxW/2))) dX = maxW/2;
            let dY = ((y / screenHeight) * maxH) - (maxH/2);
            if(dY < (0 - (maxH/2))) dY = -maxH/2;
            if(dY > (0 + (maxH/2))) dY = maxH/2;
            item.style.transform = `translate(${dX}%,${dY}%)`;
        }
    }
};


function changeOpacity(selector){
    document.querySelectorAll(selector).forEach(item => {
        if(window.innerWidth > 768){
            item.classList.add('anim-opacity_trigger');
        } else {
            item.classList.remove('anim-opacity_trigger');
        }        
    });

    func();
    document.addEventListener('scroll',func);

    function func(event){
        if(window.innerWidth <= 768) return;
        document.querySelectorAll('.anim-opacity_trigger').forEach((item,i) => {
            let screenHeight = window.innerHeight;
            let itemY1 = item.getBoundingClientRect().top - (2 * screenHeight / 3);
            let itemY2 = item.getBoundingClientRect().bottom - (1 *screenHeight / 5);

            if(itemY1 < 0 && itemY2 > 0){
                item.classList.add('active');
            }
        });      
    }
};


function checkSubmit(){
    if(location.hash == "#success") document.querySelector('.popup_succes').classList.add('active');
    if(location.search == "?pdf") document.querySelector('#menu_switch_item-2').click();
};


function validatePhone(event){
    if(!(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel')) return;
    let target = event.target;
    
    //console.log(+target.dataset.format)
    if(+target.dataset.format){
        //target.value = target.value.replace(/./g,".");
        //target.value = target.value.replace(/,/g,".");
        target.value = target.value.replace(/,/g,".");
        target.value = target.value.replace(/[^.0-9]/g,"");
    } else {
        target.value = target.value.replace(/\D/g,"");
    }

    /*if(target.value.slice(0,3) != '380' && target.dataset.type != 'number'){
        target.value = `380${target.value.slice(3)}`;
    }*/
};


class FormValidate{
    constructor(params){
        this.form = params.item;
        this.status = false;
        this.items = this.form.querySelectorAll('.form_validate_item');
        this.submit = this.form.querySelector('.form_validate_submit');
        if(!this.submit) return;
        this.submitFlag = false;

        this.form.addEventListener('input',this.checkInputsPattern.bind(this));
        this.form.addEventListener('change',this.checkInputsPattern.bind(this));
        //this.form.addEventListener('input',this.validatePhone.bind(this));
        this.submit.addEventListener('click',this.submitClickHandler.bind(this));
    }

    checkInputsPattern(event){
        if(event.target.tagName.toLowerCase() != 'input' && event.target.tagName.toLowerCase() != 'textarea') return;
        let eType = event.target.type.toLowerCase();
        if(!(event.target.required) && !(eType == 'checkbox' || eType == 'radio') && !(eType == 'file')) return;

        let target = event.target;

        if(event.type == 'input'){
            if(this.testValue(target)) this.changeClassList(target,true);
        } else if(event.type == 'change'){
            this.testValue(target) ? this.changeClassList(target,true) : this.changeClassList(target,false);

            if(eType == 'checkbox' || eType == 'radio'){
                if(event.target.name){
                    let flag = false;
                    let counter = 0;

                    this.form.querySelectorAll(`input[name=${target.name}]`).forEach(item => {
                        if(item.checked){
                            flag = true;
                            counter++;
                        } 
                    })

                    if(flag){
                        this.changeClassList(target,true);
                    } else {
                        this.changeClassList(target,false);
                    }

                    
                    if(!target.closest('.order_select')) return;
                    if(!target.closest('.order_select').querySelector('.order_select_num')) return;
                    target.closest('.order_select').querySelector('.order_select_num').textContent = counter;
                } else {
                    if(target.checked){
                        this.changeClassList(target,true);
                    } else {
                        this.changeClassList(target,false);
                    }
                }
            }

            this.checkItems();
        }

    }

    testValue(target){
        let result = true;
        
        if(target.dataset.pattern){
            let regexp = new RegExp(target.dataset.pattern);
            if(!regexp.test(`${target.value}`)) result = false;
        } else {
            if(target.value == '') result = false;
        }

        if(target.getAttribute('minlength') && (target.value.length < +target.getAttribute('minlength'))) result = false;
        if(target.getAttribute('maxlength') && (target.value.length > +target.getAttribute('maxlength'))) result = false;
        return result;
    }

    changeClassList(target,direction = true){
        if(direction){
            target.closest('.form_validate_item').classList.remove('invalid');
            target.classList.remove('invalid');
        } else {
            target.closest('.form_validate_item').classList.add('invalid');
            target.classList.add('invalid');
        }
    }

    checkItems(){
        this.status = true;
        this.items.forEach(item => {
            let field;
            field = item.querySelector('input, textarea');
            if(item.classList.contains('invalid') || !field.value) this.status = false;
        })

        if(this.status){
            this.submitFlag = true;
        } else {
            this.submitFlag = false;
        }
    }

    /*validatePhone(){
        if(!(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel')) return;
        
        event.target.value = event.target.value.replace(/\D/g,"");
        if(event.target.value.slice(0,3) != '380'){
            event.target.value = `380${event.target.value.slice(3)}`;
        }
    }*/

    submitClickHandler(event){
        this.items.forEach(item => {
            let event = new Event('change',{
                'bubbles': true,
                'cancelable': true
            });
            item.querySelector('input').dispatchEvent(event);
        })

        if(!this.submitFlag){
            event.preventDefault();
            return;
        }
        this.submitFlag = false;
        this.submit.disabled = true;
        this.submit.querySelector('span').textContent = '...';

        dataLayer.push({
            'event': 'GAevent',
            'eventCategory': 'Form',
            'eventAction': 'Submit'}
        )

        this.form.submit();
    }
};


function hiddenScrollAside(selector){
    document.querySelectorAll(selector).forEach(box =>{            
      box.classList.add('scroll-emul_block');
      box.style.height = `${(parseInt(getComputedStyle(box).height))}px`;
      let cont = box.querySelector('.scroll-emul_container');

      if(!box.children[0].classList.contains('scroll-emul_container')){
          cont = document.createElement('div');
          cont.classList = 'scroll-emul_container';

          let content = document.createElement('div');
          content.classList = 'scroll-emul_content';

          while(box.children.length){
              content.append(box.children[0])
          }

          let line = document.createElement('div');
          line.classList = 'scroll-emul_line';

          let line_item = document.createElement('div');
          line_item.classList = 'scroll-emul_line_item';

          cont.append(content);
          line.append(line_item);
          cont.append(line);
          box.append(cont);

          let n = content.offsetWidth - content.clientWidth - content.clientLeft;
          if(n<=0) n = 50;
          content.style.width = `calc(100% + ${n}px)`;
          content.style.paddingRight = `${n}px`;

          let contentFullHeight = 0;
          for(let i = 0; i<content.children.length; i++){
              contentFullHeight += parseFloat(content.children[i].offsetHeight);
          };
          let line_itemHeight = (parseFloat(content.offsetHeight) / contentFullHeight) * 100;
          line.hidden = (line_itemHeight >= 100)
          line_item.style.height = `${line_itemHeight}%`;

          content.removeEventListener('scroll', scrollContent);
          content.addEventListener('scroll', scrollContent);

          function scrollContent(e){
              line_item.style.top = `${(e.target.scrollTop / contentFullHeight) * 100}%`;
          }
      } else {
            let content = box.querySelector('.scroll-emul_content');
            let line = box.querySelector('.scroll-emul_line');
            let line_item = box.querySelector('.scroll-emul_line_item');

            let contentFullHeight = 0;
            for(let i = 0; i<content.children.length; i++){
                contentFullHeight += parseFloat(content.children[i].offsetHeight);
            };
            let line_itemHeight = (parseFloat(content.offsetHeight) / contentFullHeight) * 100;
            line.hidden = (line_itemHeight >= 100)
            line_item.style.height = `${line_itemHeight}%`;

            content.removeEventListener('scroll', scrollContent);
            content.addEventListener('scroll', scrollContent);

            function scrollContent(e){
                line_item.style.top = `${(e.target.scrollTop / contentFullHeight) * 100}%`;
            }
        }
    })
};


class Slider{
    constructor(params){
        this.params = params;
        this.container = params.item;
        this.params.moveTime ? (this.moveTime = this.params.moveTime) : (this.moveTime = 0.4);
        if(this.params.sizeWork){
            this.sizeFlag = 0;
            this.checkSize(this.params.sizeWork);
            window.addEventListener('resize', this.checkSize.bind(this,this.params.sizeWork));
        }
        if(!this.sizeFlag) this.create();

        this.container.addEventListener('mousedown',this.mouseFlip.bind(this));
        this.container.addEventListener("touchstart", this.touchFlip.bind(this));

        window.addEventListener('resize', this.prepare.bind(this));
    }

    checkSize(p){
        let trigger = false;
        let w = document.body.offsetWidth;
        if(p.desktop && w > 1100) trigger = true;
        if(p.touch && (w > 768 && w <= 1100)) trigger = true;
        if(p.mobile && w <= 768) trigger = true;

        if(trigger){
            if(this.sizeFlag != 1){
                this.sizeFlag = 1;
                this.create();
            }
        } else {
            this.sizeFlag = 2;

            if(!this.container.querySelector('.slider_box')) return;
            let box = this.container.querySelector('.slider_box');
            while(box.children[0]){
                box.children[0].style.width = '100%';
                box.children[0].style.minWidth = '100%';
                this.container.append(box.children[0]);
            }
            box.remove();
            deleteElem(this.container.querySelector('.slider_block'));
            deleteElem(this.slider_nav);
            deleteElem(this.slider_arrow_right);
            deleteElem(this.slider_arrow_left);
            deleteElem(this.slider_counter);

            function deleteElem(elem){
                if(elem) elem.remove();
            }
        }
    }

    create(){
        this.createSliderBox();
        this.findSlideOnScreen();
        if(this.params.navigationDotters && !(this.params.multiDisplay && this.params.infinity)) this.createSliderNavigationDotters();
        this.prepare();
        if(this.params.navigationArrows) this.createSliderNavigationArrows();
        if(this.params.navigationCounter && !(this.params.multiDisplay && this.params.infinity)) this.createSliderNavigationCounter();
        if(this.params.slideClickRewind) this.prepareSlidesOnclick();
        if(this.params.autoShift) this.changeSlidesAutomaticaly();
    }

    findSlideOnScreen(){
        this.slideOnScreen = 1;
        if(this.params.multiDisplay){
            let w = document.body.offsetWidth;
            if(w>0 && w<=768){
                this.slideOnScreen = this.params.multiDisplay.mobile;
            } else if(w>768 && w<=1100){
                this.slideOnScreen = this.params.multiDisplay.touch;
            } else {
                this.slideOnScreen = this.params.multiDisplay.desktop;
            }
        }
    }

    prepare(){
        if(this.sizeFlag == 2) return;
        this.activeSlider = 0;

        this.extendSlides();
        this.slideAll();
    }

    createSliderBox(){
        this.block = document.createElement('div');
        this.block.classList = ('slider_block');
        this.box = document.createElement('div');
        this.box.classList = ('slider_box');

        this.sliders = [].slice.call(this.container.children);
        this.sliders.forEach((item,i,arr)=>{
            item.classList.add('slider_slide');
            this.box.append(item);
        });
        this.block.append(this.box);
        this.container.append(this.block);
        this.block.style.width = '100%';
        this.block.style.maxWidth = '100vw';
        this.block.style.overflow = 'hidden';
        this.box.style.display = 'flex';
        this.box.style.transition = `transform ${this.moveTime}s ease-in-out`;
        this.box.style.webkitTransition = `-webkit-transform ${this.moveTime}s ease-in-out`;
        this.box.style.transform = `translateX(0)`;
        this.box.style.webkitTransform = `translateX(0)`;
    }

    createSliderNavigationArrows(){
        this.slider_arrow_right = document.createElement('div');
        this.slider_arrow_right.classList = 'slider_arrow slider_arrow-right';
        this.slider_arrow_right.innerHTML = `<img src="img/slider_arrow_right.svg" alt="" />`
        this.slider_arrow_right.onclick = ()=> this.slideMove({direction: 'right'});
        //slider_arrow_right.ontouchstart = ()=> this.slideMove({direction: 'right'});
        this.container.append(this.slider_arrow_right);

        this.slider_arrow_left = document.createElement('div');
        this.slider_arrow_left.classList = 'slider_arrow slider_arrow-left';
        this.slider_arrow_left.innerHTML = `<img src="img/slider_arrow_left.svg" alt="" />`
        this.slider_arrow_left.onclick = ()=> this.slideMove({direction: 'left'});
        //slider_arrow_left.ontouchstart = ()=> this.slideMove({direction: 'left'});
        this.container.append(this.slider_arrow_left);
    }

    createSliderNavigationCounter(){
        this.slider_counter = document.createElement('div');
        this.slider_counter.classList = 'slider_counter';

        let numberStart = `01`;
        let numberEnd = Math.ceil(this.sliders.length / this.slideOnScreen);
        numberEnd = (numberEnd<10) ? `0${numberEnd}` : numberEnd;

        this.slider_counter.innerHTML = `<span class="slider_counter_number slider_counter_number-start">${numberStart}</span><span class="slider_counter_line"></span><span class="slider_counter_number slider_counter_number-end">${numberEnd}</span>`;
        this.container.append(this.slider_counter);
    }

    changeSliderNavigationCounter(){
        let numberStart = Math.ceil(this.activeSlider/this.slideOnScreen) + 1;
        if(numberStart < 1) numberStart = 1;
        numberStart = (numberStart<10) ? `0${numberStart}` : numberStart;

        this.container.querySelectorAll('.slider_counter_number-start')[0].textContent = numberStart;
    }

    createSliderNavigationDotters(){
        this.slider_nav = document.createElement('ul');
        this.slider_nav.classList = 'slider_nav';

        this.butts = [];
        let m = this.sliders.length / this.slideOnScreen;
        if(m - parseInt(m)) m = parseInt(m) + 1;
        for(let i=0; i<m; i++){
            let slider_nav_butt = document.createElement('li');
            slider_nav_butt.classList = 'slider_nav_butt';
            slider_nav_butt.style.transition = `all ${this.moveTime} ease-in-out`;
            slider_nav_butt.dataset.number = i;
            this.butts.push(slider_nav_butt);
            this.slider_nav.append(slider_nav_butt);
        }

        this.container.addEventListener('click',func.bind(this));

        function func(event){
            if(!event.target.closest('.slider_nav_butt')) return;
            let butt = event.target.closest('.slider_nav_butt');

            clearInterval(this.autoShift);
            let n = (butt.dataset.number * this.slideOnScreen);
            return this.slideMove({counter: n});
        }

        this.container.append(this.slider_nav);
    }

    changeSlidesAutomaticaly(){
        this.autoShift = setInterval(()=>{
            this.slideMove({direction: 'right'});
        }, this.moveTime * 20000);
    }

    extendSlides(){
        this.boxWidth = this.box.offsetWidth/this.slideOnScreen;
        let d = this.boxWidth;
        let marginRight = 0;

        if(this.params.multiDisplay){
            if(this.params.multiDisplay.marginRight){
                let w = document.body.offsetWidth
                if(w>0 && w<=700){
                    marginRight = this.params.multiDisplay.marginRight.mobile;
                } else if(w>700 && w<=1100){
                    marginRight = this.params.multiDisplay.marginRight.touch;
                } else {
                    marginRight = this.params.multiDisplay.marginRight.desktop;
                }
            }

            d = this.boxWidth - (marginRight * (this.slideOnScreen - 1)) / this.slideOnScreen;
        }

        d = d + 'px';
        if(d == '0px') d = '100%';

        this.sliders.forEach((slide,i,arr)=>{
            slide.style.width = `${d}`;
            slide.style.minWidth = `${d}`;
            slide.dataset.number = i;
            if((i + 1) % this.slideOnScreen) slide.style.marginRight = `${marginRight}px`;
            //if(this.params.infinity) slide.style.marginRight = `${marginRight}px`;
        });
    }

    slideAll(callback){
        if(this.flagBlock) return;
        this.flagBlock = true;
        let n = 0;

        this.sliders.forEach((slide,i,arr)=>{
            if(slide.classList.contains('active')){
                this.boxShift = -(i * this.boxWidth);
                this.box.style.transform = `translateX(${this.boxShift}px)`;
                this.box.style.webkiteTransform = `translateX(${this.boxShift}px)`;
                n = slide.dataset.number;
            }
        });

        if(!this.sliders.length) return;
        if(n == 0) this.sliders[0].classList.add('active');
        if(n >= this.sliders.length) n = this.sliders.length - 1;

        if(this.params.navigationDotters){
            let m = n;
            if(this.params.multiDisplay && this.params.multiDisplay.multiShift){
                m = n / this.slideOnScreen;
                if(m - parseInt(m)) m = parseInt(m) + 1;
            }

            this.butts.forEach((butt,i,arr)=>{
                butt.classList.remove('active');
                if(i==m) butt.classList.add('active');
            });
        };

        if(this.params.emulateDotters){
            this.emulSlides = [].slice.call(document.querySelector(this.params.emulateDotters).children);
            this.emulSlides.forEach((item,i)=>{
                item.classList.remove('active');
            })
            this.emulSlides[n].classList.add('active');
        }

        setTimeout(() => {
            this.flagBlock = false;
            if(callback) callback();
            this.flagBlockSlide = false
        }, this.moveTime * 1000);
    }

    slideMove(params){
        if(this.flagBlockSlide) return;
        this.flagBlockSlide = true;
        this.installActiveSlider();

        if(this.params.multiDisplay && this.params.multiDisplay.multiShift){
            let m = this.sliders.length - (this.sliders.length % this.slideOnScreen);
            if(m == this.sliders.length) m = this.sliders.length - this.slideOnScreen;

            if(params.direction == 'right') this.activeSlider += this.slideOnScreen;
            if(params.direction == 'left') this.activeSlider -= this.slideOnScreen;
            if(params.counter != undefined) this.activeSlider = params.counter;

            if(this.params.infinity){
                this.infinitySlideWork.call(this);
            } else {
                if(this.activeSlider >= m) this.activeSlider = m;
                if(this.activeSlider < 0) this.activeSlider = 0;
            }

            this.installActiveSlider(this.activeSlider);
            this.slideAll();
        } else {
            if(params.direction == 'right') this.activeSlider++;
            if(params.direction == 'left') this.activeSlider--;
            if(params.counter != undefined) this.activeSlider = params.counter;

            if(this.params.infinity){
                this.infinitySlideWork.call(this);
            } else {
                if(this.activeSlider > this.sliders.length - 1) this.activeSlider = this.sliders.length - 1;
                if(this.activeSlider < 0) this.activeSlider = 0;

                this.sliders[this.activeSlider].classList.add('active');
                this.slideAll();
            }
        }

        if(this.params.navigationCounter) this.changeSliderNavigationCounter();
    }

    installActiveSlider(n){
        this.sliders = [].slice.call(this.box.children);

        if(n || n === 0){
            this.sliders.forEach((slide,i,arr)=>{
                slide.classList.remove('active');
            })

            this.activeSlider = n;
            this.sliders[n].classList.add('active');
        } else {
            this.sliders.forEach((slide,i,arr)=>{
                if(slide.classList.contains('active')) this.activeSlider = i;
                slide.classList.remove('active');
            })
        }
    }

    infinitySlideWork(){
        if(this.flagBlockInfinity) return;
        this.flagBlockInfinity = true;
        if(this.activeSlider > this.sliders.length - this.slideOnScreen){
            let sr = this.slideOnScreen - this.sliders.length + this.activeSlider;

            for(let i=0; i<sr; i++){
                let s = this.sliders[i].cloneNode(true);
                this.box.append(s);
            }
            this.sliders = [].slice.call(this.box.children);

            this.installActiveSlider(this.activeSlider);
            this.slideAll(func0.bind(this));

            function func0(){
                this.box.style.transition = ``;
                for(let i=0; i<sr; i++){
                    this.sliders[0].remove();
                    this.sliders.shift();
                }
                this.installActiveSlider(this.activeSlider - sr);
                this.slideAll(func2.bind(this));

                function func2(){
                    this.box.style.transition = `transform ${this.moveTime}s ease-in-out`;
                    this.box.style.webkiteTransition = `-webkite-transform ${this.moveTime}s ease-in-out`;
                    this.flagBlockInfinity = false;
                }
            }

        } else if(this.activeSlider < 0){
            let sr = this.slideOnScreen;
            if(!this.params.multiShift) sr = 1;
            this.box.style.transition = ``;
            for(let i=0; i<sr; i++){
                let s = this.sliders[this.sliders.length - i - 1].cloneNode(true);
                this.box.prepend(s);
            }
            this.sliders = [].slice.call(this.box.children);
            this.installActiveSlider(sr);
            this.slideAll(func0.bind(this));

            function func0(){
                this.box.style.transition = `transform ${this.moveTime}s ease-in-out`;
                this.box.style.webkiteTransition = `-webkite-transform ${this.moveTime}s ease-in-out`;
                this.installActiveSlider(0);
                this.slideAll(func2.bind(this));

                function func2(){
                    for(let i=0; i<sr; i++){
                        let s = this.sliders[this.sliders.length - 1].remove();
                        this.sliders.pop();
                    }
                    this.installActiveSlider(0);
                    this.flagBlockInfinity = false;
                }
            }
        } else {
            this.installActiveSlider(this.activeSlider);
            this.slideAll(() => this.flagBlockInfinity = false);
        }
    }

    prepareSlidesOnclick(){
        this.container.addEventListener('click', func.bind(this));
        function func(event){
            if(!event.target.closest('.slider_slide')) return;
            let slide = event.target.closest('.slider_slide');
            let number = +slide.dataset.number
            this.sliders.forEach(slide => slide.classList.remove('active'));
            if(this.params.infinity){
                this.sliders.forEach((item,i) => {
                    item.classList.remove('active');
                    if(item == slide){
                        item.classList.add('active');
                        this.installActiveSlider(i);
                    }
                });

                this.infinitySlideWork();
            } else {
                this.installActiveSlider(slide.dataset.number)
                this.slideAll();
            }
        }
    }

    mouseFlip(event){
        event.preventDefault();
        let mousePointStart = event.clientX;
        let mousePointCurrent = 0;

        let mouseMoveBinded = mouseMove.bind(this);
        function mouseMove(event){
            event.preventDefault();
            clearInterval(this.autoShift);
            mousePointCurrent = event.clientX;
            let m = (mousePointCurrent - mousePointStart);

            if(m < -document.body.offsetWidth/4){
                this.slideMove({direction: 'right'});
                mousePointStart = mousePointCurrent;
                mouseUp.call(this,event);
            } else if(m > document.body.offsetWidth/4){
                this.slideMove({direction: 'left'});
                mousePointStart = mousePointCurrent;
                mouseUp.call(this,event);
            }
        }

        function mouseUp(event){
            event.preventDefault();
            this.container.removeEventListener('mousemove', mouseMoveBinded);
            mousePointStart = 0;
            mousePointCurrent = 0;
        }

        this.container.addEventListener('mousemove', mouseMoveBinded);
        this.container.addEventListener('mouseup', mouseUp.bind(this));
    }

    touchFlip(event){
        let touchPointStart = event.changedTouches['0'].screenX;
        let touchPointStartY = event.changedTouches['0'].screenY;
        let touchPointCurrent = 0;
        let touchPointCurrentY = 0;
        let m = 0;
        let n = 0;

        let touchMoveBinded = touchMove.bind(this);
        let touchEndBinded = touchEnd.bind(this);

        this.touchTimeStart = +new Date();

        function touchMove(event){
            touchPointCurrent = event.changedTouches['0'].screenX;
            touchPointCurrentY = event.changedTouches['0'].screenY;
            m = touchPointCurrent - touchPointStart;
            n = touchPointCurrentY - touchPointStartY;

            if(m >= document.body.offsetWidth/4){
                event.preventDefault();
                clearInterval(this.autoShift);
                this.slideMove({direction: 'left'});
                touchPointStart = touchPointCurrent;
                touchEndBinded(event);
            } else if(m <= -document.body.offsetWidth/4){
                event.preventDefault();
                clearInterval(this.autoShift);
                this.slideMove({direction: 'right'});
                touchPointStart = touchPointCurrent;
                touchEndBinded(event);
            }

        }


        function touchEnd(event){
            this.container.removeEventListener('touchmove', touchMoveBinded);
            this.container.removeEventListener('touchend', touchEndBinded);
            touchPointStart = 0;
            touchPointStartY = 0;
            touchPointCurrent = 0;
            touchPointCurrentY = 0;

            if((m <= 20 && m >= -20) && (n <= 20 && n >= -20)){
                event.target.click();
            }

            event.preventDefault();
        }

        this.container.addEventListener('touchmove', touchMoveBinded);
        this.container.addEventListener('touchend', touchEndBinded);
        this.container.addEventListener('touchcancel', touchEndBinded);
    }
};


function lazyLoadIframe(selector){
    document.querySelectorAll(selector).forEach(item => {
        setTimeout(() => {
            if(item.dataset.src) item.src = item.dataset.src;
        }, 1000)
    })
};