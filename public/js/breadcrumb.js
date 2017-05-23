/**
 * JQuery code which is included in the header for all pages for the breadcrumb functionality
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 */
$(document).ready(function () {
//Kudos to http://stackoverflow.com/questions/25844332/dynamic-breadcrumb-based-on-current-page-using-javascript-jquery
    var url = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
    var currentItem = $(".sidebar").find("[href$='" + url + "']");

    $("#breadcrumb").html($("<a href='/home'>Home</a>"));

    $(currentItem.parents("li").clone().get().reverse()).each(function () {
        $("#breadcrumb").append(" > ").append( $(this).children('a').clone().children().remove().end());//.text()
    });
});