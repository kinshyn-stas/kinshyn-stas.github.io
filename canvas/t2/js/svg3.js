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
	let stepDuration = 1;

	let arrCounter = 0;
	let arrLast = arr[0];


	function moveSvg(){
		if(arrCounter >= arr.length - 1) arrCounter = 0;

		let arr0 = arr[arrCounter].slice()
		let arr1 = arr0.split('');
		let arr2 = [];
		let arr2c = 0;
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
				arr2[arr2c - 1].v.push(n)
			}
		});


		let arr3 = [];
		arr2.map((item) => {
			if(item.s){
				item.v = +item.v.join('') + 40;
			}		
			arr3.push(item.v);	
		})

		let result = arr3.join('');



		p1.setAttribute('d',`${result}`);
		a1.setAttribute('from',`${arrLast}`);
		a1.setAttribute('to',`${result}`);
		//a1.setAttribute('dur',`${stepDuration}s`);


		arrCounter++;
		arrLast = result;	
	}

	moveSvg()

	a1.addEventListener('repeatEvent', () => {
		//a1.setAttribute('dur',`0s`);
		moveSvg();
	})
}

drawSvg();