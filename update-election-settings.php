<?php

session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['employeeID'])) {
    header("Location: login.php");
    exit();
}

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["save"]) || isset($_POST["flexSwitchCheckDefault1"]) || isset($_POST["flexSwitchCheckDefault2"])) {
        // Retrieve data from the form
        $isActive = $_POST["flexSwitchCheckDefault1"] == "on" ? 1 : 0;
        $isPaused = $_POST["flexSwitchCheckDefault2"] == "on" ? 1 : 0;
        $showResult = $_POST["flexSwitchCheckDefault3"] == "on" ? 1 : 0;
        $openForApply = $_POST["flexSwitchCheckDefault4"] == "on" ? 1 : 0;

        // Perform MySQL update operation
        // Sample SQL query (replace with your actual table and column names):
        $sql = "UPDATE election_settings SET IsActive = '$isActive', IsPaused = '$isPaused', showResult = '$showResult', openForApply = '$openForApply' WHERE SectionBatch = '$SectionBatch'";

        if (mysqli_query($conn, $sql)) {
            // echo "Election settings have been updated successfully.";
            header('location:dashboard.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please fill in all the required fields.";
    }
}

// Close the database connection
mysqli_close($conn);
