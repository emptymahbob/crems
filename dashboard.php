<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['employeeID'])) {
    header("Location: login.php");
    exit();
}
include('header.php');

// Include your database connection file
include('connection.php');

$employeeID = $_SESSION['employeeID'];

$sql = "SELECT SectionBatch FROM election_data WHERE employeeID = '$employeeID'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Set SectionBatch value
    $SectionBatch = $row['SectionBatch'];
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>

<h2 class="text-center mt-5 mb-2">Dashboard for <?php echo $SectionBatch; ?></h2>

<div class="container-fluid" style="width: 90%;">
    <div class="row">
        <div class="col-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">

                <!-- Import/Insert Voters code start -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Import/Insert Voters
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form method="post" action="import-voters.php" enctype="multipart/form-data">
                                <div class="container-fluid mt-2" style="width: 50%;">
                                    <hr>
                                    <h6 class="text-center">Import Voters Using xlsx File</h6>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload xlsx File:</label>
                                        <input class="form-control" type="file" name="formFile" id="formFile" aria-describedby="fileHelp" required>
                                        <div id="fileHelp" class="form-text">&nbsp;&nbsp;&nbsp;You can download the xlsx file template from <a href="list.xlsx" download>here</a></div>
                                        <input type="submit" class="btn btn-outline-success mt-2" value="Import">
                                    </div>
                                </div>
                            </form>
                            <form method="post" action="import-voters.php">
                                <div class="container-fluid mt-2" style="width: 50%;">
                                    <hr>
                                    <h6 class="text-center">Import Voter manually</h6>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Voter Name:</label>
                                        <input class="form-control" type="text" name="Name" id="Name" placeholder="Enter Voter name according to DIU registered name." required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ID" class="form-label">Voter Student ID:</label>
                                        <input class="form-control" type="text" name="VID" id="VID" placeholder="Enter voter student ID." required>
                                        <input type="submit" class="btn btn-outline-success mt-2" value="Import">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Import/Insert Voters code end -->


                <!-- Insert Candidate code start -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading2nd">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2nd" aria-expanded="false" aria-controls="flush-collapse2nd">
                            Insert Candidate
                        </button>
                    </h2>
                    <div id="flush-collapse2nd" class="accordion-collapse collapse" aria-labelledby="flush-heading2nd" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <hr>
                            <h6 class="text-center">Applicant Candidate</h6>
                            <hr>
                            <div class="container-fluid mt-1" style="width: 95%;">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-hover">
                                            <tr class="table-info">
                                                <th>SI. No.</th>
                                                <th>Candidate Name</th>
                                                <th>Candidate ID</th>
                                                <th>Symbol</th>
                                                <th>Previous Semester SGPA</th>
                                                <th>Average Attendance</th>
                                                <th>Action</th>
                                            </tr>

                                            <?php
                                            // Include your database connection file
                                            include('connection.php');

                                            // Fetch candidates data from the database (replace with your actual column names)
                                            $sql = "SELECT * FROM applyCandidate WHERE SectionBatch = '$SectionBatch'";
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                $serialNo = 1;
                                                // Loop through each row in the result set
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<tr style="cursor:pointer;">';
                                                    echo '<th>' . $serialNo . '</th>';
                                                    echo '<td>' . $row['CandidateName'] . '</td>';
                                                    echo '<td>' . $row['CandidateID'] . '</td>';
                                                    echo '<td class="fs-5">' . $row['Symbol'] . '</td>';
                                                    echo '<td class="">' . $row['sgpa'] . '</td>';
                                                    echo '<td class="">' . $row['attendance'] . '</td>';
                                                    echo '<td><a href="accept-candidate.php?CandidateID=' . $row['CandidateID'] . '&SectionBatch=' . $SectionBatch . '" class="btn btn-outline-success btn-sm mr-2">Accept</a>
                                                    <a href="deleteCandidate.php?SectionBatch=' . $row['SectionBatch'] . '&CandidateID=' . $row['CandidateID'] . '" class="btn btn-outline-danger btn-sm">Delete</a></td>';
                                                    echo '</tr>';
                                                    $serialNo++;
                                                }
                                            } else {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                            }

                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="insert-candidate.php">
                                <hr>
                                <h6 class="text-center">Insert Candidate</h6>
                                <hr>
                                <div class="container-fluid mt-2" style="width: 55%;">
                                    <div class="mb-3">
                                        <label for="cName" class="form-label">Candidate Name:</label>
                                        <input class="form-control" type="text" name="cName" id="cName" placeholder="Enter Candidate name according to DIU registered name." required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cID" class="form-label">Candidate Student ID:</label>
                                        <input class="form-control" type="text" name="cID" id="cID" placeholder="Enter Candidate student ID." required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="symbol" class="form-label">Candidate Symbol</label>
                                        <input class="form-control" type="text" name="symbol" id="symbol" placeholder="Enter Candidate Symbol" required>
                                        <input type="submit" class="btn btn-outline-success mt-2" value="Insert">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Insert Candidate code end -->


                <!-- Setting election code start -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Election Settings
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php

                            // Fetch current election settings
                            $sql = "SELECT * FROM election_settings WHERE SectionBatch = '$SectionBatch'";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                $row = mysqli_fetch_assoc($result);

                                // Set default values
                                $isActive = $row['IsActive'];
                                $isPaused = $row['IsPaused'];
                                $showResult = $row['showResult'];
                                $openForApply = $row['openForApply'];
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }

                            // Close the database connection
                            mysqli_close($conn);
                            ?>
                            <form method="post" action="update-election-settings.php">
                                <div class="container-fluid mt-2" style="width: 100%;">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input" type="checkbox" name="flexSwitchCheckDefault1" id="flexSwitchCheckDefault1" <?php echo $isActive == 1 ? "checked" : ""; ?>>
                                                <label class="form-check-label" for="flexSwitchCheckDefault1">Active or Inactive the Election</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input" type="checkbox" name="flexSwitchCheckDefault2" id="flexSwitchCheckDefault2" <?php echo $isPaused == 1 ? "checked" : ""; ?>>
                                                <label class="form-check-label" for="flexSwitchCheckDefault2">Pause or Resume the Vote</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input" type="checkbox" name="flexSwitchCheckDefault3" id="flexSwitchCheckDefault3" <?php echo $showResult == 1 ? "checked" : ""; ?>>
                                                <label class="form-check-label" for="flexSwitchCheckDefault3">Show the Election Result</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input" type="checkbox" name="flexSwitchCheckDefault4" id="flexSwitchCheckDefault4" <?php echo $openForApply == 1 ? "checked" : ""; ?>>
                                                <label class="form-check-label" for="flexSwitchCheckDefault4">Open for Application</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="container-fluid mt-1" style="width: 40%;">
                                                <input class="btn btn-outline-success btn-sm" type="submit" name="save" value="Save Settings">
                                            </div>
                                        </div>
                            </form>
                            <div class="col-2 mt-1">
                                <div class="form-check center form-switch">
                                    <form action="delete-election.php" method="post">
                                        <input type="hidden" name="SectionBatch" value="<?php echo $SectionBatch; ?>">
                                        <input class="btn btn-outline-danger btn-sm" type="submit" name="deleteElection" value="Delete the Election">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Setting election code end -->



        <!-- View candidate code start -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    View Candidates
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <tr class="table-success">
                                        <th>Serial No.</th>
                                        <th>Candidate Name</th>
                                        <th>Candidate ID</th>
                                        <th>Symbol</th>
                                        <th>Action</th>
                                    </tr>

                                    <?php
                                    // Include your database connection file
                                    include('connection.php');

                                    // Fetch candidates data from the database (replace with your actual column names)
                                    $sql = "SELECT * FROM candidates WHERE SectionBatch = '$SectionBatch'";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        $serialNo = 1;
                                        // Loop through each row in the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr style="cursor:pointer;">';
                                            echo '<th>' . $serialNo . '</th>';
                                            echo '<td>' . $row['CandidateName'] . '</td>';
                                            echo '<td>' . $row['CandidateID'] . '</td>';
                                            echo '<td class="fs-5">' . $row['Symbol'] . '</td>';
                                            echo '<td><a href="delete-candidate.php?CandidateID=' . $row['CandidateID'] . '&SectionBatch=' . $SectionBatch . '" class="btn btn-outline-danger btn-sm">Delete</a></td>';
                                            echo '</tr>';
                                            $serialNo++;
                                        }
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }

                                    // Close the database connection
                                    mysqli_close($conn);
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- View candidate code end -->




        <!-- View Voters code start -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                    View Voters
                </button>
            </h2>
            <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-heading4" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <tr class="table-success">
                                        <th>Serial No.</th>
                                        <th>Voter Name</th>
                                        <th>Voter Student ID</th>
                                        <th>Action</th>
                                    </tr>

                                    <?php
                                    // Include your database connection file
                                    include('connection.php');

                                    // Fetch voters data from the database (replace with your actual column names)
                                    $sql = "SELECT * FROM voters WHERE SectionBatch = '$SectionBatch'";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        $serialNo = 1;
                                        // Loop through each row in the result set
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr style="cursor:pointer;">';
                                            echo '<th>' . $serialNo . '</th>';
                                            echo '<td>' . $row['Name'] . '</td>';
                                            echo '<td>' . $row['VID'] . '</td>';
                                            echo '<td><a href="delete-voter.php?VID=' . $row['VID'] . '&SectionBatch=' . $SectionBatch . '" class="btn btn-outline-danger btn-sm">Delete</a></td>';
                                            echo '</tr>';
                                            $serialNo++;
                                        }
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }

                                    // Close the database connection
                                    mysqli_close($conn);
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- View Voters code end -->


        <?php
        // Include your database connection file
        include('connection.php');

        // Fetch candidates data from the database (replace with your actual column names)
        $candidatesQuery = "SELECT c.CandidateID, c.CandidateName, c.Symbol, COUNT(v.VID) as Votes 
                    FROM candidates c
                    LEFT JOIN votes v ON c.CandidateID = v.CandidateID
                    WHERE c.SectionBatch = '$SectionBatch'
                    GROUP BY c.CandidateID
                    ORDER BY Votes DESC";

        $candidatesResult = mysqli_query($conn, $candidatesQuery);

        if (!$candidatesResult) {
            echo "Error: " . $candidatesQuery . "<br>" . mysqli_error($conn);
            exit();
        }

        // Fetch total number of voters
        $totalVotersQuery = "SELECT COUNT(DISTINCT VID) as TotalVoters FROM votes";
        $totalVotersResult = mysqli_query($conn, $totalVotersQuery);

        if (!$totalVotersResult) {
            echo "Error: " . $totalVotersQuery . "<br>" . mysqli_error($conn);
            exit();
        }

        $rowTotalVoters = mysqli_fetch_assoc($totalVotersResult);
        $totalVoters = $rowTotalVoters['TotalVoters'];

        ?>

        <!-- view result code start -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                    View Results
                </button>
            </h2>
            <div id="flush-collapse5" class="accordion-collapse collapse show" aria-labelledby="flush-heading5" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <tr class="table-success">
                                        <th class="text-center">Rank</th>
                                        <th class="text-center">Candidate Name</th>
                                        <th class="text-center">Candidate ID</th>
                                        <th class="text-center">Symbol</th>
                                        <th class="text-center">No. of Votes / No. of Voters</th>
                                    </tr>
                                    <?php
                                    $rank = 1;
                                    while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                        echo '<tr style="cursor:pointer;">';
                                        echo '<th class="text-center"># ' . $rank . '.</th>';
                                        echo '<td class="text-center">' . $row['CandidateName'] . '</td>';
                                        echo '<td class="text-center">' . $row['CandidateID'] . '</td>';
                                        echo '<td class="fs-5 text-center">' . $row['Symbol'] . '</td>';
                                        echo '<td class="text-center">' . $row['Votes'] . ' votes out of ' . $totalVoters . ' voters</td>';
                                        echo '</tr>';
                                        $rank++;
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- view result code end -->

        <?php
        // Close the database connection
        mysqli_close($conn);
        ?>



    </div>
</div>
</div>
</div>

<?php
include('footer.php');
?>
