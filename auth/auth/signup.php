<?php
session_start();
// if the user is alreay signed in, redirect them to the members_page.php page
	if (isset($_SESSION['logged'])) {
		header("Location: ../../index.php");
		echo 'Congratulations, you are logged in!';
	}
// use the following guidelines to create the function in auth.php
// instead of using "die", return a message that can be printed in the HTML page
if(count($_POST)>0){
	// check if the fields are empty
	if(!isset($_POST['email']) {
		echo 'please enter your email';
	}
	if(!isset($_POST['password']) {
		echo 'please enter your password';
	}
	// check if the email is valid
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo 'Your email is invalid';
	}
	// check if password length is between 8 and 16 characters
	if(strlen($_POST['password'])<8) {
		echo 'Please enter a password >=8 characters';
	}
	
	// check if the password contains at least 2 special characters
	if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', ($_POST['password']) < 2) {
		echo 'Please enter a passowrd with at least 2 special characters.';
	}

    // one or more of the 'special characters' found in $string

	// check if the file containing banned users exists
		$banfile= '../data/banned.csv.php';
		if (file_exists($banfile) && is_file($banfile)) {
			$_SESSION['banfile'] = True;
		}
		else {
			echo "The file $banfile does not exist";
		}
		
	// check if the email has not been banned
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
	// check if the file containing users exists
		$userfile='../data/users.csv.php';
		if (file_exists($userfile) $$ is_file($userfile)) {
			$_SESSION['userfile'] = True;
		}
		else {
			echo "The file $userfile does not exist";
		}
		
	// check if the email is in the database already
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
	// encrypt password
		$password = md5($_POST['password']);
	// save the user in the database 
		if ($_SESSION['exists'] == true || $SESSION['banned'] == true) {
			if ($_SESSION['exists'] ==true) {
				echo 'That user already exists.';
				header("Location: ../../index.php");
			}
			if ($_SESSION['banned'] ==true) {
				echo 'That email is banned.';
				header("Location: ../../index.php");
			}
		}
		
		else {
			file_put_contents($userhandler,"$_POST['email'],$password",FILE_APPEND)
			fclose($userhandler);
			echo 'That user was created!.';
			header("Location: ../../index.php");
		}
	// show them a success message and redirect them to the sign in page
		
}

// improve the form
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Create a new account</title>
  </head>
  <body>
  <div class="container">
    <h1>Create a new account</h1>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<div class="form-group">
			<label>First and last name</label>
			<input type="text" class="form-control" name="name">
		</div>
		<div class="form-group">
			<label>Email address</label>
			<input type="text" class="form-control" name="email">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="text" class="form-control" name="password">
		</div>
		<div class="form-group">
			<label>Confirm Password</label>
			<input type="text" class="form-control" name="password2">
		</div>
		<button type="submit" class="btn btn-primary" name="reg_user">Submit</button>
		<p>
			Already have an account?
			<a href="signin.php">Login here</a>
	</form>
	
	
<?php
	if ((isset($_POST['email'])) {
		$username = mysqli_real_escape_string($_POST['name']); 
		$email = mysqli_real_escape_string($_POST['email']); 
		$password = mysqli_real_escape_string($_POST['password']);
		$password2 = mysqli_real_escape_string($_POST['password2']);
		
		if ($password != $password) {
			echo 'The passwords do not match';
			header('location: index.php');
			session_destroy();
		}
		else {
			$password = md5($password);
		}
		?>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>