/**
 * Created by wangli on 2017/12/3.
 */

var _g_bubbles_hint = [
    "merry christmas",
    "happy~",
    "12.25,haha~",
    "hello~",
    "are you happy? Be happy, ok?",
    "oh~oh~oh~ha~ha~ha~"
];

function add_value(add_v, cur_v, max_value, default_v) {
    var v = add_v+cur_v;
    if(add_v > 0){
        if(cur_v >= max_value) {cur_v = default_v; return cur_v;}
        if(v >= max_value) return max_value;
    }
    else{
        if(cur_v <= max_value) {cur_v = default_v; return cur_v;}
        if(v <= max_value) return max_value;
    }
    return v;
}

function snowflake(canvas_id) {
    //缓冲区备胎
    var _canvas_2 = document.getElementById(canvas_id+"_bak");
    var _2d_2 = _canvas_2.getContext("2d");

    //工作区
    var _canvas = document.getElementById(canvas_id);
    var _2d = _canvas.getContext("2d");
    var _body = $("body");

    //图片加载
    var _img_snowflake = new Image();
    var _img_snowflake_bk = new Image(0);

    // shim layer with setTimeout fallback
    window.requestAnimFrame = (function(){
        return window.requestAnimationFrame   ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            function( callback ){
                window.setTimeout(callback, 1000 / 60);
            };
    })();

    //要绘制的内容
    var _draw_context = {};

    function add_draw(priority, draw_always, func) {
        //priority 绘制的优先级
        //draw_always 是不是每次都有绘制
        //func 绘制时调用的函数
        while (_draw_context.hasOwnProperty(priority)){
            //保证这个要绘制的对象存在
            priority = priority+1;
        }
        _draw_context[priority] = [draw_always, func];
    }

    //雪花精灵
    var _snowflake_size = {x:60, y:60};
    var _snowflake_spirit = [];
    var _mouse_enter_snowflake_index = null;
    var _mouse_pos = [];
    var _bubbles = [];

    //后面可以考虑加风向
    //倾斜

    window.onload = function () {
        _canvas.setAttribute("width", _body.width());
        _canvas.setAttribute("height", _body.height());
        _canvas_2.setAttribute("width", _body.width());
        _canvas_2.setAttribute("height", _body.height());

        //设置资源
        _img_snowflake.src = "snowflake.png";
        if(_body.height() > _body.width()) _img_snowflake_bk.src = "snowflake_bk_tel.jpg";
        else _img_snowflake_bk.src = "snowflake_bk.jpg";
        _img_snowflake.width = 100;
        _img_snowflake.height = 100;

        //设置事件
        _canvas.onmousemove = mouse_move;
        _canvas.onclick = mouse_click;

        //开始刷新
        window.requestAnimFrame(update);
        //永久绘制内容
        add_draw(0, true, draw_background); //背景图
        add_draw(0, true, draw_frame_num); //显示帧数
        add_draw(10, true, draw_snowflake); //绘制雪花
        add_draw(10, true, draw_path_test);
        // add_draw(11, true, draw_snowflake_test);
        add_draw(12, true, draw_mouse_path);
        add_draw(13, true, draw_bubble);

        //初始化精灵的数量
        for (var i = 0; i < 50; ++i){
            _snowflake_spirit.push(gen_snowflake());
        }
        //创建控制雪花
        create_special_snowflake();
    };

    function create_special_snowflake() {
        var control_text_style = {style:_2d.createRadialGradient(0,0,10,30,30,30), font:"20px 黑体 500"};
        control_text_style.style.addColorStop(0, "#ffb961"); //rgb(255,131,250)
        control_text_style.style.addColorStop(1, "#fdfdff"); //rgb(191,62,255)
        // control_text_style.style.addColorStop(1.0, "#2aff30"); //rgb(0,191,255)

        var y = _body.height() - _snowflake_size.y - 30;
        var total_x = _body.width() - _snowflake_size.x*2;

        var snow = gen_snowflake();
        snow.scale = 1;
        snow.x = total_x;
        snow.y = y;
        var bubble = {x:snow.x+(snow.width-10)/2-10, y:snow.y+snow.height+15, snow:snow, text_style:control_text_style, always:true};
        snow.control.func = snow_control_music;
        snow.control.type = 1;
        snow.control.play = false;
        snow.control.bubble = bubble;
        snow.data = "音乐";
        _snowflake_spirit.push(snow);
        _bubbles.push(bubble);
        snow = gen_snowflake();
        snow.scale = 1;
        snow.x = total_x - _snowflake_size.x - 20;
        snow.y = y;
        bubble = {x:snow.x+(snow.width-10)/2-10, y:snow.y+snow.height+15, snow:snow, text_style:control_text_style, always:true};
        snow.control.func = snow_control_message;
        snow.control.type = 2;
        snow.control.bubble = bubble;
        snow.data = "消息";
        _snowflake_spirit.push(snow);
        _bubbles.push(bubble);
    }
    
    function mouse_click() {
        if(!_mouse_enter_snowflake_index)
            return;

        var x = _g_mouse_pos.clientX, y = _g_mouse_pos.clientY;
        var t = _snowflake_spirit[_mouse_enter_snowflake_index];
        if(x < t.x || x > (t.x+t.width*t.scale) ||
            y < t.y || y > (t.y+t.height*t.scale))
            return;

        //鼠标命中,判断是不是控制雪花
        if(!t.control || !t.control.func || !t.control.type)
            return;

        //控制面板
        switch (t.control.type){
            case 1: //音乐
                if(!t.control.play){
                    t.control.play = true;
                    document.getElementById("music").play();
                }
                else{
                    t.control.play = false;
                    document.getElementById("music").pause();
                }
                break;
        }
    }

    function mouse_move(e) {
        mouseMove(e);

        //鼠标坐标
        var x = _g_mouse_pos.clientX, y = _g_mouse_pos.clientY;
        // _mouse_pos.push({x:x, y:y});

        if(_mouse_enter_snowflake_index !== null){
            var t = _snowflake_spirit[_mouse_enter_snowflake_index];
            if(x < t.x || x > (t.x+t.width*t.scale) ||
                y < t.y || y > (t.y+t.height*t.scale)){
                _mouse_enter_snowflake_index = null;
            }
        }

        if(_mouse_pos.length > 10000)
            _mouse_pos.splice(0, 1000);
        for (var i = 0; i < _snowflake_spirit.length; ++i){
            var snow = _snowflake_spirit[i];
            if(x >= snow.x && x <= (snow.x+snow.width*snow.scale) &&
                y >= snow.y && y <= (snow.y+snow.height*snow.scale)){
                _mouse_enter_snowflake_index = i;
                break;
            }
        }
    }

    function snow_control_music(snow, mouse_type) {
        if(snow.control.play){
            snow.angle = add_value(5, snow.angle, 360, 0);
        }
        if(mouse_type === null) return;
        else if(mouse_type === 1) { //鼠标进入
            snow.angle += 10;
            return;
        }
    }

    function snow_control_message(snow, mouse_type) {
        snow.angle = add_value(5, snow.angle, 360, 0);
        if(mouse_type === null) return;
        else if(mouse_type === 1) { //鼠标进入
            snow.angle += 10;
            return;
        }
    }

    function snow_control_default(snow) {
        snow.angle = add_value(-5, snow.angle, 0, 360);
        var bubble = {x:snow.x, y:snow.y, snow:snow};
        var t_width = _2d.measureText(snow.data);
        if(_body.width()<=snow.x+t_width.width+snow.width) bubble.x -= (t_width.width+snow.width/2);
        _bubbles.push(bubble);
    }

    function gen_snowflake() {
        return snowflake = {
            width: _snowflake_size.x,
            height: _snowflake_size.y,
            angle: 0,
            scale: Math.random(),

            //其他
            data: _g_bubbles_hint[Math.floor(xy_get_random(0, _g_bubbles_hint.length-1))],
            control: {func:null, type:null},

            // 控制y
            y: -xy_get_random(60, 500),
            y_speed: xy_get_random(0.5, 2),

            // 控制x位置
            path_test: [],
            x: xy_get_random(0, _body.width()),
            lr: xy_get_random_pn(-1, 1),
            lr_factor: 20000,
            
            update: function (mouse_enter) {
                //事件更新
                if(mouse_enter){
                    if(this.control && this.control.func)
                        this.control.func(this, 1);
                    else
                        snow_control_default(this);
                    return;
                }

                //特殊雪花更新
                if(this.control && this.control.func){
                    this.control.func(this, null);
                    return;
                }

                //x轴更新
                this.x += Math.sin(this.lr_factor/2000*this.lr);
                if(Math.random()*10000 > this.lr_factor){
                    this.lr *= -1;
                    this.lr_factor = 20000;
                }
                else{
                    this.lr_factor -= 2;
                }

                //旋转以及扭曲更新
                if(Math.random() > 0.5){
                    this.angle = add_value(2, this.angle, 360, 0);
                }
                else{
                }

                //y轴更新
                this.y += this.y_speed;
                // this.path_test.push({x:this.x, y:this.y});
            }
        };
    }
    
    function update_data() {
        //数据更新
        for (var i = 0; i < _snowflake_spirit.length; ++i){
            var snowflake = _snowflake_spirit[i];

            if(snowflake.x > _body.width() ||
                snowflake.y > _body.height()){
                //这个精灵已经出局，重新生成一个
                _snowflake_spirit[i] = gen_snowflake();
            }

            //鼠标覆盖的时候不动
            snowflake.update(i === _mouse_enter_snowflake_index);
        }
    }

    function draw_next() {
        for (var key in _draw_context){
            var element = _draw_context[key];
            if(element[1]){
                element[1](_2d_2);
            }
            if(!element[0]){
                //一次性绘制
                delete _draw_context[key];
            }
        }
    }

    function update() {
        //全部复制
        _2d.drawImage(_canvas_2, 0, 0, _body.width(), _body.height(), 0, 0, _body.width(), _body.height());

        //准备下一次要更新的内容
        update_data();
        draw_next(); //绘制缓冲区

        window.requestAnimFrame(update);
    }

    function draw_background(context) {
        context.drawImage(_img_snowflake_bk, 0, 0, _body.width(), _body.height());
    }

    var _frame_num = {update_frame_at_count:0, frame_last:0, frame:0};
    function draw_frame_num(context) {
        var t = _frame_num.frame_last;
        _frame_num.frame_last = (new Date()).valueOf();

        if(_frame_num.update_frame_at_count <= 0) {
            _frame_num.update_frame_at_count = 20; //120帧后更新
            _frame_num.frame = (1000/(_frame_num.frame_last-t)).toFixed(2);
        }

        _frame_num.update_frame_at_count -= 1;
        context.font = "15px Verdana";
        context.fillStyle = "rgb(255,255,255)";
        context.fillText(_frame_num.frame, 10, 20);
    }

    function draw_snowflake(context) {
        for (var i = 0; i < _snowflake_spirit.length; ++i) {
            var snowflake = _snowflake_spirit[i];

            context.save();
            context.translate(snowflake.x+snowflake.width*0.5, snowflake.y+snowflake.height*0.5);
            context.rotate(snowflake.angle*Math.PI/180);
            context.scale(snowflake.scale, snowflake.scale);
            context.drawImage(_img_snowflake, -snowflake.width*0.5, -snowflake.height*0.5, snowflake.width, snowflake.height);
            context.restore();
        }
    }

    function draw_bubble(context){
        if(!_bubbles.length) return;
        for (var i = 0; i < _bubbles.length; ++i){
            var b = _bubbles[i];
            context.save();
            if(b.text_style){
                context.font = b.text_style.font;
                context.fillStyle = b.text_style.style;
            }
            context.fillText(b.snow.data, b.x, b.y, 200);
            context.restore();
            if(!b.always)
                _bubbles.splice(i, 1);
        }
    }

    function draw_mouse_path(context){
        if(!_mouse_pos.length)return;
        for (var i = 0; i < _mouse_pos.length; ++i){
            context.save();
            context.strokeStyle = "rgb(178, 58, 238)";
            context.lineWidth = 1;
            context.beginPath();
            for (var j = 0; j < _mouse_pos.length-(_mouse_pos.length%2); j+=2){
                context.moveTo(_mouse_pos[j].x, _mouse_pos[j].y);
                context.lineTo(_mouse_pos[j+1].x, _mouse_pos[j+1].y);
            }
            context.stroke();
            context.restore();
        }
    }

    function draw_path_test(context){
        for (var i = 0; i < _snowflake_spirit.length; ++i){
            var snow = _snowflake_spirit[i];
            if(!snow.path_test.length) continue;
            context.save();
            context.strokeStyle = "rgb(255, 0, 0)";
            context.lineWidth = 1;
            context.beginPath();
            for (var j = 0; j < snow.path_test.length-(snow.path_test.length%2); j+=2){
                context.moveTo(snow.path_test[j].x, snow.path_test[j].y);
                context.lineTo(snow.path_test[j+1].x, snow.path_test[j+1].y);
            }
            context.stroke();
            context.restore();
        }
    }

    // var r = 0;
    // var a = 0;
    // function draw_snowflake_test(context){
    //     context.save();
    //     //context.fillStyle = "rgb(0, 128, 128)";
    //     //context.fillRect(0, 0, 230 ,230);
    //     // context.translate(230, 230);
    //     context.setTransform(a*Math.PI/180, -r, r, r, 230, 230);
    //     // context.rotate(a*Math.PI/180);
    //     //context.fillRect(-30, -30, 60, 60);
    //     context.drawImage(_img_snowflake, -30, -30, 60, 60);
    //     context.restore();
    //     r += 0.01;
    //     a += 1;
    //     if(r > 10) r = 0;
    // }



}