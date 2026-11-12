<?php
session_start();
require_once '../partials/security.php';
  $login = false;
  $showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '../partials/dbconnect.php';
        require_csrf();
       
        $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
        $pass = isset($_POST['password']) ? $_POST['password'] : '';
       
       $stmt = mysqli_prepare($conn, "SELECT * FROM regdetails WHERE email=? LIMIT 1");
       mysqli_stmt_bind_param($stmt, "s", $email);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       $userdata = $result === false ? null : mysqli_fetch_assoc($result);
       mysqli_stmt_close($stmt); 

       if($userdata && authenticate_password($pass, $userdata['password'])){
           if (!password_verify($pass, $userdata['password'])) {
               $newHash = password_hash($pass, PASSWORD_DEFAULT);
               $update = mysqli_prepare($conn, "UPDATE regdetails SET password=? WHERE sr=?");
               mysqli_stmt_bind_param($update, "si", $newHash, $userdata['sr']);
               mysqli_stmt_execute($update);
               mysqli_stmt_close($update);
               $userdata['password'] = $newHash;
           }
           $groupResult = mysqli_query($conn, "SELECT * FROM cand ORDER BY id");
           $_SESSION["userdata"] = $userdata;
           $_SESSION["groupdata"] = $groupResult ? mysqli_fetch_all($groupResult, MYSQLI_ASSOC) : array();
           $login = true;
           session_regenerate_id(true);
           $_SESSION['loggedin'] = true;
           $_SESSION['email'] = $email;
           $_SESSION['role'] = 'user';
           header("location: ../Dashboard/userdash.php");
           exit();
       }
        
    else{
      $showError = "Invalid Credentials";
    }
   }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link
      href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
      rel="stylesheet"
    />

    
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
      rel="stylesheet"
    />
      </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand">Online Voting System</a>
        <form class="d-flex">
         
          <a href="../Registration/reg.php" class="navbar-brand" id= "login1">Register</a>
        </form>
      </div>
    </nav>

    <?php
  if($login){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are logged in.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  if($showError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> Invalid Credentials
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  ?>


    <div class="container">
      <div class="top-header">
        <h3>Welcome back</h3>
        <p>Enter your credentials to access your account</p>
      </div>

      <form action="../login/login.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
        <div class="user">
          <i class="bx bxs-user-circle"></i>
          <input type="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="pass">
          <i class="bx bxs-lock-alt"></i>
          <input type="password" name="password" placeholder="Enter your password" required />
        </div>
        <div class="btn">
          <button type="submit">Sign in</button>
        </div>
      </div>
    </form>
    <p class="last">Forgot your password? <a href="#"> Reset Password </a></p>
  </body>
</html>