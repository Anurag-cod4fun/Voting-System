<?php
    session_start();
    require_once '../partials/security.php';
    require_user();

    $userdata = $_SESSION['userdata'];
    $groupdata = $_SESSION['groupdata'];

    if ($_SESSION['userdata']['status'] == 0) {
        $status = '<b style = "color:red"> NOT VOTED </b>';
    }
    else {
        $status = '<b style = "color:green"> VOTED </b>';
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userdash.css?v=2">
    <title>Online Voting</title>
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
        <div id="movingtxt">Your voice shapes the future. Review each candidate carefully before casting your vote.</div>
        <div id="mainsection">
            <div class="dashboard-heading">
                <p class="eyebrow">VOTER DASHBOARD</p>
                <h1>Make your choice count.</h1>
                <p>Review the candidates below and cast one secure vote.</p>
            </div>
            <div class="profile"><b>Name : </b> <?php echo e($userdata['firstname'] . " " . $userdata['lastname']); ?>
                <br><b> Age :</b> <?php echo e($userdata['age']); ?>
                <br><b> Gender :</b> <?php echo e($userdata['gender']); ?>
                <br><b> Email :</b> <?php echo e($userdata['email']); ?>
                <br><b> Status :</b> <?php echo $status ?>
            </div>

            <div id="group">
                <?php
                    if ($_SESSION['groupdata']){
                        for($i=0; $i<count($groupdata); $i++) {
                            ?>
                            <div>
                                <img src="../Dashboard/uploads/<?php echo e($groupdata[$i]['DPimage']); ?>" style="float : right" height="100" width="100" alt="<?php echo e($groupdata[$i]['Name']); ?>">
                                <b>Name: </b><?php echo e($groupdata[$i]['Name']); ?><br>
                                <b>Party Name: </b><?php echo e($groupdata[$i]['PartyName']); ?><br>
                                
                                <br>
                                <br>
                                
                                <form action="../Dashboard/vote.php" method="POST">
                                    <input type="hidden" name="gid" value="<?php echo e($groupdata[$i]['id']); ?>">
                                    <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
                                   
                                    <?php
                                        if ($_SESSION['userdata']['status'] == 0) {
                                            ?>
                                    <input type="submit" name="votebtn" value = "Vote" id="votebtn">
                                    <?php
                                        }
                                        else {
                                            ?>
                                            <button disabled type="button" name="votebtn" value="Voted" id="voted">Voted</button>
                                            <?php
                                        }
                                        ?>
                                </form>
                                
                                <br>
                                <hr>
                            </div>
                            <?php
                        }
                    }
                    else {
                        echo ("something is wrong");
                    }
                ?>
            </div>
        </div>
</body>
</html>