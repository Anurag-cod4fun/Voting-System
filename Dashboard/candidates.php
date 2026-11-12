<?php
session_start();
require_once '../partials/security.php';

require_admin();

$uploadError = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
require_csrf();
include '../partials/dbconnect.php';

$name = trim(isset($_POST['name']) ? $_POST['name'] : '');
$Partyname = trim(isset($_POST['partyname']) ? $_POST['partyname'] : '');
$role = trim(isset($_POST['post']) ? $_POST['post'] : '');

// Allow-list of image extensions. Anything else (php, phtml, phar, ...) is rejected.
$allowed = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');

$ext = isset($_FILES['img']) ? strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)) : '';
$tmp_name = isset($_FILES['img']) ? $_FILES['img']['tmp_name'] : '';

if(strlen($name) < 1 || strlen($name) > 15 || strlen($Partyname) < 1 || strlen($Partyname) > 15 ||
   strlen($role) < 1 || strlen($role) > 15){
    $uploadError = "Candidate details are invalid.";
}
elseif(!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK || !array_key_exists($ext, $allowed)){
    $uploadError = "Only JPG, JPEG, PNG and GIF images are allowed.";
}
elseif($_FILES['img']['size'] > 2 * 1024 * 1024){
    $uploadError = "Image must be 2MB or smaller.";
}
else{
    // Verify the real content, not the client-supplied name or MIME type.
    $info = @getimagesize($tmp_name);
    if($info === false || !in_array($info['mime'], $allowed, true)){
        $uploadError = "The uploaded file is not a valid image.";
    }
}

if($uploadError === false){
    // Never trust the client filename: generate the stored name server-side.
    $image = bin2hex(random_bytes(16)) . '.' . $ext;
    $uploadDir = realpath(__DIR__ . '/uploads');
    $destination = $uploadDir === false ? '' : $uploadDir . DIRECTORY_SEPARATOR . $image;

    if($uploadDir === false || !move_uploaded_file($tmp_name, $destination)){
        $uploadError = "Could not save the uploaded image.";
    }
    else{
        $stmt = mysqli_prepare($conn, "INSERT INTO `cand` (`Name`, `PartyName`, `DPimage`, `Post`, `votes`) VALUES (?, ?, ?, ?, 0)");
        mysqli_stmt_bind_param($stmt, "ssss", $name, $Partyname, $image, $role);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if(!$result){
            @unlink($destination);
            $uploadError = "Could not add the candidate.";
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="candidates.css?v=2">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Add Candidate</title>
</head>
<body>
    <div>
        <nav class="admin-nav">
            <ul>
                <li class="nav-brand"><h2 id="header1">OnlineVoting</h2></li>
                <li class="nav-logout"><a href="admindash.php" class="link-logout">Back</a></li>
            </ul>
        </nav>
    </div>
    <main>
      <div class="page-intro">
        <p class="eyebrow">ELECTION SETUP</p>
        <h1 class="headline">Add a candidate</h1>
        <p>Create a clear, accurate profile for the ballot.</p>
      </div>

    <?php if($uploadError !== false){ ?>
    <div class="alert alert-danger" role="alert" style="max-width:600px;margin:0 auto 15px;">
        <?php echo htmlspecialchars($uploadError, ENT_QUOTES, 'UTF-8'); ?>
    </div>
    <?php } ?>

    <div class="form-div">
        <form action="candidates.php" method= "POST" enctype="multipart/form-data">
          <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
            <label for="exampleInputEmail1">Candidate name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name = "name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Party or group</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Party" name="partyname">
            </div>
            
                    <div>
                        <label for="img">Profile image</label>
                        <input type="file" name="img" id="img" class="form-control" accept=".jpg,.jpeg,.png,.gif" required>
                    </div>

                    <div class="form-group">
                        <br>
                        <label for="post">Position</label>
                        <input type="text" placeholder="Enter position" id="post" name="post" class="form-control">
                    </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
              <label class="form-check-label" for="exampleCheck1">Confirm Adding Candidate</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
    </main>
</body>
</html>