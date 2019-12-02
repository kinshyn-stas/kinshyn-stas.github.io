let canvas = document.getElementById('c1');
let ctx = canvas.getContext('2d');

/*function changeCanvasSize(id){
	let canvas = document.getElementById(id);
	canvas.width = document.body.offsetWidth;
	canvas.height = document.body.offsetHeight;
}

changeCanvasSize('c1');

window.addEventListener('resize',() => changeCanvasSize('c1'));*/


function drawContour(){
	/*let w = canvas.width;
	let h = canvas.height;
	let c = 10;

	ctx.beginPath();
	ctx.moveTo(w,0);
	//ctx.bezierCurveTo(850,100,350,0,0,880);

	let x0 = w;
	let y0 = 0;

	ctx.lineJoin = 'round';

	let xM = 0;
	let yM = 0;

	let d = 0;
	let wavesStep = 1;
	let direction = true;
	let q = 120;


	for(let i=1; i<=16; i++){
		//ctx.quadraticCurveTo(475,440,0,880);
		//ctx.lineTo(w - ((w / c) * i), (h / c) * i);

		makeWaves();
		console.log(x0,y0);

		let x2 = x0 - 90;
		let y2 = y0 + 90;
		let x1 = (x2 - x0)/2 + x0 + xM;
		let y1 = (y2 - y0)/2 + y0 + yM;

		x0 = x2;
		y0 = y2;

		console.log(x1, x2, x2, y2);
		ctx.quadraticCurveTo(x1, y1, x2, y2);
	}
	

	function makeWaves(){
		d++;
		if(d >= wavesStep){
			d = 0;
			direction = !direction;
		}

		if(direction){
			xM = q;
			yM = q;
		} else {
			xM = -q;
			yM = -q;
		}

		console.log(direction,xM);
	}


	ctx.stroke();*/


	let obj = {
		x1 : 0,
		y1 : 0,
		x2 : 0,
		y2 : 0,
		x3 : 0,
		y3 : 0,
		x4 : 0,
		y4 : 0,
	}


	function func(){
		console.log('t1');
		document.querySelectorAll('input').forEach(input => {
			obj[input.dataset.label] = input.value;
		})
	}

	func();

	function d1(){
		ctx.clearRect(0,0,1000,1000);
		ctx.beginPath();
		ctx.moveTo(10,10);
		ctx.quadraticCurveTo(obj.x1,obj.y1,obj.x2,obj.y2);
		ctx.quadraticCurveTo(obj.x3,obj.y3,obj.x4,obj.y4);
		//ctx.bezierCurveTo(obj.x1,obj.y1,obj.x2,obj.y2,100,100);
		//ctx.bezierCurveTo(obj.x3,obj.y3,obj.x4,obj.y4,200,200);
		ctx.strokeStyle = 'red';
		ctx.stroke();
	}

	d1();


	document.addEventListener('change', ()=> {
		func();
		d1();
	});
}

drawContour();