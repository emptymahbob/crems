<?php
include('header.php');
?>
<br><br>
<h2 class="text-center mt-5 mb-5">Run a New Election</h2>

<div class="container-fluid mt-2" style="width: 40%;">
    <div class="row">
        <div class="col-12">
            <?php
            // Include the PHP script for processing form data
            include('run-election.php');
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="EmployeeID" class="form-label"><b>Employee ID</b></label>
                    <input type="text" class="form-control" id="EmployeeID" name="EmployeeID" aria-describedby="EmployeeIDhelp" placeholder="Enter Employee ID" required>
                    <div id="EmployeeIDhelp" class="form-text text-primary"><b>&nbsp;&nbsp;&nbsp;Every DIU Teacher has an Employee ID. So only teachers are allowed to start the election. </b></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="Password" placeholder="Enter the ERP Password" required>
                </div>
                <div class="mb-3">
                    <label for="SectionBatch" class="form-label"><b>Section & Batch</b></label>
                    <input type="text" class="form-control" id="SectionBatch" name="SectionBatch" placeholder="Enter Section and Batch Number" required>
                </div>
                <button type="submit" class="btn btn-outline-success">Run the Election</button>
            </form>
        </div>
    </div>
</div>



<?php
include('footer.php');
?>