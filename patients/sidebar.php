
<html>
<head>
    <style>
        sidebar {
            height: 100%;
            width: 160px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }




    </style>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



</head>
<body>
<sidebar>

    <div class="d-flex flex-column flex-shrink-0 p-3 bg-primary" style="width: 200px; height:100%">

        <div><a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="dashboard.php" class="nav-link active" style="font-size: 18px;">

                        <i class="fa fa-dashboard" style="font-size:24px"></i>
                        Dashboard
                    </a>
                </li>
                <hr>
                <li>
                    <a href="profile.php" class="nav-link active" style="font-size: 18px;">
                        <i class="fa fa-user" style="font-size:24px"></i>
                        Profile
                    </a>
                </li>
                <hr>

                <li>
                    <a href="appointment.php" class="nav-link active" style="font-size: 18px;">
                        <i class="fa fa-stethoscope"style="font-size:24px"></i>
                      Book Appointments
                    </a>
                </li>
                <hr>
                <li>
                    <a href="my_appointments.php" class="nav-link active" style="font-size: 18px;">
                        <i class="fa fa-heartbeat" style="font-size:24px"></i>
                    My appointments
                    </a>
                </li>
                <hr>
                <li>
                    <a href="change_password.php" class="nav-link active" style="font-size: 18px;">
                        <i class="fa fa-lock" style="font-size:24px"></i>
                        Change Password
                    </a>
                </li>
                <hr>

            </ul>
        </div>

    </div>
</sidebar>
</body>
</html>
