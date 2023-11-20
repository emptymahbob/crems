<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $CandidateName = mysqli_real_escape_string($conn, $_POST['CandidateName']);
    $CandidateID = mysqli_real_escape_string($conn, $_POST['CandidateID']);
    $Symbol = mysqli_real_escape_string($conn, $_POST['Symbol']);
    $sgpa = mysqli_real_escape_string($conn, $_POST['sgpa']);
    $attendance = mysqli_real_escape_string($conn, $_POST['attendance']);
    $SectionBatch = mysqli_real_escape_string($conn, $_POST['SectionBatch']);

    // Check if the candidate exists in the voters table
    $checkVoterQuery = "SELECT * FROM voters WHERE VID = '$CandidateID'";
    $checkVoterResult = mysqli_query($conn, $checkVoterQuery);

    if (mysqli_num_rows($checkVoterResult) > 0) {
        // Candidate exists in voters table, check if already applied
        $checkAppliedQuery = "SELECT * FROM applyCandidate WHERE CandidateID = '$CandidateID' AND SectionBatch = '$SectionBatch'";
        $checkAppliedResult = mysqli_query($conn, $checkAppliedQuery);

        if (mysqli_num_rows($checkAppliedResult) > 0) {
            // Candidate has already applied
            echo "You have already applied. Multiple applications are not allowed.";
        } else {
            // Candidate does not exist in applyCandidate table, proceed with the application
            $sql = "INSERT INTO applyCandidate (CandidateName, CandidateID, Symbol, sgpa, attendance, SectionBatch)
                    VALUES ('$CandidateName', '$CandidateID', '$Symbol', '$sgpa', '$attendance', '$SectionBatch')";

            if (mysqli_query($conn, $sql)) {
                // echo "Candidate applied successfully!";
                header('location:applyCandidate.php?SectionBatch=' . $SectionBatch);
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        // Candidate does not exist in the voters table
        echo "Candidate with ID $CandidateID does not exist. Application not allowed.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
