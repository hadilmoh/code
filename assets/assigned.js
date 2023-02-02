            $(document).ready(function (){
                $("#assigned").change( function () {
                    var user = $(this).val();
                    var tk_id = $("#tk_id").val();
                    $.ajax({
                        type: "POST",
                        url: "view-ticket-insert.php",
                        data: {
                            idUser : user,
                            tkID : tk_id
                        },
                        success: function () {
                            // alert("done");
                            location.reload();
                        }
                    });
                });
                
            });
            