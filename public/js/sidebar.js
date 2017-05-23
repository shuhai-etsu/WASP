/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in most of the pages that require a sidebar
 * Defines behavior when collapsible items are clicked upon
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */

$(document).ready(function () {
    $('[data-toggle=collapse]').click(function () {
        //$('.sidebar').toggleClass('active');
        $('.sidebar').toggleClass('aria-expanded="true"');
        //$('.sidebar').toggleClass('bg-primary');
    });

    $('#hamburger').click(function () {
        window.scrollTo(0, 0);
    });
});