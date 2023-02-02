<?php
session_start();
if (isset($_SESSION['password']) && isset($_SESSION['user_email'])) {
    
require_once('dbcon.php');
?><!DOCTYPE html>
<html lang="en"> 
    <head>   
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Titles</title>
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
                                <a href="jobtitle.php" class="sub-list collapse__sublink">Job Title</a>
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
                <?php 
                if($_SESSION['permission'] == "admin"){
                ?>
                <br>
            <div class="cont"> 
			<div class="table-responsive">  
				<h3 align="center">Add Job Titles</h3><br />
                <div class="card">
                    <div class="card-header">Enter Job Titles</div>
                    <div class="card-body">
                        <span id="result"></span>
                        <div id="live_data"></div> 
                    </div>      
                </div>          
			</div>  
		</div>

    </div>
</div>
    </body>  
</html> 
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
        <script>
            new MultiSelectTag('countries1')  // id
            new MultiSelectTag('countries2')  // id
        </script>

        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>


       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- sweetalert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>  
$(document).ready(function(){  
    function fetch_data()  
    {  
        $.ajax({  
            url:"jobtitleSelect.php",  
            method:"POST",  
            success:function(data){  
				$('#live_data').html(data);  
            }  
        });  
    }  
    fetch_data();  
    $(document).on('click', '#btn_add', function(){  
        var jopTitle_id = $('#jopTitle_id').text();  
        var jopTitle_name = $('#jopTitle_name').text();  
        if(jopTitle_id == '')  
        {  
            // alert("Enter First Name");
            $('#result').html("<div class='alert alert-success'>Enter Job Title Id</div>");  
            return false;  
        }  
        if(jopTitle_name == '')  
        {  
            // alert("Enter Last Name");  
            $('#result').html("<div class='alert alert-success'>Enter Job Title Name</div>"); 
            return false;  
        }  
        $.ajax({  
            url:"insert.php",  
            method:"POST",  
            data:{jopTitle_id:jopTitle_id, jopTitle_name:jopTitle_name},  
            dataType:"text",  

            success:function(data)  
            {  
            
               
                $('#result').html("<div class='alert alert-success'>"+data+"</div>"); 
                fetch_data();  
            }  
        })  
    });  
    
	
    function edit_data(id, column_name)  
    {  
        $.ajax({  
            url:"edit.php",  
            method:"POST",  
            data:{id:id, column_name:column_name},  
            dataType:"text",  
            success:function(data){  
                //alert(data);
				$('#result').html("<div class='alert alert-success'>"+data+"</div>");
            }  
        });  
    }  
    $(document).on('blur', '.jopTitle_id', function(){  
        var id= $(this).data("id1"); 
        var jopTitle_id = $(this).text();  
        if(jopTitle_id == '')  
        {  
          
            $('#result').html("<div class='alert alert-success'>Enter Job Title Id</div>");  
            return false;  
        }  
        edit_data( id,jopTitle_id, "jopTitle_id");  
    });  
    $(document).on('blur', '.jopTitle_name', function(){  
        var jopTitle_id= $(this).data("id2");  
        var jopTitle_name = $(this).text();
        if(jopTitle_name == '')  
        {  
            
            $('#result').html("<div class='alert alert-success'>Enter Job Title Name</div>"); 
            return false;  
        }     
        edit_data(jopTitle_id,jopTitle_name, "jopTitle_name");  
    });  
    $(document).on('click', '.btn_delete', function(){  
        var jopTitle_id=$(this).data("id3");
        
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
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            
            )
                    $.ajax({  
                    url:"delete.php",  
                    method:"POST",  
                    data:{jopTitle_id:jopTitle_id},  
                    dataType:"text",  
                    success:function(data){  
                        fetch_data();  
                    }  
                });  
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
            )
        }
        })
    
    });  
});  
</script>
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