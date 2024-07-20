<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <style>
.card-hover:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease-in-out;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.card-custom {
    width: 350px; /* Ensures consistent card width */
    margin-bottom: 1rem; /* Spacing between cards */
}

.card-body-link {
    display: block;
    color: inherit; /* Keeps text color the same */
    text-decoration: none; /* No underline */
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
                    <div class="d-sm-flex justify-content-between align-items-center mb-4"></div>
                        <div class="row" style="margin: -13px;">
                        <div class="col-lg-12 mb-4 d-flex justify-content-start">

                        <div class="card shadow border-start-primary py-2 me-4" style="width: 350px;"> 
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                    <div class="col ms-3">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1">Events available now</div>

                                        <?php 
                                        include("admin-database.php");
                                        $sql = "SELECT COUNT(eventName) AS eventCount FROM crud"; //total count of events
                                        $result = mysqli_query($conn , $sql);
                                        $row = mysqli_fetch_array($result);
                                        $eventCount = $row['eventCount'];
                                        ?>
                                        <div class="text-dark fw-bold h5 mb-0"><span><?php echo $eventCount; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <div class="card shadow border-start-primary py-2" style="width: 350px;"> 
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                                <div class="col ms-3">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1">Members available now</div>
                                    
                                    <?php 
                                    include("admin-database.php");
                                    $sql = "SELECT COUNT(email) AS userCount FROM users"; //total count of users
                                    $result = mysqli_query($conn , $sql);
                                    $row = mysqli_fetch_array($result);
                                    $eventCount = $row['userCount'];
                                    ?>

                                    <div class="text-dark fw-bold h5 mb-0"><span><?php echo $eventCount; ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <?php
                //show hot shows
                    include("admin-database.php");
                    $sql = "SELECT c.eventName, c.date, SUM(ep.seats_booked) AS seat_booked ,c.id
                            FROM crud c
                            JOIN event_participants ep
                            ON c.id = ep.event_id
                            GROUP BY c.id
                            ORDER BY seat_booked DESC
                            LIMIT 3";

                    
                    $result = mysqli_query($conn, $sql);
                    
                    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>




<div class="col-lg-12 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-primary fw-bold m-0">Hot Shows</h6>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($result as $row)
            {
                ?>
            <a href="admin-view.php?id=<?php echo $row['id']; ?>" class="list-group-item list-group-item-action">
                <div class="row align-items-center no-gutters">
                    <div class="col-auto">
                        <i class="fas fa-fire hot-show-icon"></i>
                    </div>
                    <div class="col me-2">
                        <h6 class="mb-0"><strong><?php echo htmlspecialchars($row['eventName']); ?></strong></h6>
                        <div class="small text-gray-500"><?php echo htmlspecialchars($row['date']); ?></div>
                        <span class="badge bg-primary rounded-pill"><?php echo htmlspecialchars($row['seat_booked']); ?> ticket booked</span>
                    </div>
                </div>
                    <?php
            }
            ?>
            </a>
        </ul>
    </div>
</div>


                    










                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>