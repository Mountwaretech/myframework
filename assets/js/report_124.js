var reprt_path = window.location.protocol + "//" + location.host + "/";

var _load_reprt_data = {};
var load_status_prod = false;
_load_reprt_data.init = function($resp) {
    if (load_status_prod)
        return
    load_status_prod = true;
    $("._pro_loder_bx").css("display", "block");
    var $data_ref = new FormData($("#_load_report_FRM")[0]);
    $data_ref.append("action", "_load_report_func");
    $.ajax({
        url: reprt_path + "report_func",
        type: "POST",
        data: $data_ref,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result, status) {
            //console.log(result);
            if (status == "success") {
                $("._pro_loder_bx").css("display", "none");
                $(".apxbx12_data").html(result).addClass("_actv").promise().done(function() {
                    load_status_prod = false;
                    $('#example').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'csvHtml5',
                                text: "csv",
                                title: title_table
                            },
                            {
                                extend: 'excelHtml5',
                                text: "excel",
                                title: title_table
                            },
                            {
                                extend: 'pdfHtml5',
                                text: "PDF",
                                pageSize: 'A2',
                                title: title_table,
                                customize: function(win) {
                                    win['header'] = (function() {
                                        return {
                                            columns: [{
                                                    image: logo,
                                                    width: 50,
                                                    margin: [25, 0]
                                                },
                                                {
                                                    alignment: 'left',
                                                    text: 'SMART CARD',
                                                    fontSize: 25,
                                                    margin: [30, 10]
                                                }

                                            ]
                                        }
                                    });
                                    win['footer'] = (function() {
                                        return {
                                            columns: [{
                                                    alignment: 'right',
                                                    text: footer_title,
                                                    fontSize: 11,
                                                    margin: [20, 10]
                                                }

                                            ]
                                        }
                                    });

                                }
                            },
                            {
                                extend: 'print',
                                text: "print",
                                pageSize: 'A2',
                                orientation: "landscape",
                                title: title_table,
                                customize: function(win) {
                                    var data = '<div style="position:relative;padding:10px;display:block;font-weight: bold;font-size: 30px;"><img src="' + logo + '" style="position:relative;width: 150px;" /><div style="display:block;font-weight: bold;font-size: 30px;position: relative;text-align: center;">SMART CARD APP</div> <span style="position:absolute;top: 20px;right: 20px;font-weight: 400;font-size: 15px;">';
                                    data += curr_date + '</span></div>';
                                    $(win.document.body)
                                        .prepend(data).find("h1").css({ 'font-size': '25px', 'padding': '5px 25px', 'text-align': 'center' });
                                    $(win.document.body).append("<div style='position: fixed;right: 10px;bottom: 0px;font-size:12px;'>" + footer_title + "</div>");

                                }
                            }
                        ]
                    });
                })
            }
        }
    });
    return false;
} 

var mywindow;
$(document).on("click", ".print_btn", function() {
    mywindow = window.open();
    var data = '<html><head><title>' + title_table + ' </title></head>';
    data += '<div style="position:relative;padding:10px;display:block;font-weight: bold;font-size: 30px;"><img src="' + logo + '" style="position:relative;width: 150px;" /><div style="display:block;font-weight: bold;font-size: 30px;position: relative;text-align: center;">HYDAC INDIA PVT LTD</div> <span style="position:absolute;top: 20px;right: 20px;font-weight: 400;font-size: 15px;">';
    data += curr_date + '</span></div>';
    mywindow.document.write(data);
    mywindow.document.write($('#printarea').html());
    mywindow.document.write('<div style="position: fixed;right: 10px;bottom: 0px;font-size:12px;">' + footer_title + '</div>');
    mywindow.document.write('</body></html>');
    mywindow.print();
    mywindow.close();
});

var generatePDF = function() {
    kendo.drawing.drawDOM($("#printarea")).then(function(group) {
        var $success = kendo.drawing.pdf.saveAs(group, title_table + ".pdf");
        setTimeout(function() {
            window.top.close();
        }, 3000)
    });
}


$(document).on("click", "._page_ur_link", function() {
    var $this_href = $(this).attr("data-href");
    window.location.assign($this_href);
});

function _sales_prod_data($sales_uniqueid) {
    load_status_prod = true;
    $("._pro_loder_bx").css("display", "block");
    var $data_ref = { action: "sales_prod_data", sales_uniqueid: $sales_uniqueid };
    $.ajax({
        url: reprt_path + "report_func",
        type: "POST",
        data: $data_ref,
        cache: false,
        success: function(result, status) {
            if (status == "success") {
                $("._pro_loder_bx").css("display", "none");
                $(".sales_proddata").html(result).addClass("_actv").promise().done(function() {
                    load_status_prod = false;
                    $('#example').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'csvHtml5',
                                text: "csv",
                                title: title_table
                            },
                            {
                                extend: 'excelHtml5',
                                text: "excel",
                                title: title_table
                            },
                            {
                                extend: 'pdfHtml5',
                                text: "PDF",
                                pageSize: 'A2',
                                title: title_table,
                                customize: function(win) {
                                    win['header'] = (function() {
                                        return {
                                            columns: [{
                                                    image: logo,
                                                    width: 50,
                                                    margin: [25, 0]
                                                },
                                                {
                                                    alignment: 'left',
                                                    text: 'SMART CARD',
                                                    fontSize: 25,
                                                    margin: [30, 10]
                                                }

                                            ]
                                        }
                                    });
                                    win['footer'] = (function() {
                                        return {
                                            columns: [{
                                                    alignment: 'right',
                                                    text: footer_title,
                                                    fontSize: 11,
                                                    margin: [20, 10]
                                                }

                                            ]
                                        }
                                    });

                                }
                            },
                            {
                                extend: 'print',
                                text: "print",
                                pageSize: 'A2',
                                orientation: "landscape",
                                title: title_table,
                                customize: function(win) {
                                    var data = '<div style="position:relative;padding:10px;display:block;font-weight: bold;font-size: 30px;"><img src="' + logo + '" style="position:relative;width: 150px;" /><div style="display:block;font-weight: bold;font-size: 30px;position: relative;text-align: center;">SMART CARD APP</div> <span style="position:absolute;top: 20px;right: 20px;font-weight: 400;font-size: 15px;">';
                                    data += curr_date + '</span></div>';
                                    $(win.document.body)
                                        .prepend(data).find("h1").css({ 'font-size': '25px', 'padding': '5px 25px', 'text-align': 'center' });
                                    $(win.document.body).append("<div style='position: fixed;right: 10px;bottom: 0px;font-size:12px;'>" + footer_title + "</div>");

                                }
                            }
                        ]
                    });
                })
            }
        }
    });
}



function _sales_cash_prod_data($sales_uniqueid) {
    load_status_prod = true;
    $("._pro_loder_bx").css("display", "block");
    var $data_ref = { action: "sales_cash_prod_data", sales_uniqueid: $sales_uniqueid };
    $.ajax({
        url: reprt_path + "report_func",
        type: "POST",
        data: $data_ref,
        cache: false,
        success: function(result, status) {
            if (status == "success") {
                $("._pro_loder_bx").css("display", "none");
                $(".sales_proddata").html(result).addClass("_actv").promise().done(function() {
                    load_status_prod = false;
                    $('#example').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'csvHtml5',
                                text: "csv",
                                title: title_table
                            },
                            {
                                extend: 'excelHtml5',
                                text: "excel",
                                title: title_table
                            },
                            {
                                extend: 'pdfHtml5',
                                text: "PDF",
                                pageSize: 'A2',
                                title: title_table,
                                customize: function(win) {
                                    win['header'] = (function() {
                                        return {
                                            columns: [{
                                                    image: logo,
                                                    width: 50,
                                                    margin: [25, 0]
                                                },
                                                {
                                                    alignment: 'left',
                                                    text: 'SMART CARD',
                                                    fontSize: 25,
                                                    margin: [30, 10]
                                                }

                                            ]
                                        }
                                    });
                                    win['footer'] = (function() {
                                        return {
                                            columns: [{
                                                    alignment: 'right',
                                                    text: footer_title,
                                                    fontSize: 11,
                                                    margin: [20, 10]
                                                }

                                            ]
                                        }
                                    });

                                }
                            },
                            {
                                extend: 'print',
                                text: "print",
                                pageSize: 'A2',
                                orientation: "landscape",
                                title: title_table,
                                customize: function(win) {
                                    var data = '<div style="position:relative;padding:10px;display:block;font-weight: bold;font-size: 30px;"><img src="' + logo + '" style="position:relative;width: 150px;" /><div style="display:block;font-weight: bold;font-size: 30px;position: relative;text-align: center;">SMART CARD APP</div> <span style="position:absolute;top: 20px;right: 20px;font-weight: 400;font-size: 15px;">';
                                    data += curr_date + '</span></div>';
                                    $(win.document.body)
                                        .prepend(data).find("h1").css({ 'font-size': '25px', 'padding': '5px 25px', 'text-align': 'center' });
                                    $(win.document.body).append("<div style='position: fixed;right: 10px;bottom: 0px;font-size:12px;'>" + footer_title + "</div>");

                                }
                            }
                        ]
                    });
                })
            }
        }
    });
}

$(document).on("change", ".report_filter_brnch", function() { 
  var $data_val=$(this).val();
   getBrandCashier($data_val);
   getBrandmachine($data_val);
}); 

$(document).on("click", ".filterbtnbx", function() { 
    _load_reprt_data.init();
    return false;
  }); 

  $(document).on("change", ".student_branch", function() { 
    _load_reprt_data.init();
    return false;
  }); 
  $(document).on("change", ".cash_userdata", function() { 
    _load_reprt_data.init();
    return false;
  }); 

function getBrandCashier($data_val)
{
    var $data_ref = { action: "filterBrch_Cashier", data_val: $data_val };
    $.ajax({
        url: reprt_path + "report_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            console.log(result);
            if (status == "success") {
                $(".select_casher_data").html(result);
            }
        }
    });
}



function getBrandmachine($data_val)
{
    var $data_ref = { action: "report_filter_machine", data_val: $data_val };
    $.ajax({
        url: reprt_path + "report_func",
        type: "POST",
        data: $data_ref,
        cache: true,
        success: function(result, status) {
            console.log(result);
            if (status == "success") {
                $(".report_filter_machine").html(result); 
            }
        }
    });
}

