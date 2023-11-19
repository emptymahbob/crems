<?php
session_start();

// Check if the user is already logged in, redirect to the dashboard
if (isset($_SESSION['employeeID'])) {
    header("Location: dashboard.php");
    exit();
}

include('header.php');
?>
<br><br>
<h2 class="text-center mt-5 mb-5">Login to view Election dashboard</h2>

<div class="container-fluid mt-2" style="width: 40%;">
    <div class="row">
        <div class="col-12">
            <?php
            // Include the PHP script for processing login
            include('process-login.php');
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="EmployeeID" class="form-label"><b>Employee ID</b></label>
                    <input type="text" class="form-control" id="EmployeeID" name="EmployeeID" placeholder="Enter Employee ID" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="Password" placeholder="Enter the ERP Password" required>
                </div>
                <div class="mb-3">
                    <label for="SectionBatch" class="form-label"><b>Section & Batch</b></label>
                    <select class="form-select" name="SectionBatch" aria-label="Default select example" required>
                        <option selected disabled>Select your Section and batch</option>
                        <?php
                        // Include your database connection file
                        include('connection.php');

                        // Retrieve section and batch data from the database
                        $result = mysqli_query($conn, "SELECT DISTINCT SectionBatch FROM election_data");

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['SectionBatch'] . "'>" . $row['SectionBatch'] . "</option>";
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-success">Login</button>
            </form>
        </div>
    </div>
</div>



<?php
include('footer.php');
?>