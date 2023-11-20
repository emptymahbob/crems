<?php
// Include your database connection file
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $candidateID = $_POST['CandidateID'];
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $vid = mysqli_real_escape_string($conn, $_POST['VID']);
    $sectionBatch = mysqli_real_escape_string($conn, $_POST['SectionBatch']);

    // Check if the voter has already voted for another candidate
    $checkVoteQuery = "SELECT * FROM votes WHERE VID = '$vid' AND SectionBatch = '$sectionBatch'";
    $checkVoteResult = mysqli_query($conn, $checkVoteQuery);

    if (mysqli_num_rows($checkVoteResult) > 0) {
        // Voter has already voted
        echo "Multiple votes are not allowed.";
        exit();
    }

    // Validate the voter details
    $validateVoterQuery = "SELECT * FROM voters WHERE VID = '$vid' AND `Name` = '$name' AND `SectionBatch` = '$sectionBatch'";
    $validateVoterResult = mysqli_query($conn, $validateVoterQuery);

    if (mysqli_num_rows($validateVoterResult) === 0) {
        // Invalid voter details
        echo "Invalid voter details. Please check your name and student ID.";
        exit();
    }

    // Update the votes table to record the vote
    $insertVoteQuery = "INSERT INTO votes (CandidateID, VID, SectionBatch) VALUES ('$candidateID', '$vid', '$sectionBatch')";
    if (mysqli_query($conn, $insertVoteQuery)) {
        // Vote submitted successfully
        header('location:view_election.php?SectionBatch='.$sectionBatch);
        exit();
    } else {
        echo "Error: " . $insertVoteQuery . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
