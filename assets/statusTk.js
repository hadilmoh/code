$(document).ready(function (){
    $("#state").change( function () {
        var s_tk = $(this).val();
        var tk_id = $("#tk_id").val();
        var code_ticket = $("#codeTicket").val(); 
        $.ajax({
            type: "POST",
            url: "view-ticket-insert.php",
            data: {
                status_tk : s_tk,
                tkID : tk_id,
                code : code_ticket
            },
            success: function () {
                // alert("done");
                location.reload();
            }
        });
    });
    
});
