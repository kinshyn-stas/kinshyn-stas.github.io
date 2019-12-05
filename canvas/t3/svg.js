"use strict";

class makeSvg{
	constructor(){
		this.draw = SVG('drawing').size(951, 879);
		this.group = this.draw.group().attr({ filter: "url(#filter0_i)"});
		this.path = this.draw.path().attr({ id: 'p1', fill: "url(#paint0_linear)", d: "M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",});
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
			"M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",
			"M304.129 419.693C534 19 889 210 951 0.0482788V879C951 879 -0.775573 883.939 0 879C47.5 576.5 158.283 673.921 304.129 419.693Z",
			"M304.129 419.693C562 63 914.5 309.5 951 0.0482788V879C951 879 0 884 0 879C0 578 132.413 657.214 304.129 419.693Z",
			"M310.129 419.693C596.5 87 874.5 292 957 0.0482788V879C957 879 6.60481 883.963 5.99994 879C-30.5 579.5 118.924 641.827 310.129 419.693Z",
			"M304.129 419.693C653.685 183.121 759.5 194.5 951 0.0482788V879C951 879 -0.758895 883.942 0.000148595 879C46 579.5 68.0001 579.5 304.129 419.693Z",
			"M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",
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
		let arr1 = arr0.split('');
		let arr2 = [];
		let arr2c = 0;

		let xCounter = true;

		arr1.forEach((n,i) => {
			if(n == ' ' || (n != '.' && isNaN(parseFloat(n)))){
				arr2[arr2c] = {
					s: false,
					v: [],
				};

				arr2[arr2c + 1] = {
					s: false,
					v: [],
				};

				arr2[arr2c].v.push(n);
				arr2c += 2;
			} else {
				arr2[arr2c - 1].s = true;
				arr2[arr2c - 1].c = xCounter;
				arr2[arr2c - 1].v.push(n);
				xCounter = !xCounter;
			}
		});

		//console.log(arr1);

		let arr3 = [];
		arr2.map((item) => {
			if(item.s){
				let v = +item.v.join('')

				if(item.c){
					if(Math.abs(this.mX - v) < this.cD && v >= this.cD){
						console.log(this.mX,v);
						//v += (this.cD - Math.abs(this.mX - v));
					}
				} else {
					/*if(Math.abs(this.mY - v) < this.cD && v >= this.cD){
						console.log(this.mY,v);
						v += (this.cD - Math.abs(this.mY - v));
					}*/
				}

				item.v = v;
			}
			arr3.push(item.v);	
		});
		let result = arr3.join('');

		this.path.animate(1000).attr('d',result).afterAll(function(){
			this.arrCounter++;
			this.arrLast = result;
			this.t();
		}.bind(this));
	}
}

new makeSvg();