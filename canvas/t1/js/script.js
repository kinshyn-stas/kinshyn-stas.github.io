/*let canvas = document.getElementById('c1');
let ctx = canvas.getContext('2d');

let pi = Math.PI;*/


/*ctx.fillStyle = 'red';
ctx.fillRect(100,50,150,75);
ctx.fillStyle = 'green';
ctx.fillRect(150,100,100,50);
ctx.clearRect(0,0,400,200);*/


/*ctx.rect(5,10,100,100);
ctx.strokeStyle = 'red';
ctx.lineWidth = 4;
ctx.stroke();
ctx.fillStyle = 'orange';
ctx.fill();*/


/*ctx.beginPath();
ctx.strokeStyle = 'green';
ctx.lineWidth = 5;
ctx.moveTo(100,50);
ctx.lineTo(150,150);
ctx.lineCap = 'square';
ctx.lineCap = 'butt';
ctx.stroke();

ctx.beginPath();
ctx.strokeStyle = 'red';
ctx.lineWidth = 20;
ctx.moveTo(200,50);
ctx.lineTo(350,50);
ctx.lineTo(350,100);
ctx.lineCap = 'round';
ctx.stroke();*/


/*ctx.beginPath();
ctx.lineWidth = 5;
ctx.moveTo(50,150);
ctx.lineTo(150,50);
ctx.lineTo(250,150);
ctx.closePath();
ctx.stroke();
ctx.fillStyle = 'green';
ctx.fill();*/


/*let myColor = 'red';
document.getElementById('color').onchange = function(){
	myColor = 'green';
	console.log(myColor);
}

canvas.onmousedown = function(event){
	canvas.onmousemove = function(event){
		let x = event.offsetX;
		let y = event.offsetY;
		ctx.fillStyle = myColor;
		ctx.fillRect(x-5,y-5,10,10);
	}

	canvas.onmouseup = function(){
		canvas.onmousemove = null;
	}
}*/


/*ctx.beginPath();
ctx.arc(150,100,75,0,pi/2,true);
ctx.lineWidth = 10;
ctx.stroke();
ctx.fillStyle = 'green';
ctx.fill();
ctx.closePath();

ctx.beginPath();
ctx.arc(250,100,75,0,pi/2,false);
ctx.lineWidth = 10;
ctx.stroke();
ctx.fillStyle = 'pink';
ctx.fill();
ctx.closePath();*/

/*canvas.onmousemove = function(event){
	ctx.clearRect(0,0,400,200);
	let x = event.offsetX;
	let y = event.offsetY;
	let radius = Math.pow((Math.abs(x-200)*Math.abs(x-200) + Math.abs(y-100)*Math.abs(y -100)),(1/2));
	ctx.beginPath();
	ctx.arc(200,100,radius,0,2*pi,false);
	ctx.fill();
}*/


/*let x = 200;
let y = 100;
let stepCount = 0;
let direction;
let timer;
let myX;
let myY;

function drawDot(){
	ctx.clearRect(0,0,400,200);

	if(stepCount == 0){
		stepCount = Math.floor(15 * Math.random());
		direction = Math.floor(8 * Math.random());
	} else {
		stepCount --;
	}

	switch(direction){
		case 0:
			y = y-1;
			break;
		case 1:
			x = x+1;
			y = y-1;
			break;
		case 2:
			x = x+1;
			break;
		case 3:
			x = x+1;
			y = y+1;
			break;
		case 4:
			y = y+1;
			break;
		case 5:
			x = x-1;
			y = y+1;
			break;
		case 6:
			x = x-1;
			break;
		case 7:
			x = x-1;
			y = y-1;
			break;
	}

	if(x<0 || x>400 || y<0 || y>200) step=0;

	ctx.fillRect(x-3, y-3, 6, 6);

	ctx.beginPath();
	ctx.moveTo(x,y);
	ctx.lineTo(myX,myY);
	ctx.stroke();

	timer = setTimeout(drawDot, 20)
}

drawDot();

canvas.onmousemove = function(event){
	myX = event.offsetX;
	myY = event.offsetY;
}*/


/*let x=0;
let y=0;
let timer;

function drawSin(){
	y = 100 +  20 * Math.sin(2 * x);
	x = x+0.1;
	ctx.fillRect(x,y,2,2);

	timer = setTimeout(drawSin, 10);
}

drawSin();*/


/*let canvas = document.getElementById('c2');
let ctx = canvas.getContext('2d');*/


/*let R = 140;
let r = 80;
let d = 80;
let teta = 0;
let timer;

function spiro(){
	let x = (R - r) * Math.cos(teta) + d * Math.cos( (R - r) * teta / r);
	let y = (R - r) * Math.sin(teta) - d * Math.sin( (R - r) * teta / r);

	teta += 0.1;
	ctx.fillRect(2*x + 300,2*y + 300,4,4);

	timer = setTimeout(spiro, 10);
}

spiro();*/


let canvas = document.getElementById('c1');
let ctx = canvas.getContext('2d');


ctx.moveTo(200,50);
ctx.quadraticCurveTo(150,0,100,50);
ctx.quadraticCurveTo(50,100,200,180);
ctx.quadraticCurveTo(300,100,300,50);
ctx.quadraticCurveTo(250,0,200,50);
ctx.lineWidth = 4;
ctx.stroke();
ctx.fillStyle = 'pink';
ctx.fill();


canvas.onmousemove = function(event){
	let x = event.offsetX;
	let y = event.offsetY;

	ctx.clearRect(0,0,400,200);
	ctx.beginPath();
	ctx.moveTo(50,50);
	ctx.quadraticCurveTo(x,y,50,150);
	ctx.stroke();
}