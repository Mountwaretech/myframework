/*
Created by  Balamurugan M
Email: inventorbala@gmail.com    
contact: 9524435595
Date : 07/12/2017 08:30: PM
path name
 */
var $log_path = window.location.protocol + "//" + location.host + "/";

$(document).on("click", "._logbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
   $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#logFRmData_set")[0]);
    $data_ref.append("action", "_login_func");
    $.ajax({
        type: 'POST',
        url: $log_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
       dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    login_msg(result.msg, "success");
                    setTimeout(function() {
                        window.location.assign(result.url);
                    }, 3000)
                }
            }
            if (result.current_status == "error") {
                $this_val.html($this_html).prop("disabled", false);
                $(".text_bx_disp").removeClass("err_bx");
                $("#" + result.field_id + "").addClass("err_bx");
                $(".span_error").html("");
                $(".span" + result.field_id + "").html(result.msg);
                setTimeout(function() {
                    $(".span_error").html("");
                }, 5000);
            }
            if (result.current_status == "error_resp") {
                login_msg(result.msg, "error");
                $(".text_bx_disp").removeClass("err_bx");
                $(".span_error").html("");
                $this_val.html($this_html).prop("disabled", false);
            }
        }
    });
    return false;
});


$(document).on("keypress", ".text_bx_disp", function(e) {
    var key = e.which;
    if (key == 13) {
        $("._logbtn").click();
        return false;
    }
});

/*login messages*/
function login_msg(message, type) {
    if (type == "success") {
        $("#lgn-msg_cnt-err").css('display', 'none');
        $("#lgn-msg_cnt-scs").html(message).addClass("actv").fadeIn(200);
    }
    if (type == "error") {
        $("#lgn-msg_cnt-err").html(message).addClass("actv").fadeIn(200);
        setTimeout(function() {
            $("#lgn-msg_cnt-err").fadeOut(2000).promise().done(function() {
                $(this).html('').removeClass("actv");
            })
        }, 4000);
    }
}