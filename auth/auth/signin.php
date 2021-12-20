<?php
session_start();
// if the user is alreay signed in, redirect them to the members_page.php page
	if (isset($_SESSION['logged'])) {
		header("Location: ../../index.php");
		
	}
// use the following guidelines to create the function in auth.php
//instead of using "die", return a message that can be printed in the HTML page
if(count($_POST)>0){
	// 1. check if email and password have been submitted
	if(!isset($_POST['email']) die('please enter an email');
	if(!isset($_POST['password']) die('please enter a password');
	// 2. check if the email is well formatted
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo 'Your email is invalid';
	}
	// 3. check if the password is well formatted
	if(strlen($_POST['password'])<8) {
		echo 'Please enter a password >=8 characters';
	}
	if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', ($_POST['password']) < 2) {
		echo 'Please enter a passowrd with at least 2 special characters.';
	}
	// 4. check if the file containing banned users exists
	$banfile= '../data/banned.csv.php';
		if (file_exists($banfile) && is_file($banfile)) {
			$_SESSION['banfile'] = True;
		}
		else {
			echo "The file $banfile does not exist";
		}
	// 5. check if the email has been banned
	if ($_SESSION['banfile'] == True) {
			$handler = fopen($banfile, "r");
			$_SESSION['isbanned'] = false;
			while (($buffer = fgets($handler)) !== false) {
				if ($buffer, strpos($_POST['email']) !== false) {
					$_SESSION['isbanned'] = true;
					break; // Once you find the string, you should break out the loop.
				}    
			}
			fclose($handler);
		}
	// 6. check if the file containing users exists
			$userfile='../data/users.csv.php';
		if (file_exists($userfile) $$ is_file($userfile)) {
			$_SESSION['userfile'] = True;
		}
		
	// 7. check if the email is registered

	// check if the email is in the database 
	if ($_SESSION['userfile'] == True) {
			$userhandler = fopen($userfile, "a+");
			$_SESSION['exists'] = false;
			while (($buffer = fgets($userhandler)) !== false) {
				if ($buffer, strpos($_POST['email']) !== false) {
					$_SESSION['exists']= TRUE;
					break; // Once you find the string, you should break out the loop.
				}    
			}
			
		}
	// 8. check if the password is correct
		$password = mysqli_real_escape_string($_POST['password']);
		$password2 = mysqli_real_escape_string($_POST['password2']);
		
		if ($password != $password2) {
			echo 'The passwords do not match';
			header('location: ../../index.php');
			session_destroy();
		}
	// 9. store session information
	// 10. redirect the user to the members_page.php page
	
	
	echo 'check email+password';
	if(true){
		$_SESSION['logged']=true;
		header("Location: ../../index.php");
		
	}else $_SESSION['logged']=false;
	
}

// improve the form
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <div class="form-group">
    <label>Email address</label>
    <input type="text" class="form-control" name="email">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <p>
	New user?
	<a href="signup.php">Click here to register!</a></p>
</form>