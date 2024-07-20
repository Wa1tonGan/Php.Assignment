<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">

    <style>
    .img-table {
        width: 70px;  
        height: 70px; 
        object-fit: cover; 
    }
</style>


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
                    <h3 class="text-dark mb-4">Current Events</h3>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"></div>
                                </div>
                            </div>
                            <div class="col-xl-12" style="margin: 4px;padding: 31px;padding-left: 9px;padding-bottom: 29px;padding-right: 31px;"><a href="admin-add.php"><button class="btn btn-primary" type="button" style="width: 132.2875px;height: 41.6px;margin: 1px;padding: 3px 12px;margin-left: 0px;margin-bottom: 0px;margin-top: -10px;">Add Event</button></a></div>

                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 272.125px;">Title</th>
                                            <th style="width: 154.55px;">Date</th>
                                            <th style="width: 101.387px;">Time</th>
                                            <th style="width: 83.35px;">Pax</th>
                                            <th style="width: 148.637px;">Location</th>
                                            <th style="width: 100px;">Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    include("admin-database.php");

                                    $sql= "SELECT * FROM crud";

                                    $result=mysqli_query($conn ,$sql);

                                    while($row = mysqli_fetch_array($result)) 
                                    {
                                        //display event details
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row["eventName"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["time"]) . "</td>";            
                                        echo "<td>" . htmlspecialchars($row["pax"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["location"]) . "</td>";
                                        echo "<td><img src='" . htmlspecialchars($row['imagePath']) . "' class='img-table'/></td> ";
                                        echo "<td>";echo "<a href='admin-view.php?id=" . $row["id"] . "' class='btn btn-info'>Read More </a> ";
                                        echo "<a href='admin-edit.php?id=" . $row["id"] . "' class='btn btn-warning'>Edit </a> ";
                                        echo "<a href='#' class='btn btn-danger' onclick='return confirmation(" . $row["id"] . ");'>Delete</a> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                    <script>
                                        //connfirmation for delete by  using javascript
                                        function confirmation(eventId) {
                                            if (confirm("Are you sure you want to delete this user?")) {
                                                 window.location.href = 'admin-delete.php?id=' + eventId;
                                                }
                                                return false; 
                                            }
                                    </script>
                                    <?php 
                                    //pass back the success or error message
                                    if (isset($_GET['success']))
                                    {
                                        echo "<script>
                                        alert('Deleted successfully.');
                                        window.location.href = 'admin-event.php';
                                        </script>";
                                    }
                                    if (isset($_GET['error']))
                                    {
                                        echo "<script>
                                        alert('Cannot delete event because someone already booked');
                                        window.location.href = 'admin-event.php';
                                        </script>";
                                    }
                                    if (isset($_GET['errors']))
                                    {
                                        echo "<script>
                                        alert('Error deleting event.');
                                        </script>";
                                    }
?>
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
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>