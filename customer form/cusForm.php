<?php 
// session_start();
//  if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
//     header("Location: login.php");
//      exit();
// }
require '../dbcon.php';
 ?>
<!DOCTYPE html>
<html lang="en"> <!-- dir="rtl" -->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- start css files -->
            <!-- botstrap link -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
            <!-- datatable link -->
        <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <!-- this link i get it from youtube video to put icon -->
        <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
            <!-- rendear allelement normaly -->
        <link rel="stylesheet" href="../css/normalize.css">
            <!-- font Awesome Library -->
        <link rel="stylesheet" href="../css/all.min.css">
            <!-- master file -->
        <link rel="stylesheet" href="../css/master.css">
            <!-- styleForm file -->
        <link rel="stylesheet" href="css/styleForm.css">
        <!-- end css files -->
        <!-- google fonts  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Work+Sans:wght@200;400;600;700&display=swap" rel="stylesheet">
        <!-- end google fonts  -->
        <!-- sweetalert for alert -->
        <link rel="stylesheet" href="sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    </head>
    <body>

        <div class="page">
            <!--sidebar for all pages-->

            <div class="content contentForm">
                <!-- start container -->
                    
                    <div class="contenForm">
                        <h1>How can we help you</h1>
                        <form id="sendRequest">
                            <div class="top-of-form">
                                <div class="box box1">
                                    <div class="text-form">
                                        <h4>Ticket info</h4>
                                        <p>Provide your ticket info</p>
                                    </div>
                                </div>

                                <div class="box box2">

                                <div id="errorMessage" class="warning alert alert-warning d-none"></div>
                                <input style="display:none;" class="form-control" type="Number" readonly value="<?php echo(rand(999999, 111111));?>" name="code" required>
                                <input style="display:none;" class="form-control" type="Number" readonly value="<?php echo(rand(999999, 111111));?>" name="id_customers" required>

                                    <div class="form-floating" style="margin-bottom: 16px;">
                                        <select name="issu"  class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                            <option value="" selected>Open this select menu</option>
                                            <?php
                                            $quer = "SELECT requests.id , requests.request_name , requests.status , request_department.department_id , request_department.request_id , departments.department_id , departments.status 
                                            FROM requests , request_department , departments 
                                            WHERE requests.status='1'
                                            AND request_department.request_id=requests.id
                                            AND request_department.department_id=departments.department_id
                                            AND departments.status='1'";  
                                            $query_ru = mysqli_query($con, $quer);
                                            foreach($query_ru as $issue){
                                                ?>
                                                <option value="<?php echo $issue['id']?>"><?php echo $issue['request_name']?></option>
                                            <?php
                                            }
                                            
                                            ?>
                                                                                    
                                        </select>
                                        <label for="floatingSelect">Works with selects</label>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="Description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
                                        <label for="floatingTextarea2">Description</label>    
                                    </div>
                                </div>
                                
                            </div>

                            <div class="bottom-of-form">
                                <div class="box box1">
                                    <div class="text-form">
                                        <h4>Personal info</h4>
                                        <p>Provide your personal info</p>
                                    </div>
                                </div>

                                <div class="box box2">
                                    <div class="form-floating mb-3">
                                        <input name="name" type="text" class="form-control" id="floatingInput" required>
                                        <label for="floatingInput">Name</label>
                                      </div>
                                    <div class="form-floating mb-3">
                                        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@gmail.com" required>
                                        <label for="floatingInput">Email Gmail address</label>
                                    </div> 
                                    <div class="form-floating mb-3">
                                    
                                    <input class="form-control" type="number" min="10" id="floatingInput" name="Phone" required>
                                    <label for="floatingInput">Phone</label>
                                      </div>
                                    <button type="submit">submit</button> 
                                </div>
                                
                            </div>
                            
                        </form>
                    </div>
                    
            
                <!-- end container -->
            </div>
        </div>
        
        
        <!-- sweetalert2 for alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!--start links for form  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <!--end links for form  -->

        <script>
            $(document).on('submit', '#sendRequest', function (e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    formData.append("send_request", true);

                    $.ajax({
                        type: "POST",
                        url: "check_form.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            
                            var res = jQuery.parseJSON(response);
                             if(res.status == 421) {

                                $('#errorMessage').removeClass('d-none');
                                $('#errorMessage').text(res.message);

                            }else if(res.status == 200){

                                $('#errorMessage').addClass('d-none');
                                $('#sendRequest')[0].reset();

                                Swal.fire({
                                    icon:'success',
                                    title:'Done',
                                    text: res.message
                                })

                            }else if(res.status == 500) {
                                alert(res.message);

                            }
                        }
                    });

            });

        </script>


        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>


    </body>
</html>



