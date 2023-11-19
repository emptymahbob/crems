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

// Function to handle xlsx file import
function importFromXlsx($filePath, $conn)
{
    // Your logic to read data from xlsx file and insert into the database
    // This will depend on the library you use for reading xlsx files
    // Example: PHPExcel, PhpSpreadsheet, etc.

    // After reading data, perform MySQL insert operations
    // Insert each voter into the database
    // Sample SQL query (replace with your actual table and column names):
    // $sql = "INSERT INTO voters (Name, VID) VALUES ('$name', '$studentVID')";
    // mysqli_query($conn, $sql);

    // Example using PhpSpreadsheet library
    require 'vendor/autoload.php'; // Make sure to include the path to your autoload.php file

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    foreach ($sheetData as $row) {
        $name = $row['A']; // Assuming name is in column A
        $studentVID = $row['B']; // Assuming student VID is in column B
        $sectionBatch = $row['C'];

        // Perform MySQL insert operation
        $sql = "INSERT INTO voters (Name, VID, SectionBatch) VALUES ('$name', '$studentVID', '$sectionBatch')";
        mysqli_query($conn, $sql);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["formFile"])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["formFile"]["name"]);

        // Upload the file
        if (move_uploaded_file($_FILES["formFile"]["tmp_name"], $targetFile)) {
            // Call the function to import data from the xlsx file
            importFromXlsx($targetFile, $conn);

            header("Location: dashboard.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } elseif (isset($_POST["Name"]) && isset($_POST["VID"])) {
        // Insert voter data manually
        $name = $_POST["Name"];
        $studentVID = $_POST["VID"];

        // Perform MySQL insert operation
        $sql = "INSERT INTO voters (Name, VID, SectionBatch) VALUES ('$name', '$studentVID', '$SectionBatch')";
        mysqli_query($conn, $sql);

        header("Location: dashboard.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
