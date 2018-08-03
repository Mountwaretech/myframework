var setting_path = window.location.protocol + "//" + location.host + "/";

function profile_initbx() {
    var $data_ref = { action: "profile_databx", data_val: $("._profile_li.actbx").attr("data-val") };
    $.ajax({
        type: 'POST',
        url: setting_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        success: function(result, status) {
            if (status == "success") {
                $(".profile_databx").html(result);
            }
        }
    });
}

$(document).on("click", "._profile_li", function() {
    var $this_id = $(this);
    $process_status = false;
    $("._profile_li").removeClass("actbx");
    if (!$(this).hasClass("actbx")) {
        $this_id.addClass("actbx");
        $process_status = true;
    } else {
        $this_id.removeClass("actbx");
        $process_status = true;
    }
    if ($process_status) {
        profile_initbx();
    }
});

/* Reset password button action */
$(document).on("click", ".pass_resetbtn ", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("LOADING...").prop("disabled", true);
    var $data_ref = new FormData($("#pwd_reset_frm")[0]);
    $data_ref.append("action", "password_reset_fun");
    $.ajax({
        type: 'POST',
        url: setting_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    $this_val.html($this_html).prop("disabled", false);
                    message_box(result.current_status, result.msg, 3000);
                    timeout_href(result.url, 2000);
                }
            }
            if (result.current_status == "error") {
                $this_val.html($this_html).prop("disabled", false);
                message_box(result.current_status, result.msg, 3000);
            }
        }
    });
    return false;
});


$(document).on("click", "._com_btn ", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("LOADING...").prop("disabled", true);
    var $data_ref = new FormData($("#comp_prof_frorm")[0]);
    $data_ref.append("action", "comp_prof_frorm");
    $.ajax({
        type: 'POST',
        url: setting_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    $this_val.html($this_html).prop("disabled", false);
                    message_box(result.current_status, result.msg, 3000);
                    window.location.reload();
                }
            }
            if (result.current_status == "error") {
                $this_val.html($this_html).prop("disabled", false);
                message_box(result.current_status, result.msg, 3000);
            }
        }
    });
    return false;
});