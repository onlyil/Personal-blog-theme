/**
 *
 * @authors Your Name (you@example.org)
 * @date    2017-05-04 11:36:47
 * @version $Id$
 */
window.requestAnimationFrame = window.requestAnimationFrame || function (a){return setTimeout(a,1000/60)};

var can = document.getElementById('canvas');
var ctx = can.getContext('2d');
var oMain = document.querySelector('.main');
can.width = window.innerWidth;
can.height = oMain.clientHeight;
ctx.lineWidth = 0.3;
//初始连接线条位置
var mousePosition = {
    x : 50*can.width/100,
    y : 50*can.height/100
};

//粒子对象参数
var dots = {
    n : 100,    //粒子个数
    distance : 100,    //粒子之间距离
    radius : 100,    //粒子距离鼠标距离
    array : []    //保存粒子对象
};

//创建圆形粒子对象
function Dot() {
    //粒子圆心随机坐标
    this.x = Math.random()*can.width;
    this.y = Math.random()*can.height;
    //运动速度值
    this.vx = -0.5 + Math.random();
    this.vy = -0.5 + Math.random();
    this.radius = Math.random()*5;
    this.color = "#bbb";
}

//绘制粒子
Dot.prototype.draw = function() {
    ctx.beginPath();
    ctx.fillStyle = this.color;
    ctx.arc(this.x , this.y , this.radius , 0 , Math.PI*2 , false);
    ctx.fill();
};

//添加粒子
function createCircle(){
    for(var i=0;i<dots.n;i++){
        dots.array.push(new Dot());
    }
}

//绘制粒子集合
function drawDots(){
    for(var i=0;i<dots.n;i++){
        var dot = dots.array[i];
        dot.draw();
    }
}

//移动
function moveDots(){
    for(var i=0;i<dots.n;i++){
        var dot = dots.array[i];
        //碰壁反弹
        if(dot.y<0 || dot.y>can.height){
            dot.vy = -dot.vy;
        }else if(dot.x<0 || dot.x>can.width){
            dot.vx = -dot.vx;
        }
        //加上速度移动
        dot.x += dot.vx;
        dot.y += dot.vy;
    }
}

//不断移动
function animateDots(){
    ctx.clearRect(0,0,can.width,can.height);
    moveDots();
    drawDots();
    connectDots();
    requestAnimationFrame(animateDots);
}

//链接粒子
function connectDots(){
    for(var i=0;i<dots.n;i++){
        for(var j=0;j<dots.n;j++){
            iDot = dots.array[i];
            jDot = dots.array[j];
            if( (iDot.x - jDot.x) < dots.distance && (iDot.y - jDot.y) < dots.distance && (iDot.x - jDot.x) > -dots.distance && (iDot.y - jDot.y) > -dots.distance ){
                    ctx.beginPath();
                    ctx.strokeStyle = "#bbb";
                    ctx.moveTo(iDot.x , iDot.y);
                    ctx.lineTo(jDot.x , jDot.y);
                    ctx.closePath();
                    ctx.stroke();
            }
        }
    }
}
createCircle();
animateDots();

