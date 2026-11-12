<?php
  session_start();
  require_once '../partials/security.php';
  $showAert = false;
  $showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '../partials/dbconnect.php';
        require_csrf();
        $fname = trim(isset($_POST['firstname']) ? $_POST['firstname'] : '');
        $lname = trim(isset($_POST['lastname']) ? $_POST['lastname'] : '');
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
        $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
        $pass = isset($_POST['password']) ? $_POST['password'] : '';
        $cpassword = isset($_POST['cpass']) ? $_POST['cpass'] : '';
        $validGenders = array('Male', 'Female', 'Others');

        if ($pass !== $cpassword) {
          $showError = "Passwords do not match";
        } elseif (strlen($fname) < 1 || strlen($fname) > 11 || strlen($lname) < 1 ||
            strlen($lname) > 11 || !in_array($gender, $validGenders, true) ||
            $age === false || $age < 18 || $age > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            strlen($pass) < 8) {
          $showError = "Please enter valid registration details.";
        } else {
          $stmt = mysqli_prepare($conn, "INSERT INTO regdetails (firstname, lastname, gender, age, email, password, status) VALUES (?, ?, ?, ?, ?, ?, 0)");
          $hash = password_hash($pass, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sssiss", $fname, $lname, $gender, $age, $email, $hash);
          $result = mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          if($result){
              $showAert = true;
          } else {
              $showError = "That email is already registered or could not be saved.";
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
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="reg.css?v=2">
</head>
<body>


    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand">Online Voting System</a>
          <form class="d-flex">
            <a href="../login/login.php" class="navbar-brand" id= "login1">Login</a>
          </form>
        </div>
      </nav>

  <?php
  if($showAert){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Now you can Login
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  if($showError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> ' . e($showError) . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  ?>



    <div class="form">
    <form action="../Registration/reg.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
        <div class="form-heading">
          <p class="eyebrow">JOIN THE ELECTION</p>
          <h1>Create your voter account</h1>
          <p>Register once to securely participate in the election.</p>
        </div>
        
        <div class="mb-3">
         <div><label for="name1" class="form-label">Full name</label></div>
          <input type="text" name="firstname" id="name1" class="form-control anurag" placeholder="First name" required>
          <input type="text" name="lastname" id="name2" class="form-control anurag" placeholder="Last name" required>
        </div>


        <div class="mb-3">
          <label for="option1" class="sr-only">Gender</label>
          <select name="gender" id="option1" class="form-control anurag" required>
            <option value="">Select gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
          </select>

          <input type="number" name="age" id="age1" class="form-control anurag" placeholder="Age" min="18" max="120" required>

        </div>


        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder = "name@example.com" name = "email" required>
          <div id="emailHelp" class="form-text" style="font-family: courier;">We'll never share your email with anyone else.</div>
        </div>


        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1" minlength="8" required>
          <d>*Use at least 8 characters.</d>
        </div>


        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirm password</label>
          <input type="password" class="form-control" id="confirmPassword" name="cpass" required>
        </div>


        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
          <label class="form-check-label" for="exampleCheck1" style="font-family: courier;">Agree terms and conditions</label>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Create account</button>

      </form>
    </div>
</body> 
</html>                                                                                                                 