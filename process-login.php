<?php
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

    // Sanitize input data before using it in the query
    $employeeID = mysqli_real_escape_string($conn, $employeeID);
    $password = mysqli_real_escape_string($conn, $password);
    $SectionBatch = mysqli_real_escape_string($conn, $SectionBatch);

    // Check if the entered credentials exist in the database
    $query = "SELECT * FROM election_data WHERE EmployeeID = '$employeeID' AND Password = '$password' AND SectionBatch = '$SectionBatch'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Set session variables upon successful login
        $_SESSION['employeeID'] = $employeeID;
        $_SESSION['SectionBatch'] = $SectionBatch;

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p style='color: red;'>Login failed. Please check your credentials.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
