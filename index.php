<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="./reset_css/reset.css">
  <link rel="stylesheet" href="./grid_system/css/bootstrap.css">
  <link rel="stylesheet" href="./grid_system/css/bootstrap-theme.css">


<body>
<div class="mega-container">
  <canvas id="canvas1" width="100" height="100" style="display:block"></canvas>

  </div>

</div>

</body>

<style media="screen">


.mega-container{
  width: 10vw;
  height: 10vh;
  /* overflow:hidden; */
  position: relative;
}

.full-width{

  }
</style>

<!-- jquery -->
<script  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
crossorigin="anonymous"></script>
<script type="text/javascript">


$('document').ready(function () {

});

function getRandN(min, max) {return Math.random() * (max - min) + min;}

var canvas  = document.getElementById('canvas1');
var scratch = document.createElement('canvas');
var ctx  = canvas.getContext('2d');
var ctxS = scratch.getContext('2d');

window.addEventListener('resize', resizeCanvas, false);

function resizeCanvas() {
    scratch.width = canvas.width = window.innerWidth;
    scratch.height = canvas.height = window.innerHeight;
}

resizeCanvas();

function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect(),
        root = document.documentElement;

    // return relative mouse position
    var mouseX = evt.clientX - rect.left - root.scrollLeft;
    var mouseY = evt.clientY - rect.top - root.scrollTop;
    return {
        x: mouseX,
        y: mouseY
    };
}

var circles = [];

function circ(x, y, rad, strW,strS) {
    ctxS.lineWidth  = strW;
    ctxS.strokeStyle = strS;
    ctxS.beginPath();
    ctxS.arc(x, y, rad, 0, 2 * Math.PI, false);
    ctxS.closePath();
    ctxS.stroke();
}

function draw_js() {
  // console.log(bass);
  ctxS.fillStyle = "#ffffff";
  ctxS.fillRect(0,0,canvas.width,canvas.height);
  if (circles.length>0) {
    for (var i = 0; i < circles.length; i++) {
      for (var p = 0; p < circles[i].length; p++) {
          if((circles[i][p].strokeWidth==0) || (circles[i][p].strokeWidth<0.1)) {
            circles[i].splice(p,1);
            if(circles[i].length === 0){
              // console.log('circle deleted');
              circles.splice(i,1)
              break;
            }
          }   else {
              circ(circles[i][p].x, circles[i][p].y, circles[i][p].radius, circles[i][p].strokeWidth, circles[i][p].strokeStyle);
              circles[i][p].radius += (2/(p+1));
              circles[i][p].strokeWidth -= (0.3*(p+1));
          }
      }
    }
  }

    ctx.drawImage(scratch, 0, 0);
    window.webkitRequestAnimationFrame(draw_js);
}

window.webkitRequestAnimationFrame(draw_js);

setInterval(function () {
  // console.log(circles.length);
    if (circles.length<10) {
      addCircle(true);
      if ((getRandN(0,2))>1.5) {
        addCircle(true);
        addCircle(true);
      }
    }
}, 1000);

addCircle(true);
function addCircle(random) {
  if (random===true) {
    var XX = getRandN(0,canvas.width);
    var YY = getRandN(0,canvas.height);
  } else {
    var XX = event.clientX;
    var YY = event.clientY;
  }

  if ((getRandN(0,2))>1.9) { var strokeColor = "#ffffff"; }
  else{ var strokeColor = "#000000"; }

  radius_vary = 10;
  iterations = parseInt(getRandN(1,10));
  temp_arr = []
    for (var i = 0; i < iterations; i++) {
        temp_arr.push(
          {
            x: XX,
            y: YY,
            radius: radius_vary,
            strokeWidth: canvas.width/30,
            strokeStyle : strokeColor
          }
        );
    }
    circles.unshift(temp_arr);
  }


canvas.addEventListener('click',function(){
addCircle(false);
})


</script>
</html>
