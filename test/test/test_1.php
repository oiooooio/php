<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../../js/jquery/jquery.min.js" type="application/javascript"></script>

    <style>
        body{
            padding: 0;
            margin: auto 0;
            overflow-y: hidden;
        }

        .canvas {
            width: 100%;
            height: 100%;
        }

    </style>
    <script type="text/javascript">
        function GetWidthAndHeight() {
            var winWidth = 0;
            var winHeight = 0;

            // 获取窗口宽度
            if (window.innerWidth)
                winWidth = window.innerWidth;
            else if ((document.body) && (document.body.clientWidth))
                winWidth = document.body.clientWidth;
            // 获取窗口高度
            if (window.innerHeight)
                winHeight = window.innerHeight;
            else if ((document.body) && (document.body.clientHeight))
                winHeight = document.body.clientHeight;
            return [winWidth, winHeight];
        }
        
        (function(){
            function Run(){
                canvas_cxt.globalCompositeOperation="source-over";
                canvas_cxt.fillStyle="rgba(8,8,12,0.65)";
                canvas_cxt.fillRect(0,0,g_width,g_height);
                canvas_cxt.globalCompositeOperation="lighter";
                x=q-u;
                y=r-v;
                u=q;
                v=r;
                for(var d=0.86*g_width,func_rand_color=0.125*g_width,m=0.5*g_width,t=Math.random,n=Math.abs,o=z;o--;){
                    var h=A[o],i=h.x,j=h.y,a=h.a,b=h.b,c=i-q,k=j-r,g=Math.sqrt(c*c+k*k)||0.001,c=c/g,k=k/g;
                    if(w&&g<m)
                        var s=14*(1-g/m),a=a+(c*s+0.5-t()),b=b+(k*s+0.5-t());
                    g<d&&(s=0.0014*(1-g/d)*g_width,a-=c*s,b-=k*s);
                    g<func_rand_color&&(c=2.6E-4*(1-g/func_rand_color)*g_width,a+=x*c,b+=y*c);
                    a*=B;
                    b*=B;
                    c=n(a);
                    k=n(b);
                    g=0.5*(c+k);
                    0.1>c&&(a*=3*t());
                    0.1>k&&(b*=3*t());
                    c=0.45*g;
                    c=Math.max(Math.min(c,3.5),0.4);
                    i+=a;
                    j+=b;
                    i>g_width?(i=g_width,a*=-1):0>i&&(i=0,a*=-1);
                    j>g_height?(j=g_height,b*=-1):0>j&&(j=0,b*=-1);
                    h.a=a;
                    h.b=b;
                    h.x=i;
                    h.y=j;
                    canvas_cxt.fillStyle=h.color;
                    canvas_cxt.beginPath();
                    canvas_cxt.arc(i,j,c,0,D,!0);
                    canvas_cxt.closePath();
                    canvas_cxt.fill()
                }
            }
            function onMouseMove(d){
                d=d?d:window.event;
                q=d.clientX-m.offsetLeft-n.offsetLeft;
                r=d.clientY-m.offsetTop-n.offsetTop
            }

            function onMouseDown(){
                w=!0;
                return!1
            }
            function onMouseUp(){
                return w=!1
            }
            function RandColor(){
                this.color="rgb("+Math.floor(255*Math.random())+","+Math.floor(255*Math.random())+","+Math.floor(255*Math.random())+")";
                this.b=this.a=this.x=this.y=0;
                this.size=1
            }

            var window_rect = GetWidthAndHeight();
            var D=2*Math.PI,g_width=window_rect[0],g_height=window_rect[1],
                z=600,B=0.96,A=[],o,canvas_cxt,n,m,q,r,x,y,u,v,w;
            window.onload=function(){
                o=document.getElementById("mainCanvas");
                if(o.getContext){
                    m=document.getElementById("outer");
                    n=document.getElementById("canvasContainer");
                    canvas_cxt=o.getContext("2d");
                    for(var d=z;d--;){
                        var func_rand_color=new RandColor;
                        func_rand_color.x=0.5*g_width;
                        func_rand_color.y=0.5*g_height;
                        func_rand_color.a=34*Math.cos(d)*Math.random();
                        func_rand_color.b=34*Math.sin(d)*Math.random();
                        A[d]=func_rand_color;
                    }
                    q=u=0.5*g_width;
                    r=v=0.5*g_height;
                    document.onmousedown=onMouseDown;
                    document.onmouseup=onMouseUp;
                    document.onmousemove=onMouseMove;
                    setInterval(Run,33);
                }
                else document.getElementById("output").innerHTML="对不起，需要最新版本的Chrome, Firefox, Opera, Safari, or Internet Explorer 9."
            }
        })();
    </script>
</head>
<body>


<div id="outer">
    <div id="canvasContainer">
        <canvas id="mainCanvas" class="canvas"></canvas>
        <div id="output"></div>
    </div>
</div>

</body>
</html>

