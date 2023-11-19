<!DOCTYPE html>
<html lang="en">

<head>
    <title>DIU-CREMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <nav class="fixed-top navbar navbar-expand-sm bg-success navbar-success">
        <div class="container-fluid" style="width: 70%;">
            <a class="navbar-brand" href="index.php"><b>
                    <h3><span class="text-warning">DIU </span><span class="text-info"> CREMS</span></h3>
                </b></a>
            <ul class="navbar-nav">

                <?php
                $currentUrl = $_SERVER['REQUEST_URI'];
                if ($currentUrl == "/diu-crems/dashboard.php") {
                ?>
                    <li class="nav-item">
                        <a class="nav-link text-white btn btn-outline-info" onclick="javascript:return confirm('Do you really want to Logout?')" href="logout.php">
                            Logout
                        </a>
                    </li>

                    <?php
                } else {

                    if (!isset($_SESSION['employeeID'])) {
                    ?>

                        <li class="nav-item">
                            <a class="nav-link text-white btn btn-outline-info" href="dashboard.php">Dashboard</a>
                        </li>

                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link text-white btn btn-outline-info" href="login.php">Login</a>
                        </li>
                <?php
                    }
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white btn btn-outline-info" href="start_election.php">Start New Election</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn btn-outline-info" href="elections.php">View Elections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn btn-outline-info" href="view_results.php">View Results</a>
                </li>
            </ul>
        </div>
    </nav><br><br>