/**
 * Created by oiooooio on 2016/10/23.
 */


function get_url_args(name) {
    var pos_start = window.location.search.indexOf("?");
    if(pos_start < 0){return false;}

    var tmp = window.location.search.substring(pos_start+1);
    var tmp_a = tmp.split("=");
    if(tmp_a.length == 0){return false;}

    for (var i = 0; i < tmp_a.length; i++){
        if(tmp_a[i] == name){return true;}
    }
    return false;
}

function get_ctl(ctl_id) {
    var ctl = ctl_id;
    if(ctl_id.indexOf("#") === -1){
        ctl = "#"+ctl_id;
    }
    return $(ctl);
}

function enabled_button(bt_id, is_enabled) {
    if(is_enabled){
        get_ctl(bt_id).attr('disabled',"true");
    }
    else{
        get_ctl(bt_id).removeAttr('disabled');
    }
}

/**
 * is_restore: 在倒计时完毕后，是否还原控件为倒计时之前的状态
 * cb_finish: 如果倒计时完毕，将调用此函数
 */
function countdown_for_ctl(bt_id, seconds, is_restore, cb_finish) {
    var ctl = get_ctl(bt_id);
    var ctl_name = ctl.html();
    var id = window.setInterval(function () {
        seconds = seconds - 1;
        if(seconds <= 0){
            window.clearInterval(id);
            if(is_restore){
                ctl.html(ctl_name);
                enabled_button(bt_id, false);
            }
            if(cb_finish){cb_finish();}
            return;
        }
        ctl.html("{0} ({1})".format(ctl_name, seconds));
    }, 1000);
    return id;
}

function is_pc() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPod", "iPadMini", "QQBrowser"]; //"iPad",
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) !== -1) {
            flag = false;
            break;
        }
    }
    return flag;
}

