"use strict";

class makeSvg{
	constructor(){
		this.draw = SVG('drawing').size(1920, 900);
		this.group = this.draw.group().attr({ filter: "url(#filter0_i)"});
		this.path = this.draw.path().attr({ id: 'p1', fill: "url(#paint0_linear)",
			d: `M 0 0
			V 1920
			H 450
			C 200 1250 160 150 220 1000
			C 280 950  240 850 220 800
			C 200 750  160 650 220 600
			C 280 550  240 450 220 400
			C 200 350  160 250 220 200
			C 280 150  240 50  220 0
			Z`,
		});
		this.group.add(this.path);
		this.defs = this.draw.defs().attr({id: 'd1'});
		d1.innerHTML = `<filter id="filter0_i" x="0" y="0.0482788" width="951" height="911.174" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
					<feFlood flood-opacity="0" result="BackgroundImageFix"/>
					<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
					<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
					<feOffset dy="30"/>
					<feGaussianBlur stdDeviation="20"/>
					<feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
					<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
					<feBlend mode="normal" in2="shape" result="effect1_innerShadow"/>
				</filter>
				<linearGradient id="paint0_linear" x1="-4.65925" y1="-140" x2="506.631" y2="991.808" gradientUnits="userSpaceOnUse">
					<stop offset="0.520833" stop-color="#5840BA"/>
					<stop offset="1" stop-color="#6F59CD"/>
				</linearGradient>`;

		this.arr = [
			`M 1 0
			V 1950
			H 450
			C 200 1250 160 150 220 1000
			C 280 950  240 850 220 800
			C 200 750  160 650 220 600
			C 280 550  240 450 220 400
			C 200 350  160 250 220 200
			C 280 150  240 50  220 0
			Z`,
		];

		this.arrCounter = 0;
		this.arrLast = this.arr[0];
		this.mX = 0;
		this.mY = 0;


		this.stepN = 0;


		document.body.addEventListener('mousemove',this.m.bind(this));

		this.t();
	}

	m(event){
		this.mX = event.clientX - drawing.querySelector('svg').getBoundingClientRect().x;
		if(this.mX < 0) this.mX = 0;
		this.mY = event.clientY - drawing.querySelector('svg').getBoundingClientRect().y;
		if(this.mY < 0) this.mY = 0;
	}

	t(){
		if(this.arrCounter >= this.arr.length - 1) this.arrCounter = 0;

		let arr0 = this.arr[this.arrCounter].slice()
		let arr1 = arr0.split(' ');

		let tcb = [];

		function randomInteger(min, max) {
		   return Math.floor(min + Math.random() * (max + 1 - min));
		}

		arr1.forEach((item,i,arr) => {
			if(item == 'C'){
				tcb.push(i);
			}
		});

		function l(){
			let n1 = this.stepN - 1;
			if(n1 < 0) n1 = tcb.length - 1
			arr1[tcb[n1] + 1] = +arr1[tcb[n1] + 1] + 20;
			arr1[tcb[n1] + 3] = +arr1[tcb[n1] + 3] + 30;
			arr1[tcb[n1] + 5] = +arr1[tcb[n1] + 5] + 40;

			arr1[tcb[this.stepN] + 1] = +arr1[tcb[this.stepN] + 1] + 40;
			arr1[tcb[this.stepN] + 3] = +arr1[tcb[this.stepN] + 3] + 30;
			arr1[tcb[this.stepN] + 5] = +arr1[tcb[this.stepN] + 5] + 20;	
		};

		//l.call(this);

		this.stepN++;
		if(this.stepN > tcb.length - 1) this.stepN = 0;

		let P = 70;
		let pointN = {
			place: 0,
			n: 0,
			x: P,
			y: P,
		};

		tcb.forEach((item,i,arr) => {
			findNearPoint.call(this,i,1,arr1[item + 1],arr1[item + 2]);
			findNearPoint.call(this,i,3,arr1[item + 3],arr1[item + 4]);
			findNearPoint.call(this,i,5,arr1[item + 5],arr1[item + 6]);
		});


		function findNearPoint(i,n,x,y){
			if((Math.abs(x - this.mX) < P && Math.abs(y - this.mY) < P) && x >= P && y >= P){
				if((Math.abs(x - this.mX) + Math.abs(y - this.mY)) < (Math.abs(x - pointN.x) + Math.abs(y - pointN.y))){
					pointN.place = i;
					pointN.n = n;
					pointN.x = x;
					pointN.y = y;				
				}
			};
		}

		//console.log(pointN);

		function func2(pointN,tcb,arr){
			if(!pointN.place) return;

			let arr0 = arr.slice();

			let d = (Math.abs(pointN.x - this.mX) + Math.abs(pointN.y - this.mY)) / 2;

			let n1 = pointN.place - 1;
			if(n1 >= 0){
				arr0[tcb[n1] + 1] = +arr0[tcb[n1] + 1] + (d / 3);
				arr0[tcb[n1] + 2] = +arr0[tcb[n1] + 2] + (d / 3);
				arr0[tcb[n1] + 3] = +arr0[tcb[n1] + 3] + ((2 * d) / 3);
				arr0[tcb[n1] + 4] = +arr0[tcb[n1] + 4] + ((2 * d) / 3);
				arr0[tcb[n1] + 5] = +arr0[tcb[n1] + 5] + d;
				arr0[tcb[n1] + 6] = +arr0[tcb[n1] + 6] + d;
			}


			arr0[tcb[pointN.place] + 1] = +arr0[tcb[pointN.place] + 1] + d;
			arr0[tcb[pointN.place] + 2] = +arr0[tcb[pointN.place] + 2] + d;
			arr0[tcb[pointN.place] + 3] = +arr0[tcb[pointN.place] + 3] + ((2 * d) / 3);
			arr0[tcb[pointN.place] + 4] = +arr0[tcb[pointN.place] + 4] + ((2 * d) / 3);
			arr0[tcb[pointN.place] + 5] = +arr0[tcb[pointN.place] + 5] + (d / 3);	
			arr0[tcb[pointN.place] + 6] = +arr0[tcb[pointN.place] + 6] + (d / 3);	


			return arr0;
		}

		arr1 = func2.call(this,pointN,tcb,arr1) ? func2.call(this,pointN,tcb,arr1) : arr1;

		let result = arr1.join(' ');
		//console.log(result);

		this.path.animate(500).attr('d',result).afterAll(function(){
			this.arrCounter++;
			this.arrLast = result;
			this.t();
		}.bind(this));
	}
}

new makeSvg();