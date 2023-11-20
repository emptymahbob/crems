<!DOCTYPE html>
<html lang="en">

<head>
  <title>DIU-CREMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    body {
      font-family: 'Roboto', sans-serif;
    }

*{
      font-family: 'Roboto', sans-serif;
      /* You can also specify different weights or styles for different elements */
      font-weight: 400;
      /* Bold */
    }
  </style>
</head>

<body>

  <nav class="navbar fixed-top navbar-expand-sm bg-success navbar-success">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <b>
          <h3><span class="text-warning">DIU </span><span class="text-info"> CREMS</span></h3>
        </b>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <?php
          // Check if the user is not logged in, redirect to the login page
          if (!isset($_SESSION['employeeID'])) {
          ?>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-info text-white" href="login.php">Login</a>
            </li>
          <?php
          } else {
          ?>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-info text-white" href="dashboard.php">Dashboard</a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-info text-white" href="start_election.php">Start New Election</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-info text-white" href="elections.php">View Elections</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<br><br>
  <div class="container mt-5">
    <h2 class="text-center">Welcome to the DIU CRMS (Class Representative Election Management System)</h2>

    <div class="row mt-3">
      <div class="col-md-6">
        <div class="card text-dark bg-light">
          <div class="card-header">
            <h5 class="card-title">Background</h5>
          </div>
          <div class="card-body">
            <p class="card-text text-break">
              In educational institutions, the role of a Class Representative (CR) is crucial in maintaining communication between students and faculty, addressing concerns, and ensuring a smooth academic experience. We always use the traditional process of electing CRs. However, I believe that, as software engineers, we should consider employing a software-based system for this purpose. Implementing a digital voting system could introduce an element of excitement and efficiency that would appeal to everyone involved. <br><br>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card text-dark bg-light">
          <div class="card-header">
            <h5 class="">Motivation</h5>
          </div>
          <div class="card-body">
            <p class="card-text text-break">
              The motivation behind this project stems from the need for a more efficient and transparent way to elect Class Representatives. Traditional elections often suffer from low voter turnout, lack of anonymity, and difficulty in counting and verifying votes. By creating an online CR Voting System, we aim to: <b>Enhance Democracy:</b> Enable all students to participate in the election process easily, promoting inclusivity and diversity. <b>Improve Efficiency:</b> Reduce the administrative burden of organizing and conducting elections. <b>Ensure Transparency:</b> Provide a secure and transparent platform for conducting elections, minimizing the chances of fraud or manipulation.
            </p>
          </div>
        </div>
      </div>
    </div>

    <h2 class="text-center m-4">Requirement Specification</h2>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card text-dark bg-light">
          <div class="card-header">
            <h5 class="">Functional Requirements:</h5>
          </div>
          <div class="card-body">
            <p class="card-text">
              <b>1.</b> Admin Password Setup: The admin should be able to set a password during the
              initial system setup to start the voting process. Only the admin should have the
              authority to start and cancel the voting process using this password. <br>
              <b>2.</b> Admin Access Control: The admin should have exclusive access to features such
              as viewing results, adding candidates, and removing candidates. These adminexclusive features should be password-protected to prevent unauthorized access. <br>
              <b>3.</b> User Management: The admin should have the capability to add multiple users to
              the system in bulk by uploading a user list. Additionally, the admin should be able
              to add individual users manually, entering their unique IDs. <br>
              <b>4.</b> User Authentication: For security and confirmation purposes, users should be
              required to enter their unique ID before they can vote. The system should validate
              the entered ID against the list of registered users to ensure eligibility. <br>
              <b>5.</b> Voting Process: Registered users should be able to cast their votes for a single
              candidate of their choice. The system must ensure that each user can vote only
              once. <br>
              <b>6.</b> Candidate Management: The admin should have the capability to add candidates
              to the election. The admin should also be able to remove candidates if necessary. <br>
              <b>7.</b> Vote Tallying and Result Display: The system should automatically tally the votes
              and display the results. The results should include the candidate with the highest
              number of votes, declared as the winner. <br><br><br><br>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer p-2 bg-success text-white text-center">
    <p>Copyright © Daffodil International University | CREMS | All rights reserved.</p>
  </div>

</body>

</html>