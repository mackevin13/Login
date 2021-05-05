<?php




// Page Title
$pageTitle = 'Enter Authentication Code';

// Initialize the session
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    // Check if the user is not logged in, if yes then redirect him to login page
    header('location: index.php'); 
    exit;
} else if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // Check if the user is authenticated, if yes then redirect him to home page
    header('location: home.php');
    exit;
}

// Include database config file
require_once 'database.php';

// Define variables and initialize with empty values
$authentication = $authentication_err = '';
$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepare a select statement
    $sql = "SELECT code FROM authentication WHERE user_id = $user_id AND NOW() <= created_at AND NOW() <= expiration ORDER BY id DESC limit 1";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        if ($row = $result->fetch_assoc()) {
            // Check if username is empty
            if (empty(trim($_POST['authentication']))) {
                $authentication = 'Please enter your authentication code.';
            } else {
                $authentication = trim($_POST['authentication']);
            }

            if (empty($authentication_err)) {
                if ($authentication === $row['code']) {
                    $_SESSION['authenticated'] = true;
                    header('location: home.php');
                } else {
                    $authentication_err = 'Your authentication code is incorrect.';
                }
            }
        }
    } else {
        $authentication_err = 'Your code is expired please sign out and login again.';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Authenticator Code</title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body align = center>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>

			
			<div class="col-sm-4">
				<div class="row">
					<h1 >Enter Verification Code</h1>
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- Authentication Code -->
                    <input type="number" id="authentication" name="authentication" class="form-control <?php if (!empty($authentication_err)) {echo 'is-invalid';} ?> mt-3" placeholder="XXXXXX">
                    <div class="invalid-feedback">
                        <?php echo $authentication_err; ?>
                    </div>
                    <p class="mt-3">View your authentication code <a href="authen_code.php" target="blank">here</a>.</p>
                    <!-- Sign in button -->
                    <div class="mt-3">
                        <button class="btn btn-primary btn-block submit">Confirm</button>
                        <a href="logout.php" style="padding-top:10px;padding-right:10px;color:darkred;">Sign Out</a>
                    </div>
                </form>

				</div>

			</div>


			<div class="col-sm-4"></div>
		</div>
	</div>

</body>
</html>