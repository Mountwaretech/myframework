var admin_path = window.location.protocol + "//" + location.host + "/";

$(document).on("click", "._back_href", function() {
    var $this_val = $(this);
    $data_href = $this_val.attr("data-href");
    window.location.assign($data_href);
});


$(document).on("click", ".chekbx_lbl_li", function() {
    $status = false;
    if (!$(this).hasClass("actv")) {
        $(this).addClass("actv").find(".chekbx_lbl").addClass("actv");
        $(this).find("._oper_data").prop("checked", true).promise().done(function() {
            $status = true;
        });
    } else {
        $(this).removeClass("actv").find(".chekbx_lbl").removeClass("actv");
        $(this).find("._oper_data").prop("checked", false).promise().done(function() {
            $status = true;
        });
    }
});

$(document).on("click", ".chekbx_all_lbl", function() {
    $status = false;
    if (!$(this).hasClass("actv")) {
        $(".chekbx_all_lbl").addClass("actv").find(".chekbx_lbl").addClass("actv");
        $(".chekbx_lbl").addClass("actv").find(".chekbx_lbl").addClass("actv");
        $("._oper_data").prop("checked", true).promise().done(function() {
            $status = true;
        });

    } else {
        $(".chekbx_all_lbl").removeClass("actv").find(".chekbx_lbl").removeClass("actv");
        $(".chekbx_lbl").removeClass("actv").find(".chekbx_lbl").removeClass("actv");
        $("._oper_data").prop("checked", false).promise().done(function() {
            $status = true;
        });
    }
    if ($status) {}
});


/* User form add function */
$(document).on("click", ".user_upbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#user_frm1243")[0]);
    $data_ref.append("action", "user_save_func");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            //console.log(result);
            if (status == "success") {
                if (result.current_status == "success") {
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        $this_val.html($this_html).prop("disabled", false);
                        window.location.assign(result.url);
                    }, 3000)
                }
            }
            if (result.current_status == "error") {
                message_box(result.current_status, result.msg, 3000);
                $this_val.html($this_html).prop("disabled", false);
            }
        }
    });
    return false;
});


var _loaduser_list = {};
var load_status_prod = false;
_loaduser_list.init = function($limit) {
        if (load_status_prod)
            return
        load_status_prod = true;
        $("._pro_loder_bx").css("display", "block");
        $data_ref = new FormData($("#fltr_FRm_cnt")[0]);
        $data_ref.append("action", "user_list-filter");
        if ($limit !== undefined) {
            $data_ref.append("limit", $limit);
        }

        $.ajax({
            url: admin_path + "glb_data_func",
            type: "POST",
            data: $data_ref,
            cache: true,
            processData: false,
            contentType: false,
            success: function(result, status) { 
                if (status == "success") {
                    $("._pro_loder_bx").css("display", "none");
                    if ($limit === undefined) {
                        $(".user_list-main-bx").html(result).addClass("_actv").promise().done(function() {
                            load_status_prod = false;
                            $(this).find(".img-disp-tg").each(function() {
                                img_load_buffer($(this), 300);
                            });
                        })
                    } else {
                        $(".user_list-main-bx").append(result).promise().done(function() {
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
_loaduser_list.pagin = function() {
        if (_loaduser_list.data.total_count !== undefined) {
            if (_loaduser_list.data.total_count > 0 && _loaduser_list.data.total_count > _loaduser_list.data.curr_count) {
                _loaduser_list.init(_loaduser_list.data.curr_count);
            }
        }
    }

    /* empl search  function */
$(document).on("keyup", ".user_srchbx", function(event) {
    _loaduser_list.init();
});

$(document).on("click", ".fiterbysearch", function(event) {
    _loaduser_list.init();
});



$(document).on("click", ".user_stuschge ", function() {
    var $this_val = $(this);
    var $data_ref = {
        action: "status_change_func",
        data_val: $this_val.attr("data-val")
    };
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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

$(document).on("click", "._operation_add", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#operation_frm1243_add")[0]);
    $data_ref.append("action", "operation_add");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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
                    setTimeout(function() {
                        window.location.assign(window.location.href);
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

$(document).on("click", ".job_card_ad", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#jobcard_frm1243")[0]);
    $data_ref.append("action", "job_card_add");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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

$(document).on("click", ".assign_op_data", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#_assing_FRM321_OPER")[0]);
    $data_ref.append("action", "assign_job_operation");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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


$(document).on("click", ".assign_user_oper", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#_User_FRM321_OPER")[0]);
    $data_ref.append("action", "assign_user_operation");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            //console.log(result);
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


$(document).on("click", ".remove_bx", function() {
    popup_init(true);
    var $data_ref = { action: "remove_bx", data_val: $(this).attr("data-val") };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                popup_data(result);
            }
        }
    });
});

$(document).on("click", "._2124_js_14", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
   $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#remove_FRM321")[0]);
    $data_ref.append("action", "remove_data");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            console.log(result);
            if (status == "success") {
                if (result.current_status == "success") {
                    popup_close();
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        window.location.reload();
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


$(document).on("click", ".admim_adbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#admin_frm123")[0]);
    $data_ref.append("action", "admin_adfunc");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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



$(document).on("click", "._master_adbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#master_addFRM")[0]);
    $data_ref.append("action", "master_add_data");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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

$(document).on("click", ".branch_adbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#branch_frm1243")[0]);
    $data_ref.append("action", "branchr_add_data");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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



var _loadbranch_list = {};
var load_status_prod = false;
_loadbranch_list.init = function($limit) {
        if (load_status_prod)
            return
        load_status_prod = true;
        $("._pro_loder_bx").css("display", "block");
        $data_ref = new FormData($("#fltr_FRm_branch")[0]);
        $data_ref.append("action", "branch_list-filter");
        if ($limit !== undefined) {
            $data_ref.append("limit", $limit);
        }

        $.ajax({
            url: admin_path + "glb_data_func",
            type: "POST",
            data: $data_ref,
            cache: true,
            processData: false,
            contentType: false,
            success: function(result, status) {
                //console.log(result);
                if (status == "success") {
                    $("._pro_loder_bx").css("display", "none");
                    if ($limit === undefined) {
                        $(".branch_list-main-bx").html(result).addClass("_actv").promise().done(function() {
                            load_status_prod = false;
                            $(this).find(".img-disp-tg").each(function() {
                                img_load_buffer($(this), 300);
                            });
                        })
                    } else {
                        $(".branch_list-main-bx").append(result).promise().done(function() {
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
_loadbranch_list.pagin = function() {
        if (_loadbranch_list.data.total_count !== undefined) {
            if (_loadbranch_list.data.total_count > 0 && _loadbranch_list.data.total_count > _loadbranch_list.data.curr_count) {
                _loadbranch_list.init(_loadbranch_list.data.curr_count);
            }
        }
    }
    /* empl search  function */
$(document).on("keyup", ".branch_search", function(event) {
    _loadbranch_list.init();
});

$(document).on("change", ".branch_name_code", function() {
    var $data_val = $('select.branch_name_code option:selected').val();
    $data_ref = { action: "student_ID_generate", data_val: $data_val };
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        dataType: "json",
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    $(".stud_id").val(result.stud_id);
                    $(".stud_regid").val(result.stud_id);

                }
                if (result.current_status == "error") {
                    message_box(result.current_status, result.msg, 3000);
                }
            }
        }
    });
});




$(document).on("click", ".stud_btnad", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#stud_frm1243")[0]);
    $data_ref.append("action", "stud_add_func");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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

$(document).on("submit","#stud_FRm_data", function(e){
    e.preventDefault();
});
var _loadstudent_list = {};
var load_status_prod = false;
_loadstudent_list.init = function($limit, resp_dt) {
        if (load_status_prod)
            return
        load_status_prod = true;
        $("._pro_loder_bx").css("display", "block");
        $data_ref = new FormData($("#stud_FRm_data")[0]);
        $data_ref.append("action", "stud_list-filter");
        if ($limit !== undefined) {
            $data_ref.append("limit", $limit);
        }
        $.ajax({
            url: admin_path + "glb_data_func",
            type: "POST",
            data: $data_ref,
            cache: true,
            processData: false,
            contentType: false,
            success: function(result, status) {   
                if (status == "success") {
                    $("._pro_loder_bx").css("display", "none");
                    if ($limit === undefined) {
                        $(".student_list-main-bx").html(result).addClass("_actv").promise().done(function() {
                            if(resp_dt !== undefined)
                            {
                                resp_dt({status:"success"});
                            }
                            load_status_prod = false;
                            $(this).find(".img-disp-tg").each(function() {
                                img_load_buffer($(this), 300);
                            });
                        })
                    } else {
                        $(".student_list-main-bx").append(result).promise().done(function() {
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
_loadstudent_list.pagin = function() {
    if (_loadstudent_list.data.total_count !== undefined) {
        if (_loadstudent_list.data.total_count > 0 && _loadstudent_list.data.total_count > _loadstudent_list.data.curr_count) {
            _loadstudent_list.init(_loadstudent_list.data.curr_count);
        }
    }
}

$(document).on("keyup", ".student_search", function(e) { 
    e.preventDefault();
    if(e.keyCode!="13")
    {
         _loadstudent_list.init();
    }
   
});
$(document).on("keyup", ".barcode_search", function(e) { 
    e.preventDefault();
    var $this = $(this);
    if(e.keyCode =="13")
    {
         _loadstudent_list.init(undefined, function(resp){
             if(resp.status == "success")
             {
          $this.val('');       
             }
         });
       
    }
   
});
$(document).on("click", ".fiterbystudent", function() {
    _loadstudent_list.init();
});



$(document).on("click", ".add_payment", function() {
    popup_init(true);
    var $data_ref = { action: "add_payment_bx", data_val: $(this).attr("data-val") };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                popup_data(result);
            }
        }
    });
});

$(document).on("click", ".amount_pay", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#amount_frmdata")[0]);
    $data_ref.append("action", "add_payment");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            //console.log(result);
            if (status == "success") {
                if (result.current_status == "success") {
                    popup_close();
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        _load_stud_paybx(result.student_uniqueid);
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


function _load_stud_paybx($student_uniqueid) {
    var student_uniqueid = $student_uniqueid;
    var $data_ref = { action: "load_stud_paybx", student_uniqueid: student_uniqueid };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                $loader_html = $("._loder_disbx").html();
                $(".total_amnt" + student_uniqueid + "").html($loader_html).promise().done(function() {
                    setTimeout(function() {
                        $(".total_amnt" + student_uniqueid + "").html(result);
                    }, 3000)
                });
            }
        }
    })
}

$(document).on("click", "._add_card_12", function() {
    popup_init(true);
    var $data_ref = { action: "add_card_bx", data_val: $(this).attr("data-val") };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                popup_data(result);
            }
        }
    });
});


$(document).on("click", ".add_cardbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $loader_html = $("._loder_disbx").html();
    $this_val.html($loader_html).prop("disabled", true);
    var $data_ref = new FormData($("#card_frmdata")[0]);
    $data_ref.append("action", "add_card_func");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    popup_close();
                    message_box(result.current_status, result.msg, 0);
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


$(document).on("click", ".password_reset", function() {
    popup_init(true);
    var $data_ref = { action: "password_reset_popup",data_val:$(this).attr("data-val") };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                popup_data(result);
            }
        }
    });
});



$(document).on("click", ".confirm_reset", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#_password_frm")[0]);
    $data_ref.append("action", "password_reste_func");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    popup_close();
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        window.location.assign(window.location.href);
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


$(document).on("click", ".user_imgrmve", function() {
    var $data_ref = { action: "user_img_remove", data_val: $(this).attr("data-val") };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000)
                }
            }
            if (result.current_status == "error") {
                message_box(result.current_status, result.msg, 3000);
            }
        }
    });
});


$(document).on("click", ".user_btn_edit", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#userEdit_FRmData")[0]);
    $data_ref.append("action", "user_data_function");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        window.location.assign(result.page_url);
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

$(document).on("click", ".card_blck_req", function() {
    popup_init(true);
    var $data_ref = { action: "card_block_quest", data_val: $(this).attr("data-val") };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                popup_data(result);
            }
        }
    });
});





$(document).on("click", "._card_blk_btn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#_card_blk_FRm")[0]);
    $data_ref.append("action", "card_block_data");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    popup_close();
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        _load_stud_paybx(result.student_uniqueid);
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



$(document).on("click", ".transfer_payment", function() {
    popup_init(true);
    var $data_ref = { action: "transfer_payment_bx", data_val: $(this).attr("data-val") };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                popup_data(result);
            }
        }
    });
});


$(document).on("click", ".transfer_pay", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#transfer_frmdata")[0]);
    $data_ref.append("action", "transfer_frmdata");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    transfer_stud_review(result.data);
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

function transfer_stud_review(dataSet) {
    var $data_ref = { action: "transfer_stud_review", dataSet: dataSet };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            if (status == "success") {
                popup_data(result);
            }
        }
    });
}


$(document).on("click", ".transfer_paybtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#transfer_revie_FRMata")[0]);
    $data_ref.append("action", "transfer_revie_confirm");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
            if (status == "success") {
                if (result.current_status == "success") {
                    popup_close();
                    message_box(result.current_status, result.msg, 3000);
                    setTimeout(function() {
                        window.location.reload();
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



$(document).on("click", ".ads_addbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#ads_frm1243_add")[0]);
    $data_ref.append("action", "ads_saveData");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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


$(document).on("click", ".terminal_addbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
  $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#terminal_frm1243_add")[0]);
    $data_ref.append("action", "terminal_saveData");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
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


$(document).on("click", ".stall_adbtn", function() {
    var $this_val = $(this);
    $this_html = $this_val.html();
    $this_val.html("loading...").prop("disabled", true);
    var $data_ref = new FormData($("#stall_frm1243")[0]);
    $data_ref.append("action", "stall_saveData");
    $.ajax({
        type: 'POST',
        url: admin_path + "glb_data_func",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result, status) {
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

$(document).on("change", ".selectBranch", function() { 
    var $data_ref = { action: "filterstall_data", data_val: $(this).val() };
    $.ajax({
        url: admin_path + "glb_data_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            console.log(result);
            if (status == "success") {
                $(".stall_select").html(result);
            }
        }
    }); 
}); 