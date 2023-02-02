<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_email'])) {
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
                        <a class="actives op-nav" href="dashboard.php">
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
                <div class="dashboard-page cont">
                    <!-- first row -->
                    <div class="row-dash">
                        <div class="side-one">
                            <div class="small-box box-dash">
                                <div class="icon-small-box">
                                    <i class="fa-solid fa-ticket"></i>
                                </div>
                                <div class="text-small-box">
                                    <?php
                                    $query = 'SELECT * FROM ticket';
                                    $query_run = mysqli_query($con, $query);
                                    $res1 = mysqli_num_rows($query_run);                               
                                    ?>
                                    <h3><?php echo $res1;?></h3>
                                    <p>Total Tickets</p>
                                </div>
                            </div>
                            <div class="small-box box-dash">
                                <div class="icon-small-box">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                                <div class="text-small-box">    
                                    <?php
                                    $query = 'SELECT * FROM ticket WHERE status = "closed"';
                                    $query_run = mysqli_query($con, $query);
                                    $res2 = mysqli_num_rows($query_run);                               
                                    ?>                                
                                    <h3><?php echo  $res2;?></h3>
                                    <p>Solved Tickets</p>
                                </div>
                            </div>
                            <div class="small-box box-dash">
                                <div class="icon-small-box">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="text-small-box">
                                    <?php
                                    $query = 'SELECT * FROM customers';
                                    $query_run = mysqli_query($con, $query);
                                    $res3 = mysqli_num_rows($query_run);                               
                                    ?>    
                                    <h3><?php echo $res3; ?></h3>
                                    <p>Total clinets</p>
                                </div>
                            </div>
                            <div class="small-box box-dash">
                                <div class="icon-small-box">
                                    <i class="fa-solid fa-ticket-simple"></i>
                                </div>
                                <div class="text-small-box">     
                                    <?php
                                    $date = date("Y-m-d");
                                    $query = "SELECT * FROM ticket WHERE date_t = '$date'";
                                    $query_run = mysqli_query($con, $query);
                                    $res4 = mysqli_num_rows($query_run);                               
                                    ?>    
                                    <h3><?php echo $res4; ?></h3>
                                    <p>Today's Tickets</p>
                                </div>
                            </div>
                        </div>     
                    </div>

                    <!-- second row -->
                    <div class="row-dash">
                        <div class="side-one side-one-row-two box-dash">
                            <div class="head-box">
                                <h3>Recently Tickets</h3>
                                <button><a class="text-light" href="ticket.php">View All</a></button>
                            </div>
                                                       
                            <div class="table">
                            <table id="datatableid" class="table" style="width:100%">
                            <thead>
                              <tr class="text-center">
                                <th scope="col">Code</th>
                                <th scope="col">Issue</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Department</th>
                                <th scope="col">User</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                                $query = "SELECT ticket.ticket_id, ticket.code, ticket.ticket_status, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                                departments.department_id, departments.department_name,
                                                users.id, users.name,
                                                requests.id, requests.request_name
                                                FROM departments, requests, ticket, users
                                                WHERE departments.department_id = ticket.department
                                                AND users.id = ticket.user
                                                AND ticket.request = requests.id
                                                ORDER BY ticket_id DESC LIMIT 10";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    
                                                    foreach($query_run as $ticket){
                                                        
                                                ?><tr class="text-center">
                                                    <td><?= $ticket['code'] ?></td>
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
                                                        <?php elseif($ticket['status'] == 'Spam'): ?>
                                                            <span class="badge bg-dark">Spam</span>
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
                                ?>  
                             
                            </tbody>
                          </table>
                            </div>        
                       
                        </div>
                        
                    </div>
                    
                    
                </div>
                <!-- end container -->
            </div>
        </div>

       
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" charset="utf-8"></script>

        <script type="text/javascript">
            $(function() {
                $('.chart').easyPieChart({
                size: 160,
                barColor: "#4d4dff",
                scaleLength: 0,
                lineWidth: 15,
                trackColor: "#525151",
                lineCap: "circle",
                animate: 2000,
                });
            });
        </script> -->

        <!--start links for form  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!--end links for form  -->

        <!-- datatable link "last block to run" -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <!-- <script>
            $(document).ready(function () {
                $('#datatableid').DataTable();
            }); 
        </script> -->
        
        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
        <!-- ===== MAIN JS ===== -->
        <script src="js/main.js"></script>

        
    </body>
</html>
<?php }else{
header("Location: login.php");
     exit();
    }  ?>