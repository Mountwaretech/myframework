var prod_path = window.location.protocol + "//" + location.host + "/";

$(document).on("click", "._category_add", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
  $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#category_frm1243_add")[0]);
    $data_ref.append("action", "category_adfunc");
    $.ajax({
        type: 'POST',
        url: prod_path + "prod_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
       dataType: 'json',
        success: function(result, status) { 
            console.log(result);
            if (status == "success") {
                if (result.current_status == "success") {
                    $this_val.html($this_html).prop("disabled", false);
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        window.location.assign(result.url);
                    }, 3000)
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
 
$(document).on("click", ".prod_upbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#prod_frm1243")[0]);
    $data_ref.append("action", "prod_add_func");
    $.ajax({
        type: 'POST',
        url: prod_path + "prod_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            console.log(result);
            if (status == "success") {
                if (result.current_status == "success") {
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        window.location.assign(result.url);
                    }, 3000)
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



var _loadprod_list = {};
var load_status_prod = false;
_loadprod_list.init = function($limit) {
    if (load_status_prod)
        return
    load_status_prod = true;
    $("._pro_loder_bx").css("display", "block");
    $data_ref = new FormData($("#PRODFRm_cnt")[0]);
    $data_ref.append("action", "prod_list_filter");
    if ($limit !== undefined) {
        $data_ref.append("limit", $limit);
    }
    $.ajax({
        url: prod_path + "prod_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        processData: false,
        contentType: false,
        success: function(result, status) {
            if (status == "success") {
                $("._pro_loder_bx").css("display", "none");
                if ($limit === undefined) {
                    $(".prod_list-main-bx").html(result).addClass("_actv").promise().done(function() {
                        load_status_prod = false;
                        $(this).find(".img-disp-tg").each(function() {
                            img_load_buffer($(this), 300);
                        });
                    })
                } else {
                    $(".prod_list-main-bx").append(result).promise().done(function() {
                        load_status_prod = false;
                        $(this).find(".img-disp-tg").each(function() {
                            img_load_buffer($(this), 300);
                        });
                    });
                }
            }
        }
    });
}

/* window scroll load function  */
_loadprod_list.pagin = function() {
    if (_loadprod_list.data.total_count !== undefined) {
        if (_loadprod_list.data.total_count > 0 && _loadprod_list.data.total_count > _loadprod_list.data.curr_count) {
            _loadprod_list.init(_loadprod_list.data.curr_count);
        }
    }
}

/* empl search  function */
$(document).on("keyup", ".product_search", function(event) {
    _loadprod_list.init();
});

$(document).on("change", ".category_data", function(event) {
    _loadprod_list.init();
});



$(document).on("click", ".prod_stuschge", function() {
    var $this_val = $(this);
    var $data_ref = {
        action: "prod_status_change",
        product_uniqueid: $this_val.attr("data-val")
    };
    $.ajax({
        type: 'POST',
        url: prod_path + "prod_func",
        data: $data_ref,
        cache: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "active") {
                    message_box(result.current_status, result.msg, 3000);
                    $this_val.removeClass("red").addClass("act").html("Activated");
                }
                if (result.current_status == "deactive") {
                    message_box(result.current_status, result.msg, 3000);
                    $this_val.removeClass("act").addClass("red").html("Deactivated");
                }
                if (result.current_status == "error") {
                    message_box(result.current_status, result.msg, 3000);
                }

            }
        }
    });
});