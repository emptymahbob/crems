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
    if (isset($_POST["cName"]) && isset($_POST["cID"]) && isset($_POST["symbol"])) {
        // Retrieve candidate data from the form
        $candidateName = $_POST["cName"];
        $CandidateID = $_POST["cID"];
        $candidateSymbol = $_POST["symbol"];

        // Perform MySQL insert operation
        // Sample SQL query (replace with your actual table and column names):
        $sql = "INSERT INTO candidates (CandidateName, CandidateID, Symbol, SectionBatch) VALUES ('$candidateName', '$CandidateID', '$candidateSymbol', '$SectionBatch')";

        if (mysqli_query($conn, $sql)) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please fill in all the required fields.";
    }
}

// Close the database connection
mysqli_close($conn);
