
<?php 
session_start();
if (isset($_SESSION['password']) && isset($_SESSION['user_email'])) {
require 'dbcon.php';
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
        <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
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
        <!-- sweetalert for alert -->
        <link rel="stylesheet" href="sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="style.css">
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
                        <a class="actives op-nav" href="report.php">
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
                <div class="cont">
                    <div class="head-of-section">
                        <h2>Report</h2>
                    </div>

                    <div class="head-of-section">
                        <form action="" method="GET" class="w-100">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <label>Department</label>
                                    <select type="text" name="department_id" id="department_id" class="form-select">
                                    <option value="0">No Department</option>
                                    <?php
                                        $query = "SELECT * FROM departments";
                                        $query_run = mysqli_query($con, $query);
                                        foreach($query_run as $dept){
                                            if($dept['department_id'] > 0){
                                        ?>
                                        <option value="<?php echo $dept['department_id'] ?>"><?php echo $dept['department_name']?></option>
                                        <?php
                                    }}
                                    ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <label>User</label>
                                    <select type="text" name="id" id="id" class="form-select">
                                    <option value="0">No User</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select type="text" name="state" class="form-select">
                                                <option value="0">No Status</option>
                                                <option value="On hold">On hold</option>
                                                <option value="Assigned">Assigned</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Spam">Spam</option>
                                                <option value="Closed">Closed</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                         <br>
                                      <button type="submit" class="btn btn-primary btn-filter">Filter</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <div class="list-section">
                        <table id="datatableid" class="table text-center" style="width:100%">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Status</th>
                                <th scope="col">Department</th>
                                <th scope="col">User</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    if(isset($_GET['from_date']) && isset($_GET['to_date']) )
                                    {       $department = $_GET['department_id'];
                                            $user = $_GET['id'];
                                            $status = $_GET['state'];
                                            $from_date = $_GET['from_date'];
                                            $to_date = $_GET['to_date'];
                                            if($department == '0' && $status == '0' && $user == '0'){
                                            $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                            departments.department_id, departments.department_name,
                                            users.id, users.name,
                                            requests.id, requests.request_name
                                            FROM departments, requests, ticket, users
                                            WHERE departments.department_id = ticket.department
                                            AND users.id = ticket.user
                                            AND ticket.request = requests.id
                                            AND ticket.date_t BETWEEN '$from_date' AND '$to_date'";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                ?><tr>
                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                    <td><?= $ticket['request_name'] ?></td>
                                                    <td><?= $ticket['date_t']?></td>
                                                    <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <td><?= $ticket['department_name'] ?></td>
                                                    <td><?= $ticket['name'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?> 
                                            <div class='alert alert-danger text-center' role="alert"> <?php  echo "No data from date"; ?> </div> 
                                            <?php 
                                        }
                                    }if($department != '0'  && $status == '0' && $user == '0'){
                                    $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                            departments.department_id, departments.department_name,
                                            users.id, users.name,
                                            requests.id, requests.request_name
                                            FROM departments, requests, ticket, users
                                            WHERE departments.department_id = ticket.department
                                            AND users.id = ticket.user
                                            AND ticket.request = requests.id
                                            AND ticket.date_t BETWEEN '$from_date' AND '$to_date'
                                            AND ticket.department = '$department'";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                ?><tr>
                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                    <td><?= $ticket['request_name'] ?></td>
                                                    <td><?= $ticket['date_t']?></td>
                                                    <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <td><?= $ticket['department_name'] ?></td>
                                                    <td><?= $ticket['name'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?> 
                                            <div class='alert alert-danger text-center' role="alert"> <?php  echo "Inter Date OR No Data for department"; ?> </div> 
                                            <?php 
                                        }
                                    }else if(($department == '0'  && $status != '0' && $user == '0')) {
                                        $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                            departments.department_id, departments.department_name,
                                            users.id, users.name,
                                            requests.id, requests.request_name
                                            FROM departments, requests, ticket, users
                                            WHERE departments.department_id = ticket.department
                                            AND users.id = ticket.user
                                            AND ticket.request = requests.id
                                            AND ticket.date_t BETWEEN '$from_date' AND '$to_date'
                                            AND ticket.status = '$status'";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                ?><tr>
                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                    <td><?= $ticket['request_name'] ?></td>
                                                    <td><?= $ticket['date_t']?></td>
                                                    <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <td><?= $ticket['department_name'] ?></td>
                                                    <td><?= $ticket['name'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?> 
                                            <div class='alert alert-danger text-center' role="alert"> <?php  echo "Inter Date OR No Data for status"; ?> </div> 
                                            <?php 
                                        }

                                    }else if($department != '0'  && $status != '0' && $user == '0'){
                                        $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                            departments.department_id, departments.department_name,
                                            users.id, users.name,
                                            requests.id, requests.request_name
                                            FROM departments, requests, ticket, users
                                            WHERE departments.department_id = ticket.department
                                            AND users.id = ticket.user
                                            AND ticket.request = requests.id
                                            AND ticket.date_t BETWEEN '$from_date' AND '$to_date'
                                            AND ticket.status = '$status'
                                            AND ticket.department = '$department'";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                ?><tr>
                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                    <td><?= $ticket['request_name'] ?></td>
                                                    <td><?= $ticket['date_t']?></td>
                                                    <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <td><?= $ticket['department_name'] ?></td>
                                                    <td><?= $ticket['name'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?> 
                                            <div class='alert alert-danger text-center' role="alert"> <?php  echo "Inter Date OR No Data for department and status"; ?> </div> 
                                            <?php 
                                        }
                                    }else if ($department == '0'  && $status == '0' && $user != '0'){
                                        $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                            departments.department_id, departments.department_name,
                                            users.id, users.name,
                                            requests.id, requests.request_name
                                            FROM departments, requests, ticket, users
                                            WHERE departments.department_id = ticket.department
                                            AND users.id = ticket.user
                                            AND ticket.request = requests.id
                                            AND ticket.date_t BETWEEN '$from_date' AND '$to_date'
                                            AND ticket.user = '$user'";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                ?><tr>
                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                    <td><?= $ticket['request_name'] ?></td>
                                                    <td><?= $ticket['date_t']?></td>
                                                    <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <td><?= $ticket['department_name'] ?></td>
                                                    <td><?= $ticket['name'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?> 
                                            <div class='alert alert-danger text-center' role="alert"> <?php  echo "Inter Date OR No Data for user"; ?> </div> 
                                            <?php 
                                        }
                                    }else if ($department != '0'  && $status == '0' && $user != '0'){
                                            $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                            departments.department_id, departments.department_name,
                                            users.id, users.name,
                                            requests.id, requests.request_name
                                            FROM departments, requests, ticket, users
                                            WHERE departments.department_id = ticket.department
                                            AND users.id = ticket.user
                                            AND ticket.request = requests.id
                                            AND ticket.date_t BETWEEN '$from_date' AND '$to_date'
                                            AND ticket.user = '$user'
                                            AND ticket.department = '$department'";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                ?><tr>
                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                    <td><?= $ticket['request_name'] ?></td>
                                                    <td><?= $ticket['date_t']?></td>
                                                    <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <td><?= $ticket['department_name'] ?></td>
                                                    <td><?= $ticket['name'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?> 
                                            <div class='alert alert-danger text-center' role="alert"> <?php  echo "Inter Date OR No Data for department and user"; ?> </div> 
                                            <?php 
                                        }
                                    } if ($department == '0'  && $status != '0' && $user != '0'){
                                        $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                        departments.department_id, departments.department_name,
                                        users.id, users.name,
                                        requests.id, requests.request_name
                                        FROM departments, requests, ticket, users
                                        WHERE departments.department_id = ticket.department
                                        AND users.id = ticket.user
                                        AND ticket.request = requests.id
                                        AND ticket.date_t BETWEEN '$from_date' AND '$to_date'
                                        AND ticket.user = '$user'
                                        AND ticket.status = '$status'";
                                            $query_run = mysqli_query($con, $query);
                                            if(mysqli_num_rows($query_run) > 0){
                                                foreach($query_run as $ticket){
                                            ?><tr>
                                                <td><?= $ticket['ticket_id'] ?></td>
                                                <td><?= $ticket['request_name'] ?></td>
                                                <td><?= $ticket['date_t']?></td>
                                                <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                <td><?= $ticket['department_name'] ?></td>
                                                <td><?= $ticket['name'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?> 
                                        <div class='alert alert-danger text-center' role="alert"> <?php  echo "Inter Date OR No Data for user and status"; ?> </div> 
                                        <?php 
                                    }
                                } if ($department != '0'  && $status != '0' && $user != '0'){
                                    $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                    departments.department_id, departments.department_name,
                                    users.id, users.name,
                                    requests.id, requests.request_name
                                    FROM departments, requests, ticket, users
                                    WHERE departments.department_id = ticket.department
                                    AND users.id = ticket.user
                                    AND ticket.request = requests.id
                                    AND ticket.date_t BETWEEN '$from_date' AND '$to_date'
                                    AND ticket.user = '$user'
                                    AND ticket.status = '$status'
                                    AND ticket.department = '$department'";
                                        $query_run = mysqli_query($con, $query);
                                        if(mysqli_num_rows($query_run) > 0){
                                            foreach($query_run as $ticket){
                                        ?><tr>
                                            <td><?= $ticket['ticket_id'] ?></td>
                                            <td><?= $ticket['request_name'] ?></td>
                                            <td><?= $ticket['date_t']?></td>
                                            <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                            <td><?= $ticket['department_name'] ?></td>
                                            <td><?= $ticket['name'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?> 
                                    <div class='alert alert-danger text-center' role="alert"> <?php  echo "Inter Date OR No Data from department user and status"; ?> </div> 
                                    <?php 
                                }
                            }
                                    }else{
                                        $query = "SELECT ticket.ticket_id, ticket.description, ticket.date_t, ticket.code, ticket.request, ticket.status, ticket.time, ticket.priority, ticket.department, ticket.user, ticket.customers,
                                            departments.department_id, departments.department_name,
                                            users.id, users.name,
                                            requests.id, requests.request_name
                                            FROM departments, requests, ticket, users
                                            WHERE departments.department_id = ticket.department
                                            AND users.id = ticket.user
                                            AND ticket.request = requests.id";
                                                $query_run = mysqli_query($con, $query);
                                                if(mysqli_num_rows($query_run) > 0){
                                                    foreach($query_run as $ticket){
                                                ?><tr>
                                                    <td><?= $ticket['ticket_id'] ?></td>
                                                    <td><?= $ticket['request_name'] ?></td>
                                                    <td><?= $ticket['date_t']?></td>
                                                    <td>
                                                        <?php if($ticket['priority'] == 'normal'): ?>
                                                            <span class="badge bg-primary"><?= $ticket['priority'] ?></span>
                                                        <?php elseif($ticket['priority'] == 'important'): ?>
                                                            <span class="badge bg-warning"><?= $ticket['priority'] ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger"><?= $ticket['priority'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <td><?= $ticket['department_name'] ?></td>
                                                    <td><?= $ticket['name'] ?></td>
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
        <!-- ===== IONICONS ===== -->
        <script>
            $(document).ready(function(){
                $('#department_id').on('change',function(){
                    var iduser = $(this).val();
                    if(iduser){
                        $.get(
                            "ajax2.php",
                            {id: iduser},
                            function(data){
                                $('#id').html(data);
                            }
                        );
                    }else{
                        $('#id').html('<option selected="" disabled="">select Department first</option>')
                    }
                });
            });
        </script>
        <!-- datatable link -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
        
        <script type="text/javascript">
            
            $('#datatableid').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        } );
    
        </script>
        
    </body>
</html>
<?php }else{
    ?>
    
    <div class="d-flex justify-content-center align-items-center p-1" style="margin-top: 120px;">
    	<div class="shadow w-350 p-3 text-center" style="background-color: white; border-radius:10%;">
            <i class="fa-solid fa-user-lock" style="font-size: 50px; color: #aaa;"></i>
            <h2>Access Restricted</h2>
            <h4 style="color: #aaa;">you dont have permission to view this page, or the page may not be<br>availabel, Please contact the owner and ask to invite you to this page,<br>or switch accounets.</h4>
        </div>
    </div>

<?php } }else{
    header("Location: login.php");
    exit();
}