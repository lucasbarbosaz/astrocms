$(document).ready(function(e) {
    $('#onlinecount').load('/api/count');
   
    $.ajaxSetup({
        cache: true
    });
    setInterval(function() {
        $('#onlinecount').load('/api/count');
    }, 8000);
    $("#onlinecount").click(function() {
        $('#onlinecount').load('/api/count');
    });
});
