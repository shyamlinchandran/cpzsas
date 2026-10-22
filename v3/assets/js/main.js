toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
}

var issubmited = 0;
$(document).keydown(function (e) {
    var key = e.charCode || e.keyCode || 0;
    if (key === 115) {
        if (issubmited === 0) {
            //formsubmit($("#frmcreate"));
            //$('.frmcreate').trigger('submit');
            $('.form-button-save').click();
        }
    }
});
$('#searchmenu').keyup(function () {
    var that = this,
        $allListElements = $('.sidebar ul > li');
    var $matchingListElements = $allListElements.filter(function (i, li) {
        var listItemText = $(li).text().toUpperCase(),
            searchText = that.value.toUpperCase();
        return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
});
var add_back = '';

function guid() {
    return "ss".replace(/s/g, s4);
}

function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
}

function addHistoryBred(url, text, html) {
    if (text.trim() !== '' && text.trim() !== 'Sign out') {
        var item = {
            url: url,
            text: text,
            html: html
        };
        if (lastUrls !== null) {
            if (lastUrls.length === 6) {
                lastUrls.shift();
            }
        }
        if (lastUrls !== null) {
            if (!lastUrls.find(o => o.url === url && o.text === text)) {
                lastUrls.push(item);
            }
        } else {
            lastUrls = [];
            lastUrls.push(item);
        }
        genbreds();
    }
    localStorage.setItem('addHistoryBred', JSON.stringify(lastUrls));
}
// Revert to a previously saved state
window.addEventListener('popstate', function (event) {

    console.log(window.location.href);
    $("#div1").html(event.state);

    if (window.location.href.indexOf('dashboard/admin') !== -1) {
        window.location.reload();
    }
});

function historyanch(index) {
    $.each(lastUrls, function (ind, value) {
        if (index.trim() === value.text.trim()) {
            $("#div1").html(value.html);
        }
    });
}

function genbreds() {

    if (lastUrls === null) {
        return;
    }
    var ach = '';
    var list = lastUrls;
    $.each(list, function (index, value) {
        ach = ach + '<li> <a onclick="historyanch(\'' + value.text.trim() + '\')"   >' + value.text + '</a><span class="sm" index="' + index + '"></li>';
    });
    $("#achHis").html(ach);
}
$(document).ajaxError(function () {
    showpage();
    // alert("An error occurred!");
});
$(document).on('click', ".sm", function (event) {
    var index = $(this).attr('index');
    lastUrls.splice(index, 1);
    genbreds();
});
$(document).on('click', "a", function (event) {
    var self = this;

    var ckeid = $(this).attr('class');

    if (ckeid != undefined && ckeid.indexOf('cke') !== -1) {
        return;
    }
    var Main = $(this).attr('Main');
    var data_toggle = $(this).attr('data-toggle');
    if (data_toggle === "tab") {
        return;
    }
    if (data_toggle === "collapse") {
        return;
    }
    $('.tooltip').remove();
    if (Main === "Main") {
        $.ajax({
            url: href,
            success: function () {
                window.location.reload();
            }
        });
        return;
    }
    var href = $(this).attr('href');
    if (href === '#' || href == undefined) {
        return;
    }
    href = href.replace('?newpage=new', '');
    hidepage();
    var tp = $(this).attr('tp');
    var back = $(this).attr('back');
    if (back !== '' && back !== undefined) {
        add_back = back;
    } else {
        add_back = '';
    }
    if (tp === 'new') {
        showpage();
        return;
    }
    if (tp === 'self') {
        his_back = readCookie('last_click');
        createCookie('last_click', href, 3);
        window.location = href;
        return;
    } else {
        if (tp === 'confirm') {
            event.preventDefault();
            var message = $(this).attr('message');
            var suc = $(this).attr('success');
            var action = $(this).attr("href");
            var base = $(this).attr("base");
            bootbox.confirm({
                message: message,
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result === true) {
                        $.ajax({
                            url: action,
                            success: function () {
                                toastr["success"](suc);
                                showpage();
                                $.ajax({
                                    url: base,
                                    success: function (result) {
                                        $("#div1").html(result);
                                    }
                                });
                            },
                            error: function (jqXHR, exception) {
                                var msg = '';
                                if (jqXHR.status === 0) {
                                    msg = 'Not connect.\n Verify Network.';
                                } else if (jqXHR.status === 404) {
                                    msg = 'Requested page not found. [404]';
                                } else if (jqXHR.status === 500) {
                                    msg = 'Internal Server Error [500].';
                                } else if (exception === 'parsererror') {
                                    msg = 'Requested JSON parse failed.';
                                } else if (exception === 'timeout') {
                                    msg = 'Time out error.';
                                } else if (exception === 'abort') {
                                    msg = 'Ajax request aborted.';
                                } else {
                                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                }
                                if (jqXHR.status !== 0) {
                                    var errurl = base_url_triger + "Exption/saveerror";
                                    $.post(errurl, {
                                        err_url: action,
                                        err_text: msg,
                                        errr_num: jqXHR.status
                                    },
                                        function (data, status) {
                                            $("#div1").html(data);
                                        });
                                } else {
                                    $("#div1").html(gettxterror());
                                }
                            }
                        });
                    } else {
                        showpage();
                        return;
                    }
                }
            });
        } else
            if (href !== null && href !== undefined) {
                last_click = href;
                createCookie('tp', tp, 3);
                $(this).parent().siblings().removeClass('active');
                $(this).parent().addClass('active');
                event.preventDefault();
                $.ajax({
                    url: href,
                    success: function (result) {
                        history.pushState(result, event.target.textContent, href + "?newpage=new");
                        if ($(self).text() !== '') {
                            addHistoryBred(href, $(self).text(), result)
                        }
                        if (tp === 'pdf') {
                            // var iframe = $('<iframe id="printf" name="printf" style="margin-left:20vh;width:100vh;height:100vh;">');
                            // iframe.attr('src', href);
                            // $('#div1').html(iframe);
                            // window.frames["printf"].focus();
                            // window.frames["printf"].print();
                            pdfpage(href);
                        } else {
                            his_back = readCookie('last_click');
                            createCookie('last_click', href, 3);
                            if (tp === 'popup') {
                                var id_gen = guid();
                                $("<div>" + result + " </div>").PopupWindow({
                                    title: "Sales ",
                                    modal: false,
                                    state: "maximized"
                                });
                            } else {

                                $("#div1").html(result);
                                let r = Math.random().toString(36).substring(7);
                                $('.glyphicon-plus').parent().attr('id', r);
                                var id = "#" + r;
                                $(document).bind('keydown', 'f3', function (evt) {
                                    evt.preventDefault();
                                    $(id).click();
                                    return false;
                                });
                            }
                        }
                        showpage();
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status === 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status === 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        if (jqXHR.status !== 0) {
                            var errurl = base_url_triger + "Exption/saveerror";
                            $.post(errurl, {
                                err_url: action,
                                err_text: msg,
                                errr_num: jqXHR.status
                            },
                                function (data, status) {
                                    $("#div1").html(data);
                                });
                        } else {
                            $("#div1").html(gettxterror());
                        }
                    }
                });
            }
        // 
    }


});


function gettxterror() {
    var s = '<section class="content"> <div class="error-page">        <h2 class="headline text-red">0</h2>' +
        '<div class="error-content">' +
        '<h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>' +
        '<p> Please check your Internet' + '</p> </div>  </div>  </section>';
    return s;
}

function hidepage() {
    $(".cont").css("opacity", 0);
    $("#loading-img").css({
        "display": "block"
    });
}

function showpage() {
    setTimeout(function () {
        $(".cont").css("opacity", 1);
        $("#loading-img").css({
            "display": "none"
        });
    }, 100);
}

$(document).on('hide.bs.modal', '#myModalPop', function () {
    $('#modal-body').html('');
});

function formsubmit(frm) {
    if (!$(this).isValid()) {
        return;
    }
    $(this).find("input[type='submit']").prop('disabled', true);
    hidepage();
    var is_model = $('#is_model').val();
    var $form = $(frm);
    var id = $form.attr('id');
    issubmited = 1;
    var ms = $("#" + id).isValid();
    if (ms !== true) {
        return;
    }
    var url = $(frm).attr('action');
    var noajax = $(frm).attr('noajax');
    var end = $(frm).attr("enctype");
    if (end === "multipart/form-data" && document.getElementById("file") !== null) {

        var file = document.getElementById("file").files[0];
        var data = new FormData();
        data.append("file", file);
        var other_data = $(frm).serializeArray();
        $.each(other_data, function (key, input) {
            data.append(input.name, input.value);
        });
        $.ajax({
            type: 'POST',
            url: url,
            data: data, // send it here
            contentType: false, // this
            processData: false, // and this should be false in case of uploading files
            beforeSend: function (xhr) { },
            success: function (Onj) {
                var wsQuery = JSON.parse(Onj);
                if (wsQuery.bill !== undefined && wsQuery.bill !== '') {
                    navigate(wsQuery.bill);
                }
                if (is_model === '1') {
                    showpage();
                    $('#mcb').click();
                    return;
                }
                setTimeout(function () {
                    toastr["success"](wsQuery.message);
                    showpage();
                }, 1000);
                var back = $(frm).attr('back');
                $.ajax({
                    url: back,
                    success: function (result) {
                        $("#div1").html(result);
                        issubmited = 0;
                    }
                });
                showpage();
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status === 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status === 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                if (jqXHR.status !== 0) {
                    var errurl = base_url_triger + "Exption/saveerror";
                    $.post(errurl, {
                        err_url: url,
                        err_text: msg,
                        errr_num: jqXHR.status
                    },
                        function (data, status) {
                            $("#div1").html(data);
                        });
                } else {
                    $("#div1").html(gettxterror());
                }
            }
        });

    } else {
        if (noajax !== 's') {
            var curd = $(frm).attr('curd');

            event.preventDefault();
            $.ajax({
                url: url,
                data: $(frm).serialize(),
                type: 'POST',
                dataType: 'json',
                success: function (wsQuery) {
                    var ledger_hide = $('#ledger_hide').val();
                    if (ledger_hide === 'yes') {
                        var message = "Do you like to edit this "
                        if (wsQuery.ref_code === 'sup') {
                            message = message + "  Supplier ?";
                        } else {
                            message = message + "  Customer ?";
                        }
                        bootbox.confirm({
                            message: message,
                            buttons: {
                                confirm: {
                                    label: 'Yes',
                                    className: 'btn-success'
                                },
                                cancel: {
                                    label: 'No',
                                    className: 'btn-danger'
                                }
                            },
                            callback: function (result) {
                                if (result === true) {
                                    if (wsQuery.ref_code === 'sup') {
                                        $("#last_click").attr('href', base_url_triger + "suppliers/edit/" + wsQuery.id + "?newpage=new");
                                        $("#last_click").click();
                                    } else {
                                        $("#last_click").attr('href', base_url_triger + "customers/edit/" + wsQuery.id + "?newpage=new");
                                        $("#last_click").click();
                                    }
                                } else {
                                    setTimeout(function () {
                                        toastr["success"](wsQuery.message);
                                        showpage();
                                    }, 1000);
                                    var back = $(frm).attr('back');
                                    $.ajax({
                                        url: back,
                                        success: function (result) {
                                            $("#div1").html(result);
                                            issubmited = 0;
                                        }
                                    });
                                }
                            }
                        });
                    } else {
                        if (curd === 'curd') {
                            $(frm)[0].reset();
                            setTimeout(function () {
                                toastr["success"]('Saved Successfuly');
                                showpage();
                                $.ajax({
                                    url: list_url,
                                    success: function (result) {
                                        $("#div1").html(result);
                                    }
                                });
                            }, 1000);
                        } else {
                            var lstype = $(frm).attr('clr');
                            if (lstype !== undefined && lstype !== '') {
                                localStorage.setItem(lstype, '');
                            }
                            try {
                                if (wsQuery.bill !== undefined && wsQuery.bill !== '') {
                                    printJS({
                                        printable: wsQuery.bill,
                                        type: 'pdf',
                                        showModal: false
                                    })
                                }
                            } catch (err) {

                            }
                            if (is_model === '1') {
                                showpage();
                                $('#mcb').click();
                                return;
                            }
                            setTimeout(function () {
                                toastr["success"](wsQuery.message);
                                showpage();
                            }, 1000);
                            var back = $(frm).attr('back');
                            $.ajax({
                                url: back,
                                success: function (result) {
                                    $("#div1").html(result);
                                    issubmited = 0;
                                }
                            });
                        }
                    }
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status === 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status === 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    if (jqXHR.status !== 0) {
                        var errurl = base_url_triger + "Exption/saveerror";
                        $.post(errurl, {
                            err_url: url,
                            err_text: msg,
                            errr_num: jqXHR.status
                        },
                            function (data, status) {
                                $("#div1").html(data);
                            });
                    } else {
                        $("#div1").html(gettxterror());
                    }
                }
            });
        }
    }
}
$(document).on('submit', "form", function (event) {
    event.preventDefault();
    $(this).find("input[type='submit']").prop('disabled', true);
    formsubmit(this);
})
$(document).on('click', function (event) {
    $('.tooltip').remove();
});
$(document).on('change', ".two-digits", function () {
    if (isNaN(parseFloat(this.value)))
        return;
    this.value = parseFloat(this.value).toFixed(3);
});
$(document).on('keyup', ".date", function () {
    // alert($(this).val());
});
$(document).ready(function () {
    var last_click = readCookie('last_click');
    var cutomerDetailsDB = localStorage.getItem('addHistoryBred');
    lastUrls = JSON.parse(cutomerDetailsDB);
    newpage();
    genbreds();
    showpage();
    $('#back_all').click(function () {
        click(last_click)
    });
});
function pdfpage(newpage) { 
    var div = '           <section class="content">' +
        '<div class="box"> <iframe id="printf" src="' + newpage + '" name="printf" style=" width:100%;height:100vh"></div>             </section>';
    $('#div1').html(div);
    window.frames["printf"].focus();
    window.frames["printf"].print();
}
function newpage() {
    var last_click = readCookie('last_click');
    var newpage = readCookie('newpage');
    //console.log(newpage.indexOf('dashboard')); 
    if (newpage === last_click) {
        var tp = readCookie('tp');
        if (tp === 'pdf') {
            pdfpage(newpage);
            //eraseCookie('newpage')
        } else {
            if (newpage != null && newpage.indexOf('logout') === -1 && newpage.indexOf('dashboard') === -1) {
                $("#last_click").attr('href', newpage + "?newpage=new");
                $("#last_click").click();
                //eraseCookie('newpage')
            }
        }
    } else {
        $('#back_all').click(function () {
            click(last_click)
        });
    }

}

function click(last_click) {
    if (last_click != null && last_click.indexOf('logout') === -1 && last_click.indexOf('dashboard') === -1) {
        $("#last_click").attr('href', last_click);
        $("#last_click").click();
    }
}

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else
        var expires = "";
    document.cookie = name + "=" + escape(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return unescape(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}