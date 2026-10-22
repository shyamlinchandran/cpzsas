var default_per_page = typeof default_per_page !== 'undefined' ? default_per_page : 25;
var oTable = null;
var oTableArray = [];
var oTableMapping = [];

function supports_html5_storage()
{
    try {
        JSON.parse("{}");
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

var use_storage = supports_html5_storage();

var aButtons = [];
var mColumns = [];

//$(document).ready(function () {
//    $('table.groceryCrudTable tfoot').html('');
//    $('table.groceryCrudTable thead tr th').each(function (index) {
//        if (!$(this).hasClass('actions'))
//        {
//            mColumns[index] = index;
//        }
//    });
//
//    if (!unset_export)
//    {
//        aButtons.push({
//            "sExtends": "xls",
//            "sButtonText": export_text,
//            "mColumns": mColumns
//        });
//    }
//
//    if (!unset_print)
//    {
//        aButtons.push({
//            "sExtends": "print",
//            "sButtonText": print_text,
//            "mColumns": mColumns
//        });
//    }
//
//    //For mutliplegrids disable bStateSave as it is causing many problems
//    if ($('.groceryCrudTable').length > 1) {
//        use_storage = false;
//    }
//
//    $('.groceryCrudTable').each(function (index) {
//        if (typeof oTableArray[index] !== 'undefined') {
//            return false;
//        }
//
//        oTableMapping[$(this).attr('id')] = index;
//
//        oTableArray[index] = loadDataTable(this);
//    });
//
//    $(".groceryCrudTable tfoot input").keyup(function () {
//
//        chosen_table = datatables_get_chosen_table($(this).closest('.groceryCrudTable'));
//
//        chosen_table.fnFilter(this.value, chosen_table.find("tfoot input").index(this));
//
//        if (use_storage)
//        {
//            var search_values_array = [];
//
//            chosen_table.find("tfoot tr th").each(function (index, value) {
//                search_values_array[index] = $(this).children(':first').val();
//            });
//
//            localStorage.setItem('datatables_search_' + unique_hash, '["' + search_values_array.join('","') + '"]');
//        }
//    });
//
//    var search_values = localStorage.getItem('datatables_search_' + unique_hash);
//
//    if (search_values !== null)
//    {
//        $.each($.parseJSON(search_values), function (num, val) {
//            if (val !== '')
//            {
//                $(".groceryCrudTable tfoot tr th:eq(" + num + ")").children(':first').val(val);
//            }
//        });
//    }
//
//    $('.clear-filtering').click(function () {
//        localStorage.removeItem('DataTables_' + unique_hash);
//        localStorage.removeItem('datatables_search_' + unique_hash);
//
//        chosen_table = datatables_get_chosen_table($(this).closest('.groceryCrudTable'));
//
//        chosen_table.fnFilterClear();
//        $(this).closest('.groceryCrudTable').find("tfoot tr th input").val("");
//    });
//
//    loadListenersForDatatables();
//
//    $('a.ui-button').on("mouseover mouseout", function (event) {
//        if (event.type == "mouseover") {
//            $(this).addClass('ui-state-hover');
//        } else {
//            $(this).removeClass('ui-state-hover');
//        }
//    });
//
//    $('th.actions').unbind('click');
//    $('th.actions>div .DataTables_sort_icon').remove();
//
//});

function loadListenersForDatatables() {

    $('.refresh-data').click(function () {
        var this_container = $(this).closest('.dataTablesContainer');

        var new_container = $("<div/>").addClass('dataTablesContainer');

        this_container.after(new_container);
        this_container.remove();

        $.ajax({
            url: $(this).attr('data-url'),
            success: function (my_output) {
                new_container.html(my_output);

                //loadDataTable(new_container.find('.groceryCrudTable'));

                loadListenersForDatatables();
            }
        });
    });
}

function loadDataTable(this_datatables) {
    return $(this_datatables).dataTable({

        "sPaginationType": "full_numbers",
        "bStateSave": use_storage,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('DataTables_' + unique_hash, JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('DataTables_' + unique_hash));
        },
        "iDisplayLength": default_per_page,
        "aaSorting": datatables_aaSorting,
        //		"oLanguage":{
        //		    "sProcessing":   list_loading,
        //		    "sLengthMenu":   show_entries_string,
        //		    "sZeroRecords":  list_no_items,
        //		    "sInfo":         displaying_paging_string,
        //		    "sInfoEmpty":   list_zero_entries,
        //		    "sInfoFiltered": filtered_from_string,
        //		    "sSearch":       search_string+":",
        //		    "oPaginate": {
        //		        "sFirst":    paging_first,
        //		        "sPrevious": paging_previous,
        //		        "sNext":     paging_next,
        //		        "sLast":     paging_last
        //		    }
        //		},
        "bDestory": true,
        "bRetrieve": true,
        "fnDrawCallback": function () {
            $('.image-thumbnail').fancybox({
                'transitionIn': 'elastic',
                'transitionOut': 'elastic',
                'speedIn': 600,
                'speedOut': 200,
                'overlayShow': false
            });
            add_edit_button_listener();
        },
        //"sDom": 'T<"clear"><"H"lfr><"F"ip>t', //<"F"ip>
        "dom": "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>R" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "oTableTools": {
            "aButtons": aButtons,
            "sSwfPath": base_url + "assets/grocery_crud/themes/datatables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
        }
    });
}

function datatables_get_chosen_table(table_as_object)
{
    chosen_table_index = oTableMapping[table_as_object.attr('id')];
    return oTableArray[chosen_table_index];
}

function delete_row(delete_url, row_id, msg = '')
{

    var smurl = delete_url.slice(0, delete_url.lastIndexOf('/'));
    smurl = smurl.slice(0, smurl.lastIndexOf('/'));
    var mspre = $("#exdt31_delf32").val();

    bootbox.confirm({
        message: mspre + msg,
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
                    url: delete_url,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.success)
                        {
                            success_message(data.success_message);
                            $("#backurl").attr('href', smurl);
                            $("#backurl").click();
                        } else
                        {
                            error_message(data.error_message);
                            $("#backurl").attr('href', smurl);
                            $("#backurl").click();
                        }
                    }
                });
            } else {
                return;
            }
        }
    });


    return false;
}

function fnGetSelected(oTableLocal)
{
    var aReturn = new Array();
    var aTrs = oTableLocal.fnGetNodes();

    for (var i = 0; i < aTrs.length; i++)
    {
        if ($(aTrs[i]).hasClass('row_selected'))
        {
            aReturn.push(aTrs[i]);
        }
    }
    return aReturn;
}

function success_message(success_message)
{
//	noty({
//		  text: success_message,
//		  type: 'success',
//		  dismissQueue: true,
//		  layout: 'top',
//		  callback: {
//		    afterShow: function() {
//
//		        setTimeout(function(){
//		        	$.noty.closeAll();
//		        },7000);
//		    }
//		  }
//	});

    var dialog = bootbox.dialog({
        message: '<p class="text-center">' + success_message + '</p>',
        closeButton: false,
    });
    setTimeout(function () {
        dialog.modal('hide');
    }, 1000);
}

function error_message(error_message)
{
    noty({
        text: error_message,
        type: 'error',
        layout: 'top',
        dismissQueue: true
    });
}
