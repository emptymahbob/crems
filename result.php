<?php
include('header.php');
?>
<br>
<div class="container-fluid mt-2" style="width: 70%;">
    <div class="row">
        <div class="col-12">

            <?php
            // Include your database connection file
            include('connection.php');

            // Fetch candidates data from the database (replace with your actual column names)
            $candidatesQuery = "SELECT c.CandidateID, c.CandidateName, c.Symbol, COUNT(v.VID) as Votes
                    FROM candidates c
                    LEFT JOIN votes v ON c.CandidateID = v.CandidateID
                    WHERE c.SectionBatch = '" . $_GET['SectionBatch'] . "'
                    GROUP BY c.CandidateID
                    ORDER BY Votes DESC";

            $candidatesResult = mysqli_query($conn, $candidatesQuery);

            if (!$candidatesResult) {
                echo "Error: " . $candidatesQuery . "<br>" . mysqli_error($conn);
                exit();
            }

            // Fetch total number of voters
            $totalVotersQuery = "SELECT COUNT(DISTINCT VID) as TotalVoters FROM votes";
            $totalVotersResult = mysqli_query($conn, $totalVotersQuery);

            if (!$totalVotersResult) {
                echo "Error: " . $totalVotersQuery . "<br>" . mysqli_error($conn);
                exit();
            }

            $rowTotalVoters = mysqli_fetch_assoc($totalVotersResult);
            $totalVoters = $rowTotalVoters['TotalVoters'];

            ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center m-4">Result for <?php echo $_GET['SectionBatch']; ?></h3>
                        <table class="table table-bordered table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th class="text-center">Rank</th>
                                    <th class="text-center">Candidate Name</th>
                                    <th class="text-center">Candidate ID</th>
                                    <th class="text-center">Symbol</th>
                                    <th class="text-center">No. of Votes / No. of Voters</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rank = 1;
                                while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                    echo '<tr>';
                                    echo '<th class="text-center" scope="row"># ' . $rank . '.</th>';
                                    echo '<td class="text-center">' . $row['CandidateName'] . '</td>';
                                    echo '<td class="text-center">' . $row['CandidateID'] . '</td>';
                                    echo '<td class="fs-5 text-center">' . $row['Symbol'] . '</td>';
                                    echo '<td class="text-center">' . $row['Votes'] . ' votes out of ' . $totalVoters . ' voters</td>';
                                    echo '</tr>';
                                    $rank++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
            // Close the database connection
            mysqli_close($conn);
            ?>


        </div>
    </div>
</div>



<?php
include('footer.php');
?>