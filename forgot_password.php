<?php
// Include config file
include_once "database.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password =  "";
$username_err = $password_err = $confirm_password_err =  "";
// Processing form data when form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate username
  if (empty(trim($_POST['uname']))) {
    $username_err = "Please enter a Username.";
  } else {
    // Prepare a select statement
    $sql = "SELECT user_name FROM users WHERE user_name = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = trim($_POST['uname']);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $username = trim($_POST['uname']);
        } else {
          $username_err = "There is no account with that username";
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate password
  $password = $_POST['psw'];
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);
  if (empty($password)) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST['psw'])) < 8) {
    $password_err = "Password must have atleast 8 characters.";
  } elseif (!$uppercase) {
    $password_err = "Password should contain 1 upper case.";
  } elseif (!$lowercase) {
    $password_err = "Password should contain 1 lower case.";
  } elseif (!$number) {
    $password_err = "Password should contain 1 number.";
  } elseif (!$specialChars) {
    $password_err = "Password should contain 1 special character.";
  } else {
    $password = trim($_POST['psw']);
  }

  // Validate confirm password
  if (empty(trim($_POST['psw-repeat']))) {
    $confirm_password_err = "Please enter confirm password.";
  } else {
    $confirm_password = trim($_POST['psw-repeat']);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }


  // Check input errors before inserting in database
  if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

    // Prepare an update statement
    $sql = "UPDATE users SET password = ? WHERE user_name = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);

      // Set parameters
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
      $param_username = $username;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        
        // prepare and bind
         $stmt1 = $conn->prepare("INSERT INTO activity_log (activity, user_name) VALUES (?, ?)");
         $stmt1->bind_param("ss", $activity, $username);
         echo "<script>alert('ENTER PASSWORD');</script>";
         
        // // set parameters and execute
         $activity = "Reset a Password";
         $username = $username;
        
         $stmt1->execute();
         $stmt1->close();

        // Redirect to login page
        
        header("location: index.php" );

      } else {
        echo "Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }

  }

  // Close connection
  mysqli_close($conn);
}
?>
</!DOCTYPE html>
<html>
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
 	.box {
 		float: center;
 		width: 50%;
 		margin: auto;
 		padding: auto;

 	}
  a {
    color: white;
  }
  body{
  	color: #1877f2;
    background: rgb(193,193,193);

  }
  .p{
  	color: #1877f2;;
  }
</style>


<br>
<br><br>
<body align = center>

  <h2 class="text-center">Forgot Password</h2> 
  <div class = "container">
  </div> <!-- /container -->
  <br>


  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <div class = "box" >
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">

     
       <h4 class = "form-signin-heading"></h4>
        
       <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label style="color: white;">Username</label>
       <input type="text" placeholder="Enter Username" name="uname" id="uname" class="form-control" value="<?php echo $username; ?>" 
       > 
       <span class="help-block">
          <?php echo $username_err; ?>
        </span>
        </div>
        

        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <label style="color: white;">New Password</label>
       <input type="password" placeholder="Enter New Password" name="psw" id="psw" class="form-control" value="<?php echo $password; ?>" > 
       <span class="help-block"><?php echo $password_err; ?></span>
         </div>     

         <label style="color: white;">Confirm Password</label>
         <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
          <input type="password" placeholder="Confirm Password" name="psw-repeat" id="psw-repeat" class="form-control" value="<?php echo $confirm_password; ?>">
          <span class="help-block"><?php echo $confirm_password_err; ?>
         </div>
       <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
       name = "submit" id="submit">Submit </button>

  
     </form>
     <hr>
     <div>
      <p style="color: white;"> Already have an account?<a href="index.php" style="color: #1877f2;">Sign in</a></p>
       <p ><a href="registration-form.php" style="color: #1877f2;"> Create an Account</a></p>

     </div>
   </div> 
 </div>
</div>
</form>


</body>
</html>