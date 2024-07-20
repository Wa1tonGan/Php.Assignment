<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #64739b;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-theater-masks"></i></div>
                    <div class="sidebar-brand-text mx-3"><span style="font-size: 14px;">theatre society</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                <?php
                    include("admin-database.php");

                    $sql = "SELECT * FROM crud";

                    $result =mysqli_query($conn , $sql);
                    $row = mysqli_fetch_array($result);
                    if($row)
                    {
                    ?>
                        <li class="nav-item"><a class="nav-link active" href="admin-index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a><a class="nav-link" href="admin-event.php"><i class="far fa-calendar-alt"></i><span>Events</span></a><a class="nav-link" href="attendees1.php?event_id=<?php echo $row['id']; ?>"><i class="fas fa-users"></i><span>Attendees</span></a><a class="nav-link" href="admin-member.php"><i class="fas fa-user-friends"></i><span>Members</span></a></li>
                    <?php
                }
                    ?>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mb-0">Admin Panel</h3>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown show no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="true" data-bs-toggle="dropdown" href="#"><i class="far fa-user" style="font-size: 34px;"></i></a>
                                    <div class="dropdown-menu show shadow dropdown-menu-end animated--grow-in" data-bs-popper="none"><a class="dropdown-item" href="admin-logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Attendees</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">List of Event for&nbsp;<select onchange="location = this.value;" name="event_id">
                            <?php
                            include("admin-database.php");

                            $sql = "SELECT eventName, id
                                    FROM crud 
                                    ORDER BY eventName";
                    
                            $result =  mysqli_query($conn,$sql);
                            $row  =  mysqli_fetch_array($result);
                                ?>
                                    <optgroup label for ="event_id">
                                            <?php 
                                            foreach($result as $row) 
                                            { 
                                                
                                    ?>
                                        <option value="attendees1.php?event_id=<?php echo $row["id"];?>" <?php if($row["id"] == $_GET["event_id"]) {echo "Selected";}  ?> ><?php echo $row['eventName'] ?></option>

                                        <?php
                                            }
                                        ?>
                                    </optgroup>
                                <?php
                            
                            ?>
                                </select>
                                

                                

                            
                            
                            
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Event</th>
                                            <th>Seat Booked</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        include("admin-database.php");

                                      

                                        $event_id = $_GET['event_id'];

                                        $sql = "SELECT u.email, c.eventName, SUM(ep.seats_booked) AS total_seats_booked ,u.id ,ep.blacklisted
                                                FROM users u
                                                JOIN event_participants ep 
                                                ON u.id = ep.user_id
                                                JOIN crud c 
                                                ON ep.event_id = c.id
                                                WHERE c.id = $event_id
                                                GROUP BY u.email ,c.eventName ";  
                                        
                                                

                                        $result = mysqli_query($conn, $sql);
                                        $row  = mysqli_fetch_array($result);
                                        
                                        
                                        foreach($result as $row)
                                        {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['eventName']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['total_seats_booked']) . "</td>";
                                            if ($row['blacklisted'] == 1) {
                                                echo "<td><span class='badge bg-danger'>Blacklisted</span></td>";
                                                echo "<td><a href='admin-unblacklistuser.php?user_id=" . $row['id'] . "&event_id=" . $event_id . "'' class='btn btn-warning'>Unblock</a></td> "; //parameter for unblacklisting      
                                            } 
                                            else 
                                            {
                                                echo "<td><span class='badge bg-success'>Active</span></td>";
                                                echo "<td><a href='admin-blacklist.php?user_id=" . $row['id'] . "&event_id=" . $event_id . "' class='btn btn-danger'>BlackList</a></td>"; //parameter for blacklisting
                                            }                                           
                                            echo "</td>";
                                            echo "</tr>";
                                        

                                        }
                                    ?>
                                    </tbody>

                                
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"></div>
                </div>
            </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>


