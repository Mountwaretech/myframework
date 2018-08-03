/*
Created by Bala murugan
Email: inventorbala@gmail.com    
contact: 9524435595
Date : 12/01/2018 08:48: PM
path name
*/
var mainpath = window.location.protocol + "//" + location.host + "/";

$(document).on("click", "._cls_p_icn8,.popup-mdl-bg,.close_popup_btn,._pop_close,.close_btn", function() {
    popup_close();
});

$(document).on("click", "._bck_notify", function() {
    window.location.assign($(this).attr("data-href"));
});

$(document).on("click", "._radiobx_dis", function() {
    $("._radiobx_dis").each(function() {
        $(this).removeClass("actv");
        $(this).find(".chk_bx_fltr").removeClass("actv");
    });
    $(this).addClass("actv").find(".chk_bx_fltr").addClass("actv");
    $(this).find(".radio_filert_box").prop("checked", true).promise().done(function() {
        var $data_val = $(".radio_filert_box:checked").val();
    });
});

$(document).on("click", "._radiobx_disbx", function() {
    $("._radiobx_disbx").each(function() {
        $(this).removeClass("actv");
        $(this).find(".radio_bx_fltr").removeClass("actv");
    });
    $(this).addClass("actv").find(".radio_bx_fltr").addClass("actv");
    $(this).find("._radiobx_dis").prop("checked", true).promise().done(function() {});
});









/* ///////////////////////////////////////// Message Box Function /////////////////////////////////////////////////*/

function message_box($status, $msg, $time) {

    if ($status == "success") {
        $(".bx-msg-data").html("<div class='alert alert-success' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }
    if ($status == "mail_success") {
        $(".bx-msg-data").html("<div class='alert alert-success' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }

    if ($status == "pop_success") {
        $(".bx-msg-data").html("<div class='alert alert-success' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }
    if ($status == "paid_sucess") {
        $(".bx-msg-data").html("<div class='alert alert-success' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }

    if ($status == "error") {
        $(".bx-msg-data").html("<div class='alert alert-danger' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }
    if ($status == "exists") {
        $(".bx-msg-data").html("<div class='alert alert-warning' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }
    if ($status == "error_resp") {
        $(".bx-msg-data").html("<div class='alert alert-warning' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }


    if ($status == "active") {
        $(".bx-msg-data").html("<div class='alert alert-success' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }
    if ($status == "deactive") {
        $(".bx-msg-data").html("<div class='alert alert-danger' style='margin-top: -13px;'>" + $msg + "</div>").css('display', 'block');

    }


    if ($time != null) {
        setTimeout(function() {
            $(".bx-msg-data").fadeOut(200).promise().done(function() {
                $(this).html('');
            });
        }, parseInt($time));
    }

}

var popup_close = {};

function popup_init() {
    if (!$("#cdn-ld-frm").hasClass("actv")) {
        $("#cdn-ld-frm").fadeIn(500).addClass("actv");
    } else {
        $("#cdn-ld-frm").fadeIn(500);
    }
    $("#popup-blk").html($(".pop_up_init").html()).addClass("actv");
    popup_close.status = false;
}

function popup_data($data, resp, close_btn) {
    $("#popup-blk").html($data).promise().done(function() {
        $(this).addClass("actv");
        if (close_btn === undefined) {
            $(".close_popup_btn").fadeIn(100);
        }
        if (resp !== null && resp !== undefined) {
            resp({
                current_status: "success",
                this_data: $("#popup-blk")
            });
        }
    });

}
var popup_close = function() {
    $("#cdn-ld-frm").fadeOut(200).promise().done(function() {
        $(".close_popup_btn").fadeOut(100);
        $("#popup-blk").empty().removeClass("actv");
        $("#pop-innr-bx").css({
            top: '0px',
            left: '0px'
        });
    });
    popup_close.status = true;
}

function timeout_href($href_url, $duration) {
    setTimeout(function() {
        if ($href_url != null && $href_url != undefined) {
            window.location.assign($href_url);
        } else {
            window.location.assign(window.location.href);

        }

    }, $duration);
}

/*  IMAGE UPLOAD FUNCTION Jquery */
$(document).on("click", "#image_url", function() {
    $("#img_logo_file").click();
});
$(document).on("change", "#img_logo_file", function() {
    var i;
    for (i = 0; i < $(this)[0].files.length; i++) {
        var file = $(this)[0].files[i];
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if (file) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e) {
                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    $('._com_src_log').css({ "display": "block" });
                    $("._com_src_log").attr("src", e.target.result).fadeIn(100);
                } else {
                    $('._com_src_log').attr('src', '');
                    $('._com_src_log').css({ "display": "none" });
                }
            };
        }
    }
});



/*  IMAGE UPLOAD FUNCTION Jquery */
$(document).on("click", "#upload_filebtn", function() {
    $("#upload_file").click();
    return false;
});
$(document).on("change", "#upload_file", function() {
    var file = $(this)[0].files;
    imgPath = $(this)[0].value,
        extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    $('.upload_reader').css("display", "inline-block");
    $('.upload_reader').html(file[0].name);
    return false;
});

$(document).on("click", "._toggle_class", function() {
    var $this_data = $(this);
    if (!$this_data.hasClass("active")) {
        $this_data.addClass("active");
        $("._toggle_act_bx").addClass("active");
    } else {
        $this_data.removeClass("active");
        $("._toggle_act_bx").removeClass("active");
    }

});


$(document).on("click", ".tp_nv_icn4", function() {
    if (!$(".top-nav_hdr").hasClass("actv")) {
        $(".top-nav_hdr").addClass("actv");
    }
});
$(document).on("click", function(e) {
    if ($(e.target).closest(".tp_nv_icn4").length == 0) {
        $(".top-nav_hdr").removeClass("actv");
    }
});

$(document).on("keypress", "._num_type", function(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
});

$(document).on("keypress", ".pri_valid", function(eve) {
    if ((eve.which != 46 || $(this).val().indexOf('.') != -1) &&
        (eve.which < 48 || eve.which > 57) ||
        ($(this).val().indexOf('.') == 0)
    ) {
        eve.preventDefault();
    }
});


function img_load_buffer(this_data, fadeTime, response, easing, progress_bx, width_img, height_img) {
    if (fadeTime === null && fadeTime === undefined) {
        fadeTime = 500;
    }
    if (easing === null && easing === undefined) {
        easing = 'easeOutExpo';
    }
    if (!this_data.hasClass("prcs")) {
        if (width_img !== null && width_img !== undefined) {
            if (width_img < height_img) {
                this_data.css({
                    width: '100%',
                    height: 'auto'
                });
            } else {
                this_data.css({
                    width: 'auto',
                    height: '100%'
                });
            }
        }
        var this_ref = this_data;
        this_data.attr("src", this_data.attr("data-src")).load(function() {
            if (progress_bx !== null && progress_bx !== undefined) {
                progress_bx.fadeOut(1);
            }
            this_data.addClass("prcs").fadeIn(fadeTime).promise().done(function() {

                $(this).closest(".img_prod_bx-mn-lst").fadeIn(fadeTime, easing);

            });
            if (response !== null && response !== undefined) {
                response({
                    current_status: "success"
                });
            }
        });
    }

}

$(document).on("click", "._log_out_fn", function() {
    var $this_val = $(this);
    var $data_val = {
        action: "_log_out_func"
    };
    var func_pathname = mainpath + 'glb_data_func';
    $.ajax({
        type: 'POST',
        url: func_pathname,
        data: $data_val,
        dataType: "json",
        cache: false,
        success: function(result, status) {
            if (result.current_status == "success") {
                message_box(result.current_status, result.msg, 3000);
                setTimeout(function() {
                    window.location.assign(result.url);
                }, 2000);

            }
        }
    });
});
$(document).on("click", ".nav-user", function() {
    var this_id = $(this);
    if (!$(this).hasClass("_bx_act")) {
        this_id.addClass("_bx_act");
        $(".sett_mnubx").addClass("_bx_act");
    } else {
        this_id.removeClass("_bx_act");
        $(".sett_mnubx").removeClass("_bx_act");
    }
});

$(document).on("click", "body", function(e) {
    if ($(e.target).closest('.nav-user').length == 0) {
        $(".nav-user").removeClass("_bx_act");
        $(".sett_mnubx").removeClass("_bx_act");
    }
});

$(document).on("click", ".sett_mnubx", function(e) {
    e.stopPropagation();
});


$.fn.extend({
    timeline: function(params) {
        var response;
        $(this).find(".ref_filter_opt").on("click", function(e) {

            if (!$(".ref_filter_opt").hasClass("active")) {
                $(".ref_filter_opt,.blk_filter-cont-box").addClass("active");
            } else {
                $(".ref_filter_opt,.blk_filter-cont-box").removeClass("active");
            }
        });
        /*click*/
        $(this).find("li.-actn-lnk").on("click", function() {
            var $this_val = $(this);
            $data_label = $this_val.attr("data-label");
            if ($data_label === "Custom Range") {
                $(".span_fil_val").html($data_label);
                $(".ref_filter_opt,.blk_filter-cont-box").removeClass("active");
                $(".cutom_libx").addClass("dis_block").promise().done(function() {
                    $('.custom_fromdate').bootstrapMaterialDatePicker({ format: "dddd DD MMMM YYYY ", weekStart: 0, time: false }).on('change', function(e, date) {
                        $('.custom_fromdate').val(date.format("YYYY-MM-DD"));
                        $('.custom_todate').bootstrapMaterialDatePicker('setMinDate', date).focus();
                    });
                    $('.custom_todate').bootstrapMaterialDatePicker({ format: "dddd DD MMMM YYYY ", weekStart: 0, time: false }).on('change', function(e, date) {
                        $('.custom_todate').val(date.format("YYYY-MM-DD"));
                    });
                });
            } else {
                $label_data = $this_val.attr("data-label");
                $from_date = $this_val.attr("data-fromdate");
                $to_date = $this_val.attr("data-todate");
                $(".span_fil_val").html($data_label);
                $("li.-actn-lnk").removeClass("active");
                $this_val.addClass("active");

                $(".cutom_libx").removeClass("dis_block");
                response = {
                    "from_date": $from_date,
                    "to_date": $to_date,
                    "label_data": $label_data
                };
                if ($this_val.attr("data-date") !== undefined) {
                    response.data_date = $this_val.attr("data-date");
                }
                params.select(response);
            }
        });
        $(this).find(".apply_btn").on("click", function(e) {
            e.preventDefault();
            var this_id = $(this);
            $from_date = $(".custom_fromdate").val();
            $to_date = $(".custom_todate").val();
            $label_data = "custom_date";
            $(".span_fil_val").html($from_date + " to " + $to_date);
            response = {
                "from_date": $from_date,
                "to_date": $to_date,
                "label_data": $label_data,
                "data_date": [$from_date, $to_date],
                "date_type": "custom_pick"
            };
            params.select(response);
        });


        $(this).find(".cutom_libx input").on("click", function() {
            $(".ref_filter_opt,.blk_filter-cont-box").removeClass("active");
        })

        $(document).on("click", "body", function(e) {
            if ($(e.target).closest('.ref_filter_opt').length == 0) {
                $(".ref_filter_opt,.blk_filter-cont-box").removeClass("active");
            }
        });
    }
});