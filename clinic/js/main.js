"use strict";

window.onload = function(){

	new classMultiplyWrapper(Slider, {
		selector: '.offers_slider',
		infinity: true,
		navigationDotters: true,
		autoShift: true,
	});

	new classMultiplyWrapper(Slider, {
		selector: '.specialists_slider',
		infinity: true,
		multiDisplay: {
			mobile: 1,
			touch: 3,
			desktop: 7,
			multiShift: true,
		},
		slideClickRewind: true,
		moveTime: 0.5,
	});


	new classMultiplyWrapper(Calendar, {
		selector: '.calendar_container',
	});


	new classMultiplyWrapper(Calendar, {
		selector: '.rozklad_container',
		type: 'big',
	});


	document.addEventListener('click', clickItemHandler);


	document.addEventListener('change',togglePartForm);


	document.addEventListener('keydown', function(event){
		if(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel'){
		    let keycode = event.keyCode;

		    if ((0 <= event.key && event.key <= 9)||(event.key == "Backspace")||(event.key == "Delete")){} else {
				event.preventDefault();
			};
		};
	});


	emulateSelector('.select_emulator');


	new inputFileEmulator('.input_emulator-file');


	countTextareaSybmols('.textarea-count');


	document.addEventListener('keydown',focusSearch)
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
		params.moveTime ? (this.moveTime = params.moveTime) : (this.moveTime = 0.4);
		this.createSliderBox();
		if(this.params.navigationDotters && !this.params.multiDisplay) this.createSliderNavigationDotters();
		this.prepare();
		if(this.params.navigationArrows) this.createSliderNavigationArrows();
		if(this.params.navigationCounter && !this.params.multiDisplay) this.createSliderNavigationCounter();
		if(this.params.slideClickRewind) this.prepareSlidesOnclick();
		if(this.params.autoShift) this.changeSlidesAutomaticaly();
			

		this.container.addEventListener('mousedown',this.mouseFlip.bind(this));
		this.container.addEventListener("touchstart", this.touchFlip.bind(this));

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
			slider_nav.append(slider_nav_butt);
		}

		this.container.addEventListener('click',func.bind(this));
		this.container.addEventListener('touchstart',func.bind(this));

		function func(event){
			if(!event.target.closest('.slider_nav_butt')) return;
			let butt = event.target.closest('.slider_nav_butt');

			clearInterval(this.autoShift);
			return this.slideMove({counter: butt.dataset.number});
		}

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
		/*this.container.addEventListener('click', func.bind(this));

		function func(event){
			if(!event.target.closest('.slider_slide')) return;
			let slide = event.target.closest('.slider_slide');
			let number = +slide.dataset.number

			this.sliders.forEach(slide => slide.classList.remove('active'));

			if(this.params.infinity){
				console.log('activeSlider: ' + this.activeSlider);
				console.log('number: ' + number);
				let n = number - Math.floor(this.slideOnScreen/2);
				if(n>=this.sliders.length){
					console.log('t1');
					n = 0;
				} else if(n<0){
					console.log('t2');
					n = this.sliders.length + n - Math.floor(this.slideOnScreen/2);
				}


				console.log('n: ' + n);


				for(let i = 0; i< n - this.activeSlider; i++){
					this.installActiveSlider(this.activeSlider + 1);
					this.infinitySlideWork();``
				}
			} else {
				let n = slide.dataset.number - Math.floor(this.slideOnScreen / 2);
				if(n<=0) n = 0;
				if(n>= this.slider.length) n = this.slider.length - 1;
			
				this.slideMove({counter : n});					
			}
		}*/
	}

	mouseFlip(event){
		event.preventDefault();
		//let x = this.box;		
		let mousePointStart = event.clientX;
		let mousePointCurrent = 0;

		let mouseMoveBinded = mouseMove.bind(this);
		function mouseMove(event){
			event.preventDefault();
			clearInterval(this.autoShift);
			mousePointCurrent = event.clientX;
			let m = (mousePointCurrent - mousePointStart);
			//x.style.transform = `translateX(${this.boxShift + m}px)`;
			//x.style.webkiteTransform = `translateX(${this.boxShift + m}px)`;

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
			//x.style.transform = `translateX(${this.boxShift}px)`;
			//x.style.webkiteTransform = `translateX(${this.boxShift}px)`;
		}

		this.container.addEventListener('mousemove', mouseMoveBinded);
		this.container.addEventListener('mouseup', mouseUp.bind(this));
	}

	touchFlip(event){
		//let x = this.box;		
		let touchPointStart = event.changedTouches['0'].screenX;
		let touchPointCurrent = 0;

		let touchMoveBinded = touchMove.bind(this);
		function touchMove(event){
	    	touchPointCurrent = event.changedTouches['0'].screenX;
	    	let m = touchPointCurrent - touchPointStart;

			if(m >= document.body.offsetWidth/4){
				event.preventDefault();
				clearInterval(this.autoShift);
				this.slideMove({direction: 'left'});
				touchPointStart = touchPointCurrent;
				touchEnd.call(this,event);
			} else if(m <= -document.body.offsetWidth/4){
				event.preventDefault();
				clearInterval(this.autoShift);
				this.slideMove({direction: 'right'});
				touchPointStart = touchPointCurrent;
				touchEnd.call(this,event);		
			}

  		}

		function touchEnd(event){
	    	event.preventDefault();
			this.container.removeEventListener('touchmove', touchMoveBinded);
			touchPointStart = 0;
		    touchPointCurrent = 0;
			//x.style.transform = `translateX(${this.boxShift}px)`;
			//x.style.webkiteTransform = `translateX(${this.boxShift}px)`;
		}

		this.container.addEventListener('touchmove', touchMoveBinded);
		this.container.addEventListener('touchend', touchEnd.bind(this));
		this.container.addEventListener('touchcancel', touchEnd.bind(this));
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

		'think-form': function(target){
			event.preventDefault();
			let form = target.closest('.click-obj');			

			form.querySelectorAll('.think_variant input').forEach((input) => {
				if(input.checked){
					form.classList.add('closed');
					func();
				}
			})

			function func(){
				form.querySelectorAll('.think_variant').forEach((variant) => {
					variant.classList.add('closed');
					variant.querySelector('input').disabled = true;
					let p = +variant.dataset.percent;
					let stat = variant.querySelector('.think_statistic')
					stat.style.width = `calc(${p}% + (66px * ${p} / 100))`;
					stat.innerHTML = `<span class="think_statistic_number">${p}%</span>`;
				})

				let inputS = form.querySelector('input[type=submit]')
				inputS.value = "Дякуємо за відповідь!";			
				inputS.disabled = true;			
				inputS.classList.add('disabled');			
			}
		},

		'change-language': function(target){
			let box = target.closest('.click-obj');
			if(box.classList.contains('active')){
				box.querySelectorAll('.lang_item').forEach(item => item.classList.remove('active'));
				target.classList.add('active');
				box.classList.remove('active');
			} else {
				box.classList.add('active');
			}


			box.setAttribute('tabindex','1');
			box.onblur = function(){
				this.classList.remove('active');
			};
		},

		'change-language-mobile': function(target){
			target.closest('.click-obj').querySelectorAll('.click-item').forEach(item => item.classList.remove('active'));
			target.classList.add('active');
		},

		'article-toggle': function(target){
			target.closest('.article_tabs').querySelectorAll('.article_tab').forEach(tab => tab.classList.remove('active'));
			target.classList.add('active');
			target.closest('.article_container').querySelectorAll('.article_item').forEach(item => item.classList.add('hidden'));
			target.closest('.article_container').querySelectorAll(`.${target.dataset.class}`).forEach(item => item.classList.remove('hidden'));
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

		'change-punkt': function(target){
			let box = target.closest('.documents_list');
			let item = target.closest('.documents_list_item');

			let flag = false;
			if(item.classList.contains('active')) flag = true;

			box.querySelectorAll('.documents_list_item').forEach(t => t.classList.remove('active'));
			if(!flag) item.classList.add('active');
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


// calendar start
	class Calendar{
		constructor(parametrs){
			this.parametrs = parametrs;
			this.box = this.parametrs.item;
			this.box.classList.add('calendar');
			this.direction = true;
			this.type = parametrs.type;
			this.dayName = [{name: 'НД',output: true,},{name: 'ПН',output: false,},{name: 'ВТ',output: false,},{name: 'СР',output: false,},{name: 'ЧТ',output: false,},{name: 'ПТ',output: false,},{name: 'СБ',output: true,},]
			this.date = new Date()
			this.createCalendar();
			window.addEventListener('resize',this.createCalendar.bind(this));
		}

		createCalendar(params){
			this.takeJSON();
			this.countColumns();
			this.cleanBox();
			this.createHead();
			this.createHeader();
			this.createPanel();
			this.createTable(); 
		}

		takeJSON(){
			this.data = JSON.parse(rozklad);
			console.log(this.data);
		}

		countColumns(){
			this.box.classList.remove('collapse');

			let m = Math.floor((this.box.offsetWidth - 180) / 128);

			if(m>8) m = 8;
			if(m<4){
				m = 4;
				this.box.classList.add('collapse');
			} 
			this.columns = m;

			if(this.parametrs.type != 'big') this.columns = 8;
		}

		cleanBox(){
			this.box.innerHTML = '';
		}

		createTable(){
			this.data.forEach((item,i) =>{
				if(item.branch && item.branch == this.box.dataset.branch){
					this.createRow(item);
				}
			})
		}

		createHead(){			
			this.head = document.createElement('div');
			this.head.classList = "calendar_head";	
			this.box.append(this.head);
		}

		createHeader(){
			this.headBox = document.createElement('div');
			this.headBox.classList = "calendar_head_box";			

			this.calculateDate({
				callback: func.bind(this),
			});

			function func(n,i){
				let columnHead = document.createElement('div');
				columnHead.classList = 'calendar_head_item';
				columnHead.dataset.date = +this.date;
				columnHead.dataset.column = i;

				columnHead.onclick = function(e){
					if(!this.box.classList.contains('collapse')) return;
					if(+this.box.querySelectorAll('.calendar_head_item')[2].dataset.date < +event.target.closest('.calendar_head_item').dataset.date){
						this.date = new Date(+this.collapseLeft);
						this.direction = true;
					} else {
						this.date = new Date(+this.collapseRight);
						this.direction = false;
					}
					this.collapse = true;
					this.createCalendar();
					this.collapse = false;
				}.bind(this);
				columnHead.innerHTML = `<div class="calendar_head_content">
											<span class="calendar_head_name">${this.dayName[n].name}</span>
											<span class="calendar_head_date">${(this.date.getDate() >= 10) ? this.date.getDate() : '0' + this.date.getDate()}.${(this.date.getMonth() + 1 >= 10) ? this.date.getMonth() + 1 : '0' + (this.date.getMonth() + 1)}</span>
										</div>`;

				this.direction ? this.headBox.append(columnHead) : this.headBox.prepend(columnHead);
			}

			this.head.append(this.headBox);
		}

		createPanel(){
			let panel = document.createElement('div');
			panel.classList = 'calendar_panel';

			let arrowLeft = document.createElement('a');
			arrowLeft.classList = 'calendar_arrow calendar_arrow-left';
			arrowLeft.innerHTML = `<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="var(--svg-opacity-3)" fill-rule="evenodd" clip-rule="evenodd" d="M0.287829 7.20792L6.3223 0.328386C6.70617 -0.109461 7.32854 -0.109461 7.71222 0.328386C8.09593 0.765844 8.09593 1.47536 7.71222 1.91278L2.37264 8.00012L7.71206 14.0872C8.09577 14.5249 8.09577 15.2343 7.71206 15.6718C7.32835 16.1094 6.70601 16.1094 6.32215 15.6718L0.287674 8.79214C0.095819 8.5733 0 8.2868 0 8.00015C0 7.71336 0.096005 7.42665 0.287829 7.20792Z" fill="var(--svg-color-3)"/>
									</svg>`;
			arrowLeft.onclick = ()=>{
				this.date = new Date(+this.leftDate - 86400000);
				this.direction = false;
				this.createCalendar();				
			}

			let arrowRight = document.createElement('a');
			arrowRight.classList = 'calendar_arrow calendar_arrow-right';
			arrowRight.innerHTML = `<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="var(--svg-opacity-3)" fill-rule="evenodd" clip-rule="evenodd" d="M7.71217 8.79208L1.6777 15.6716C1.29383 16.1095 0.671461 16.1095 0.287783 15.6716C-0.0959275 15.2342 -0.0959275 14.5246 0.287783 14.0872L5.62736 7.99988L0.287938 1.91276C-0.0957722 1.47513 -0.0957722 0.765684 0.287938 0.328226C0.671648 -0.109409 1.29399 -0.109409 1.67785 0.328226L7.71233 7.20786C7.90418 7.4267 8 7.7132 8 7.99985C8 8.28664 7.904 8.57335 7.71217 8.79208Z" fill="var(--svg-color-3)"/>
									</svg>`;
			arrowRight.onclick = ()=>{
				this.date = new Date(+this.rightDate + 86400000);
				this.direction = true;
				this.createCalendar();				
			}

			panel.append(arrowLeft);
			panel.append(arrowRight);

			if(this.type == 'big'){
				this.headBox.append(panel)
			} else {
				this.head.append(panel);
			}
		}

		createPerson(params){
			let personBox = document.createElement('div');
			personBox.classList = "calendar_person";
			personBox.innerHTML = `<div class="calendar_person_left">
										<span class="calendar_person_name">${params.name}</span>
										<span class="calendar_person_position">${params.position}</span>
									</div>
									<div class="calendar_person_right">
										<span class="calendar_cabinet">${params.cabinet}</span>
									</div>`;

			return personBox;
		}

		createRow(params){
			let row = document.createElement('div');
			row.classList = "calendar_row";		

			if(this.parametrs.type == 'big') row.append(this.createPerson(params));	

			let calendarCells = document.createElement('div');
			calendarCells.classList ="calendar_cells";

			this.calculateDate({
				callback: func.bind(this),
			});

			function func(n,i){
				let columnCell = document.createElement('div');
				columnCell.classList = 'calendar_cell';
				columnCell.dataset.column = i;

				columnCell.addEventListener('mouseover', func1);
				columnCell.addEventListener('mouseout', func2);
				function func1(event){
					let cell = event.target.closest('.calendar_cell');
					cell.closest('.calendar').querySelectorAll('.calendar_head_item')[i].classList.add('hover');
				}
				function func2(event){
					let cell = event.target.closest('.calendar_cell');
					let b = cell.closest('.calendar').querySelectorAll('.calendar_head_item')[i].classList.remove('hover');
				}

				let x;
				params.events.forEach((e)=>{
					if(this.date.getFullYear() == e.year && this.date.getMonth() == e.month && this.date.getDate() == e.date) x=e;
				})
				
				let columnCellTopInner;
				columnCellTopInner = `<span class="calendar_cell_time">${params.timetable[this.date.getDay() - 1].worktime}</span>`
				if(x) columnCellTopInner += `<span class="calendar_cell_event">${x.name}</span>`;
				
				let columnCellBottomInner = ``;
				if(!x && this.type != 'big') columnCellBottomInner = `<div class="button_container">
												<a class="button_little">записатись</a>
												</div>`


				columnCell.innerHTML = `<div class="calendar_cell_content">
											<div class="calendar_cell_top">
												${columnCellTopInner}
											</div>
											<div class="calendar_cell_bottom">
												${columnCellBottomInner}
											</div>
										</div>`;

				this.direction ? calendarCells.append(columnCell) : calendarCells.prepend(columnCell);
			}

			row.append(calendarCells);
			this.box.append(row);			
		}

		limitM(m){
			if(m > 32 - new Date(this.date.getFullYear(), this.date.getMonth(), 32).getDate()){
				m = 1;
				this.date.setMonth(this.date.getMonth() + 1);	
			} else if(m < 1){
				this.date.setMonth(this.date.getMonth() - 1);		
				m = 32 - new Date(this.date.getFullYear(), this.date.getMonth(), 32).getDate();		
			}

			return m;
		}

		calculateDate(params){
			if(this.direction){
				this.leftDate = new Date(+this.date);
			} else {
				this.rightDate = new Date(+this.date);
			}

			let m = this.date.getDate();

			for(let i=0; i<this.columns;){

				m = this.limitM(m)

				this.date.setDate(m);

				if(this.direction){
					if(i == 1){
						this.collapseLeft = new Date(this.date);
					}
					if(i == 2){
						this.collapseRight = new Date(this.date);
					}
				} else {
					if(i == 1){
						this.collapseRight = new Date(this.date);
					}
					if(i == 2){
						this.collapseLeft = new Date(this.date);
					}
				}

				let n = this.date.getDay();
				if(n>=this.dayName.length - 1) n = 0;
				if(!this.dayName[n].output){	

					params.callback(n,i);

					i++;
				}

				this.direction ? m+=1 : m-=1;
			}

			if(this.direction){
				this.rightDate = new Date(+this.date);
				this.date = new Date(+this.leftDate);
			} else {
				this.leftDate = new Date(+this.date);	
				this.date = new Date(+this.rightDate);		
			}
		}
	}
// calendar end


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


function countTextareaSybmols(selector){
	document.querySelectorAll(selector).forEach(textarea => {
		let counter = document.createElement('span');
		counter.classList = 'textarea-counter';
		textarea.parentNode.append(counter);

		textarea.addEventListener('change',func);
		textarea.addEventListener('keydown',func);

		function func(e){
			let textarea = e.target.closest('textarea');
			let text = textarea.value;

			if(text.length > 249){
				event.preventDefault();
				let t = text.split('');
				t.length = 249;
				textarea.value = t.join('')
				return false;
			} 
			counter.innerHTML = `${text.length + 1}/250`;
		}
	})
}


function togglePartForm(event){
	if(!event.target.classList.contains('change-item')) return;
	let target = event.target.closest('.change-item');
	let name = target.name;

	document.querySelectorAll(`.change-item[name=${name}]`).forEach(item => {
		if(item.dataset.label) document.querySelectorAll(item.dataset.label).forEach(t => t.hidden = !item.checked);
	});
};


function focusSearch(event){
	if(!event.target.closest('#search')) return;
	
	let input = event.target.closest('#search');

	let box = input.closest('.search_box');

	let list = box.querySelector('.search_list');
	list.classList.add('active');

	let words = ['Search', 'SEO', 'Seagul', 'Send'];

	list.querySelectorAll('.search_list_item').forEach(item => item.remove());

	words.forEach(word => {
		let item = document.createElement('div');
		item.classList = 'search_list_item';
		item.textContent = word;
		item.onclick = ()=>{
			input.value = word;
			list.classList.remove('active');
		}
		list.append(item);
	})

	box.append(list);

	box.setAttribute('tabindex','1');
	box.onblur = function(){
		list.classList.remove('active');
	};
};