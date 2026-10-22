$(function () {
    $("#mClick").bind("click", function () {
        ismodel = true;
        $('#crudForm').trigger('submit');

    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        // do something...
        alert($('#insert_primary_key mdf').val());
    });
    $("#crudForm").bind('ajax:complete', function () {
        alert($('#insert_primary_key fdsf').val());
    });
});