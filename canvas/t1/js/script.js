let canvas = document.getElementById('c1');
let ctx = canvas.getContext('2d');


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


let pi = Math.PI;

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

canvas.onmousemove = function(event){
	ctx.clearRect(0,0,400,200);
	let x = event.offsetX;
	let y = event.offsetY;
	let radius = Math.pow((Math.abs(x-200)*Math.abs(x-200) + Math.abs(y-100)*Math.abs(y -100)),(1/2));
	ctx.beginPath();
	ctx.arc(200,100,radius,0,2*pi,false);
	ctx.fill();
}