/**
 * Created by oiooooio on 2016/10/2.
 */

var g_item_count = 0;
var g_item_templete = "<tr id={0}><td>{1}</td><td>{2}</td><td>{3}</td><td>{4}</td></tr>";

var g_total_ms = 0;
var g_start_time = 0;
var g_last_time = 0;

var g_is_start = false;

function start() {
    if(!g_is_start){
        //每10ms执行一次
        g_last_time = new Date().getTime();
        g_start_time = g_last_time;
        g_is_start = true;
        window.setInterval(function () {
            g_total_ms += 10;
            $("#p_timer").html(get_timer_str(g_total_ms));
        }, 10);
    }
    else {
        var cur_time = new Date().getTime();
        add_item(get_timer_str(cur_time - g_start_time),
            get_timer_str(cur_time - g_last_time));
        g_last_time = cur_time;
    }
}

function get_timer_str(milliseconds) {
    var total_second = parseInt(milliseconds / 1000);
    var hour = parseInt(total_second / 3600);
    var minute = parseInt(total_second / 60);
    var second = parseInt(total_second % 60);
    var milli_second = milliseconds % 1000;
    return "{0}:{1}:{2}:{3}".format(hour, minute, second, milli_second);
}

function reset() {
    location.reload();
}

function add_item(diff1, diff2) {
    ++g_item_count;
    var key = "xxx_tr_"+g_item_count;
    var item = g_item_templete.format(key, g_item_count, diff1, diff2, new Date().toLocaleString());
    $("#tb_container").append(item);
    $("#div_container").scrollTop($("#div_container").height());

    if(g_item_count % 2 == 0){
        $("#"+key).css("background-color","#EEE0E5");
    }
    else {
        $("#"+key).css("background-color","#F5FFFA");
    }
}