<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $CandidateName = mysqli_real_escape_string($conn, $_POST['CandidateName']);
    $CandidateID = mysqli_real_escape_string($conn, $_POST['CandidateID']);
    $Symbol = mysqli_real_escape_string($conn, $_POST['Symbol']);
    $sgpa = mysqli_real_escape_string($conn, $_POST['sgpa']);
    $attendance = mysqli_real_escape_string($conn, $_POST['attendance']);
    $SectionBatch = mysqli_real_escape_string($conn, $_POST['SectionBatch']);

    // Insert data into the applyCandidate table
    $sql = "INSERT INTO applyCandidate (CandidateName, CandidateID, Symbol, sgpa, attendance, SectionBatch)
            VALUES ('$CandidateName', '$CandidateID', '$Symbol', '$sgpa', '$attendance', '$SectionBatch')";

    if (mysqli_query($conn, $sql)) {
        // echo "Candidate applied successfully!";
        header('location:applyCandidate.php?SectionBatch='. $SectionBatch);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
