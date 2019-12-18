"use strict";

window.onload = function(){

    new classMultiplyWrapper(Slider, {
        selector: '.catalog_slider',
        navigationArrows: true,
        navigationLine: true,
        multiDisplay: {
            mobile: 1,
            touch: 3,
            desktop: 3,
            multiShift: true,
            marginRight: {
                mobile: 15,
                touch: 15,
                desktop: 24,
            },
        },
    });

    document.addEventListener('click', clickItemHandler);


    document.addEventListener('change',togglePartForm);


    document.addEventListener('keydown', function(event){
        if(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel'){
            let keycode = event.keyCode;
            if ((44 < keycode && keycode < 58)||(keycode == 187)||(keycode == 8)||(keycode == 37)||(keycode == 39)){} else {
                event.preventDefault();
            };
        };
    });


    emulateSelector('.select_emulator');


    new inputFileEmulator('.input_emulator-file');


    hiddenScrollAside('.aside-main');
    window.addEventListener('resize',() => hiddenScrollAside('.aside-main'));


    toggleAsideElasticBlock();
    window.addEventListener('resize',toggleAsideElasticBlock);


    document.addEventListener('mouseover',handlerStarsHover);
};


function classMultiplyWrapper(Cls,parametrs){
    document.querySelectorAll(parametrs.selector).forEach((item) => {
        parametrs.item = item;
        new Cls(parametrs);
    })
};


class Slider{
    constructor(params){
        this.container = params.item;
        this.params = params;
        params.moveTime ? (this.moveTime = params.moveTime) : (this.moveTime = 0.4);
        this.createSliderBox();
        if(this.params.navigationDotters) this.createSliderNavigationDotters();
        this.prepare();
        if(this.params.navigationArrows) this.createSliderNavigationArrows();
        if(this.params.navigationCounter) this.createSliderNavigationCounter();
        if(this.params.navigationLine) this.createSliderNavigationLine();
        if(this.params.slideClickRewind) this.prepareSlidesOnclick();


        this.box.addEventListener('mousedown',this.mouseFlip.bind(this));
        this.box.addEventListener("touchstart", this.touchFlip.bind(this));

        window.addEventListener('resize', this.prepare.bind(this));
    }

    prepare(){
        this.activeSlider = 0;

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

        this.boxShift = 0;
        this.marginRight = 0;

        this.extendSlides();
        this.slideAll();
    }

    createSliderBox(){
        if(this.container.children.length && this.container.children[0].classList.contains('slider_block')){
            this.block = this.container.children[0];
            return;
        }

        this.block = document.createElement('div');
        this.block.classList = ('slider_block');
        this.box = document.createElement('div');
        this.box.classList = ('slider_box');

        this.sliders = [].slice.call(this.container.children);
        this.sliders.forEach((item,i,arr)=>{
            this.box.append(item);
        });
        this.block.append(this.box);
        this.container.append(this.block);
        this.block.style.width = '100%';
        this.block.style.maxWidth = '100vw';
        this.block.style.overflow = 'hidden';
        this.box.style.display = 'flex';
        this.box.style.transition = `transform ${this.moveTime}s ease-in-out`;
        this.box.style.transform = `translateX(0)`;
    }

    createSliderNavigationArrows(){
        let slider_arrow_right = document.createElement('div');
        slider_arrow_right.classList = 'slider_arrow slider_arrow-right';
        slider_arrow_right.innerHTML = `<span class="slider_arrow_text"></span>
                                        <span class="slider_arrow_icon"></span>`;
        slider_arrow_right.onclick = ()=> this.slideMove({direction: 'right'});
        this.container.append(slider_arrow_right);

        let slider_arrow_left = document.createElement('div');
        slider_arrow_left.classList = 'slider_arrow slider_arrow-left';
        slider_arrow_left.innerHTML = `<span class="slider_arrow_text"></span>
                                        <span class="slider_arrow_icon"></span>`;
        slider_arrow_left.onclick = ()=> this.slideMove({direction: 'left'});
        this.container.append(slider_arrow_left);

        if(this.activeSlider == 0) slider_arrow_left.classList.add('non-active');
    }

    createSliderNavigationCounter(){
        let slider_counter = document.createElement('div');
        slider_counter.classList = 'slider_counter';

        let numberStart = `01`;
        let numberEnd = Math.ceil(this.sliders.length / this.slideOnScreen);
        numberEnd = (numberEnd<10) ? `0${numberEnd}` : numberEnd;

        slider_counter.innerHTML = `<span class="slider_counter_number slider_counter_number-start">${numberStart}</span><span class="slider_counter_line"></span><span class="slider_counter_number slider_counter_number-end">${numberEnd}</span>`;
        this.container.append(slider_counter);
    }

    changeSliderNavigationCounter(){
        let numberStart = Math.ceil(this.activeSlider/this.slideOnScreen) + 1;
        if(numberStart < 1) numberStart = 1;
        numberStart = (numberStart<10) ? `0${numberStart}` : numberStart;

        this.container.querySelectorAll('.slider_counter_number-start')[0].textContent = numberStart;
    }

    createSliderNavigationDotters(){
        let slider_nav = document.createElement('ul');
        slider_nav.classList = 'slider_nav';

        this.butts = [];
        for(let i=0; i<this.sliders.length; i++){
            let slider_nav_butt = document.createElement('li');
            slider_nav_butt.classList = 'slider_nav_butt';
            slider_nav_butt.style.transition = `all ${this.moveTime} ease-in-out`;
            slider_nav_butt.dataset.number = i;
            this.butts.push(slider_nav_butt);
        }

        this.butts.forEach((butt,i,arr)=>{
            butt.addEventListener('click',func.bind(this));
            slider_nav.append(butt);

            function func(){
                return this.slideMove({counter: butt.dataset.number});
            }
        });

        this.container.append(slider_nav);
    }

    createSliderNavigationLine(){
        let slider_line = document.createElement('div');
        slider_line.classList = 'slider_line';

        let slider_line_item = document.createElement('div');
        slider_line_item.classList = 'slider_line_item';
        slider_line_item.style.cssText = `position: absolute;
                                        left: 0;
                                        top: 0;
                                        height: 100%;
                                        width: ${(100 / Math.ceil(this.sliders.length / this.slideOnScreen))}%;
                                        transition: left ${this.moveTime}s ease-in-out, width ${this.moveTime}s linear`;

        slider_line.append(slider_line_item);
        this.container.append(slider_line);
    }

    extendSlides(){
        this.boxWidth = this.box.offsetWidth/this.slideOnScreen;

        if(this.params.multiDisplay && this.params.multiDisplay.marginRight){
            let w = document.body.offsetWidth;
            //console.log(w)
            if(w>0 && w<=768){
                console.log('n1')
                this.marginRight = this.params.multiDisplay.marginRight.mobile;
            } else if(w>768 && w<=1100){
                this.marginRight = this.params.multiDisplay.marginRight.touch;
            } else {
                this.marginRight = this.params.multiDisplay.marginRight.desktop;
            }

            this.boxWidth -= (this.marginRight * (this.slideOnScreen - 1))/this.slideOnScreen;
        }

        this.sliders.forEach((slide,i,arr)=>{
            slide.style.width = `${this.boxWidth}px`;
            slide.style.minWidth = `${this.boxWidth}px`;
            slide.style.marginLeft = `${this.marginRight}px`;
            slide.dataset.number = i;
        });
    }

    slideAll(callback){
        if(!this.sliders.length) return;
        let n = 0;
        this.boxShift -= this.marginRight;

        this.sliders.forEach((slide,i,arr)=>{
            if(slide.classList.contains('active')){
                n = slide.dataset.number;
                this.boxShift = -(i * this.boxWidth) -((i+1) * this.marginRight);
            }
        });

        this.box.style.transform = `translateX(${this.boxShift}px)`;

        if(n == 0) this.sliders[0].classList.add('active');
        if(n >= this.sliders.length) n = this.sliders.length - 1;

        if(this.params.navigationDotters){
            this.butts.forEach((butt,i,arr)=>{
                butt.classList.remove('active');
                if(i==n) butt.classList.add('active');
            });
        };

        if(this.params.emulateDotters){
            this.emulSlides = [].slice.call(document.querySelector(this.params.emulateDotters).children);
            this.emulSlides.forEach((item,i)=>{
                item.classList.remove('active');
            })
            this.emulSlides[n].classList.add('active');
        }

        if(this.params.navigationArrows && !this.params.infinity && this.container.querySelector('.slider_arrow-left')){
            this.container.querySelectorAll('.slider_arrow').forEach(arrow => arrow.classList.remove('non-active'));
            if(this.activeSlider <= 0) this.container.querySelector('.slider_arrow-left').classList.add('non-active');
            if(this.activeSlider >= (this.sliders.length - this.slideOnScreen)) this.container.querySelector('.slider_arrow-right').classList.add('non-active');
        }

        if(callback) setTimeout(callback, this.moveTime * 1000);
    }

    slideMove(params){
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

        if(this.params.navigationLine){
            this.container.querySelector('.slider_line_item').style.left = `${(100 / Math.ceil(this.sliders.length / this.slideOnScreen)) * (Math.ceil(this.activeSlider / this.slideOnScreen) + 1) - (100 / Math.ceil(this.sliders.length / this.slideOnScreen))}%`;
        }
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
        let l = this.slideOnScreen;

        if(this.activeSlider > this.sliders.length - l){
            for(let i=0; i<l; i++){
                this.box.append(this.sliders[i].cloneNode(true));
            }
            this.sliders = [].slice.call(this.box.children);

            this.installActiveSlider(this.activeSlider);
            this.slideAll(func.bind(this));

            function func(){
                this.box.style.transition = ``;
                this.installActiveSlider(0);
                this.slideAll(func2.bind(this));

                function func2(){
                    for(let i=0; i<l; i++){
                        this.sliders[this.sliders.length - 1].remove();
                        this.sliders.pop();
                    }
                    this.box.style.transition = `transform ${this.moveTime}s ease-in-out`;
                };
            }

        } else if(this.activeSlider < 0){
            this.box.style.transition = ``;
            for(let i=0; i<l; i++){
                this.box.prepend(this.sliders[this.sliders.length - i - 1].cloneNode(true));
            }
            this.sliders = [].slice.call(this.box.children);

            this.installActiveSlider(l);
            this.slideAll(func.bind(this));

            function func(){
                this.box.style.transition = `transform ${this.moveTime}s ease-in-out`;
                this.installActiveSlider(0);
                this.slideAll(func2.bind(this));

                function func2(){
                    this.box.style.transition = ``;
                    this.installActiveSlider(this.sliders.length - l);
                    for(let i=0; i<l; i++){
                        this.sliders[0].remove();
                        this.sliders.shift();
                    }
                    this.slideAll(func3.bind(this));

                    function func3(){
                        this.box.style.transition = `transform ${this.moveTime}s ease-in-out`;
                    }
                };
            }
        } else {
            this.installActiveSlider(this.activeSlider);
            this.slideAll();
        }
    }

    prepareSlidesOnclick(){
        this.sliders.forEach((slide)=>{

            slide.addEventListener('click', func.bind(this));

            function func(){
                this.sliders.forEach(slide => slide.classList.remove('active'));
                slide.classList.add('active');
                this.slideAll();
            }
        })
    }

    mouseFlip(event){
        event.preventDefault();
        let x = this.box;
        let mousePointStart = event.clientX;
        let mousePointCurrent = 0;

        let mouseMoveBinded = mouseMove.bind(this);
        function mouseMove(event){
            event.preventDefault();
            mousePointCurrent = event.clientX;
            let m = (mousePointCurrent - mousePointStart);
            x.style.transform = `translateX(${this.boxShift + m}px)`;

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
            this.box.removeEventListener('mousemove', mouseMoveBinded);
            mousePointStart = 0;
            mousePointCurrent = 0;
            x.style.transform = `translateX(${this.boxShift}px)`;
        }

        this.box.addEventListener('mousemove', mouseMoveBinded);
        this.box.addEventListener('mouseup', mouseUp.bind(this));
    }

    touchFlip(event){
        let x = this.box;
        let touchPointStart = event.changedTouches['0'].screenX;
        let touchPointCurrent = 0;
        this.touchBlockFlag = false;

        let touchMoveBinded = touchMove.bind(this);
        function touchMove(event){
            touchPointCurrent = event.changedTouches['0'].screenX;
            let m = touchPointCurrent - touchPointStart;

            if(m >= document.body.offsetWidth/4){
                event.preventDefault();
                this.slideMove({direction: 'left'});
                touchPointStart = touchPointCurrent;
                this.touchBlockFlag = true;
                touchEnd.call(this,event);
            } else if(m <= -document.body.offsetWidth/4){
                event.preventDefault();
                this.slideMove({direction: 'right'});
                touchPointStart = touchPointCurrent;
                this.touchBlockFlag = true;
                touchEnd.call(this,event);
            }

        }

        function touchEnd(event){
            if(!this.touchBlockFlag) return;
            event.preventDefault();
            this.box.removeEventListener('touchmove', touchMoveBinded);
            let touchPointStart = 0;
            let touchPointCurrent = 0;
            x.style.transform = `translateX(${this.boxShift}px)`;
        }

        this.box.addEventListener('touchmove', touchMoveBinded);
        this.box.addEventListener('touchend', touchEnd.bind(this));
        this.box.addEventListener('touchcancel', touchEnd.bind(this));
    }
};


function clickItemHandler(event){
    if(!event.target.closest('.click-item')) return;
    let item = event.target.closest('.click-item');

    let obj = {
        'toggle': function(target){
            target.closest('.click-obj').classList.toggle('active');
        },

        'toggle-focus': function(target){
            target.closest('.click-obj').classList.toggle('active');

            target.closest('.click-obj').setAttribute('tabindex','1');
            target.closest('.click-obj').onblur = function(){
                this.classList.remove('active');
            };
        },

        'remove': function(target){
            target.closest('.click-obj').remove();
        },

        'scroll-top': function(target){
            let int = setInterval(func, 1);

            function func(){
                if(window.pageYOffset >0){
                    window.scrollTo(0, window.pageYOffset - 30);
                } else {
                    clearInterval(int);
                }

            }
        },

        'menu-toggle': function(target){
            let aside = target.closest('.aside-main');
            if(aside.classList.contains('active')){
                aside.classList.remove('active');
            } else {
                aside.classList.add('active');
            }
            aside.querySelectorAll('.aside-main_butt').forEach(item => item.classList.toggle('hidden'));
            toggleAsideElasticBlock();
        },

        'list-toggle': function(target){
            let aside = target.closest('.aside-main');
            let box = target.closest('.list_box');

            if(box.classList.contains('active')){
                box.classList.remove('active');
            } else {
                aside.querySelectorAll('.list_box').forEach(box => box.classList.remove('active'));
                box.classList.add('active');
            }
        },

        'panel-toggle': function(target){
            let box = target.closest('.catalog_panel_toggler');
            box.querySelectorAll('.catalog_panel_toggler_item').forEach(item => item.classList.toggle('active'));
            document.querySelectorAll('.catalog_panel_box').forEach(item => item.classList.toggle('active'));
        },

        'change-tab': function(target){
            let box = target.closest('.tabs_box');

            document.querySelectorAll(target.dataset.label).forEach(tabContent => {
                tabContent.closest('.tabs_content').querySelectorAll('.tab_content').forEach(item => item.classList.remove('active'));

                tabContent.classList.add('active');
            })

            box.querySelectorAll('.tab_item ').forEach(item => item.classList.remove('active'));
            target.classList.add('active');

            if(box.classList.contains('catalog_tabs_box')){
                slideLineToActiveTab(box);
            }

            function slideLineToActiveTab(box){
                let line = box.querySelector('.catalog_tabs_line');
                let items = box.querySelectorAll('.catalog_tabs_item');
                let left = 0;

                for(let i=0; i<items.length; i++){
                    if(items[i].classList.contains('active')) break;
                    left += items[i].offsetWidth;
                }

                line.style.left = `${left}px`
            }
        },

        'select_tag_remove': function(target){
            let box = target.closest('.catalog_panel_item');
            let select = box.querySelector('.select');
            select.classList.remove('select_on');
            select.querySelector('.select_option.selected').classList.remove('selected');
            select.querySelector('.select_option.default').classList.add('selected');
        },

        'change_stuff-image': function(target){
            let parent = target.closest('.click-obj')
            if(!target.classList.contains('actual')){
                parent.querySelectorAll('.click-item').forEach(item => item.classList.remove('actual'));
                target.classList.add('actual');

                makeImageActive();

                function makeImageActive(){
                    parent.querySelector('.measure').remove();

                    let box = document.createElement('div');
                    box.classList = 'measure';
                    box.innerHTML = `<div class="measure_item measure_item-top"></div>
                            <div class="measure_help">
                                <div class="measure_item measure_item-left"></div>
                                <div class="measure_item measure_item-right"></div>
                            </div>
                            <div class="measure_item measure_item-bottom"></div>`;

                    target.append(box);
                }               
            }
        },

        'change-size': function(target){
            let input = target.closest('.stuff_form_size_item').querySelector('input');
            let direction = target.dataset.direction;

            if(direction == 'top' || direction == 'right'){
                input.value++;
            } else {
                input.value--;
            }
        },

        'popup-open': function(target){
            document.querySelector(target.dataset.label).classList.add('active');
        },

        'popup-close': function(target){
            if(target.dataset.label){
                document.querySelector(target.dataset.label).classList.remove('active')
            } else {
                target.closest('.popup-container').classList.remove('active');
            }
        },
    }

    if(item.dataset.action){
        let actions = item.dataset.action.split(' ');
        actions.forEach(action => obj[action](item))
    } else {
        obj['toggle'](item);
    }
};


function emulateSelector(select){
    let selects = document.querySelectorAll(select);

    selects.forEach((select) =>{
        select.classList.add('collapsed');

        let emul = document.createElement('div');
        emul.classList = "select";
        emul.onclick = ()=>emul.classList.toggle('active');
        emul.setAttribute('tabindex','1');
        emul.onblur = function(){
            this.classList.remove('active');
        };

        let emulList = document.createElement('div');
        emulList.classList = "select_list";
        emul.append(emulList);



        select.querySelectorAll('option').forEach((item)=>{
            let option = document.createElement('div');
            option.classList = "select_option";
            option.innerHTML = item.innerHTML;
            option.dataset.value = item.value;
            option.onclick = ()=>{
                select.querySelectorAll('option').forEach(item =>{
                    if(item.value == option.dataset.value){
                        if(!item.hasAttribute('selected')){
                            item.setAttribute('selected',true);
                            select.onchange();
                        }
                    } else {
                        item.removeAttribute('selected');
                    }
                })
                option.parentNode.querySelectorAll('.select_option').forEach((option)=>{
                    option.classList.remove('selected')
                });
                option.classList.add('selected');

                if(!option.classList.contains('default')) emul.classList.toggle('select_on');
            };
            if(item.selected) option.classList.add('selected');
            if(item.dataset.default == 'true') option.classList.add('default');
            if(item.disabled) option.classList.add('disabled');
            emulList.append(option);
        });

        select.parentNode.prepend(emul);

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


class inputFileEmulator{
    constructor(selector){
        document.querySelectorAll(selector).forEach(box =>{
            let input = box.querySelector('input');
            let label = box.querySelector('label');

            input.addEventListener('change', function(e){
                let fileName = '';

                if (this.files && this.files.length > 1){
                    fileName = ( this.getAttribute('data-multiple-caption') || '' ).replace('{count}', this.files.length);
                }
                else{
                    fileName = e.target.value.split('\\').pop();
                }

                if (fileName) label.innerHTML = `<span>${fileName}</span>`;
            })
        })
    }
}


function hiddenScrollAside(selector){
    document.querySelectorAll(selector).forEach(box =>{
        box.classList.add('scroll-emul_block');
        box.style.overflowX = 'hidden';
        let cont = box.querySelector('.scroll-emul_container');


        if(!box.children[0].classList.contains('scroll-emul_container')){
            cont = document.createElement('div');
            cont.classList = 'scroll-emul_container';

            while(box.children.length){
                cont.append(box.children[0])
            }

            box.append(cont);
            cont.style.height = `100%`;
            cont.style.overflowY = `scroll`;
        }

        cont.style.width = `calc(100% + ${cont.offsetWidth - cont.clientWidth - cont.clientLeft}px)`;
    })
};


function toggleAsideElasticBlock(){
    let aside = document.getElementById('aside');
    let container = document.querySelector('.aside-main_container');

    aside.querySelectorAll('.list_box-elastic').forEach(item => item.classList.add('hidden'));
    aside.querySelectorAll('.list_list-elastic').forEach(item => item.classList.add('hidden'));

    let h0 = container.offsetHeight;

    let h2 = 0;
    aside.querySelectorAll('.list_list-elastic').forEach(item => {
        item.classList.remove('hidden');
        h2 += item.offsetHeight
    });

    if(document.body.offsetWidth <= 1100) h2 = 0;


    if(document.documentElement.clientHeight < h0 + h2){
        aside.querySelectorAll('.list_box-elastic').forEach(item => item.classList.remove('hidden'));
        aside.querySelectorAll('.list_list-elastic').forEach(item => item.classList.add('hidden'));
    } else {
        aside.querySelectorAll('.list_box-elastic').forEach(item => item.classList.add('hidden'));
        aside.querySelectorAll('.list_list-elastic').forEach(item => item.classList.remove('hidden'));
    }
};


function togglePartForm(event){
    if(!event.target.classList.contains('tekstura_input_toggle')) return;
    let target = event.target.closest('.tekstura_input_toggle');

    document.querySelectorAll(`.tekstura_description`).forEach(item => {
        item.classList.remove('active');
    });

    target.closest('.tekstura_item').querySelector('.tekstura_description').classList.add('active');
};


function handlerStarsHover(event){
    if(!event.target.closest('.stars_item')) return;
    let target = event.target.closest('.stars_item');
    let box = target.closest('.stars_box');
    let stars = box.querySelectorAll('.stars_item');

    stars.forEach(item => item.classList.remove('active'));

    for(let i=0; i<stars.length - 1; i++){
        stars[i].classList.add('active');
        if(stars[i] === target) break;
    }
};



function changeMeasureBorders(){
    document.removeEventListener('mousedown', mousedown);
    document.addEventListener('mousedown', mousedown);

    function mousedown(e){
        if(!e.target.closest('.measure')) return;
        if(e.which && e.which != 1) return;
        event.preventDefault();
        console.log('down');

        let box = e.target.closest('.measure');
        let boxPosition = box.getBoundingClientRect();
        let boxHeight = box.clientHeight;
        let boxWidth = box.clientWidth;

        let mTop = box.querySelector('.measure_item-top');
        let mBottom = box.querySelector('.measure_item-bottom');
        let mLeft = box.querySelector('.measure_item-left');
        let mRight = box.querySelector('.measure_item-right');

        let startX = e.clientX - boxPosition.left;
        let partX = false;
        let paddLeft = parseFloat(getComputedStyle(mLeft).width);
        if(paddLeft <= 0) paddLeft = 10;
        let paddRight = parseFloat(getComputedStyle(mRight).width);
        if(paddRight <= 0) paddRight = 10;
        if(((paddLeft > boxWidth / 2) && startX <= paddLeft) || (startX <= boxWidth / 2)){
            partX = true;
        } else if(((paddRight > boxWidth / 2) && startX >= (boxWidth - paddRight)) || (startX > boxWidth / 2)){
            partX = false;
        }

        let startY = e.clientY - boxPosition.top;
        let partY = false;
        let paddTop = parseFloat(getComputedStyle(mTop).height);
        if(paddTop <= 0) paddTop = 10;
        let paddBottom = parseFloat(getComputedStyle(mBottom).height);
        if(paddBottom <= 0) paddBottom = 10;
        if(((paddTop > boxHeight / 2) && startY <= paddTop) || (startY <= boxHeight / 2)){
            partY = true;
        } else if(((paddBottom > boxHeight / 2) && startY >= (boxHeight - paddBottom)) || (startY > boxHeight / 2)){
            partY = false;
        }

        let position;
        if((startY <= paddTop) || (startY >= boxHeight - paddBottom)){
            position = true;
        } else {
            position = false;
        }

        let paddingTop,
        paddingBottom,
        paddingLeft,
        paddingRight;

        document.addEventListener('mousemove', mousemove);
        document.addEventListener('mouseup', mouseup);

        function mousemove(e){
            let d1,d2

            if(position){
                d1 = true;

                if(partY){
                    paddingTop = e.clientY - boxPosition.top;
                    d2 = true;
                } else {
                    paddingBottom = boxHeight - (e.clientY - boxPosition.top);
                    d2 = false;
                } 
            } else {
                d2 = false;

                if(partX){
                    paddingLeft = e.clientX - boxPosition.left;
                    d2 = true;
                } else {
                    paddingRight = boxWidth - (e.clientX - boxPosition.left);
                    d2 = false;
                } 
            }            
            
            changePadding(d1,d2);
        }

        function mouseup(e){
            console.log('up');

            document.removeEventListener('mousemove', mousemove);
            document.removeEventListener('mouseup', mouseup);
        }

        function changePadding(d1,d2){
            if(d1){
                if(d2){
                    if((paddingTop + paddBottom) >= boxHeight) paddingTop = boxHeight - paddBottom; 
                    if(paddingTop < 0) paddingTop = 0;
                    mTop.style.height = `${paddingTop}px`;
                } else {
                    if((paddingBottom + paddTop) >= boxHeight) paddingBottom = boxHeight - paddTop; 
                    if(paddingBottom < 0) paddingBottom = 0;
                    mBottom.style.height = `${paddingBottom}px`;
                }
            } else {
                if(d2){
                    if((paddingLeft + paddRight) >= boxWidth) paddingLeft = boxWidth - paddRight; 
                    if(paddingLeft < 0) paddingLeft = 0;
                    mLeft.style.width = `${paddingLeft}px`;
                } else {
                    if((paddingRight + paddLeft) >= boxWidth) paddingRight = boxWidth - paddLeft; 
                    if(paddingRight < 0) paddingRight = 0;
                    mRight.style.width = `${paddingRight}px`;
                }
            } 

        }

        box.ondragstart = function() {
          return false;
        };
    }
}

changeMeasureBorders();