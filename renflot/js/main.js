"use strict";

window.onload = function(){

	/*new classMultiplyWrapper(Slider, {
		selector: '.sertificat_box',
		infinity: true,
		navigationDotters: true,
		sizeWork: {
			desktop: false,
			touch: false,
			mobile: true,
		}
	});*/

	document.addEventListener('click', clickItemHandler);


	/*new classMultiplyWrapper(FormValidate, {
		selector: '.form_validate',
	});*/

	//emulateSelector('.select_emulator');


	//new inputFileEmulator('.input_emulator-file');


	installVideoHeight();
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
		if(this.params.navigationDotters && !this.params.multiDisplay) this.createSliderNavigationDotters();
		this.prepare();
		if(this.params.navigationArrows) this.createSliderNavigationArrows();
		if(this.params.navigationCounter && !this.params.multiDisplay) this.createSliderNavigationCounter();
		if(this.params.slideClickRewind) this.prepareSlidesOnclick();
		if(this.params.autoShift) this.changeSlidesAutomaticaly();	
	}

	prepare(){
		if(this.sizeFlag == 2) return;
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
		for(let i=0; i<this.sliders.length; i++){
			let slider_nav_butt = document.createElement('li');
			slider_nav_butt.classList = 'slider_nav_butt';
			slider_nav_butt.style.transition = `all ${this.moveTime} ease-in-out`;
			slider_nav_butt.dataset.number = i;
			this.butts.push(slider_nav_butt);
			this.slider_nav.append(slider_nav_butt);
		}

		this.container.addEventListener('click',func.bind(this));
		//this.container.addEventListener('touchstart',func.bind(this));

		function func(event){
			if(!event.target.closest('.slider_nav_butt')) return;
			let butt = event.target.closest('.slider_nav_butt');

			clearInterval(this.autoShift);
			return this.slideMove({counter: butt.dataset.number});
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

		this.sliders.forEach((slide,i,arr)=>{	
			slide.style.width = `${d}px`;
			slide.style.minWidth = `${d}px`;
			slide.dataset.number = i;
			if((i + 1) % this.slideOnScreen) slide.style.marginRight = `${marginRight}px`;
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
		let touchPointCurrent = 0;

		let touchMoveBinded = touchMove.bind(this);
		let touchEndBinded = touchEnd.bind(this);

		this.touchTimeStart = +new Date();

		function touchMove(event){
	    	touchPointCurrent = event.changedTouches['0'].screenX;
	    	let m = touchPointCurrent - touchPointStart;

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
	    	event.preventDefault();
			this.container.removeEventListener('touchmove', touchMoveBinded);
			this.container.removeEventListener('touchend', touchEndBinded);
			touchPointStart = 0;
		    touchPointCurrent = 0;

			this.touchTimeEnd = +new Date();
			if(this.touchTimeEnd - this.touchTimeStart > 10){
				event.target.click();
			}				    
		}

		this.container.addEventListener('touchmove', touchMoveBinded);
		this.container.addEventListener('touchend', touchEndBinded);
		this.container.addEventListener('touchcancel', touchEndBinded);
	}
};


function clickItemHandler(event){
	if(!event.target.closest('.click-item')) return;
	let item = event.target.closest('.click-item');
	let parent;
	if(item.closest('.click-obj')) parent = item.closest('.click-obj');

	let obj = {
		'toggle': function(target){
			parent.classList.toggle('active');
		},

		'remove': function(target){
			parent.remove();
		},

		'open-list': function(target){
			if(parent.classList.contains('active')){
				parent.classList.remove('active');
			} else {
				parent.classList.add('active');
				parent.onblur = (e)=>{
					parent.classList.remove('active');
				}
			}
			
		},

		'change-list': function(target){
			parent.classList.remove('active');
			parent.querySelector('.header_list_item-actual').textContent = target.textContent;
			parent.querySelectorAll('.header_list_item.actual').forEach(item => item.classList.remove('actual'));
			target.classList.add('actual');
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
	}

	if(item.dataset.action){
		let actions = item.dataset.action.split(' ');
		actions.forEach(action => obj[action](item))
	} else {
		obj['toggle'](item);
	}
};


function installVideoHeight(){
	document.querySelectorAll('.video_box').forEach(item => {
		let video;
		if(item.querySelector('video')){
			video = item.querySelector('video');
		} else if(item.querySelector('iframe')){
			video = item.querySelector('iframe');
		};

		let p = 56.25;
		if(video){
			p = (video.height / video.width) * 100;
		}
		item.style.paddingBottom = `${p}%`;
	})
};


class FormValidate{
	constructor(params){
		this.form = params.item;
		this.status = false;
		this.items = this.form.querySelectorAll('.form_validate_item');
		this.submit = this.form.querySelector('.form_validate_submit');
		this.submit.disabled = true;

		this.form.addEventListener('input',this.checkInputsPattern.bind(this));
		this.form.addEventListener('change',this.checkInputsPattern.bind(this));
		this.form.addEventListener('input',this.validatePhone.bind(this));
	}

	checkInputsPattern(event){
		if(event.target.tagName.toLowerCase() != 'input') return;
		let eType = event.target.type.toLowerCase();
		if(!(event.target.required && event.target.dataset.pattern) && !(eType == 'checkbox' || eType == 'radio') && !(eType == 'file')) return;

		let target = event.target;
		let regexp =  new RegExp(target.dataset.pattern);

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
		let regexp =  new RegExp(target.dataset.pattern);
		let result = true;
		if(!regexp.test(`${target.value}`)) result = false;
		if(target.dataset.min && (target.value.length < +target.dataset.min)) result = false;
		if(target.dataset.max && (target.value.length > +target.dataset.max)) result = false;
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
			if(item.classList.contains('invalid') || !item.querySelector('input').value) this.status = false;
		})

		if(this.status){
			this.submit.disabled = false;
		} else {
			this.submit.disabled = true;
		}
	}

	validatePhone(){
		if(!(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel')) return;
		
		event.target.value = event.target.value.replace(/\D/g,"");
		if(event.target.value.slice(0,3) != '380'){
			event.target.value = `380${event.target.value.slice(3)}`;
		}
	}
};


class inputFileEmulator{
	constructor(selector){
		document.querySelectorAll(selector).forEach(box =>{
			let input = box.querySelector('input');
			let label = box.querySelector('label');
			let acceptArr;
			if(input.getAttribute('accept')) acceptArr = input.getAttribute('accept').split('/');

			input.addEventListener('change', function(e){
				let fileName = '';

				if (this.files && this.files.length > 1){
					fileName = ( this.getAttribute('data-multiple-caption') || '' ).replace('{count}', this.files.length);
				}
				else{
					fileName = e.target.value.split('\\').pop();
				}

				if (fileName) label.innerHTML = `<span>${fileName}</span>`;

				if(acceptArr){
					let n = fileName.slice(fileName.lastIndexOf('.') + 1);
					let result = acceptArr.findIndex(item => item == n);
					if(result == -1){
						input.value = '';
						label.innerHTML = `<span>Неверный формат файла</span>`;
					}
				}
			})
		})
	}
};