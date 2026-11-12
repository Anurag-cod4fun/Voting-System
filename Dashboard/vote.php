
<?php
session_start();
require_once '../partials/security.php';
require_user();
require_csrf();

include ('../partials/dbconnect.php');

$gid = filter_input(INPUT_POST, 'gid', FILTER_VALIDATE_INT);
$uid = $_SESSION['userdata']['sr'];

if ($gid === false) {
    http_response_code(400);
    exit('Invalid candidate.');
}

mysqli_begin_transaction($conn);
$statusStmt = mysqli_prepare($conn, "UPDATE regdetails SET status=1 WHERE sr=? AND status=0");
mysqli_stmt_bind_param($statusStmt, "i", $uid);
mysqli_stmt_execute($statusStmt);
$statusUpdated = mysqli_stmt_affected_rows($statusStmt) === 1;
mysqli_stmt_close($statusStmt);

$voteStmt = mysqli_prepare($conn, "UPDATE cand SET votes=votes+1 WHERE id=?");
mysqli_stmt_bind_param($voteStmt, "i", $gid);
mysqli_stmt_execute($voteStmt);
$voteUpdated = mysqli_stmt_affected_rows($voteStmt) === 1;
mysqli_stmt_close($voteStmt);

if($statusUpdated && $voteUpdated){
    mysqli_commit($conn);
    $result2 = mysqli_query($conn, "SELECT * FROM cand ORDER BY id");
    $_SESSION["groupdata"] = $result2 ? mysqli_fetch_all($result2, MYSQLI_ASSOC) : array();
    $_SESSION["userdata"]['status'] = 1;
    echo '
        <script>
        alert("Successfully Voted!");
        window.location = "../Dashboard/userdash.php";
        </script>
        ';
        
}
else {
    mysqli_rollback($conn);
    echo '
    <script>
    alert("Some Error Occured!");
    window.location = "../Dashboard/userdash.php";
   </script>
    ';
}


?>