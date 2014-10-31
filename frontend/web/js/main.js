jQuery(document).ready(function($) {
    var visitortimezone = -new Date().getTimezoneOffset()/60;
    $.cookie('time_zone', visitortimezone);
});