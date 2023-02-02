<?php
session_start();
require_once('dbcon.php');

if (isset($_SESSION['id']) && isset($_SESSION['user_email'])) {
    
 global $con;
 ?>
<!DOCTYPE html>
<html lang="en"> <!-- dir="rtl" -->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users</title>
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
        <link rel="stylesheet" href="css/normalize.css">
            <!-- font Awesome Library -->
        <link rel="stylesheet" href="css/all.min.css">
            <!-- master file -->
        <link rel="stylesheet" href="css/master.css">
        <!-- end css files -->
        <!-- google fonts  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Work+Sans:wght@200;400;600;700&display=swap" rel="stylesheet">
        <!-- end google fonts  -->
        <!-- sweetalert2 -->
        <link rel="stylesheet" href="sweetalert2.min.css">
    </head>
    <body>

    <div class="page">
            <!--sidebar for all pages-->
            <?php 
            $query="SELECT * FROM company WHERE id='1'";
            $result=mysqli_query($con,$query);
            $fetch_src=FETCH_SRC;
            $fetch = mysqli_fetch_assoc($result);
             ?>
            <div class="sidebar">
                <div class="logo-company">
                    <?php
                    echo<<<show
                    <img src="$fetch_src$fetch[image]">
                    <h3 class="mb-3">$fetch[name_company]</h3>
                    show;
                    ?>
                </div>
                <ul>
                    <li>
                        <a class="op-nav" href="dashboard.php">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="actives op-nav" href="ticket.php">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span>Tickets</span>
                        </a>
                    </li>
                    <li>
                        <a class="op-nav" href="support.php">
                            <i class="fa-solid fa-headset"></i>
                            <span>Issues</span>
                        </a>
                    </li>
                    <li>
                        <a class="op-nav" href="departments.php">
                            <i class="fa-solid fa-building"></i>
                            <span>Departments</span>
                        </a>
                    </li>
                    <li>
                        <a class="op-nav" href="user.php">
                            <i class="fa-solid fa-user"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a class="op-nav" href="customer.php">
                            <i class="fa-solid fa-user-tie"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li>
                        <a class="op-nav" href="report.php">
                            <i class="fa-solid fa-file-signature"></i>
                            <span>Report</span>
                        </a>
                    </li>
                    <li>
                        <div class="op-nav menu-coll">
                            <i class="fa-solid fa-gear"></i>
                            <span>Settings</span>

                            <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                            <ul class="collapse__menu">
                                <a href="setting1.php" class="collapse__sublink">Account</a>
                                <a href="#" class="collapse__sublink">Language</a>
                                <a href="edit-profile.php" class="collapse__sublink">Company</a>
                                <a href="jobtitle.php" class="collapse__sublink">Job Title</a>
                            </ul>
                        </div>
                    </li>
                    
                    <li>
                        <a class="last op-nav" href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
           <div class="content">
                <!-- start head -->
                <?php
                include ('head.php');
                ?>
                <!-- end head -->
                <!-- start container -->
                <div class="user-page cont">
                    <div class="head-of-section">
                    <?php
                    if(isset($_GET['ticket_id'])){

                        $id = $_GET['ticket_id'];
                        $query = "SELECT * FROM ticket WHERE ticket_id = '$id'";                                                            
                        $query_run = mysqli_query($con, $query);
                        $result = $query_run->fetch_assoc();

                        $status_tk = $result["status"];
                        ?>
                        <input class="d-none" id="status_tk" type="text" value="<?php echo $status_tk; ?>">
                        <?php
                        $user_tk = $result["user"];
                        ?>
                        <input class="d-none" id="u_tk_id" type="text" value="<?php echo $user_tk; ?>">
                        <?php
                        $no = $result["code"];
                        ?>
                        <input class="d-none" id="codeTicket" type="text" value="<?php echo $no; ?>">
                        <?php
                        ?>
                        <input class="d-none" id="tk_id" type="text" value="<?php echo $id; ?>">
                        <?php
                        $description = $result["description"];
                        $issue = $result["request"];
                            // ======= //
                            $query_issue = "SELECT * FROM requests WHERE id = '$issue'";                                                            
                            $query_run_issue = mysqli_query($con, $query_issue);
                            $result_issue = $query_run_issue->fetch_assoc();
                            $issue_name = $result_issue["request_name"];
                            // ======= //

                        $customer = $result["customers"];
                        ?>
                        
                        <?php
                            // ======= //
                            $query_cutm = "SELECT * FROM customers WHERE c_id = '$customer'";                                                            
                            $query_run_custm = mysqli_query($con, $query_cutm);
                            $result_custm = $query_run_custm->fetch_assoc();
                            $custm_name = $result_custm["name"];
                            // ======= //
                        $department = $result["department"];
                            // ======= //
                            $query_dept = "SELECT * FROM departments WHERE department_id = '$department'";                                                            
                            $query_run_dept = mysqli_query($con, $query_dept);
                            $result_dept = $query_run_dept->fetch_assoc();
                            $dept_name = $result_dept["department_name"];
                            // ======= //
                        ?> 
                                                                                                                                                             
                        <!-- info -->
                        <div class="accordion" id="accordionExample" style="width: 100%">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Ticket Info 
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body d-flex justify-content-between">

                                        <div style="margin-right:10px; width:90%">
                                            <table style="width:100%">                                        
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i> NO</td>
                                                    <td class="rtl-d"><?php echo $no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Issue</td>
                                                    <td class="rtl-d"><?php echo $issue_name; ?> </td>
                                                </tr> 
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Assigned to</td> 
                                                    <?php
                                                    $query_user = "SELECT name FROM users WHERE id = '$user_tk' ";
                                                    $query_user_run = mysqli_query($con, $query_user);
                                                    $user_result = $query_user_run->fetch_assoc();
                                                    ?> 
                                                    <td class="rtl-d"><?php echo $user_result['name']; ?></td>                                             
                                                </tr>                                                    
                                            </table>
                                            <?php
                                            if( $_SESSION['permission'] == 'admin') {
                                                $query_users_assigned = "SELECT * FROM users,request_user
                                                WHERE status = '1' AND users.department_id = '$department' AND request_user.request_id = $issue AND request_user.user_id = users.id";
                                                $query_users_assigned_run = mysqli_query($con, $query_users_assigned);
                                                   
                                            ?>
                                            <select id="assigned" class="form-select" aria-label="Default select example">
                                                <option selected disabled>Open this select menu</option>
                                                
                                                <?php 
                                                foreach($query_users_assigned_run as $result_assigned){ ?>
                                                    <option value="<?php echo $result_assigned["id"]; ?>"> <?php echo $result_assigned["name"]; ?> </option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                                <?php
                                            }else {
                                            ?>
                                                <button class="w-100" id="assignedToMe" value="<?php echo $_SESSION['id'] ?>">Assigned to me</button>
                                            <?php
                                            }
                    }
                    ?>  
                                            
                                        </div>
                                        <!--  -->
                                        <div style=" margin-left:10px;width:90%">
                                            <table style="width:100%">                                                                                      
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Department</td>
                                                    <td class="rtl-d"><?php echo $dept_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Customer</td>
                                                    <td class="rtl-d"><?php echo $custm_name; ?></td>
                                                </tr>    
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Status</td>
                                                    <td class="rtl-d"><?php echo $status_tk; ?></td>                                                                                                     
                                                </tr>                                    
                                            </table>
                                            <?php
                                            if( $_SESSION['id'] == $user_tk && ($status_tk == "In Progress" || $status_tk == "On hold")){
                                            ?>
                                            <select id="state" class="form-select" aria-label="Default select example">
                                                <option selected disabled value="On hold">On hold</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Spam">Spam</option>
                                                <option value="Closed">Closed</option>
                                            </select>
                                            <?php
                                            } else {                              
                                            ?>
                                            <select disabled id="state" class="form-select" aria-label="Default select example">
                                                <option selected value="On hold">On hold</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Spam">Spam</option>
                                                <option value="Closed">Closed</option>
                                            </select>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- description -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Description 
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="desc">
                                            <p>
                                                <?php echo $description; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>

                    </div>

                    <div class="list-section">

                    <!-- start comment area -->
                        
                            <div class="containers">
                                <div class="rows d-flex justify-content-between">

                                    <div class="card card-comment">
                                        <div class="card-header d-flex justify-content-between align-items-baseline bg-white">
                                            <h4>Comments</h4>                       
                                            <i class="fa-solid fa-comments"></i>
                                        </div>

                                        <div class="card-body-boxes">
                                            <!-- comment between cutomer and user -->
                                            <div class="card-body card-body-comment">
                                                
                                         
                                                <div class="comment_container">
                                                                                                                
                                                </div>
                                            
                                                
                                            </div>
                                            <div class="main-comment ">

                                                    <div id="error_status"></div>
                                                    <div class="write-text d-flex justify-content-between" >
                                                        <input class="code_tk d-none" type="text" value="<?php echo $no; ?>">
                                                        <textarea class="comment_textbox form-control mb-1" rows="2"></textarea>
                                                        <?php
                                                        if( $_SESSION['id'] == $user_tk && $status_tk == "In Progress" ){
                                                        ?>
                                                            <button type="button" class="btn btn-primary add_comment_btn"><i class="fa-regular fa-paper-plane"></i></button>
                                                        <?php
                                                        }
                                                        else{
                                                        ?>
                                                            <button disabled type="button" class="btn btn-primary add_comment_btn"><i class="fa-regular fa-paper-plane"></i></button>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    
                                                                                                                                        
                                                </div>
                                            
                                        </div>
                                    </div>
                                    <!-- 
                                        ===========================
                                        ========new card===========
                                        ===========================
                                     -->

                                     <div class="card card-note">
                                        <div class="card-header d-flex justify-content-between align-items-baseline bg-white">
                                            <h4>Notes</h4>
                                            <i class="fa-solid fa-pen"></i>
                                        </div>

                                        <div class="card-body-boxes">
                                            
                                            <!-- notes between user -->
                                            <div class="card-body">                                                
                                                <div class="note_container">
                                                                                                                
                                                </div> 
                                            </div>

                                            <div class="main-comment">
                                                <div id="n_error_status"></div>
                                                <div class="write-text d-flex justify-content-between">
                                                    <input class="n_code_tk d-none" type="text" value="<?php echo $no; ?>">
                                                    <textarea class="note_textbox form-control mb-1" rows="2"></textarea>
                                                    <?php
                                                    if( $_SESSION['id'] == $user_tk && $status_tk == "In Progress" ){
                                                    ?>
                                                        <button type="button" class="btn btn-primary add_note_btn"><i class="fa-regular fa-paper-plane"></i></button>
                                                    <?php
                                                    }
                                                    else{
                                                    ?>
                                                        <button disabled type="button" class="btn btn-primary add_note_btn"><i class="fa-regular fa-paper-plane"></i></button>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>                                                                                                                                    
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        
                    <!-- end comment area -->
                        
                    </div>
                </div>
                <!-- end container -->
                
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- sweetalert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="jquery.min.js"></script>




        <script>
              $(document).on('click', '#assignedToMe', function () {

                    var u_assigne = $(this).val();
                    var tk_id = $("#tk_id").val();
              
                    $.ajax({
                        type: "POST",
                        url: "view-ticket-insert.php",
                        data: {
                            user_assigned : u_assigne,
                            tkID : tk_id
                        },
                        success: function (response) {

                            var res = jQuery.parseJSON(response);
                            // var res = response;
                            if(res.status == 150){
                                Swal.fire({
                                icon:'success',
                                title:'Done',
                                text: res.message
                                })
                            }else if(res.status == 200){
                                
                                Swal.fire({
                                icon:'warning',
                                title:'Warning!',
                                text: res.message
                                })

                            }else if(res.status == 220){
                                Swal.fire({
                                icon:'warning',
                                title:'Warning!',
                                text: res.message
                                })
                            }

                        }
                    });

                });
           
            $(document).ready(function (){
                var user = $("#u_tk_id").val();  
                $('#assigned option').each(function() {
                    if($(this).val() == user) {
                        $(this).prop("selected", true);
                    }
                });
            });
           
        </script>
        <script>
           
           $(document).ready(function (){
               var s_tk = $("#status_tk").val();  
               $('#state option').each(function() {
                   if($(this).val() == s_tk) {
                       $(this).prop("selected", true);
                   }
               });
           });
          
       </script>
       <!-- <script>
           
        //    $(document).ready(function (){
        //         var code_ticket = $("#codeTicket").val();  
                
        //         $.ajax({
        //             type: "POST",
        //             url: "view-ticket-insert.php",
        //             data: {
                       
        //                 code : code_ticket

        //             },
        //             success: function () {

                       

        //             }
        //         });
        //    });
          
       </script> -->




        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

          <!-- datatable link -->
          <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
          <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
          <script>
                $(document).ready(function () {
                    $('#datatableid').DataTable();
                }); 
          </script>


        <!-- to contact with js file -->
        <script src="assets/comment.js"></script>
        <script src="assets/notes.js"></script>
        <script src="assets/assigned.js"></script>
        <script src="assets/statusTk.js"></script>


    </body>
</html> <?php
}else{ ?>
    <!DOCTYPE html>
<html lang="en"> <!-- dir="rtl" -->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users</title>
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
        <link rel="stylesheet" href="css/normalize.css">
            <!-- font Awesome Library -->
        <link rel="stylesheet" href="css/all.min.css">
            <!-- master file -->
        <link rel="stylesheet" href="css/master.css">
        <!-- end css files -->
        <!-- google fonts  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Work+Sans:wght@200;400;600;700&display=swap" rel="stylesheet">
        <!-- end google fonts  -->
        <!-- sweetalert2 -->
        <link rel="stylesheet" href="sweetalert2.min.css">
    </head>
    <body>

    <div class="user-page cont" style="justify-content:center; align-items:center;">
                    <div class="head-of-section">
                    <?php
                    if(isset($_GET['ticket_id'])){

                        $id = $_GET['ticket_id'];
                        $query = "SELECT * FROM ticket WHERE ticket_id = '$id'";                                                            
                        $query_run = mysqli_query($con, $query);
                        $result = $query_run->fetch_assoc();

                        $status_tk = $result["status"];
                        ?>
                        <input class="d-none" id="status_tk" type="text" value="<?php echo $status_tk; ?>">
                        <?php
                        $user_tk = $result["user"];
                        ?>
                        <input class="d-none" id="u_tk_id" type="text" value="<?php echo $user_tk; ?>">
                        <?php
                        $no = $result["code"];
                        ?>
                        <input class="d-none" id="tk_id" type="text" value="<?php echo $id; ?>">
                        <?php
                        $description = $result["description"];
                        $issue = $result["request"];
                            // ======= //
                            $query_issue = "SELECT * FROM requests WHERE id = '$issue'";                                                            
                            $query_run_issue = mysqli_query($con, $query_issue);
                            $result_issue = $query_run_issue->fetch_assoc();
                            $issue_name = $result_issue["request_name"];
                            // ======= //

                        $customer = $result["customers"];
                            // ======= //
                            $query_cutm = "SELECT * FROM customers WHERE c_id = '$customer'";                                                            
                            $query_run_custm = mysqli_query($con, $query_cutm);
                            $result_custm = $query_run_custm->fetch_assoc();
                            $custm_name = $result_custm["name"];
                            // ======= //
                        $department = $result["department"];
                            // ======= //
                            $query_dept = "SELECT * FROM departments WHERE department_id = '$department'";                                                            
                            $query_run_dept = mysqli_query($con, $query_dept);
                            $result_dept = $query_run_dept->fetch_assoc();
                            $dept_name = $result_dept["department_name"];
                            // ======= //

                            $query_users_assigned = "SELECT * FROM request_user ,request_department ,users
                            WHERE request_user.request_id = $issue AND request_department.department_id = $department AND user_id = id";
                            $query_users_assigned_run = mysqli_query($con, $query_users_assigned);
                            ?>                                                                                                                                       
                        <!-- info -->
                        <div class="accordion" id="accordionExample" style="width: 100%">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Ticket Info 
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body d-flex justify-content-between">

                                        <div style="margin-right:10px; width:90%">
                                            <table style="width:100%">                                        
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i> NO</td>
                                                    <td class="rtl-d"><?php echo $no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Issue</td>
                                                    <td class="rtl-d"><?php echo $issue_name; ?> </td>
                                                </tr>                                                  
                                            </table>
                                            <?php
                                            }
                                            ?>  
                                            
                                        </div>
                                        <!--  -->
                                        <div style=" margin-left:10px;width:90%">
                                            <table style="width:100%">                                                                                      
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Customer</td>
                                                    <td class="rtl-d"><?php echo $custm_name; ?></td>
                                                </tr>    
                                                <tr>
                                                    <td class="left-td"><i class="fa-solid fa-circle-info"></i></i> Status</td>
                                                    <?php 
                                                    $query_user = "SELECT status FROM ticket WHERE ticket_id = '$id' ";
                                                    $query_user_run = mysqli_query($con, $query_user);
                                                    $user_result = $query_user_run->fetch_assoc();
                                                    ?> 
                                                    <td class="rtl-d"><?php echo $user_result['status']; ?></td>                                                       
                                                </tr> 
                                                <tr>    
                                                                            
                                            </table>
                                            
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- description -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Description 
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="desc">
                                            <p>
                                                <?php echo $description; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>

                    </div>

                    <div class="list-section">

                    <!-- start comment area -->
                                    <div class="card card-comment" style="width: 100%;">
                                        <div class="card-header d-flex justify-content-between align-items-baseline bg-white">
                                            <h4>Comments</h4>                       
                                            <i class="fa-solid fa-comments"></i>
                                        </div>

                                        <div class="card-body-boxes">
                                            <!-- comment between cutomer and user -->
                                            <div class="card-body card-body-comment">
                                                
                                         
                                                <div class="comment_container">
                                                                                                                
                                                </div>
                                            
                                                
                                            </div>
                                            <div class="main-comment ">

                                                    <div id="error_status"></div>
                                                    <div class="write-text d-flex justify-content-between">
                                                        <input class="d-none customer_id" type="text" value="<?php echo $customer; ?>">
                                                        <input class="code_tk d-none" type="text" value="<?php echo $no; ?>">
                                                        <textarea class="comment_textbox form-control mb-1" rows="2"></textarea>
                                                        <button type="button" class="btn btn-primary add_comment_btn_cus"><i class="fa-regular fa-paper-plane"></i></button>
                                                    </div>
                                                    
                                                                                                                                        
                                                </div>
                                            
                                        </div>
                                    </div>
                            </div>
                        
                    <!-- end comment area -->
                        
                    </div>
    </body>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- sweetalert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="jquery.min.js"></script>

        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

          <!-- datatable link -->
          <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
          <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
          <script>
                $(document).ready(function () {
                    $('#datatableid').DataTable();
                }); 
          </script>


        <!-- to contact with js file -->
        <script src="assets/comment.js"></script>
        <script src="assets/statusTk.js"></script>
<?php }?>