<?php 
session_start();
if (isset($_SESSION['password']) && isset($_SESSION['user_email'])) {
require_once('dbcon.php');
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

        <style>
            .notific i {
                padding-top: 10px;
                padding-bottom: 6px;
            }
        </style>
    </head>
    <body>

        <!-- Modal -->
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
                        <a class="actives op-nav" href="customer.php">
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
                        <a class="last op-nav" href="login.php">
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
                if($_SESSION['permission'] == "user"){
                ?>
                <!-- start container -->

                <div class="user-page cont">
                    <div class="head-of-section">
                        <?php
                        if(isset($_GET['c_id'])){
                            $id = $_GET['c_id'];
                            $query = "SELECT * FROM customers WHERE c_id = '$id'"; 
                            $query_run = mysqli_query($con, $query);
                            $result = $query_run->fetch_assoc();
                            ?>
                        
                        <h2><?php echo $result["name"]; ?> Tickets</h2>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="list-section">
                        
                        <table id="datatableid" class="table" style="width:100%">
                            <thead>
                              <tr class="text-center">
                                <th scope="col">ID</th>
                                <th scope="col">isuue</th>
                                <th scope="col">Time</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Department</th>
                                <th scope="col">User</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_GET['c_id']))
                                {
                                    $id = $_GET['c_id'];
                                
                                
                                                $query = "SELECT ticket.ticket_id, ticket.code, ticket.request, ticket.ticket_status, ticket.time, ticket.priority, ticket.status, ticket.department, ticket.user, ticket.customers,
                                                departments.department_id, departments.department_name,
                                                users.id, users.name,
                                                requests.id, requests.request_name,
                                                request_user.user_id, request_user.request_id , customers.c_id
                                                FROM departments, requests, ticket, users, request_user , customers
                                                WHERE departments.department_id = ticket.department
                                                AND users.id = ticket.user
                                                AND ticket.request = requests.id
                                                AND ticket.customers = $id
                                                AND ticket.customers = customers.c_id
                                                AND request_user.request_id = requests.id";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                        if($ticket['ticket_status']==0){
                                                            if($_SESSION['id'] === $ticket['user_id'] && $_SESSION['department_id'] === $ticket['department_id']){
                                                            ?>
                                                                <tr class="text-center">
                                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                                    <td><?= $ticket['request_name'] ?></td>
                                                                    <td><?= $ticket['time']?>hours</td>
                                                                    <td>
                                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><?= $ticket['department_name'] ?></td>
                                                                    <td><?= $ticket['name'] ?></td>
                                                                    <td>
                                                                        <?php if($ticket['status'] == 'On hold'): ?>
                                                                            <span class="badge bg-primary">On hold</span>
                                                                        <?php elseif($ticket['status'] == 'Assigned'): ?>
                                                                            <span class="badge bg-info text-dark">Assigned</span>
                                                                        <?php elseif($ticket['status'] == 'In Progress'): ?>
                                                                            <span class="badge bg-warning text-dark">In Progress</span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-secondary">Closed</span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td> 
                                                                    <a style="color: #aaa;" href="view_ticket.php?ticket_id=<?= $ticket['ticket_id']; ?>" class="btn"><i class="fa-solid fa-eye"></i></a>
                                                                    </td> 
                                                                    
                                                                </tr>
                                                            <?php
                                                            }
                                                        }
                                                    }

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

       

        <!--start links for form  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!--end links for form  -->

        <!-- datatable link "last block to run" -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
         <script>
            $(document).ready(function () {
                $('#datatableid').DataTable();
            }); 
        </script> 
        
        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
        <!-- ===== MAIN JS ===== -->
        <script src="js/main.js"></script>

    </body>
</html>
<?php }else{
    ?>
    
    
    <div class="user-page cont">
                    <div class="head-of-section">
                        <?php
                        if(isset($_GET['c_id'])){
                            $id = $_GET['c_id'];
                            $query = "SELECT * FROM customers WHERE c_id = '$id'"; 
                            $query_run = mysqli_query($con, $query);
                            $result = $query_run->fetch_assoc();
                            ?>
                        
                        <h2><?php echo $result["name"]; ?> Tickets</h2>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="list-section">
                        
                        <table id="datatableid" class="table" style="width:100%">
                            <thead>
                              <tr class="text-center">
                                <th scope="col">ID</th>
                                <th scope="col">isuue</th>
                                <th scope="col">Time</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Department</th>
                                <th scope="col">User</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_GET['c_id']))
                                {
                                    $id = $_GET['c_id'];
                                
                                
                                                $query = "SELECT ticket.ticket_id, ticket.code, ticket.request, ticket.ticket_status, ticket.time, ticket.priority, ticket.status, ticket.department, ticket.user, ticket.customers,
                                                departments.department_id, departments.department_name,
                                                users.id, users.name,
                                                requests.id, requests.request_name, customers.c_id
                                                FROM departments, requests, ticket, users, customers
                                                WHERE departments.department_id = ticket.department
                                                AND users.id = ticket.user
                                                AND ticket.request = requests.id
                                                AND ticket.customers = $id
                                                AND ticket.customers = customers.c_id";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                            ?>
                                                                <tr class="text-center">
                                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                                    <td><?= $ticket['request_name'] ?></td>
                                                                    <td><?= $ticket['time']?>hours</td>
                                                                    <td>
                                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><?= $ticket['department_name'] ?></td>
                                                                    <td><?= $ticket['name'] ?></td>
                                                                    <td>
                                                                        <?php if($ticket['status'] == 'On hold'): ?>
                                                                            <span class="badge bg-primary">On hold</span>
                                                                        <?php elseif($ticket['status'] == 'Assigned'): ?>
                                                                            <span class="badge bg-info text-dark">Assigned</span>
                                                                        <?php elseif($ticket['status'] == 'In Progress'): ?>
                                                                            <span class="badge bg-warning text-dark">In Progress</span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-secondary">Closed</span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td> 
                                                                    <a style="color: #aaa;" href="view_ticket.php?ticket_id=<?= $ticket['ticket_id']; ?>" class="btn"><i class="fa-solid fa-eye"></i></a>
                                                                    </td> 
                                                                    
                                                                </tr>
                                                            <?php
                                                    }

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

        <!--start links for form  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!--end links for form  -->

        <!-- datatable link "last block to run" -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        
        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
        <!-- ===== MAIN JS ===== -->
        <script src="js/main.js"></script>


<?php } }else{
    header("Location: login.php");
    exit();
}
?>