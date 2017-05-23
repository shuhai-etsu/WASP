/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in the student profile page
 *
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */

$(document).ready(function () {
    
    $('.active[data-toggle="tabajax"]').each(function(e) {
        var $this = $(this),
            loadurl = $this.attr('href'),
            targ = $this.attr('data-target');

        $.get(loadurl, function(data) {
            $(targ).html(data);
        });

        $this.tab('show');//show the tab
        return false;
    });

    $('[data-toggle="tabajax"]').click(function(e) {
        var $this = $(this),
            loadurl = $this.attr('href'),
            targ = $this.attr('data-target');

        $.get(loadurl, function(data) {
            $(targ).html(data);
        });

        $this.tab('show');
        return false;
    });

});
