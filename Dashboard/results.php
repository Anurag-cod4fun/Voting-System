<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Dashboard/results.css">
    <title>Reults</title>
</head>
<body>
    <div>
        <nav class="admin-nav">
            <ul>
                <li class="nav-brand"><h2 id="header1">OnlineVoting</h2></li>
                <li class="nav-logout"><a href="../Dashboard/admindash.php" class="link-logout">Back</a></li>
            </ul>
        </nav>
</div>
</body>
</html>
<?php
session_start();
$groupdata = $_SESSION['groupdata'];

                        for($i=0; $i<count($groupdata); $i++) {
                            ?>
                            <div>
                                <img src="../Dashboard/uploads/<?php echo $groupdata[$i]['DPimage'] ?>" style="float : right" height="100" width = "100">
                                <b>Name: </b><?php echo $groupdata[$i]['Name'] ?><br>
                                <b>Party Name: </b><?php echo $groupdata[$i]['PartyName'] ?><br>
                                <b>Votes: </b><?php echo $groupdata[$i]['votes'] ?>
                                <br>
                                <br>
                                
                               
                                
                                <br>
                                <hr>
                            </div>
                            <?php
                        }
?>