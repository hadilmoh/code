<?php
session_start();
if (isset($_SESSION['password']) && isset($_SESSION['user_email'])) {
   
require_once('dbcon.php');

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
                        <a class="op-nav" href="ticket.php">
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
                        <a class="actives op-nav" href="user.php">
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
                <?php 
                if($_SESSION['permission'] == "admin"){
                ?>
                <!-- start container -->
                <div class="user-page cont">
                    <div class="head-of-section">
                        <h2>User's List</h2>
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        + Add user
                        </button>
                    </div>
                    <div class="list-section">
                        <table id="datatableid" class="table" style="width:100%">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User type</th>
                                <th scope="col">Joptitle</th>
                                <th scope="col">Department</th>
                                <th scope="col">D-manager</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    

                                                $query = 'SELECT users.id, users.name, users.user_email, users.permission, users.setting_joptitle, users.department_id, users.Direct_manager, users.status,
                                                departments.department_id, departments.department_name,
                                                setting_joptitle.jopTitle_id, setting_joptitle.jopTitle_name,
                                                direct_manager.manager_id, direct_manager.manager_name
                                                FROM users, setting_joptitle, departments, direct_manager
                                                WHERE users.setting_joptitle = setting_joptitle.jopTitle_id
                                                AND users.department_id = departments.department_id
                                                AND users.Direct_manager = direct_manager.manager_id';
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $user){
                                                ?><tr class="text-center">
                                                    <td><?= $user['id'] ?></td>
                                                    <td><?= $user['name'] ?></td>
                                                    <td><?= $user['user_email'] ?></td>
                                                    <td><?= $user['permission'] ?></td>
                                                    <td><?= $user['jopTitle_name'] ?></td>
                                                    <td><?= $user['department_name'] ?></td>
                                                    <td><?= $user['manager_name'] ?></td>
                                                    <td>
                                                <button type="button" value="<?=$user['id'];?>" class="edit_User" style="border: 0; background-color: transparent;color: #aaa;">
                                                    <i class="fa-solid fa-pen-to-square"></i>                                                
                                                </button>
                                            </td>
                                            <td>
                                            <?php                                
                                                if($user['status']==1) {
                                                    echo '<p><a href="updateuser.php?id='.$user['id'].'&status=0" class="active" style="color: green"><i class="fa-solid fa-circle-check"></i></a></p>';
                                                }
                                                else if($user['status']==0) {
                                                    echo '<p><a href="updateuser.php?id='.$user['id'].'&status=1" class="deactive" style="color: red"><i class="fa-solid fa-circle-xmark"></i></a></p>';
                                                }
                                                ?>
                                            </td>
                                                </tr>
                                                <?php
                                            }

                                    }       
                                ?>  
                             
                            </tbody>
                          </table>
                    </div>
                </div>
                <!-- end container -->
            </div>
        </div>

        <!-- Insert User-->
        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Add new user</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveUser">
                    <div id="errorMessage" class="alert alert-warning d-none d-flex justify-content-between alert-modal-long"></div>

                    <div class="modal-body modal-body-long">
                        
                        <div class="mb-3"> 
                            <label for="" class="mb-2">ID</label>
                            <input type="number" name="id" class="form-control" required/>
                        </div>
                        <div class="mb-3"> 
                            <label for="" class="mb-2">Name</label>
                            <input type="text" name="name" class="form-control" required/>
                         </div>
                         <div class="mb-3"> 
                            <label for=""  class="mb-2">Email</label>
                            <input type="email" name="user_email" class="form-control" required/>
                        </div>
                        <div class="mb-3"> 
                            <label for=""  class="mb-2">Password</label>
                            <input type="password" name="password" class="form-control" readonly value="<?php echo(rand(999999, 111111));?>" required/>
                         </div>
                         <div class="mb-3"> 
                             <label for="" class="mb-2">User Type</label>
                            <select class="form-select" aria-label="Default select example" name="permission" >
                            <option value="user">user</option>
                            <option value="manager">admin</option>
                            </select>
                        </div>
                         <div class="mb-3"> 
                             <label for="" class="mb-2">Joptitle</label>
                            <select class="form-select" aria-label="Default select example" name="setting_joptitle" id="setting_joptitl">
                            <option selected="" value="0">select joptitle</option>
                            <?php
                                $query = "SELECT * FROM setting_joptitle";
                                $query_run = mysqli_query($con, $query);
                                    foreach($query_run as $dept){
                                        ?>
                                        <option value="<?php echo $dept['jopTitle_id']?>"><?php echo $dept['jopTitle_name']?></option>
                                        <?php
                                    }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3"> 
                        <label for="" class="mb-2">Department</label>
                        <select class="form-select" aria-label="Default select example" name="department_id">
                        <option selected="" value="0">No Department</option>
                            <?php
                                $query = "SELECT * FROM departments WHERE status='1'";
                                $query_run = mysqli_query($con, $query);
                                    foreach($query_run as $dept){
                                        ?>
                                        <option value="<?php echo $dept['department_id']?>"><?php echo $dept['department_name']?></option>
                                        <?php
                                    }
                            ?>
                        </select>
                         </div>
                        <div class="mb-3"> 
                            <label for="" class="mb-2">Direct_Manager</label>
                            <select class="form-select" aria-label="Default select example" name="Direct_manager" id="Direct_manage">
                            <option selected="" value="0">No Direct_Manager</option>
                            
                            </select>
                         </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
               </form>
                </div>
            </div>
        </div>

        <!-- End Insert User-->

        <!-- Update User-->
        <!-- Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Edit User</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUser">
                    <div id="errorMessageUpdate" class="alert alert-warning d-none d-flex justify-content-between alert-modal-long"></div>

                    <div class="modal-body modal-body-long">
                        
                        <div class="mb-3"> 
                            <label for="" class="mb-2">ID</label>
                            <input type="number" min="0" name="id" id="id" readonly class="form-control" />
                        </div>
                        <div class="mb-3"> 
                            <label for="" class="mb-2">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required/>
                         </div>
                         <div class="mb-3"> 
                            <label for=""  class="mb-2">E-mail</label>
                            <input type="email" name="user_email" id="user_email" class="form-control" required/>
                        </div>
                        <div class="mb-3"> 
                             <label for="" class="mb-2">permission</label>
                            <select class="form-select" aria-label="Default select example" id="permission" name="permission" >
                            <option value="user">user</option>
                            <option value="manager">manager</option>
                            </select>
                        </div>
                        <div class="mb-3"> 
                             <label for="" class="mb-2">joptitle</label>
                            <select class="form-select" aria-label="Default select example" name="setting_joptitle" id="setting_joptitle">
                            <option selected="" value="0">select joptitle</option>
                            <?php
                                $query = "SELECT * FROM setting_joptitle";
                                $query_run = mysqli_query($con, $query);
                                    foreach($query_run as $dept){
                                        ?>
                                        <option value="<?php echo $dept['jopTitle_id']?>"><?php echo $dept['jopTitle_name']?></option>
                                        <?php
                                    }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3"> 
                        <label for="" class="mb-2">Department</label>
                        <select class="form-select" aria-label="Default select example" name="department_id">
                        <option selected="" value="0">No Department</option>
                            <?php
                                $query = "SELECT * FROM departments WHERE status='1'";
                                $query_run = mysqli_query($con, $query);
                                    foreach($query_run as $dept){
                                        ?>
                                        <option value="<?php echo $dept['department_id']?>"><?php echo $dept['department_name']?></option>
                                        <?php
                                    }
                            ?>
                        </select>
                         </div>
                        <div class="mb-3"> 
                            <label for="" class="mb-2">Direct_Manager</label>
                            <select class="form-select" aria-label="Default select example" name="Direct_manager" id="Direct_manager">
                            <option selected="" value="0">No Direct_Manager</option>
                            
                            </select>
                         </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
               </form>
                </div>
            </div>
        </div>

        <!-- End Update User-->

        <!-- multi select drop down scribt -->
        <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
        <script>
            new MultiSelectTag('countries1')  // id
            new MultiSelectTag('countries2')  // id
        </script>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- sweetalert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                $('#setting_joptitle').on('change',function(){
                    var joptitle = $(this).val();
                    if(joptitle){
                        $.get(
                            "ajax.php",
                            {idjop: joptitle},
                            function(data){
                                $('#Direct_manager').html(data);
                            }
                        );
                    }else{
                        $('#Direct_manager').html('<option selected="" disabled="">select joptitle first</option>')
                    }
                });
            });
        </script>

<script>
            $(document).ready(function(){
                $('#setting_joptitl').on('change',function(){
                    var joptitle = $(this).val();
                    if(joptitle){
                        $.get(
                            "ajax1.php",
                            {idjop: joptitle},
                            function(data){
                                $('#Direct_manage').html(data);
                            }
                        );
                    }else{
                        $('#Direct_manage').html('<option selected="" disabled="">select joptitle first</option>')
                    }
                });
            });
        </script>



        <script>
            // Insert
                $(document).on('submit', '#saveUser', function (e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    formData.append("save_user", true);

                    $.ajax({
                        type: "POST",
                        url: "insertuser.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            
                            var res = jQuery.parseJSON(response);
                            if(res.status == 422) {
                                $('#errorMessage').removeClass('d-none');
                                $('#errorMessage').text(res.message);

                            }else if(res.status == 200){

                                $('#errorMessage').addClass('d-none');
                                $('#addUserModal').modal('hide');
                                $('#saveUser')[0].reset();
                                
                            Swal.fire({
                                icon:'success',
                                title:'Done',
                                text: res.message
                            })

                            $('#datatableid').load(location.href + " #datatableid");

                            }else if(res.status == 500) {
                                alert(res.message);

                            }else if(res.status == 420){
                                Swal.fire({
                                icon:'warning',
                                title:'error',
                                text: res.message
                            })

                            }else if(res.status == 112){
                                $('#errorMessage').removeClass('d-none');
                                $('#errorMessage').text(res.message);
                                
                            }else if(res.status == 212){
                                $('#errorMessage').removeClass('d-none');
                                $('#errorMessage').text(res.message);

                            }else if(res.status == 300){
                                $('#errorMessage').removeClass('d-none');
                                $('#errorMessage').text(res.message);
                            }
                        }
                    });

                });

            // View Data

                $(document).on('click', '.edit_User', function () {

                    var id = $(this).val();
                

                    $.ajax({
                        type: "GET",
                        url: "insertuser.php?id=" + id,
                        success: function (response) {

                            var res = jQuery.parseJSON(response);
                            if(res.status == 404) {

                                alert(res.message);
                            }else if(res.status == 200){

                                $('#id').val(res.data.id);
                                $('#name').val(res.data.name);
                                $('#user_email').val(res.data.user_email);
                                $('#permission').val(res.data.permission);
                                $('#setting_joptitle').val(res.data.setting_joptitle);
                                $('#department_id').val(res.data.department_id);
                                $('#Direct_manager').val(res.data.Direct_manager);
                                $('#editUserModal').modal('show');
                            }

                        }
                    });

                    });

            // Update User

                $(document).on('submit', '#editUser', function (e) {
                e.preventDefault();

                var formData = new FormData(this);
                formData.append("update_user", true);

                $.ajax({
                    type: "POST",
                    url: "insertuser.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        
                        var res = jQuery.parseJSON(response);
                        if(res.status == 422) {
                            $('#errorMessageUpdate').removeClass('d-none');
                            $('#errorMessageUpdate').text(res.message);

                        }else if(res.status == 200){

                            $('#errorMessageUpdate').addClass('d-none');
                            $('#editUserModal').modal('hide');
                            $('#editUser')[0].reset();

                            Swal.fire({
                                icon:'success',
                                title:'Done',
                                text: res.message
                            })

                            $('#datatableid').load(location.href + " #datatableid");


                        }else if(res.status == 500) {
                            alert(res.message);
                        }
                    }
                });

            });
        </script>

<script>
            $('.deactive').on("click",function(e){
        e.preventDefault();
        var self = $(this);
        console.log(self.data('title'));

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Active it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'Activated!',
            'Your user has been Activated.',
            'success'
            )
            location.href= self.attr('href');
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'user is inactive :)',
            'error'
            )
        }
        });
    });

    $('.active').on("click",function(e){
        e.preventDefault();
        var self = $(this);
        console.log(self.data('title'));

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, deactive it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'deactivated!',
            'Your user has been deactivated.',
            'success'
            )
            location.href= self.attr('href');
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'user is active :)',
            'error'
            )
        }
        });
    });

        </script>

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


    </body>
</html>
<?php }else{
    ?>
    
    <div class= "big-box"style="">
    	<div class="shadow small-box" style="">
            <i class="fa-solid fa-user-lock" style=""></i>
            <h3>Access Restricted</h2>
            <h6 style="color: #aaa;">you dont have permission to view this page, or the page may not be<br>availabel, Please contact the owner and ask to invite you to this page,<br>or switch accounets.</h4>
        </div>
    </div>

<?php } }else{
    header("Location: login.php");
    exit();
}