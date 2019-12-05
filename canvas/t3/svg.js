"use strict";

class makeSvg{
	constructor(){
		this.draw = SVG('drawing').size(951, 879);
		this.group = this.draw.group().attr({ filter: "#000"});
		this.path = this.draw.path().attr({ id: 'p1', fill: "#c2c2c2", stroke: "#000", d: "M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",});
		this.group.add(this.path);

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


		//drawing.querySelector('svg').addEventListener('mouseover',this.m.bind(this));
		document.body.addEventListener('mousemove',this.m.bind(this));

		this.t();
	}

	m(event){
		console.log('mouse: ' + (event.clientX));
		this.mX = event.clientX - drawing.getBoundingClientRect().x;
		this.mY = event.clientY - drawing.getBoundingClientRect().y;
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
					if(Math.abs(this.mX - v) < 250){
						v += (this.mX - v)/2;
					}
				} else {
					if(Math.abs(this.mY - v) < 250){
						v += (this.mY - v)/2;
					}
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