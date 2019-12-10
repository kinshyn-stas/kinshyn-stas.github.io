"use strict";

class makeSvg{
	constructor(){
		this.draw = SVG('drawing').size(951, 879);
		this.group = this.draw.group().attr({ filter: "url(#filter0_i)"});
		this.path = this.draw.path().attr({ id: 'p1', fill: "url(#paint0_linear)", d: "M 1080.5 977.5 V 12.9998 C 910.001 -46 886.501 124.5 816 160 C 750.159 193.154 619 239.5 569 383.5 C 519 527.5 510 542 325 607 C 71.9192 695.92 -1 869.666 1.5 977.5 H 1080.5 Z",});
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

		/*this.arr = [
			"M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",
			"M304.129 419.693C534 19 889 210 951 0.0482788V879C951 879 -0.775573 883.939 0 879C47.5 576.5 158.283 673.921 304.129 419.693Z",
			"M304.129 419.693C562 63 914.5 309.5 951 0.0482788V879C951 879 0 884 0 879C0 578 132.413 657.214 304.129 419.693Z",
			"M310.129 419.693C596.5 87 874.5 292 957 0.0482788V879C957 879 6.60481 883.963 5.99994 879C-30.5 579.5 118.924 641.827 310.129 419.693Z",
			"M304.129 419.693C653.685 183.121 759.5 194.5 951 0.0482788V879C951 879 -0.758895 883.942 0.000148595 879C46 579.5 68.0001 579.5 304.129 419.693Z",
			"M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",
		];*/

		this.arr = [
			"M 1080 977 V 12.9998 C 910 -46 886 124 816 160 C 750 193 619 239 569 383 C 519 527 510 542 325 607 C 72 696 -1 890 2 978 H 1080 Z",
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

		l.call(this);

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