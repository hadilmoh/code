
$(document).ready(function(){

    load_notes()

    function load_notes(){
        var code_tk = $('.n_code_tk').val();
        $.ajax({
            type: "POST",
            url: "viewTicketNote.php",
            data: {
                'code_tk': code_tk,
                'note_load_data': true
            },
            success: function (response) {

                $('.note_container').html("");
                // console.log(response);
                $.each(response, function(key, value) {

                    $('.note_container').
                    append('<div class="cmt_box border p-2 mb-2 rounded bg-white">\
                                <h6 class="d-inline"> '+ value.user['name'] +' <p class="text-secondary border-bottom p-b-5" style="padding-bottom:5px; font-size:12px">'+ value.cmt['n_commented_on'] +'</p> </h6>\
                                <p class="para">'+ value.cmt['note'] +'</p>\
                            </div>\
                    ');

                });
            }
        });
    }



    $('.add_note_btn').click(function (e) {
        e.preventDefault();


        var code_tk = $('.n_code_tk').val();
        var note = $('.note_textbox').val();
        if($.trim(note).length == 0) 
        {
            error_note = "Please write note";
            $('#n_error_status').text(error_note);

        }else{
            error_note = "";
            $('#n_error_status').text(error_note);

        }

        if(error_note != '')
        {
            return false;
        }
        else 
        {

            var data = {
                'code_tk': code_tk,
                'note': note,
                'add_note': true,
            }

            $.ajax({
                type: "POST",
                url: "viewTicketNote.php",
                data: data,
                success: function (response) {
                    // alert(response);
                    $('.note_textbox').val("");
                    //location.reload();
                    load_notes()

                }
            });          
        }

    });

});