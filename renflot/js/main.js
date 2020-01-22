"use strict";

window.onload = function(){

	new classMultiplyWrapper(Slider, {
		selector: '.catalog_slider',
		navigationDotters: true,
		navigationDottersCount: 2,
		sizeWork: {
			desktop: true,
			touch: true,
			mobile: false,
		}
	});

	new classMultiplyWrapper(Slider, {
		selector: '.testimonials_slider',
		navigationDotters: true,
		multiDisplay: {
			desktop: 4,
			touch: 2,
			mobile: 1,
			marginRight: {
				desktop: 30,
				touch: 30,
				mobile: 0,
			},
			multiShift: true,
		}
	});

	document.addEventListener('click', clickItemHandler);

	document.addEventListener('change', validateInputTel);
	document.addEventListener('input', validateInputTel);

	new classMultiplyWrapper(InputLine, {
		selector: '.input-line_parent',
	});

	/*new classMultiplyWrapper(FormValidate, {
		selector: '.form_validate',
	});*/

	//emulateSelector('.select_emulator');


	//new inputFileEmulator('.input_emulator-file');


	//installVideoHeight();
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
									${target.dataset.title ? ('<h2>' + target.dataset.title + '</h2>') : '<h2 class="hidden"></h2>'}
									<div class="lightbox_close click-item" data-action="remove">		
										<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M24.4001 7.61363C24.2767 7.49003 24.1302 7.39196 23.9689 7.32505C23.8076 7.25815 23.6347 7.22371 23.4601 7.22371C23.2855 7.22371 23.1125 7.25815 22.9513 7.32505C22.79 7.39196 22.6434 7.49003 22.5201 7.61363L16.0001 14.1203L9.48008 7.6003C9.35664 7.47686 9.21009 7.37894 9.04881 7.31213C8.88752 7.24532 8.71466 7.21094 8.54008 7.21094C8.36551 7.21094 8.19265 7.24532 8.03136 7.31213C7.87007 7.37894 7.72353 7.47686 7.60008 7.6003C7.47664 7.72374 7.37872 7.87029 7.31192 8.03157C7.24511 8.19286 7.21072 8.36572 7.21072 8.5403C7.21072 8.71487 7.24511 8.88774 7.31192 9.04902C7.37872 9.21031 7.47664 9.35686 7.60008 9.4803L14.1201 16.0003L7.60008 22.5203C7.47664 22.6437 7.37872 22.7903 7.31192 22.9516C7.24511 23.1129 7.21072 23.2857 7.21072 23.4603C7.21072 23.6349 7.24511 23.8077 7.31192 23.969C7.37872 24.1303 7.47664 24.2768 7.60008 24.4003C7.72353 24.5237 7.87007 24.6217 8.03136 24.6885C8.19265 24.7553 8.36551 24.7897 8.54008 24.7897C8.71466 24.7897 8.88752 24.7553 9.04881 24.6885C9.21009 24.6217 9.35664 24.5237 9.48008 24.4003L16.0001 17.8803L22.5201 24.4003C22.6435 24.5237 22.7901 24.6217 22.9514 24.6885C23.1126 24.7553 23.2855 24.7897 23.4601 24.7897C23.6347 24.7897 23.8075 24.7553 23.9688 24.6885C24.1301 24.6217 24.2766 24.5237 24.4001 24.4003C24.5235 24.2768 24.6214 24.1303 24.6883 23.969C24.7551 23.8077 24.7894 23.6349 24.7894 23.4603C24.7894 23.2857 24.7551 23.1129 24.6883 22.9516C24.6214 22.7903 24.5235 22.6437 24.4001 22.5203L17.8801 16.0003L24.4001 9.4803C24.9067 8.97363 24.9067 8.1203 24.4001 7.61363Z" fill="#8D8D8D"/>
										</svg>
									</div>
									<div class="lightbox_arrow lightbox_arrow-left click-item" data-action="switch_lightbox" data-direction="-1">
										<svg width="24" height="42" viewBox="0 0 24 42" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M23.9998 36L8.99976 21L23.9998 6L20.9998 0L-0.000240326 21L20.9998 42L23.9998 36Z" fill="#DCBC5A"/>
										</svg>
									</div>
									<div class="lightbox_arrow lightbox_arrow-right click-item" data-action="switch_lightbox" data-direction="1">
										<svg width="24" height="42" viewBox="0 0 24 42" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M0.000488281 36L15.0005 21L0.000488281 6L3.00049 0L24.0005 21L3.00049 42L0.000488281 36Z" fill="#DCBC5A"/>
										</svg>
									</div>
									<img class="active" src="${target.src}" alt="" />
									${target.dataset.text ? ('<div class="lightbox_description">' + target.dataset.text + '</div>') : '<div class="lightbox_description hidden"></div>'}
								</div>`

			document.body.append(container);
		},

		'switch_lightbox': function(target){
			if(document.body.offsetWidth <= 768) return;
			let lightbox = target.closest('.lightbox');
			let title = lightbox.querySelector('h2');
			let description = lightbox.querySelector('.lightbox_description');
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

					if(arr[n].dataset.title){
						title.innerHTML = arr[n].dataset.title;
						title.classList.remove('hidden');
					} else {
						title.innerHTML = '';
						title.classList.add('hidden');
					}					

					if(arr[n].dataset.description){
						description.innerHTML = arr[n].dataset.description;
						description.classList.remove('hidden');
					} else {
						description.innerHTML = '';
						description.classList.add('hidden');
					}

					img.classList.remove('active');
					setTimeout(()=>img.classList.add('active'), 0)
					break;
				}
			}
		},

		'form-clear': function(target){
			if(!event.target.closest('form')) return;
			let form = event.target.closest('form');
			form.querySelectorAll('input, textarea, .input-line_controller').forEach(item => {
				if(item.type == 'checkbox' || item.type == 'radio'){
					item.checked = false;
					if(item.dataset.role == 'checkbox-all') item.checked = true;
				} else if(item.classList.contains('input-line_controller')){
					item.style.left = '0';
					if(item.dataset.role == 'max') item.style.left = '100%';
				} else {
					item.value = '';
					if(item.dataset.val) item.value = item.dataset.val;
				}
			})
		},

		'open-filter': function(target){
			if(!document.getElementById('catalog_filter')) return;
			document.getElementById('catalog_filter').classList.add('active');
		},
	}

	if(item.dataset.action){
		let actions = item.dataset.action.split(' ');
		actions.forEach(action => obj[action](item))
	} else {
		obj['toggle'](item);
	}
};


/*function installVideoHeight(){
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
};*/


/*class FormValidate{
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
};*/


function validateInputTel(event){
	if(!(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel')) return;
	event.target.value = event.target.value.replace(/\D/g,"");
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


class InputLine{
	constructor(params){
		this.params = params;
		this.parent = params.item;
		this.inputMin = this.parent.querySelector('.input-line_field-min');
		this.inputMax = this.parent.querySelector('.input-line_field-max');
		this.controllMin = this.parent.querySelector('.input-line_controller-min');
		this.controllMax = this.parent.querySelector('.input-line_controller-max');
		this.line = this.parent.querySelector('.input-line');
		this.documentWidth = document.documentElement.clientWidth;

		this.prepare();

		this.parent.addEventListener('change', this.changeValue.bind(this));		
		//this.parent.addEventListener('input', this.changeValue.bind(this));		
		this.parent.addEventListener('mousedown', this.controllStart.bind(this));
		this.parent.addEventListener('touchstart', this.controllStart.bind(this), false);
		this.parent.ondragstart = function(){
			return false
		};

		window.addEventListener('resize', this.resizeX.bind(this,this.prepare));
	}

	resizeX(callback){
		if(this.documentWidth != document.documentElement.clientWidth) callback.call(this);
	}

	prepare(event){
		if(event) console.log(event)
		this.min = +this.inputMin.dataset.val;
		this.max = +this.inputMax.dataset.val;
		this.inputMin.value = this.min;
		this.inputMax.value = this.max;
		this.controllMin.style.left = '0';
		this.controllMax.style.left = '100%';
	}

	changeValue(){
		if(!event.target.closest('.input-line_field')) return;

		let target = event.target.closest('.input-line_field');
		this.direction = 1;
		if(target.dataset.role == 'min') this.direction = 0;

		if(this.direction){
			if(+this.inputMax.value > this.max) this.inputMax.value = this.max;
			if(+this.inputMax.value <= +this.inputMin.value) this.inputMax.value = +this.inputMin.value + 1;	
		} else {
			if(+this.inputMin.value < this.min) this.inputMin.value = this.min;
			if(+this.inputMin.value >= +this.inputMax.value) this.inputMin.value = +this.inputMax.value - 1;
		}

		this.changePositionsWrite();
	}

	changePositionsWrite(){
		if(this.direction){
			this.positionWrite = 100* +this.inputMax.value / (this.max - this.min);
			this.controllMax.style.left = `${this.positionWrite}%`;
			if(parseInt(getComputedStyle(this.controllMax).left) <= parseInt(getComputedStyle(this.controllMin).left) + 20) this.controllMax.style.left = `calc(${parseInt(getComputedStyle(this.controllMin).left) + 20}px)`;
		} else {
			this.positionWrite = 100* +this.inputMin.value / (this.max - this.min);
			this.controllMin.style.left = `${this.positionWrite}%`;
			if(parseInt(getComputedStyle(this.controllMin).left) >= parseInt(getComputedStyle(this.controllMax).left) - 20) this.controllMin.style.left = `calc(${parseInt(getComputedStyle(this.controllMax).left) - 20}px)`;
		}
	}

	controllStart(){
		if(!event.target.closest('.input-line_controller')) return;

		let target = event.target.closest('.input-line_controller');
		this.directionMove = 1;
		if(target.dataset.role == 'min') this.directionMove = 0;
		this.lineWidth = this.line.offsetWidth;
		let lineLeft = this.line.getBoundingClientRect().left;

		function controllMove(event){
			this.changePositions(event);
		}

		function controllEnd(event){
			document.removeEventListener('mousemove', controllMove);
			document.removeEventListener('mouseup', controllEnd);
			document.removeEventListener('touchmove', controllMove);
			document.removeEventListener('touchend', controllEnd);
			document.removeEventListener('touchcancel', controllEnd);
		}

		controllMove = controllMove.bind(this);
		controllEnd = controllEnd.bind(this);
		
		document.addEventListener('mousemove', controllMove);
		document.addEventListener('mouseup', controllEnd);

		document.addEventListener('touchmove', controllMove, false);
		document.addEventListener('touchend', controllEnd, false);
		document.addEventListener('touchcancel', controllEnd, false);
	}

	changePositions(event){
		let coordinatX;
		if(event.type == 'mousemove'){
			coordinatX = event.screenX;
		} else if(event.type == 'touchmove'){
			coordinatX = event.changedTouches[0].screenX;
		}

		this.position = parseInt((coordinatX - this.line.getBoundingClientRect().left) * 100 / this.lineWidth) + 1;
		if(this.position < 0) this.position = 0;
		if(this.position > 100) this.position = 100;

		if(this.directionMove){
			this.controllMax.style.left = `${this.position}%`;
			if(parseInt(getComputedStyle(this.controllMax).left) <= parseInt(getComputedStyle(this.controllMin).left) + 20) this.controllMax.style.left = `calc(${parseInt(getComputedStyle(this.controllMin).left) + 20}px)`;
		} else {
			this.controllMin.style.left = `${this.position}%`;
			if(parseInt(getComputedStyle(this.controllMin).left) >= parseInt(getComputedStyle(this.controllMax).left) - 20) this.controllMin.style.left = `calc(${parseInt(getComputedStyle(this.controllMax).left) - 20}px)`;
		}

		this.changeValueMove();		
	}

	changeValueMove(){
		if(this.position < 1) this.position = 1;
		this.result = this.position * this.max / 100;

		if(this.directionMove){
			this.inputMax.value = this.result;
			if(+this.inputMax.value <= +this.inputMin.value) this.inputMax.value = +this.inputMin.value + 1;	
		} else {
			this.inputMin.value = this.result;
			if(+this.inputMin.value >= +this.inputMax.value) this.inputMin.value = +this.inputMax.value - 1;
		}
	}
};