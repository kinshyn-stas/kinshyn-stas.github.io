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


    new classMultiplyWrapper(FormValidate, {
        selector: '.form_validate',
    });


    document.addEventListener('click', function(event){
        if(!event.target.closest('.header_soc_item') && !event.target.closest('.contact_soc_item')) return;
        dataLayer.push({
            'event': 'GAevent',
            'eventCategory': 'Button-click',
            'eventAction': 'Social'
        })
    });
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
            hiddenScrollAside('.menu_content_tabs');
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
    if(location.hash) document.querySelector('.popup_succes').classList.add('active');
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
        this.form.addEventListener('input',this.validatePhone.bind(this));
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

    validatePhone(){
        if(!(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel')) return;
        
        event.target.value = event.target.value.replace(/\D/g,"");
        if(event.target.value.slice(0,3) != '380'){
            event.target.value = `380${event.target.value.slice(3)}`;
        }
    }

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



hiddenScrollAside('.menu_content_tabs');
window.addEventListener('resize',() => hiddenScrollAside('.menu_content_tabs'));


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