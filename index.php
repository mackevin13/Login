<?php
date_default_timezone_set("Asia/Manila");
// Initialize the session
session_start();

/*
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
} elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Check if the user is already logged in and not authenticated, if yes then redirect him to enter authentication code page
    header('location: enter_authentication_code.php');
    exit;} */



// Include config file
require_once "database.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $msg = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $msg = "Please enter username.";
  } else{
    $username = trim($_POST["username"]);
  }

    // Check if password is empty
  if(empty(trim($_POST["password"]))){
    $msg = "Please enter your password.";
  } else{
    $password = trim($_POST["password"]);
  }

    // Validate credentials
  if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
    $sql = "SELECT id, user_name, password FROM users WHERE user_name = ?";


    if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
      $param_username = $username;


            // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
                // Store result
        mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if(mysqli_stmt_fetch($stmt)){
            if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
              session_start();

                            // Store data in session variables
              $_SESSION["loggedin"] = true;   
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username; 
              $_SESSION['authenticated'] = false;

                            $user_id = $_SESSION['id'];
                            $code = rand(100000, 1000000);
                            $dateTime = new DateTime();
                            $dateTimeFormat = 'Y-m-d H:i:s';
                            $created_at = $dateTime->format($dateTimeFormat);
                            $dateTime->add(new DateInterval('PT5M'));
                            $expiration = $dateTime->format($dateTimeFormat);

                            $sql = "INSERT INTO authentication (user_id, code, created_at, expiration) VALUES ('$user_id', '$code', '$created_at', '$expiration')";

                            // prepare and bind
         $stmt1 = $conn->prepare("INSERT INTO activity_log (activity, user_name) VALUES (?, ?)");
         $stmt1->bind_param("ss", $activity, $username);
      
        // // set parameters and execute
         $activity = "Logged In";
         $username = $username;
        
         $stmt1->execute();
         $stmt1->close();

                            if ($conn->query($sql) === true) {
                                // Redirect user to enter authentication code page
                                header('location: authen_code.php');
                            }                           

                            // Redirect user to welcome page
              header("location: authenticator.php");
            } else{
                            // Display an error message if password is not valid
              $msg = "The password you entered was not valid.";
            }
          }
        } else{
                    // Display an error message if username doesn't exist
          $msg = "No account found with that username.";
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
      }

            // Close statement
      mysqli_stmt_close($stmt);
    }
  }

    // Close connection
  mysqli_close($conn);
}

?>

<html lang = "en">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!--bootstrap4 library linked-->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

 <!--custom style-->
 <style type="text/css">
   .registration-form{
    background: #f7f7f7;
    padding: 20px;
    border: 1px solid orange;
    margin: 50px 0px;
  }
  .err-msg{
    color:red;
  }
  .registration-form form{
    border: 1px solid #e8e8e8;
    padding: 10px;
    background: #f3f3f3;
  }
  a {
    color: white;
  }
  body{
    background: rgb(193,193,193);
  }
</style>

</head>
<br>
<br>
<br>
<br>

<body align = center>

  <h2 class="text-center">Enter Username and Password</h2> 
  <div class = "container form-signin">
  </div> <!-- /container -->

  <div class = "container">
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">

       <form class = "form-signin" role = "form" 
       action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
       ?>" method = "post">
       <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
       <label for="username" type="text">Username</label>     
       <input type = "text" class = "form-control" 
       name = "username" placeholder = "Enter Username" 
       required autofocus><br> 

       <label for="username" type="text">Password</label>
       <input type = "password" class = "form-control"
       name = "password" placeholder = "Enter Password" required> <br><br>
              


       <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
       name = "login">Login</button>

       <br>
       <p align="center" ><a href="forgot_password.php">Forgot Password?</a></p>
     </form>
     <hr>
     <div>
       <button class="col-sm-12 btn btn-success " ><a href="registration-form.php"> Create an Account</a></button>
     </div>
   </div> 
 </div>
</body>
</html>