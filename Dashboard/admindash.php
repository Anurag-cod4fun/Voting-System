<?php
session_start();
require_once '../partials/security.php';
require_admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="admindash.css?v=2">
</head>
<body>
    
    <div>
        <nav class="admin-nav">
            <ul>
                <li class="nav-brand"><h2 id="header1">OnlineVoting</h2></li>
                <li class="nav-logout"><a href="../Dashboard/logout.php" class="link-logout">Logout</a></li>
            </ul>
        </nav>
    </div>

    <main class="admin-main">
      <section class="admin-hero">
        <div>
          <p class="eyebrow">ADMIN CONSOLE</p>
          <h1>Keep every ballot moving.</h1>
          <p class="hero-copy">Manage the candidate list and review voting results from one secure workspace.</p>
        </div>
        <div class="hero-mark" aria-hidden="true">✓</div>
      </section>

      <section class="admin-actions" aria-label="Administration actions">
        <article class="card" id="card1">
          <div class="card-icon" aria-hidden="true">+</div>
          <div class="container">
            <p class="card-label">CANDIDATE MANAGEMENT</p>
            <h2 id="card-post">Add candidates</h2>
            <p class="card-copy">Create a candidate profile and add their image, party, and position.</p>
            <form action="../Dashboard/candidates.php" method="get">
              <button class="card-btn">Add candidate</button>
            </form>
          </div>
        </article>

        <article class="card" id="card2">
          <div class="card-icon chart-icon" aria-hidden="true">↗</div>
          <div class="container">
            <p class="card-label">ELECTION INSIGHTS</p>
            <h2 id="card-post">Check results</h2>
            <p class="card-copy">Review the current vote count and see how each candidate is performing.</p>
            <form action="../Dashboard/results.php" method="get">
              <button class="card-btn">View results</button>
            </form>
          </div>
        </article>
      </section>
    </main>
     
</body>
</html>