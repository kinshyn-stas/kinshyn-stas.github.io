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
			"M 1080.5 977.5 V 12.9998 C 910.001 -46 886.501 124.5 816 160 C 750.159 193.154 619 239.5 569 383.5 C 519 527.5 510 542 325 607 C 71.9192 695.92 -1 869.666 1.5 977.5 H 1080.5 Z",
		];

		this.arrCounter = 0;
		this.arrLast = this.arr[0];
		this.mX = 0;
		this.mY = 0;
		this.cD = 35;


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
		//let xCounter = -1;

		function randomInteger(min, max) {
		   return Math.floor(min + Math.random() * (max + 1 - min));
		}

		arr1.forEach((item,i,arr) => {
			if(item == 'M'){
				arr[i + 1] = b(this,arr[i + 1],true);
				arr[i + 2] = b(this,arr[i + 2],false);
				//xCounter = (-1 * xCounter);
			}
			if(item == 'C'){
				arr[i + 1] = b(this,arr[i + 1],true);
				arr[i + 2] = b(this,arr[i + 2],false);
				arr[i + 3] = b(this,arr[i + 3],true);
				arr[i + 4] = b(this,arr[i + 4],false);
				arr[i + 5] = b(this,arr[i + 5],true);
				arr[i + 6] = b(this,arr[i + 6],false);
				//xCounter = (-1 * xCounter);
			}
			//console.log(item);
		})

		function b(self,n,d){
			//console.log(self.mX);
			//let result = dX * xCounter;
			let result = randomInteger(-7, 7) * 5;
			if(result < 0) result = 0;
			result += +n;

			if(Math.abs(result - self.mX) < 100 && result >= 100 && d){
				result += 100 - Math.abs(result - self.mX);
			};

			if(Math.abs(result - self.mY) < 100 && result >= 100 && !d){
				result += 100 - Math.abs(result - self.mY);
			};

			return parseInt(result);
		}

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