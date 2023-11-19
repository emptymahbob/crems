<?php
session_start();
// Include your database connection file
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employeeID = $_POST['EmployeeID'];
    $password = $_POST['Password'];
    $SectionBatch = $_POST['SectionBatch'];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize input data before inserting into the database
    $employeeID = mysqli_real_escape_string($conn, $employeeID);
    $password = mysqli_real_escape_string($conn, $password);
    $SectionBatch = mysqli_real_escape_string($conn, $SectionBatch);

    // Insert data into the database (replace with your actual table and column names)
    $sql = "INSERT INTO election_data (employeeID, password, SectionBatch) VALUES ('$employeeID', '$password', '$SectionBatch')";

    $sqlElectionSettings = "INSERT INTO election_settings (SectionBatch, IsActive, IsPaused, showResult, openForApply) VALUES ('$SectionBatch', 0, 0, 0, 0)";
    mysqli_query($conn, $sqlElectionSettings);

    if (mysqli_query($conn, $sql)) {
        $_SESSION['employeeID'] = $employeeID;
        $_SESSION['SectionBatch'] = $SectionBatch;
        header('location:dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
