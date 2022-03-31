
<!-- Internet programming Online CAT -->
<!-- By Madam Ann -->
<!--PHP script for checking validity of data entered in input text field in a form
GitHub link to my file: Aligo-tlc/Testing-form-details
Written by Emmanuel Guya Alison BIT/2018/36365-->
<html>
<head>
<style>
.error {color: #FF0000;}
b {
	color: #090363;
}
</style>

</head>
<body>  

<?php
$usernameErr = $passwordErr = $emailErr = "";   //define variables and set to empty values
$username = $password = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["username"])) {
    $usernameErr = "Userame is required";
  } 
  else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters
    if (!preg_match("/^[a-zA-Z]*$/",$username)) {
      $usernameErr = "Only letters and are allowed";
    }
    else {
    	$usernameErr = "Userame is valid";
    }
  }
   // Check if password field
   if (!empty($_POST["password"])) {
   	$password = test_input($_POST["password"]);
    if (strlen($_POST["password"]) < '8') { 
            $passwordErr = "Password Must be At Least 8 Characters long!"; }
    elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordErr = "Password Must contain at least 1 number!"; }
    elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordErr = "Password Must contain at least 1 capital Letter!"; }
    elseif(!preg_match("#[a-z]+#",$password)) {
            $passwordErr = "Password Must contain at least 1 lowercase Letter!"; }
    else{
        $passwordErr = "Password is valid"; }
	}
   else {
      $passwordErr = "Password is required!";
    }

    // check if e-mail format is correct
    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } 
    else {
        $email = test_input($_POST["email"]);
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
            $emailErr = "Invalid Email Format"; 
        }
        else {
        	$emailErr = "Email is valid";
        }
      }
}

//Function for testing Each $_POST variable for validity
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
?>

<h2>PHP Form FOR FIELD VALIDATION</h2>
<p><span class="error">* Required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <b>Username:</b> <input type="text" name="username">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  <b>Password:</b> <input type="text" name="password">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <b>E-mail:</b> <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <input type="submit" class ="Submit" name="submit" value="Submit">
  <br><br>  
</form>


<?php 
    //Print the details entered in the fileds
    if(isset($_POST['submit'])) {  
    if($usernameErr == "Userame is valid" && $passwordErr == "Password is valid" && $emailErr == "Email is valid") {  
        echo "<h3 color = #FF0001> <b>You have enetered vaild information in all fields.</b> </h3>"; 
        echo "<h4 color=#FF0001><u>Your details are:</u></h4>";  
        echo "Username: " .$username;  
        echo "<br>";  
        echo "Password: " .$password;  
        echo "<br>";  
        echo "Email: " .$email;  
        echo "<br>";   
    } else {  
        echo "<h3> <b>Please enter vaild details.</b></h3>";  
    }  
    }  
?>
</body>
</html>
