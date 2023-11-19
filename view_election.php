<?php
// Include your database connection file
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['SectionBatch'])) {
    // Retrieve voter ID from the URL parameter
    $SectionBatch = $_GET['SectionBatch'];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize input data before deleting from the database
    $SectionBatch = mysqli_real_escape_string($conn, $SectionBatch);
}

include('header.php');
?>
<br>
<h2 class="text-center mt-5 mb-5">All the candidates of the <?php echo $SectionBatch; ?></h2>

<div class="container-fluid mt-2" style="width: 50%;">
    <div class="row">
        <div class="col-12">
            <?php

            // Fetch candidate data from the database
            $sql = "SELECT * FROM candidates WHERE SectionBatch = '$SectionBatch'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<table class="table table-hover">';
                echo '<tr class="table-success">';
                echo '<th class="text-center">Candidate Name</th>';
                echo '<th class="text-center">Candidate ID</th>';
                echo '<th class="text-center">Symbol</th>';
                echo '</tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr style="cursor:pointer;">';
                    echo '<td class="text-center">' . $row['CandidateName'] . '</td>';
                    echo '<td class="text-center">' . $row['CandidateID'] . '</td>';
                    echo '<td class="fs-5 text-center">' . $row['Symbol'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
                echo '</div>';
            }
            ?>

        </div>
    </div>
</div>
<div class="container-fluid mt-2" style="width: 50%;">
    <div class="row">
        <div class="col-12">

            <?php
            // Fetch election settings data where IsPaused is 1
            $sql = "SELECT * FROM election_settings WHERE IsPaused = 1 ";
            $Result = mysqli_query($conn, $sql);

            if ($Result) {
                if (mysqli_num_rows($Result) > 0) {
            ?>
                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Voting is currently Paused.">
                        <button class="btn btn-outline-success" type="button" disabled>Vote</button>
                    </span>
                <?php
                } else {
                ?>
                    <input class="btn btn-outline-success" data-bs-toggle="modal" value="Vote" data-bs-target="#staticBackdrop">

            <?php
                    echo '<div class="alert alert-warning mt-4" role="alert">';
                    echo 'Voting is currently Paused.';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    <?php
    // Close the database connection
    mysqli_close($conn);
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Vote Your Candidate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="vote_process.php">
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="selectcandidate" class="form-label"><b>Select Candidate</b></label>
                            <select class="form-select" name="CandidateID" id="selectcandidate" aria-label="Default select example">
                                <option selected>Select your Candidate</option>
                                <?php
                                // Include your database connection file
                                include('connection.php');

                                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['SectionBatch'])) {
                                    // Retrieve voter ID from the URL parameter
                                    $SectionBatch = $_GET['SectionBatch'];

                                    // Check connection
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    // Sanitize input data before deleting from the database
                                    $SectionBatch = mysqli_real_escape_string($conn, $SectionBatch);
                                }
                                // Populate the dropdown with candidate names
                                $result = mysqli_query($conn, "SELECT * FROM candidates WHERE SectionBatch = '$SectionBatch'");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['CandidateID'] . '">' . $row['CandidateName'] . ' ' . $row['Symbol'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="voterName" class="form-label"><b>Voter Student Name</b></label>
                            <input type="text" class="form-control" name="Name" id="Name" placeholder="Enter your name according to your DIU registration name." required>
                        </div>
                        <div class="mb-3">
                            <label for="studentid" class="form-label"><b>Voter Student ID</b></label>
                            <input type="text" class="form-control" name="VID" id="studentid" placeholder="Enter your DIU student ID." required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="SectionBatch" value="<?php echo $SectionBatch; ?>">
                <button type="submit" class="btn btn-outline-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>