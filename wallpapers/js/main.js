"use strict";

window.onload = function(){

	new classMultiplyWrapper(Slider, {
		selector: '.offers_slider',
		infinity: true,
		navigationDotters: true,
	});

	new classMultiplyWrapper(Slider, {
		selector: '.specialists_slider',
		infinity: true,
		multiDisplay: {
			mobile: 1,
			touch: 3,
			desktop: 5,
			multiShift: true,
		},
		moveTime: 0.5,
	});

	document.addEventListener('click', clickItemHandler);


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
			if(w>0 && w<=700){
				this.slideOnScreen = this.params.multiDisplay.mobile;
			} else if(w>700 && w<=1100){
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

	extendSlides(){
		this.boxWidth = this.box.offsetWidth/this.slideOnScreen;

		if(this.params.multiDisplay && this.params.multiDisplay.marginRight){
			let marginRight;
			let w = document.body.offsetWidth 
			if(w>0 && w<=700){
				marginRight = this.params.multiDisplay.marginRight.mobile;
			} else if(w>700 && w<=1100){
				marginRight = this.params.multiDisplay.marginRight.touch;
			} else {
				marginRight = this.params.multiDisplay.marginRight.desktop;
			}

			this.sliders.forEach((slide,i,arr)=>{
				let d = this.boxWidth - (marginRight * (this.slideOnScreen - 1)) / this.slideOnScreen;	
				slide.style.width = `${d}px`;
				slide.style.minWidth = `${d}px`;
				if((i + 1) % this.slideOnScreen) slide.style.marginRight = `${marginRight}px`;
			});			
		} else {
			this.sliders.forEach((slide,i,arr)=>{	
				slide.style.width = `${this.boxWidth}px`;
				slide.style.minWidth = `${this.boxWidth}px`;
			});
		}

		this.sliders.forEach((slide,i,arr)=>{	
			slide.dataset.number = i;
		});
	}

	slideAll(callback){
		let n = 0;

		this.sliders.forEach((slide,i,arr)=>{
			if(slide.classList.contains('active')){
				this.boxShift = -(i * this.boxWidth);
				this.box.style.transform = `translateX(${this.boxShift}px)`;
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
				aside.querySelectorAll('.list_box')	.forEach(box => box.classList.remove('active'));
				box.classList.add('active');	
			}
		},

		'change-tab': function(target){
			document.querySelectorAll(target.dataset.label).forEach(tabContent => {
				tabContent.closest('.tabs_content').querySelectorAll('.tab_content').forEach(item => item.classList.remove('active'));

				tabContent.classList.add('active');
			})
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
		select.hidden = true;

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
				select.value=option.dataset.value;
				option.parentNode.querySelectorAll('.select_option').forEach((option)=>{
					option.classList.remove('selected')
				});
				option.classList.add('selected');
			};
			if(item.selected) option.classList.add('selected');
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

				if (fileName) label.querySelector('span').innerHTML = `<span>${fileName}</span>`;
			})
		})
	}
}


function hiddenScrollAside(selector){
	document.querySelectorAll(selector).forEach(box =>{
		box.classList.add('scroll-emul_block');
		box.style.overflowX = 'hidden';

		let cont = document.createElement('div');
		cont.classList = 'scroll-emul_container';


		if(!box.children[0].classList.contains('scroll-emul_container')){
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

	let h1 = 0;
	aside.querySelectorAll('.list_box-elastic').forEach(item => {
		item.classList.remove('hidden');
		h1 += item.offsetHeight
	});

	let h2 = 0;
	aside.querySelectorAll('.list_list-elastic').forEach(item => {
		item.classList.remove('hidden');
		h2 += item.offsetHeight
	});

	if(document.body.offsetWidth <= 768) h2 = 0;

	if(document.body.offsetHeight < h0 + h2){
		aside.querySelectorAll('.list_box-elastic').forEach(item => item.classList.remove('hidden'));
		aside.querySelectorAll('.list_list-elastic').forEach(item => item.classList.add('hidden'));
	} else {
		aside.querySelectorAll('.list_box-elastic').forEach(item => item.classList.add('hidden'));
		aside.querySelectorAll('.list_list-elastic').forEach(item => item.classList.remove('hidden'));
	}
};