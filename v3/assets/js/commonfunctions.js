//common functions 
jQuery.fn.ForceNumericOnly = function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key === 8 ||
                key === 9 ||
                key === 13 ||
                key === 46 ||
                key === 110 ||
                key === 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105)
            );
        });
    });
};
jQuery.fn.nextTab = function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var noTab = $(this).attr('NoTab');
            if (noTab === undefined) {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13) {
                    /* FOCUS ELEMENT */
                    var next = $(this).attr('next');
                    if (next === undefined) {
                        var inputs = $(this).parents("form").eq(0).find(":input");
                        var idx = inputs.index(this);
                        if (idx === inputs.length - 1) {
                            inputs[0].select()
                        } else {
                            inputs[idx + 1].focus(); //  handles submit buttons
                            //inputs[idx + 1].select();
                        }
                        return false;
                    } else {
                        var id = "#" + next;
                        $(id).focus();
                    }

                }
            }
        });
    })
};

$(document).ready(function () {
    $('.form-control').change(function () {
        var nocap = $(this).attr('nocap');
        if (nocap !== 'true') {
            var sm = capitalizeFirstLetter($(this).val());
            $(this).val(sm);
        }
    });
    // $('.form-control').nextTab();
});