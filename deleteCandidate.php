<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve parameters from the URL
    $CandidateID = $_GET['CandidateID'];
    $SectionBatch = $_GET['SectionBatch'];

    // Delete candidate from applyCandidate table
    $deleteFromApplyQuery = "DELETE FROM applyCandidate WHERE CandidateID = '$CandidateID' AND SectionBatch = '$SectionBatch'";
    if (mysqli_query($conn, $deleteFromApplyQuery)) {
        header('location: dashboard.php'); // Redirect to candidates.php or wherever you want
        exit();
    } else {
        echo "Error deleting candidate: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

