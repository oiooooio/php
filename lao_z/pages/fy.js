/**
 * Created by oiooooio on 2017/10/13.
 */

function get_jianzhuleixing(ctl_ame) {
    $.ajax({
        method: "POST",
        url: "../bg/db_kvs.php",
        data: {
            type: "set",
            id: _g_last_id,
            value_add: adds,
            value_del: dels
        },
        dataType: "html",

        success: function (data) {
            parse_kvs(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            log_info("get_kvs", "{0}, {1}, {2}".format(jqXHR, textStatus, errorThrown));
        }
    });
}
