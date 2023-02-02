function getRequest(request_id) {
    $.ajax({
        type: "GET",
        url: "API.php?request_id=" + request_id,
        success: function (res) {
            if(res.status == 404) {
                alert(res.message);
            }else if(res.status == 200){
                $('#request_id').val(res.data.id);
                $('#u_request_name').val(res.data.request_name);
                $('#u_day').val(res.data.day);
                $('#u_hour').val(res.data.hour);
                $('#u_users').val(res.data.users);
                var select_data = (res.data.priority);
                $('.select-data option').each(function() {
                    if($(this).val() == select_data) {
                        $(this).prop("selected", true);
                    }
                });
                var dep_users = res.data.dep_users
                var users = res.data.users
                var dep_ids = res.data.dep_ids
                $("#u_departments > option").each(function() {
                    if(dep_ids.includes($(this).val())){
                        $(this).prop("selected", true);
                    }
                });
                
                $("#u_users").empty();
                for (var i = 0; i < dep_users.length; i++) {
                    var id = dep_users[i]['id'];
                    var name = dep_users[i]['name'];                    
                    if(users.includes(id)) {
                        $("#u_users").append("<option selected value='"+id+"'>"+name+"</option>");
                    }else{
                        $("#u_users").append("<option value='"+id+"'>"+name+"</option>");                        
                    }
                    //console.log(users[i]);
                }

                $('#requestEditModal').modal('show');
            }

        }
    });
}


function loadData(depIds) {
    $.ajax({
        url: 'API.php?get_users=1',
        type: 'GET',
        data: {dep_ids:depIds},
        dataType: 'json',error:function(err){
            console.log(err);
        },success:function(response){            
            var users = response;//.data.subjects;
            console.log(users);
            $("#s_users").empty();
            for (var i = 0; i < users.length; i++) {
                var id = users[i]['id'];
                var name = users[i]['name'];
                $("#s_users").append("<option value='"+id+"'>"+name+"</option>");
                //console.log(users[i]);
            }
            $("#u_users").empty();
            for (var i = 0; i < users.length; i++) {
                var id = users[i]['id'];
                var name = users[i]['name'];
                $("#u_users").append("<option value='"+id+"'>"+name+"</option>");
                //console.log(users[i]);
            }
            // $("#subject").empty();
            // for (var i = 0; i < subjects.length; i++) {
            //     var id = subjects[i]['id'];
            //     var name = subjects[i]['name'];
            //     $("#subject").append("<option value='"+id+"'>"+name+"</option>");
            // }
        }
    });
}


function saveRequest(name, day, hour, priority, dept, users){
    console.log(users);
    $.ajax({
        type: "POST",
        url: 'API.php',                    
        data: {
            name : name,
            day : day,
            hour : hour,
            priority : priority,
            dept_ids : dept,
            users_ids : users,
            save_request : true
        },
        dataType: 'json',error:function(err){
            console.log(err);
        },
        success:function(response){            
            var users = response;
            console.log(response);

            // var res = jQuery.parseJSON(response);
            var res = response;
            if(res.status == 422) {
                            
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);
                // $('#errorMessage').append('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');

              
            }else if(res.status == 601) {

                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);
                // $('#errorMessage').append('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');


            }else if(res.status == 200) {

                $('#errorMessage').addClass('d-none');
                $('#requestAddModal').modal('hide');
                $('#saveRequest')[0].reset();

                Swal.fire({
                    icon:'success',
                    title:'done',
                    text:'done the save'
                })

                $('#datatableid').load(location.href + " #datatableid");
                //$('#datatableid').load(location.href + "#datatableid");
                // alert(location.href)
                }else if(res.status == 500) {
                    alert(res.message);
                }
        }
    });
};


function updateRequest(name, day, hour, priority, dept, users,request_id){
    console.log(users);
    $.ajax({
        type: "POST",
        url: 'API.php',                    
        data: {
            name : name,
            day : day,
            hour : hour,
            priority : priority,
            dept_ids : dept,
            users_ids : users,
            request_id : request_id,
            update_request : true
        },
        dataType: 'json',error:function(err){
            console.log(err);
        },success:function(response){            
            var users = response;//.data.subjects;
            console.log(response);
            // $("#datatableid").load('support.php #datatableid');

            var res = response;
            if(res.status == 422) {
                            
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);

            }else if(res.status == 601) {

                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);

            }else if(res.status == 200) {

                $('#errorMessageUpdate').addClass('d-none');
                $('#requestEditModal').modal('hide');
                $('#updateRequest')[0].reset();

                Swal.fire({
                    icon:'success',
                    title:'done',
                    text:'done the save'
                })

                //$('#datatableid').load(location.href + "#datatableid");
                // alert(location.href)
                }else if(res.status == 500) {
                    alert(res.message);
                }

        }
    });

};