 <?php

require_once('database.php');

$db= $conn; 
$register=$valid=$unameErr=$emailErr=$passErr=$cpassErr='';

 $set_uName=$set_email='';

extract($_POST);
if(isset($_POST['submit']))
{
  


   $validName="/^[a-zA-Z ]*$/";
   $validEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
   $uppercasePassword = "/(?=.*?[A-Z])/";
   $lowercasePassword = "/(?=.*?[a-z])/";
   $digitPassword = "/(?=.*?[0-9])/";
   $spacesPassword = "/^$|\s+/";
   $symbolPassword = "/(?=.*?[#?!@$%^&*-])/";
   $minEightPassword = "/.{8,}/";

 //  First Name Validation
if(empty($user_name)){
   $unameErr="User Name is Required"; 
}
else if (!preg_match($validName,$user_name)) {
   $unameErr="Digits are not allowed";
}else{
   $unameErr=true;
}



//Email Address Validation
if(empty($email)){
  $emailErr="Email is Required"; 
}
else if (!preg_match($validEmail,$email)) {
  $emailErr="Invalid Email Address";
}
else{
  $emailErr=true;
}
    
// password validation 
if(empty($password)){
  $passErr="Password is Required"; 
} 
elseif (!preg_match($uppercasePassword,$password) || !preg_match($lowercasePassword,$password) || !preg_match($digitPassword,$password) || !preg_match($symbolPassword,$password) || !preg_match($minEightPassword,$password) || preg_match($spacesPassword,$password)) {
  $passErr="Password must be at least one uppercase letter, lowercase letter, digit, a special character with no spaces and minimum 8 length";
}
else{
   $passErr=true;
}

// form validation for confirm password
if($cpassword!=$password){
   $cpassErr="Confirm Password doest Matched";
}
else{
   $cpassErr=true;
}


if($unameErr==1 && $emailErr==1 && $passErr==1 && $cpassErr==1)
{

   
    $uName =legal_input($user_name);
  
    $email     =legal_input($email);
    $password  =legal_input(password_hash($password, PASSWORD_DEFAULT));
   
  
    $checkEmail=unique_email($email);
    if($checkEmail)
    {
      $register=$email." is already exist";
    }else{

       
      $register=register($uName,$email,$password);

    }




}else{

     // set input values is empty until input field is invalid
    $set_uName=$user_name;
    $set_email=    $email;
}
// check all fields are vakid or not
}


// convert illegal input value to ligal value formate
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}

function unique_email($email){
  
  global $db;
  $sql = "SELECT email FROM users WHERE email='".$email."'";
  $check = $db->query($sql);

 if ($check->num_rows > 0) {
   return true;
 }else{
   return false;
 }
}

// function to insert user data into database table
function register($uName,$email,$password){

   global $db;
   $sql="INSERT INTO users(user_name,email,password) VALUES(?,?,?)";
   $query=$db->prepare($sql);
   $query->bind_param('sss',$uName,$email,$password);
   $exec= $query->execute();


        
       
    if($exec==true)
    {

     return "You are registered successfully";
    }
    else
    {
      return "Error: " . $sql . "<br>" .$db->error;
    }
}
?>