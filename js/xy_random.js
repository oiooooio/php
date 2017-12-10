/**
 * Created by wangli on 2017/12/3.
 */


//这个目前没法支持负数
//没办法随机1-2
//bug还挺多
function xy_get_random(x, y) {
    if(y-x === 1){
        var a = Math.random();
        if(a < 0.5) return x;
        return y;
    }

    var offset = 0;
    if(x<0 && (Math.floor((y-x)/2)*2 < (y-x))){
        offset = y-Math.abs(x);
    }

    y += 1;
    for (var i = 0; i < 10; ++i){
        a = Math.random();
        var b = (y-x)*a;
        if(x < 0){
            b = b/2;
            if(Math.random() > 0.5) b *= -1;
            else{
                b += offset;
                if(b > y) b = y;
            }
        }
        if(b >= x && b < y) return b;
    }
    return null;
}

function xy_get_random_pn(x, y) {
    if(Math.random() > 0.5) return y;
    return x;
}


function xt_random_test(ctl_id, a, b) {
    var ctl = $("#"+ctl_id);
    // window.setInterval(function () {
    //     ctl.text(ctl.text()+", " + Math.floor(xy_get_random(1, 100)));
    // }, 500);

    for (var i = 0; i < 100; ++i){
        ctl.text(ctl.text()+", " + Math.floor(xy_get_random(a, b)));
        // ctl.text(ctl.text()+", " + xy_get_random(a, b));
    }
}