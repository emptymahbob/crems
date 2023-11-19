<?php
include('header.php');
?>
<br>
<h2 class="text-center mt-5 mb-5">All running Elections</h2>

<div class="container-fluid mt-2" style="width: 60%;">
    <div class="row">
        <div class="col-12">
            <?php
            // Include your database connection file
            include('connection.php');

            // Fetch election settings data where IsActive is 1
            $sql = "SELECT * FROM election_settings WHERE IsActive = 1";
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
                        $sectionBatch = $row['SectionBatch'];
                        $openForApply = $row['openForApply'];

                        ?>
                        <tr style="cursor:pointer;">
                            <td class="text-center"><?php echo $serialNo; ?></td>
                            <td class="text-center"><?php echo $sectionBatch; ?></td>
                            <td class="text-center">
                                <a href="view_election.php?SectionBatch=<?php echo $sectionBatch; ?>" class="btn btn-outline-success btn-sm mr-2">View</a>

                                <?php
                                // Check if the openForApply is 1 to enable the Apply button
                                if ($openForApply == 1) {
                                    echo '<a href="applyCandidate.php?SectionBatch=' . $sectionBatch . '" class="btn btn-outline-success btn-sm">Apply</a>';
                                } else {
                                    echo '<button class="btn btn-outline-success btn-sm" disabled>Apply</button>';
                                }
                                ?>
                            </td>
                        </tr>

                    <?php
                        $serialNo++;
                    }

                    echo '</table>';
                } else {
                    echo '<div class="alert alert-info" role="alert">';
                    echo 'Currently, there is no active Election found.';
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