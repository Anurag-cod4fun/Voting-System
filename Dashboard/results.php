<?php
session_start();
require_once '../partials/security.php';
require_admin();
require_once '../partials/dbconnect.php';
$result = mysqli_query($conn, "SELECT * FROM cand ORDER BY votes DESC, id");
$groupdata = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="results.css?v=2">
    <title>Election Results</title>
</head>
<body>
    <nav class="admin-nav">
        <ul>
            <li class="nav-brand"><h2>OnlineVoting</h2></li>
            <li class="nav-logout"><a href="admindash.php">Back to dashboard</a></li>
        </ul>
    </nav>

    <main class="results-main">
        <header class="results-heading">
            <div>
                <p class="eyebrow">LIVE ELECTION INSIGHTS</p>
                <h1>Voting results</h1>
                <p>Current totals, ranked by votes received.</p>
            </div>
            <div class="results-badge">● Live</div>
        </header>

        <section class="results-grid" aria-label="Candidate results">
            <?php foreach ($groupdata as $candidate) { ?>
                <article class="result-card">
                    <img src="../Dashboard/uploads/<?php echo e($candidate['DPimage']); ?>" alt="<?php echo e($candidate['Name']); ?>">
                    <div class="result-content">
                        <p class="result-rank">CANDIDATE</p>
                        <h2><?php echo e($candidate['Name']); ?></h2>
                        <p class="result-party"><?php echo e($candidate['PartyName']); ?></p>
                        <div class="vote-total">
                            <strong><?php echo e($candidate['votes']); ?></strong>
                            <span>votes</span>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </section>
    </main>
</body>
</html>
