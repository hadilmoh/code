
$(document).ready(function(){

    load_comment()

    function load_comment(){ 
        var code_tk = $('.code_tk').val();
        $.ajax({
            type: "POST",
            url: "viewTicketComment.php",
            data: {
                'code_tk': code_tk,
                'comment_load_data': true
            },
            success: function (response) {

                $('.comment_container').html("");
                // console.log(response);
                $.each(response, function(key, value) {

                    $('.comment_container').
                    append('<div class="cmt_box border p-2 mb-2 rounded bg-white">\
                                <h6 class="d-inline"> '+ value.user['name'] +' ('+ value.type['type'] +') <p class="text-secondary border-bottom p-b-5" style="padding-bottom:5px; font-size:12px"> '+ value.cmt['created_at'] +'</p> </h6>\
                                <p class="para">'+ value.cmt['msg'] +'</p>\
                            </div>\
                    ');

                });
            }
        });
    }



    $('.add_comment_btn').click(function (e) {
        e.preventDefault();

        var customer = $('.customer_id').val();
        var code_tk = $('.code_tk').val();
        var msg = $('.comment_textbox').val();
        
        if($.trim(msg).length == 0) 
        {
            error_msg = "Please write message";
            $('#error_status').text(error_msg);

        }else{
            error_msg = "";
            $('#error_status').text(error_msg);

        }

        if(error_msg != '')
        {
            return false;
        }
        else 
        {

            var data = {
                'code_tk': code_tk,
                'msg': msg,
                'customer': customer,
                'add_comment': true,
            }

            $.ajax({
                type: "POST",
                url: "viewTicketComment.php",
                data: data,
                success: function (response) {
                    // alert(customer);
                    // alert(response);
                    $('.comment_textbox').val("");
                    // location.reload();
                    load_comment()

                }
            });          
        }

    });

    //=================================//

    $('.add_comment_btn_cus').click(function (e) {
        e.preventDefault();
    
        var customer = $('.customer_id').val();
        var code_tk = $('.code_tk').val();
        var msg = $('.comment_textbox').val();
        // alert(customer);
        
        if($.trim(msg).length == 0) 
        {
            error_msg = "Please write message";
            $('#error_status').text(error_msg);
    
        }else{
            error_msg = "";
            $('#error_status').text(error_msg);
    
        }
    
        if(error_msg != '')
        {
            return false;
        }
        else 
        {
    
            var data = {
                'code_tk': code_tk,
                'msg': msg,
                'customer': customer,
                'add_comment_cus': true,
            }
    
            $.ajax({
                type: "POST",
                url: "viewTicketComment.php",
                data: data,
                success: function (response) {
                    // alert(response);
                    $('.comment_textbox').val("");
                    // location.reload();
                    load_comment()
    
                }
            });          
        }
    
    });



});





