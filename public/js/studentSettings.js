/**
 * JQuery code which is included in the student settings page
 * 
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function () {
    var panels = ["Schedules", "Availabilities"];
    var sortableList1 = '',
        sortableList2 = '',
        panelsLength = panels.length,
        panelsLengthHalf = Math.floor(panelsLength/2);

    for (var i = 0; i < panelsLength; i++) {
        var element = '<div><table style="min-width: 180px;"><tr><td style="width:50px;">' + panels[i] + '</td></tr></table></div>';

        if (i < panelsLengthHalf) {
            sortableList1 = sortableList1 + element;
        } else {
            sortableList2 = sortableList2 + element;
        }
    }

    $("#sortableA").html(sortableList1);
    $("#sortableB").html(sortableList2);

    $("#sortableA, #sortableB").jqxSortable({
        connectWith: ".sortable",
        opacity: 0.5,
    });
});
