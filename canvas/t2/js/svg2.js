"use strict";

function drawSvg(){
	let path = document.getElementById('p1');
	let arr = [
		"M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",
		"M304.129 419.693C534 19 889 210 951 0.0482788V879C951 879 -0.775573 883.939 4.65464e-05 879C47.5 576.5 158.283 673.921 304.129 419.693Z",
		"M304.129 419.693C562 63 914.5 309.5 951 0.0482788V879C951 879 -6.10352e-05 884 -6.10352e-05 879C4.65464e-05 578 132.413 657.214 304.129 419.693Z",
		"M310.129 419.693C596.5 87 874.5 292 957 0.0482788V879C957 879 6.60481 883.963 5.99994 879C-30.5 579.5 118.924 641.827 310.129 419.693Z",
		"M304.129 419.693C653.685 183.121 759.5 194.5 951 0.0482788V879C951 879 -0.758895 883.942 0.000148595 879C46 579.5 68.0001 579.5 304.129 419.693Z",
		"M304.129 419.693C484.478 0.0482788 862.278 192.963 951 0.0482788V879C951 879 0 884 0 879C-0.00287749 570.618 188.403 688.97 304.129 419.693Z",
	];
	//console.log(path.getAttribute('d'));

	let a0 = p1.getAttribute('d').split('');
	let a1 = a0.slice();
	let a2 = [];
	let a2c = 0;
	a1.forEach((n,i) => {
		if(n == ' ' || (n != '.' && isNaN(parseFloat(n)))){
			a2[a2c] = {
				s: false,
				v: [],
			};
			a2[a2c + 1] = {
				s: false,
				v: [],
			};

			a2[a2c].v.push(n);

			a2c += 2;
		} else {
			a2[a2c - 1].s = true;
			a2[a2c - 1].v.push(n)
		}
	});

	let direction = {
		d: true,
		s: 0,
		max: 10,
		min: 0,
	}

	function moveSvg(){

		/*a2.forEach(item => {
			if(direction.d){
				if(direction.s>=direction.max){
					direction.d = false;
					direction.s--;
				} else {
					direction.s++;
				}
			} else {
				if(direction.s<=direction.min){
					direction.d = true;
					direction.s++;
				} else {
					direction.s--;
				}
			}



			let d = direction.s;
			console.log(d);

			if(item.s){
				let r = +item.v.join('') + d;
				arr.push(r);
			} else {
				arr.push(item.v.join(''));
			}
		})*/
		
	
		//path.setAttribute('d',arr.join(''))

		document.getElementById('a1').setAttribute('values',arr.join(';'));
	}


	let timer = setInterval(moveSvg, 10);


	/*butt.onclick = function(){
		clearInterval(timer);
	}*/
}

drawSvg();


function randomInteger(min, max) {
  return Math.round(min - 0.5 + Math.random() * (max - min + 1));
}
