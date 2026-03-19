<?php 
require_once "importance.php"; 

if(!User::loggedIn()){
    Config::redir("login.php"); 
}
?> 

<html>
<head>
    <title><?php echo CONFIG::SYSTEM_NAME; ?> | Home</title>
    <?php require_once "inc/head.inc.php"; ?> 

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f9ff;
            margin: 0;
            padding: 0;
        }

        .content-area {
            padding: 20px;
        }

        .content-header {
            font-size: 24px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .content-header small {
            font-size: 14px;
            color: #555555;
        }

        .dashboard-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .dashboard-card {
            flex: 1 1 200px;
            min-width: 200px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .dashboard-card h3 {
            font-size: 18px;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            font-size: 14px;
            color: #555555;
            margin-bottom: 15px;
        }

        .dashboard-card a {
            display: inline-block;
            padding: 8px 20px;
            background-color: #0d6efd;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .dashboard-card a:hover {
            background-color: #0b5ed7;
        }

        /* sidebar */
        .sidebar-area {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        }

        /* responsive */
        @media (max-width: 992px) {
            .dashboard-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php require_once "inc/header.inc.php"; ?> 

    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-2'>
                <div class="sidebar-area">
                    <?php require_once "inc/sidebar.inc.php"; ?>
                </div>
            </div>

            <div class='col-md-10'>
                <div class='content-area'> 
                    <div class='content-header'> 
                        Dashboard <small>View your dashboard</small>
                    </div>

                    <div class="dashboard-row">
                        <?php Dashboard::draw("Outbreaks", Dashboard::outbreaks(),  "outbreaks.php") ?>
                        <?php if($userStatus == 1){ Dashboard::draw("Doctors", Dashboard::doctors(),  "doctors-record.php"); } ?>
                        <?php Dashboard::draw("Patients", Dashboard::patients(),  "patients.php") ?>
                        <?php Dashboard::draw("Patient Book", Dashboard::getPatientRecords(),  "patients.php") ?>
                        <?php Dashboard::draw("Appointments", Dashboard::Appointments(),  "appointments.php") ?>
                        <?php Dashboard::draw("Replied Appts.", Dashboard::repliedAppointMents(),  "appointments.php") ?>
                        <?php Dashboard::draw("HIV Record", Dashboard::hivPatients(),  "hiv.php") ?>
                        <?php Dashboard::draw("Change Password", "",  "change-password.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>