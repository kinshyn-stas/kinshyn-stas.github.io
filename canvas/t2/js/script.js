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
	//let w = canvas.width;
	//let h = canvas.height;

	ctx.beginPath();
	ctx.moveTo(950,0);
	ctx.bezierCurveTo(850,100,350,0,0,880);
	ctx.stroke();
}

drawContour();