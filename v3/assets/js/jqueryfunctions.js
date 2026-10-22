/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function clearValue(ele)
{
    ele.val('');
}
function tr(val) {
    return "<tr>" + val + "</tr>";
}
function hidden(val, name,fn) {
 if (fn === undefined)
    {
        fn = '';
    }    return " <input name='" + name + "' " + fn + "  value='" + val + "' type='hidden' />";
}
function tdhtml(val) {
    return "<td>" + val + "</td>";
}


function td(val, name, al, fn, tdclas = "", poptxt = null) {
    if (fn === undefined)
    {
        fn = '';
    }
    if (tdclas !== "") {
        tdclas = " class='" + tdclas + "'";
    }
    if (poptxt !== null) {
        al = 'myspop';

        return "<td " + tdclas + "> <input data-toggle='popover' data-container='body' data-html='true' data-placement='bottom' data-trigger='hover' title='" + val + "' data-content='" + poptxt + "' style='height:25px' name='" + name + "'  " + fn + "  class='form-control " + al + "' value='" + val + "' readonly='readonly'   /></td>";
    }
    return "<td " + tdclas + "> <input  title='" + val + "'  style='height:25px' name='" + name + "'  " + fn + "  class='form-control " + al + "' value='" + val + "' readonly='readonly'   /></td>";
}
function tde(val, name, al, fn) {
    if (fn === undefined)
    {
        fn = null;
    }
    return "<td> <input style='height:25px' name='" + name + "' " + fn + "  class='form-control " + al + "' value='" + val + "' tabindex='-1' /></td>";
}
function tdes(val, name, al, fn) {
    if (fn === undefined)
    {
        fn = null;
    }
    return " <input style='height:25px' name='" + name + "' " + fn + "  class='form-control " + al + "' value='" + val + "' tabindex='-1' />";
}
