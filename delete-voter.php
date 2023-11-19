<?php
// Include your database connection file
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['VID']) && isset($_GET['SectionBatch'])) {
    // Retrieve voter ID from the URL parameter
    $VID = $_GET['VID'];
    $SectionBatch = $_GET['SectionBatch'];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize input data before deleting from the database
    $VID = mysqli_real_escape_string($conn, $VID);
    $SectionBatch = mysqli_real_escape_string($conn, $SectionBatch);

    // Delete the voter from the database
    $deleteSql = "DELETE FROM voters WHERE VID = '$VID' AND SectionBatch = '$SectionBatch'";
    if (mysqli_query($conn, $deleteSql)) {
        // echo "Voter deleted successfully.";
        header('location:dashboard.php');
        exit();
    } else {
        echo "Error deleting voter: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
