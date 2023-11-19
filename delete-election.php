<?php
// Include your database connection file
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteElection'])) {
    // Fetch SectionBatch from the URL
    $SectionBatch = $_POST['SectionBatch'];

    // Delete data from applycandidate table
    $deleteApplyCandidateQuery = "DELETE FROM applycandidate WHERE SectionBatch = '$SectionBatch'";
    mysqli_query($conn, $deleteApplyCandidateQuery);

    // Delete data from candidates table
    $deleteCandidatesQuery = "DELETE FROM candidates WHERE SectionBatch = '$SectionBatch'";
    mysqli_query($conn, $deleteCandidatesQuery);

    // Delete data from election_data table
    $deleteElectionDataQuery = "DELETE FROM election_data WHERE SectionBatch = '$SectionBatch'";
    mysqli_query($conn, $deleteElectionDataQuery);

    // Delete data from election_settings table
    $deleteElectionSettingsQuery = "DELETE FROM election_settings WHERE SectionBatch = '$SectionBatch'";
    mysqli_query($conn, $deleteElectionSettingsQuery);

    // Delete data from voters table
    $deleteVotersQuery = "DELETE FROM voters WHERE SectionBatch = '$SectionBatch'";
    mysqli_query($conn, $deleteVotersQuery);

    // Delete data from votes table
    $deleteVotesQuery = "DELETE FROM votes WHERE SectionBatch = '$SectionBatch'";
    mysqli_query($conn, $deleteVotesQuery);

    // Redirect to a suitable page after deletion
    header('Location: logout.php'); // Change this to your desired redirect location
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
