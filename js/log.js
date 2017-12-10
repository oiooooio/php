/**
 * Created by oiooooio on 2016/10/22.
 */


var ctl_log_info = "<div id=\"log_info\"  style=\"position: absolute; right: 0; top: 0; text-align: left;\"></div>";


function log_info(func_name, text) {
    if($("#log_info").length == 0){
        $(document.body).append(ctl_log_info);
        $("#log_info").html("log info:");
    }
    var ctl = $("#log_info");
    ctl.html(ctl.html() + "<br>" + func_name.toString() + ": " + text.toString())
}