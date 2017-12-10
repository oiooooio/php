//----------------------------------------------------------------------------------------------------------------------
//拿到鼠标的当前坐标

var _g_mouse_pos = null;

function mouseMove(ev)
{
    ev = ev || window.event;
    _g_mouse_pos = mouseCoords(ev);
}
function mouseCoords(ev)
{
    //鼠标移动的位置
    if(ev.pageX || ev.pageY){
        return {
            x: ev.pageX,
            y: ev.pageY,
            screenX: ev.screenX,
            screenY: ev.screenY,
            clientX: ev.clientX,
            clientY: ev.clientY
        };
    }
    return{
        x: ev.clientX + document.body.scrollLeft - document.body.clientLeft,
        y: ev.clientY + document.body.scrollTop - document.body.clientTop,
        screenX: ev.screenX,
        screenY: ev.screenY,
        clientX: ev.clientX,
        clientY: ev.clientY
    };
}
function getControlRect(ctl) {
    return {
        top: ctl.offset().top,
        left: ctl.offset().left,
        bottom: ctl.height(),
        right: ctl.width()
    }
}

// document.onmousemove = mouseMove;


//----------------------------------------------------------------------------------------------------------------------
//在指定的控件上显示一个hint

function xy_mouseenter_hint(ctl, ctl_hint) {
    var _ctl = ctl;
    var _ctl_hint = ctl_hint;
    var _timer_id = 0;
    var _mouse_enter_hint_ctl = false;

    function set_close_at_after_seconds() {
        _timer_id = window.setTimeout(function () {
            if(_mouse_enter_hint_ctl === true){
                //如果鼠标没有离开hint，则续租
                set_close_at_after_seconds();
                return;
            }
            _ctl_hint.css("display", "none");
            _timer_id = 0;
        }, 3000);
    }

    _ctl.mouseenter(function () {
        if(_timer_id > 0)
            return; //还在显示的过程中
        _ctl_hint.css("display", "block");
        _ctl_hint.css("top", $(this).height()/2+$(this).offset().top);
        _ctl_hint.css("left", $(this).width()/2+$(this).offset().left);

        _ctl.mouseleave(function () {
            set_close_at_after_seconds();
        });
    });

    _ctl_hint.mouseenter(function () {
        _mouse_enter_hint_ctl = true;
    });
    _ctl_hint.mouseleave(function () {
        _mouse_enter_hint_ctl = false;
    });
}