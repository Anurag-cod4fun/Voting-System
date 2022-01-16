

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

    <div class="container">
      <div class="top-header">
        <h3>Welcome back</h3>
        <p>Enter your credentials to access your account</p>
      </div>
      <form action="../Dashborad/dash.html">
        <div class="user">
          <i class="bx bxs-user-circle"></i>
          <input type="text" name = "email" placeholder="Enter your username" />
        </div>
        <div class="pass">
          <i class="bx bxs-lock-alt"></i>
          <input type="password" name = "pass" placeholder="Enter your password" />
        </div>
      </form>
      <div class="btn">
        <button>Sign in</button>
      </div>
    </div>
    <p class="last">Forgot your password? <a href="#"> Reset Password </a></p>
    <script src="/app.js"></script>
  </body>
</html>