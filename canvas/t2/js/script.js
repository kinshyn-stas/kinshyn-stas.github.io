let canvas = document.getElementById('c1');
let ctx = canvas.getContext('2d');

function changeCanvasSize(id){
	let canvas = document.getElementById(id);
	canvas.width = document.body.offsetWidth;
	canvas.height = document.body.offsetHeight;
}

changeCanvasSize('c1');

window.addEventListener('resize',() => changeCanvasSize('c1'));


function drawContour(){
	let w = canvas.width;
	let h = canvas.height;

	ctx.beginPath();
	ctx.moveTo(w,0);
	ctx.bezierCurveTo(w - 240, h / 2, (w - 951) / 1, h / 2, w - 951, h);
	//ctx.quadraticCurveTo((w - 951) / 3, h / 2, w - 951, h);
	ctx.stroke();
}

drawContour();