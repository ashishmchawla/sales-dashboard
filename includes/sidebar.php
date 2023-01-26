</head>

<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-light" id="sidebar-wrapper">
            <div class="sidebar-heading" style="color:white;">
                <img src="../assets/logo.png" style="height:50px">
            </div>
            <div class="list-group list-group-flush">
                <a href="../home/index.php" class="list-group-item list-group-item-action text-zooters">
                    <img src="../assets/dashboard.png" height="20"> Dashboard
                </a>
                <a href="../users/index.php" class="list-group-item list-group-item-action text-zooters">
                    <img src="../assets/user.png" height="20"> Users
                </a>
                <a href="../leads/index.php" class="list-group-item list-group-item-action text-zooters">
                    <img src="../assets/people.png" height="20"> Leads
                </a>
                <a href="../notifications/index.php" class="list-group-item list-group-item-action text-zooters">
                    <img src="../assets/notification.png" height="20"> Push Notifications
                </a>
                <a href="../settings/index.php" class="list-group-item list-group-item-action text-zooters">
                    <img src="../assets/settings.png" height="20"> System Settings
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-zooters border-bottom">
                <a id="menu-toggle" style="color:white;"><i class="fa fa-bars"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="color:white;"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                        <li class="nav-item"></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" style="color:white" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <i class="fas fa-user-shield"></i> -->
                                &nbsp; <?php echo $_SESSION['name']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php"> <i class="fas fa-sign-out-alt"></i>&nbsp;
                                    Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>