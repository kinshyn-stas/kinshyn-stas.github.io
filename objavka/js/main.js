"use strict";

window.onload = function(){

    new classMultiplyWrapper(Slider, {
        selector: '.carousel_slider',
        navigationArrows: true,
        navigationDotters: true,
        infinity: true,
    });

    new classMultiplyWrapper(Slider, {
        selector: '.pr_slider',
        navigationArrows: true,
        infinity: true,
    });

    new classMultiplyWrapper(Slider, {
        selector: '.pt_content_images_slider',
        navigationArrows: true,
        infinity: true,
        multiDisplay: {
            desktop: 5,
            touch: 5,
            mobile: 1,
            marginRight: {
                desktop: 9,
                touch: 9,
                mobile: 0,
            }
        }
    });

    document.addEventListener('click', clickItemHandler);

    document.addEventListener('mousemove', handlerStarsHover);

    document.addEventListener('click', handlerClickLinks);


    document.addEventListener('input', validatePhone);


    emulateSelector('.select_emulator');


    resizeXWrapper();


    hiddenScrollAside('.seo_content');
    window.addEventListener('resize',() => hiddenScrollAside('.seo_content'));
};


function classMultiplyWrapper(Cls,parametrs){
    document.querySelectorAll(parametrs.selector).forEach((item) => {
        parametrs.item = item;
        new Cls(parametrs);
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
        this.slider_arrow_right.innerHTML = `<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="20" cy="20" r="19.5" stroke="#4F8A86"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6 24.6L21.2 20L16.6 15.4L18 14L24 20L18 26L16.6 24.6Z" fill="#4F8A86"/>
        </svg>`
        this.slider_arrow_right.onclick = ()=> this.slideMove({direction: 'right'});
        //slider_arrow_right.ontouchstart = ()=> this.slideMove({direction: 'right'});
        this.container.append(this.slider_arrow_right);

        this.slider_arrow_left = document.createElement('div');
        this.slider_arrow_left.classList = 'slider_arrow slider_arrow-left';
        this.slider_arrow_left.innerHTML = `<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="20" cy="20" r="19.5" stroke="#4F8A86"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M23.3999 24.6L18.7999 20L23.3999 15.4L21.9999 14L15.9999 20L21.9999 26L23.3999 24.6Z" fill="#4F8A86"/>
        </svg>`
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
                if(w>0 && w<=768){
                    marginRight = this.params.multiDisplay.marginRight.mobile;
                } else if(w>768 && w<=1100){
                    marginRight = this.params.multiDisplay.marginRight.touch;
                } else {
                    marginRight = this.params.multiDisplay.marginRight.desktop;
                }
            }

            d = this.boxWidth - (marginRight * (this.slideOnScreen - 1)) / this.slideOnScreen;
        }

        if(this.sliders.length < this.slideOnScreen){
            this.block.style.width = `${100 * this.sliders.length / this.slideOnScreen}%`;
            this.slideOnScreen = this.sliders.length; 
        } 

        this.sliders.forEach((slide,i,arr)=>{
            slide.style.width = `${d}px`;
            slide.style.minWidth = `${d}px`;
            slide.dataset.number = i;
            //if((i + 1) % this.slideOnScreen) slide.style.marginRight = `${marginRight}px`;
            slide.style.marginRight = `${marginRight}px`
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


function clickItemHandler(event){
    if(!event.target.closest('.click-item')) return;
    let item = event.target.closest('.click-item');
    if(item.getAttribute('href') && item.getAttribute('href') == '#') event.preventDefault();

    let obj = {
        'toggle': function(target){
            target.closest('.click-obj').classList.toggle('active');
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

        'tab-change': function(target){
            if(target.classList.contains('active')) return;
            let block = target.closest('.main-block');
            block.querySelectorAll('.tab_item').forEach(item => item.classList.remove('active'));
            target.classList.add('active');
            block.querySelectorAll('.tab_content').forEach(item => item.classList.remove('active'));
            block.querySelector(target.dataset.label).classList.add('active');
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

        'star-pick': function(target){
            let parent = target.closest('.pi_testimonials_form_item_stars');
            parent.classList.add('active');
            let flag = false;
            parent.querySelectorAll('.pi_testimonials_form_item_star').forEach(item => item.classList.remove('active'));
            parent.querySelectorAll('.pi_testimonials_form_item_star').forEach(item => {
                if(flag) return;
                item.classList.add('active');
                if(item == target) flag = true;
            });
        },

        'switch-container': function(target){
            if(target.classList.contains('active')) return;
            let parent = target.closest('.order_content');
            parent.querySelectorAll('.order_switch_item').forEach(item => item.classList.remove('active'));
            target.classList.add('active');
            parent.querySelectorAll('.order_tab').forEach(item => item.classList.remove('active'));
            parent.querySelector(target.dataset.label).classList.add('active');
            target.closest('.order_switch_box').classList.toggle('switch');
        },

        'change-dos': function(target){
            if(target.classList.contains('active')) return;
            let parent = target.closest('.tab_parent');
            parent.querySelectorAll('.tab_label').forEach(item => item.classList.remove('active'));
            target.classList.add('active');
            console.log(parent)
            console.log(parent.querySelectorAll('.tab_dos'))
            parent.querySelectorAll('.tab_dos').forEach(item => item.classList.remove('active'));
            parent.querySelectorAll(target.dataset.label).forEach(item => item.classList.add('active'));            
        },
    }

    if(item.dataset.action){
        let actions = item.dataset.action.split(' ');
        actions.forEach(action => obj[action](item));
    } else {
        obj['toggle'](item);
    }
};


function handlerStarsHover(event){
    if(!event.target.closest('.pi_testimonials_form_item_star')) return;
    if(event.target.closest('.pi_testimonials_form_item_stars.active')) return;
    let target = event.target.closest('.pi_testimonials_form_item_star');
    let parent = target.closest('.pi_testimonials_form_item_stars');
    let flag = false;
    parent.querySelectorAll('.pi_testimonials_form_item_star').forEach(item => item.classList.remove('active'));
    parent.querySelectorAll('.pi_testimonials_form_item_star').forEach(item => {
        if(flag) return;
        item.classList.add('active');
        if(item == target) flag = true;
    });
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


function validatePhone(event){
    if(!(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel')) return;
    let target = event.target;
    
    if(+target.dataset.format){
        target.value = target.value.replace(/,/g,".");
        target.value = target.value.replace(/[^.0-9]/g,"");
    } else {
        target.value = target.value.replace(/\D/g,"");
    }
};


function costul(selector){
    let arr = document.querySelectorAll(selector);
    let n = 1;
    for(let i = arr.length - 1; i>=0; i--){
        arr[i].style.zIndex = n;
        n++;
    }
}
costul('.order_form_item, .tab_dos');