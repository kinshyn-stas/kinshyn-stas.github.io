"use strict";

window.onload = function(){

    document.addEventListener('click', clickItemHandler);


    emulateSelector('.select_emulator');


    document.addEventListener('click', handlerClickLinks);


    //document.addEventListener('input', validatePhone);


    functionMultiplyWrapper(() => hiddenScrollAside('.seo_content'));
    window.addEventListener('resize',() => hiddenScrollAside('.seo_content'));

    functionMultiplyWrapper(() => changeMainPaddingTop());
    resizeXWrapper(changeMainPaddingTop)


    new classMultiplyWrapper(Slider, {
        selector: '.rekl_box',
        navigationArrows: true,
        infinity: true,
    });

    new classMultiplyWrapper(Slider, {
        selector: '.blog_slider',
        navigationArrows: {
            left: `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                    <g fill="#0A0A0A">
                        <path d="M16 0C7.163 0 0 7.163 0 16s7.163 16 16 16 16-7.163 16-16S24.837 0 16 0zm0 .97C24.301.97 31.03 7.699 31.03 16c0 8.301-6.729 15.03-15.03 15.03C7.699 31.03.97 24.301.97 16 .97 7.699 7.699.97 16 .97z" transform="matrix(-1 0 0 1 32 0)"/>
                        <path d="M14.237 10c-.288-.006-.55.17-.667.441-.113.273-.055.589.147.8l4.638 4.034c.378.317.567.56.567.729 0 .169-.189.411-.567.728l-4.638 4.035c-.271.29-.26.751.022 1.03.282.279.73.27 1.002-.023l5.461-5.035c.406-.374.432-1.007.058-1.413-.018-.02-.038-.04-.058-.058l-5.461-5.035c-.13-.145-.313-.227-.504-.233z" transform="matrix(-1 0 0 1 32 0)"/>
                    </g>
                </svg>`,
            right: `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <g fill="#0A0A0A">
                            <path d="M16 0C7.163 0 0 7.163 0 16s7.163 16 16 16 16-7.163 16-16S24.837 0 16 0zm0 .97C24.301.97 31.03 7.699 31.03 16c0 8.301-6.729 15.03-15.03 15.03C7.699 31.03.97 24.301.97 16 .97 7.699 7.699.97 16 .97z"/>
                            <path d="M14.237 10c-.288-.006-.55.17-.667.441-.113.273-.055.589.147.8l4.638 4.034c.378.317.567.56.567.729 0 .169-.189.411-.567.728l-4.638 4.035c-.271.29-.26.751.022 1.03.282.279.73.27 1.002-.023l5.461-5.035c.406-.374.432-1.007.058-1.413-.018-.02-.038-.04-.058-.058l-5.461-5.035c-.13-.145-.313-.227-.504-.233z"/>
                        </g>
                    </svg>`,
        },
        navigationDotters: true,
        infinity: true,
        /*multiDisplay: {
            desktop: 4,
            touch: 4,
            mobile: 1,
            marginRight: {
                desktop: 24,
                touch: 24,
                mobile: 12,
            },
            multiShift: true,
        }*/
    });


    document.addEventListener('mouseover', hoverItemsHandler);


    document.addEventListener('mouseover', hoverCanvasHandler);


    functionMultiplyWrapper(headerStroke);


    functionMultiplyWrapper(vBannerContentCarousel);


    functionMultiplyWrapper(changeHeaderClassScroll);
    document.addEventListener('scroll', changeHeaderClassScroll)


    new classMultiplyWrapper(SlSlider, {
        selector: '.sl_slider',
    });


    animationText();
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


function hoverItemsHandler(event){
    if(!event.target.closest('.hover-item')) return;
    let target = event.target.closest('.hover-item');
    let parent = event.target.closest('.hover-parent');
    parent.querySelectorAll('.hover-item').forEach(item => item.classList.add('hover-hide'));
    target.classList.remove('hover-hide');
    target.classList.add('hover-focus');

    document.addEventListener('mouseout', hoverItemsHandlerCleaner);
    function hoverItemsHandlerCleaner(){
        parent.querySelectorAll('.hover-item').forEach(item => item.classList.remove('hover-hide','hover-focus'));
        document.removeEventListener('mouseout', hoverItemsHandlerCleaner);
    }
};


function hoverCanvasHandler(event){
    if(!event.target.closest('.pc_canvas_item')) return;
    let target = event.target.closest('.pc_canvas_item');
    let parent = event.target.closest('.pc_canvas_items');

    parent.querySelectorAll('.pc_canvas_item').forEach(item => item.classList.remove('active', 'left'));
    target.classList.add('active');

    if(parent.offsetWidth - target.offsetWidth - target.offsetLeft < 178){
        target.classList.add('left');
    };

    target.addEventListener('mouseout', hoverCanvasHandlerCleaner);
    function hoverCanvasHandlerCleaner(){
        target.classList.remove('active','left');
        target.removeEventListener('mouseout', hoverCanvasHandlerCleaner);
    }
};


class SlSlider{
    constructor(params){
        this.parent = params.item;
        this.params = params;

        this.articles = this.parent.querySelectorAll('.sl_slider_content_item');
        this.box = this.parent.querySelector('.sl_slider_box');
        this.items = this.parent.querySelectorAll('.sl_slider_item');

        this.activeItem(0);
        this.ready();

        this.box.addEventListener("mousedown", this.mouseFlip.bind(this));
        this.box.addEventListener("touchstart", this.touchFlip.bind(this));
        window.addEventListener("resize", this.ready.bind(this));
    }

    ready(){
        let boxWidth = 0;
        this.items.forEach(item => {
            boxWidth += item.offsetWidth;
            boxWidth += parseFloat(getComputedStyle(item).marginRight);
        });
        this.box.style.minWidth = `${boxWidth}px`;
        this.box.style.width = `auto`;

        this.activeItem(this.activeNumber);
    }

    activeItem(n){
        if(n < 0) n = 0;
        if(n >= this.items.length) n = this.items.length - 1;
        this.activeNumber = n;
        this.items.forEach(items => items.classList.remove('active'));
        this.items[n].classList.add('active');

        this.activeArticle(n);
        this.moveBox(n);
    }

    activeArticle(n){
        if(n < 0) n = 0;
        if(n >= this.articles.length) n = this.articles.length - 1;
        this.articles.forEach(article => article.classList.remove('active'));
        this.articles[n].classList.add('active')
    }

    moveBox(n){
        let boxShift = 0;
        for(let i = 0; i < n; i++){
            boxShift += this.items[i].offsetWidth;
            boxShift += parseFloat(getComputedStyle(this.items[i]).marginRight);
        }
        this.box.style.transform = `translateX(-${boxShift}px)`;
    }

    mouseFlip(event){
        event.preventDefault();
        let mousePointStart = event.clientX;
        let mousePointCurrent = 0;

        let mouseMoveBinded = mouseMove.bind(this);
        function mouseMove(event){
            event.preventDefault();
            mousePointCurrent = event.clientX;
            let m = (mousePointCurrent - mousePointStart);

            if(m < -document.body.offsetWidth/4){
                this.activeItem(this.activeNumber + 1);
                mousePointStart = mousePointCurrent;
                mouseUp.call(this,event);
            } else if(m > document.body.offsetWidth/4){
                this.activeItem(this.activeNumber - 1);
                mousePointStart = mousePointCurrent;
                mouseUp.call(this,event);
            }
        }

        function mouseUp(event){
            event.preventDefault();
            this.box.removeEventListener('mousemove', mouseMoveBinded);
            mousePointStart = 0;
            mousePointCurrent = 0;
        }

        this.box.addEventListener('mousemove', mouseMoveBinded);
        this.box.addEventListener('mouseup', mouseUp.bind(this));

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

        function touchMove(event){
            touchPointCurrent = event.changedTouches['0'].screenX;
            touchPointCurrentY = event.changedTouches['0'].screenY;
            m = touchPointCurrent - touchPointStart;
            n = touchPointCurrentY - touchPointStartY;

            if(m >= document.body.offsetWidth/4){
                if(event.cancelable){
                    event.preventDefault();
                }
                this.activeItem(this.activeNumber - 1);
                touchPointStart = touchPointCurrent;
                touchEndBinded(event);
            } else if(m <= -document.body.offsetWidth/4){
                if(event.cancelable){
                   event.preventDefault();
                }
                this.activeItem(this.activeNumber + 1);
                touchPointStart = touchPointCurrent;
                touchEndBinded(event);
            }

        }


        function touchEnd(event){
            this.box.removeEventListener('touchmove', touchMoveBinded);
            this.box.removeEventListener('touchend', touchEndBinded);
            touchPointStart = 0;
            touchPointStartY = 0;
            touchPointCurrent = 0;
            touchPointCurrentY = 0;

            if((m <= 20 && m >= -20) && (n <= 20 && n >= -20)){
                event.target.click();
            }

            if(event.cancelable){
                event.preventDefault();
            }
        }

        this.box.addEventListener('touchmove', touchMoveBinded);
        this.box.addEventListener('touchend', touchEndBinded);
        this.box.addEventListener('touchcancel', touchEndBinded);
    }
}


function clickItemHandler(event){
    if(!event.target.closest('.click-item')) return;
    let item = event.target.closest('.click-item');
    if(item.getAttribute('href') && item.getAttribute('href') == '#') event.preventDefault();
    let parent;
    if(event.target.closest('.click-obj')) parent = event.target.closest('.click-obj');

    let obj = {
        'toggle': function(target){
            parent.classList.toggle('active');

            if(target.classList.contains('header_switch')){
                let header = document.querySelector('.header_main');
                let header_content = document.querySelector('.header_content');

                if(header.classList.contains('active')){
                    header.querySelector('.header_stroke').style.display = 'none';
                    header.querySelector('.header_menu').style.height = `calc(100vh - ${header_content.clientHeight}px)`;
                    document.body.style.overflow = 'hidden';
                } else {
                    header.querySelector('.header_stroke').style.display = '';
                    header.querySelector('.header_menu').style.height = '';
                    document.body.style.overflow = '';
                }
            }
        },

        'popup-open': function(target){
            if(!document.querySelector(target.dataset.label)) return;
            let popup = document.querySelector(target.dataset.label);
            popup.classList.add('active');

            if(target.classList.contains('header_stroke_item')){
                let h = document.querySelector('.header_stroke').clientHeight;
                popup.style.top = `${h}px`;
                popup.style.height = `calc(100vh - ${h}px)`;
            }
        },

        'popup-close': function(target){
            let popup;
            if(target.dataset.label){
                popup = document.querySelector(target.dataset.label);
            } else {
                popup = target.closest('.popup_container');
            }
            popup.classList.remove('active')

            if(popup.classList.contains('popup-newsletter')){
                popup.style.top = ``;
                popup.style.height = ``;
            }
        },

        'testimonial-switch': function(target){
            parent.querySelectorAll('.click-item[data-action="testimonial-switch"]').forEach(item => {
                item.classList.remove('active');
                item.classList.add('hover-hide');
            });

            item.classList.add('active');
            item.classList.remove('hover-hide');
        },

        'blog-cat-switch': function(target){
            parent.classList.toggle('active');

            if(!target.classList.contains('active')){
                obj.querySelectorAll('.blog_slider_label').forEach(item => item.classList.remove('active'));
                target.classList.add('active');
            }
        },

        'faq-switch': function(target){
            let box = target.closest('.faq_main_f_box');
            box.querySelectorAll('.faq_main_f_item_label').forEach(item => item.classList.remove('active'));
            target.classList.add('active');
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
        emul.classList.add("select");
        emul.onclick = ()=>emul.classList.toggle('active');
        emul.setAttribute('tabindex','1');
        emul.onblur = function(){
            this.classList.remove('active');
        };

        let tit = document.createElement('div');
        tit.classList.add("select_option", "select_tit");
        tit.onclick = () => select.classList.toggle('active');
        emul.append(tit);

        let emulListOuter = document.createElement('div');
        emulListOuter.classList.add("select_list_outer");
        emul.append(emulListOuter);

        let emulList = document.createElement('div');
        emulList.classList.add("select_list","hover-parent");
        emulListOuter.append(emulList);

        select.querySelectorAll('option').forEach((item)=>{
            let option = document.createElement('div');
            option.classList.add("select_option","hover-item");
            option.innerHTML = item.innerHTML;
            option.dataset.value = item.value;

            option.onclick = ()=>{
                if(!emul.classList.contains('active')) return;
                select.value=option.dataset.value;
                tit.textContent = option.textContent;
                tit.classList.add('chosen');

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


function resizeXWrapper(func){
    let widthStart = window.innerWidth;

    window.addEventListener('resize', () => {
        if(window.innerWidth != widthStart){
            func();
            widthStart = window.innerWidth;
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
          line_item.onmousedown = function(event){
            event.preventDefault();
            let startY = event.clientY;
            let startScroll = content.scrollTop;

            document.addEventListener('mousemove', scrollMousemoveHandler);
            document.addEventListener('mouseup', scrollMouseupHandler);

            function scrollMousemoveHandler(event){
                let diffY = event.clientY - startY;
                content.scrollTop = startScroll + (contentFullHeight * diffY / parseFloat(content.offsetHeight));
            }

            function scrollMouseupHandler(event){
                document.removeEventListener('mousemove', scrollMousemoveHandler);
                document.removeEventListener('mouseup', scrollMouseupHandler);
            }
          };

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
        if(this.params.navigationArrows.right){
            this.slider_arrow_right.innerHTML = `${this.params.navigationArrows.right}`;
        } else {
            this.slider_arrow_right.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="12" viewBox="0 0 32 12" class="hover-item">
                                                    <g fill="none" fill-rule="evenodd">
                                                        <path d="M0 0H32V32H0z" transform="translate(0 -10)"/>
                                                        <path class="arrow" fill="#0A0A0A" fill-rule="nonzero" d="M25.237 10c-.288-.006-.55.17-.667.441-.113.273-.055.589.147.8l4.638 4.034H.717c-.254-.002-.492.134-.62.362-.13.227-.13.506 0 .734.128.227.366.364.62.361h28.638l-4.638 4.035c-.271.29-.26.751.022 1.03.282.279.73.27 1.002-.023l5.461-5.035c.406-.374.432-1.007.058-1.413-.018-.02-.038-.04-.058-.058l-5.461-5.035c-.13-.145-.313-.227-.504-.233z" transform="translate(0 -10)"/>
                                                    </g>
                                                </svg>`;            
        }
        this.slider_arrow_right.onclick = ()=> this.slideMove({direction: 'right'});
        this.container.append(this.slider_arrow_right);

        this.slider_arrow_left = document.createElement('div');
        this.slider_arrow_left.classList = 'slider_arrow slider_arrow-left';
        if(this.params.navigationArrows.left){
            this.slider_arrow_left.innerHTML = `${this.params.navigationArrows.left}`;
        } else {
            this.slider_arrow_left.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="12" viewBox="0 0 32 12" class="hover-item">
                                                    <g fill="none" fill-rule="evenodd">
                                                        <path d="M0 0H32V32H0z" transform="matrix(-1 0 0 1 32 -10)"/>
                                                        <path class="arrow" fill="#0A0A0A" fill-rule="nonzero" d="M25.237 10c-.288-.006-.55.17-.667.441-.113.273-.055.589.147.8l4.638 4.034H.717c-.254-.002-.492.134-.62.362-.13.227-.13.506 0 .734.128.227.366.364.62.361h28.638l-4.638 4.035c-.271.29-.26.751.022 1.03.282.279.73.27 1.002-.023l5.461-5.035c.406-.374.432-1.007.058-1.413-.018-.02-.038-.04-.058-.058l-5.461-5.035c-.13-.145-.313-.227-.504-.233z" transform="matrix(-1 0 0 1 32 -10)"/>
                                                    </g>
                                                </svg>`;            
        }
        this.slider_arrow_left.onclick = ()=> this.slideMove({direction: 'left'});
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
        if(n == 0){
            this.sliders[0].classList.add('active');
        } 
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
            if(params.counter != undefined) {
                this.sliders.forEach((slide,i) => {
                    if(+slide.dataset.number == params.counter) this.activeSlider = i
                });
            }

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


function headerStroke(){
    document.querySelectorAll('.header_stroke').forEach(parent => {
        let line = parent.querySelector('.header_stroke_line');
        let items = [];
        let item = parent.querySelector('.header_stroke_item');
        let parentWidth = parent.offsetWidth;
        let itemWidth = item.offsetWidth;

        let c = Math.floor(parentWidth / itemWidth) * 2;
        if(parentWidth < itemWidth) c = 2;
        for(let i = 0; i<c; i++){
            items.push(item.cloneNode(true));
        }

        line.innerHTML = '';
        items.forEach(item => {
            item.style.minWidth = `${parentWidth / c * 2}px`;
            if(parentWidth < itemWidth) item.style.minWidth = `${itemWidth * 2}px`;
            line.append(item);
        });
        line.style.minWidth = `${parentWidth * 2}px`;
    })
}


function vBannerContentCarousel(){
    let itemsOnScreen = 3;
    vBannerContentCheckSize();
    resizeXWrapper(vBannerContentCheckSize);


    function vBannerContentCheckSize(){
        itemsOnScreen = 3;
        if(window.innerWidth <= 1199) itemsOnScreen = 2;
        if(window.innerWidth <= 767) itemsOnScreen = 1;
    }

    document.querySelectorAll('.v-banner_content_box').forEach(box => {
        let items = box.querySelectorAll('.v-banner_content_item');
        let counter = 0;

        changeVisibleItems()
        setInterval(() => {
            changeVisibleItems()
        }, 4000)


        function changeVisibleItems(){
            items.forEach(item => item.classList.remove('v-banner_content_item-visible'));

            for(let i = 0; i < itemsOnScreen; i++){
                c();
            }

            function c(){
                items[counter].classList.add('v-banner_content_item-visible');
                items[counter].style.animationName = '';
                items[counter].style.animationName = 'v-banner_content_item';
                counter++;
                if(counter >= items.length) counter = 0;
            }            
        }
    })
};


function changeMainPaddingTop(){
    let h = document.querySelector('.header_main').clientHeight;
    document.querySelectorAll('main.main').forEach(item => item.style.paddingTop = `${h}px`);
    document.querySelectorAll('.faq_aside_content').forEach(item => item.style.top = `${h}px`);
};


function changeHeaderClassScroll(){
    if(window.pageYOffset > 10){
        document.querySelector('.header_main').classList.add('scrolled');
    } else {
        document.querySelector('.header_main').classList.remove('scrolled');
    }    
};


function animationText(){
    document.querySelectorAll('.text-anim').forEach(item => {
        item.innerHTML = `<div class="text-anim_inner" style="opacity: 0">${item.innerHTML}</div>`;

        let transform = `translate(0,100%)`;

        if(item.dataset.direction){
            switch(item.dataset.direction){
                case 'top':
                    transform = `translate(0,-100%)`;
                    break;
                case 'left':
                    transform = `translate(100%,0)`;
                    break;
                case 'right':
                    transform = `translate(-100%,0)`;
                    break;
                case 'bottom':
                    transform = `translate(0,100%)`;
                    break;
            }
        }

        let inner = item.querySelector('.text-anim_inner');
        inner.style.transform = transform;
    });


    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5,
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                let inner = entry.target.querySelector('.text-anim_inner');
                inner.style.opacity = '1';
                inner.style.transform = 'translate(0,0)';
                observer.unobserve(entry.target);
            }
        })
    }, options);

    const arr = document.querySelectorAll('.text-anim');
    arr.forEach(i => {
        observer.observe(i)
    });
};