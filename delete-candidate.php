<?php
// Include your database connection file
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['CandidateID']) && isset($_GET['SectionBatch'])) {
    // Retrieve candidate ID from the URL parameter
    $CandidateID = $_GET['CandidateID'];
    $SectionBatch = $_GET['SectionBatch'];
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize input data before deleting from the database
    $CandidateID = mysqli_real_escape_string($conn, $CandidateID);
    $SectionBatch = mysqli_real_escape_string($conn, $SectionBatch);

    // Delete the candidate from the database
    $deleteSql = "DELETE FROM candidates WHERE CandidateID = '$CandidateID' AND SectionBatch = '$SectionBatch'";
    if (mysqli_query($conn, $deleteSql)) {
        // echo "Candidate deleted successfully.";
        header('location:dashboard.php');
        exit();
    } else {
        echo "Error deleting candidate: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
