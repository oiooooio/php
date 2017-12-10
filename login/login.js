/**
 * Created by oiooooio on 2016/10/22.
 */

function get_cookie_expires(hours) {
    var tmp_d = new Date();
    tmp_d.setTime(tmp_d.getTime() + (hours*3600*1000));
    return tmp_d.toUTCString();
}

function login_out() {
    var tmp = document.cookie + ";path=/;expires=" + get_cookie_expires(-2);
    document.cookie = tmp;
}

function write_user_info(user_name, nick_name, last_login_date, md5, is_auto_login) {
    if(document.cookie.length > 0){return;}

    var tmp = "content=" + JSON.stringify({
            "user_name": user_name,
            "nick_name": nick_name,
            "last_login_date": last_login_date,
            "md5": md5
        });

    var tmp_d = "";
    if(is_auto_login){tmp_d = get_cookie_expires(7*24);}
    else {tmp_d = get_cookie_expires(1);}

    document.cookie = (tmp + ";path=/;expires=" + tmp_d);
    //启用";secure=true"要https
}

function get_user_info() {
    if(document.cookie === ""){return null;}

    var pos = document.cookie.indexOf("content=");
    if(pos == -1){ return null; }

    var start_pos = pos + "content=".length;
    var end_pos = document.cookie.lastIndexOf("}")+1;
    return JSON.parse(document.cookie.substring(start_pos, end_pos));
}

function get_user_nickname() {
    var tmp = get_user_info();
    if(!tmp){return null;}
    return tmp["nick_name"];
}

function get_user_name() {
    var tmp = get_user_info();
    if(!tmp){return null;}
    return tmp["user_name"];
}

function get_user_md5() {
    var tmp = get_user_info();
    if(!tmp){return null;}
    return tmp["md5"];
}

/*
 *  return:
 *      name:名字不对
 *      pwd:密码不对
 *      ok:没问题
 */
function check_user_info(user_name, user_pwd) {
    if (user_name == null || user_name.length < 3) {return "name";}
    if (user_pwd == null || user_pwd.length < 6) {return "pwd";}
    return "ok";
}