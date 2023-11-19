<?php
include('header.php');
?>
<br>
<h2 class="text-center mt-5 mb-5">All Finished Elections</h2>

<div class="container-fluid mt-2" style="width: 50%;">
    <div class="row">
        <div class="col-12">
            <?php
            // Include your database connection file
            include('connection.php');

            // Fetch election settings data where IsActive is 1
            $sql = "SELECT * FROM election_settings WHERE showResult = 1";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table table-hover">';
                    echo '<tr class="table-success">';
                    echo '<th class="text-center">Serial No.</th>';
                    echo '<th class="text-center">Section & Batch</th>';
                    echo '<th class="text-center">Action</th>';
                    echo '</tr>';

                    $serialNo = 1;
                    // Loop through each row in the result set
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr style="cursor:pointer;">';
                        echo '<td class="text-center">' . $serialNo . '</td>';
                        echo '<td class="text-center">' . $row['SectionBatch'] . '</td>';
                        echo '<td class="text-center"><a href="result.php?SectionBatch=' . $row['SectionBatch'] . '" class="btn btn-outline-success btn-sm">View Result</a></td>';
                        echo '</tr>';
                        $serialNo++;
                    }

                    echo '</table>';
                } else {
                    echo '<div class="alert alert-info" role="alert">';
                    echo 'Currently, there is no Finished Election found.';
                    echo '</div>';
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>



<?php
include('footer.php');
?>