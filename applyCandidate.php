<?php
include('header.php');
?>
<br>

<div class="container-fluid mt-5" style="width: 60%;">
    <div class="row">
        <div class="col-12">
            <form method="post" action="applyedCandidate.php">
                <div class="container-fluid mt-2" style="width: 70%;">
                    <hr>
                    <h3 class="text-center">Apply for Candidate</h3>
                    <hr>
                    <div class="mb-3">
                        <label for="CandidateName" class="form-label">Candidate Name:</label>
                        <input class="form-control" type="text" name="CandidateName" id="CandidateName" placeholder="Enter Candidate name according to DIU registered name." required>
                    </div>
                    <div class="mb-3">
                        <label for="CandidateID" class="form-label">Candidate Student ID:</label>
                        <input class="form-control" type="text" name="CandidateID" id="CandidateID" placeholder="Enter Candidate student ID." required>
                    </div>
                    <div class="mb-3">
                        <label for="Symbol" class="form-label">Candidate Symbol</label>
                        <input class="form-control" type="text" name="Symbol" id="Symbol" aria-describedby="help" placeholder="Enter Candidate Symbol that you want for Election" required>
                        <div id="help" class="form-text text-primary">You can use Emoji for your Election Symbol. In Windows 10/11 OS you can use "windows + (.) Dot" key to Get emoji panel.</div>
                    </div>
                    <div class="mb-3">
                        <label for="sgpa" class="form-label">Previous Semester SGPA</label>
                        <input class="form-control" type="text" name="sgpa" id="sgpa" placeholder="Enter Previous Semester SGPA" required>
                    </div>
                    <div class="mb-3">
                        <label for="attendance" class="form-label">Average Attendance</label>
                        <input class="form-control" type="text" name="attendance" id="attendance" placeholder="Enter your Average Attendance rate in %" required>
                    </div>
                    <!-- Hidden input to capture SectionBatch from URL parameter -->
                    <input type="hidden" name="SectionBatch" value="<?php echo $_GET['SectionBatch']; ?>">
                    <input type="submit" class="btn btn-outline-success mt-2" value="Apply">
                </div>
            </form>
        </div>
    </div>
</div>



<?php
include('footer.php');
?>