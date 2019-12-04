"use strict";

function drawSvg(){
	let path = document.getElementById('p1');
	let arr = [];
	//console.log(path.getAttribute('d'));

	let a0 = path.getAttribute('d').split('');
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

		a2.forEach(item => {
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
		})
		
	
		path.setAttribute('d',arr.join(''))
	}


	let timer = setInterval(moveSvg, 1000);


	butt.onclick = function(){
		clearInterval(timer);
	}
}

//drawSvg();


function randomInteger(min, max) {
  return Math.round(min - 0.5 + Math.random() * (max - min + 1));
}
