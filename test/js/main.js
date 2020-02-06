"use strict";

window.onload = function(){
	new classMultiplyWrapper(Slider, {
		selector: '.offers_slider',
		navigationArrows: true,
		navigationCounter: true,
	});

	new classMultiplyWrapper(Slider, {
		selector: '.about_slider',
		navigationArrows: true,
		navigationCounter: true,
	});

	new classMultiplyWrapper(Slider, {
		selector: '.tasks_slider',
		navigationArrows: true,
		multiDisplay: {
			mobile: 1,
			touch: 3,
			desktop: 5
		},
		slideClickRewind: true,
		emulateDotters: '#tasks_content',
	});

	new classMultiplyWrapper(Slider, {
		selector: '.turn_slider',
		navigationArrows: true,
		navigationCounter: true,
		multiDisplay: {
			mobile: 2,
			touch: 3,
			desktop: 3,
			multiShift: true,
			marginRight: {
				mobile: '16',
				touch: '40',
				desktop: '40',
			}
		},
		multiShift: true,
	});

	new classMultiplyWrapper(Slider, {
		selector: '.event_slider',
		navigationArrows: true,
		infinity: true,
	});

	new classMultiplyWrapper(Slider, {
		selector: '.prod_slider',
		navigationArrows: true,
		navigationCounter: true,
		multiDisplay: {
			mobile: 2,
			touch: 3,
			desktop: 3,
			multiShift: true,
			marginRight: {
				mobile: '16',
				touch: '40',
				desktop: '40',
			}
		},
	});


	document.addEventListener('click', clickItemHandler);


	document.addEventListener('click', startVideo);


	document.addEventListener('keydown', function(event){
		if(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel'){
		    let keycode = event.keyCode;
		    if ((44 < keycode && keycode < 58)||(keycode == 187)||(keycode == 8)||(keycode == 37)||(keycode == 39)){} else {
		    	event.preventDefault();
		    };			
		};
	});

	emulateSelector('.select_emulator');


	document.addEventListener('click', handlerClickLinks);
};

class Slider{
	constructor(params){
		this.params = params;
		this.container = params.item;
		params.moveTime ? (this.moveTime = params.moveTime) : (this.moveTime = 0.4);
		this.createSliderBox();
		if(this.params.navigationDotters && !this.params.multiDisplay) this.createSliderNavigationDotters();
		this.prepare();
		if(this.params.navigationArrows) this.createSliderNavigationArrows();
		if(this.params.navigationCounter) this.createSliderNavigationCounter();
		if(this.params.slideClickRewind) this.prepareSlidesOnclick();
		if(this.params.autoShift) this.changeSlidesAutomaticaly();
			

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
		let slider_arrow_right = document.createElement('div');
		slider_arrow_right.classList = 'slider_arrow slider_arrow-right';
		slider_arrow_right.innerHTML = `<svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect x="18.6445" y="35.2929" width="24.4558" height="24.4558" rx="3.5" transform="rotate(-135 18.6445 35.2929)"/>
		<path d="M17.2983 21.7448L21.3713 17.6718L17.2983 13.5989" stroke-width="1.5"/>
		</svg>`
		slider_arrow_right.onclick = ()=> this.slideMove({direction: 'right'});
		this.container.append(slider_arrow_right);

		let slider_arrow_left = document.createElement('div');
		slider_arrow_left.classList = 'slider_arrow slider_arrow-left';
		slider_arrow_left.innerHTML = `<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
		<rect x="18" y="0.707107" width="24.4558" height="24.4558" rx="3.5" transform="rotate(45 18 0.707107)"/>
		<path d="M19.3462 14.2554L15.2733 18.3283L19.3462 22.4012" stroke-width="1.5"/>
		</svg>`
		slider_arrow_left.onclick = ()=> this.slideMove({direction: 'left'});
		this.container.append(slider_arrow_left);
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
		}, this.moveTime * 1000);		
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
				}
			}

		} else if(this.activeSlider < 0){
			let sr = this.slideOnScreen;
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
				}
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
				console.log(this);
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
			x.style.webkiteTransform = `translateX(${this.boxShift + m}px)`;

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
			x.style.webkiteTransform = `translateX(${this.boxShift}px)`;
		}

		this.box.addEventListener('mousemove', mouseMoveBinded);
		this.box.addEventListener('mouseup', mouseUp.bind(this));
	}

	touchFlip(event){
		let x = this.box;		
		let touchPointStart = event.changedTouches['0'].screenX;
		let touchPointCurrent = 0;

		let touchMoveBinded = touchMove.bind(this);
		function touchMove(event){
	    	touchPointCurrent = event.changedTouches['0'].screenX;
	    	let m = touchPointCurrent - touchPointStart;

			if(m >= document.body.offsetWidth/4){
				event.preventDefault();
				this.slideMove({direction: 'left'});
				touchPointStart = touchPointCurrent;
				touchEnd.call(this,event);
			} else if(m <= -document.body.offsetWidth/4){
				event.preventDefault();
				this.slideMove({direction: 'right'});
				touchPointStart = touchPointCurrent;
				touchEnd.call(this,event);				
			}

  		}

		function touchEnd(event){
	    	event.preventDefault();
			this.box.removeEventListener('touchmove', touchMoveBinded);
			touchPointStart = 0;
		    touchPointCurrent = 0;
			x.style.transform = `translateX(${this.boxShift}px)`;
			x.style.webkiteTransform = `translateX(${this.boxShift}px)`;
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

		'toggle-main-menu': function(){
			document.querySelector('.mobile-menu_container').classList.toggle('active');
			document.querySelector('.main-header_icons').classList.toggle('active');
		},

		'menu': function(target){
			let box = target.closest('.main-header_langs-mob');

			if(box.classList.contains('active')){
				box.querySelectorAll('.main-header_lang-mob').forEach(item => item.classList.remove('active'));
				target.classList.add('active');
				box.classList.toggle('active');
			} else {
				box.classList.toggle('active');
			}
		},

		'popup-close': function(target){
			target.closest('.popup_container').classList.remove('active');
		},

		'popup-open': function(target){
			document.querySelector(target.dataset.target).classList.add('active');
		},

		'next-popup': function(target){
			target.closest('.popup').innerHTML = `
			<span class="click-item popup_close-span" data-action="popup-close">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M2 2L17.9099 17.9099" stroke="#3B3B3B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M17.9102 2L2.00025 17.9099" stroke="#3B3B3B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</span>
			<h2 class="popup_title">спасибо, ваша заявка отправлена</h2>
			<p>Мы свяжемся с вами в течение рабочего дня с 09:00 до 18:00</p>`
		},

		'open-filter': function(){
			document.querySelector('.filter_container').classList.add('active');
		},

		'filter-clean': function(target){
			target.closest('.filter_main').querySelectorAll('.filter_tag').forEach(tag => tag.remove());
		},

		'remove': function(target){
			target.closest('.click-obj').remove();
		}
	}

	let action = item.dataset.action ? item.dataset.action : 'toggle';
	obj[action](item);
};


function startVideo(event){
	if(!event.target.closest('.video_box')) return;
	let box = event.target.closest('.video_box');

	let img = box.querySelector('img');

	box.classList.add('active');
	box.innerHTML = `<iframe src="${img.dataset.src}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`
}


function emulateSelector(select){
	let selects = document.querySelectorAll(select);

	selects.forEach((select) =>{
		select.hidden = true;

		let emul = document.createElement('div');
		emul.classList = "select";
		emul.onclick = ()=>emul.classList.toggle('active');
		let emulList = document.createElement('div');
		emulList.classList = "select_list";
		emul.append(emulList);


		select.querySelectorAll('option').forEach((item)=>{
			let option = document.createElement('div');
			option.classList = "select_option";
			option.innerHTML = item.innerHTML;
			option.dataset.value = item.value;
			option.onclick = ()=>{
				select.value=option.dataset.value;
				option.parentNode.querySelectorAll('.select_option').forEach((option)=>{
					option.classList.remove('selected')
				});
				option.classList.add('selected');
			};
			if(item.selected) option.classList.add('selected');
			emulList.append(option);
		});

		select.parentNode.append(emul);

		let heightStart = emul.querySelector('.select_option').offsetHeight;
		let heightEnd = 0;
		emul.querySelectorAll('.select_option').forEach((option)=>{
			heightEnd += option.offsetHeight;
		});
		emul.style.height = heightStart + 'px';
		emul.querySelector('.select_list').style.maxHeight = heightStart + 'px';		
	})

	let z = 1;
	for(let i=selects.length - 1; i>=0; i--){
		selects[i].parentNode.querySelector('.select').style.zIndex = `${z}0`;
		z++;
	}
};



function classMultiplyWrapper(Cls,parametrs){
	document.querySelectorAll(parametrs.selector).forEach((item) => {
		parametrs.item = item;
		new Cls(parametrs);
	})
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
}