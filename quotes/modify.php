<?php
require_once('functions.php');
signin($_GET,'../../auth/data/users.csv.php');

if(!isset($_SESSION['username'])) {
	$-SESSION['msg'] = "Please log in to view this page";
	header('location: ../auth//auth/signin.php');

?>
<!doctype html>
<html lang="en">
	<head>
	<!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" 
		<title>ASE 230 - class of Fall 2021 Great Authors - Modify Quote</title>
	</head>

	<?php
		
		include('../lib/csv_util.php');
		
	?>

	<body style="text-align:center;">
		<!-- Page to delete a quote from an author -->
		<p>
			<?php
				$quotes = readContentHeader('../data/quotes.csv');
			?>
			<h2>Would you like to Modify this quote?</h2>
			<h1><?= $quotes[$_POST['index']]['Quote'] ?></h1>
			<p><?= $quotes[$_POST['index']]['Author'] ?></p>
			
			
			 <?php
				
				if(isset($_POST['modify'])) {
					modifyLine('../data/quotes.csv',($_POST['index']), $_POST['content']);
					echo 'That Quote and Author entry was Modified.';
				}
			?>
			
			
			<form method="post"	action="<?= $_SERVER['PHP_SELF']?>">
			<br><br>
				<p>
				Changed Quote:<textarea name="content" rows="5" cols="40"></textarea>
				<!--<spanclass="error">* <?php echo $quoteErr;?></span>-->
				</p>
				<br><br>
				<p>
				<input type="hidden" name="index" value=<?=$_POST['index']?>>
				<input type="submit" name="modify" value="Modify">
				</p>
			</form>
			
			<form method="post"	action="index.php">
				<p>
				<input type="submit" name="cancel" value="Index">
				</p>
			</form>
			
			<?php //<a href="index.php">
				//<button>Delete</button>
			//</a>
				
				
			?>
		</p>
		
		<?php
			
			echo "<p>Copyright &copy; 2017-" . date("Y") . " Noah R Gestiehr</p>";
		?>
	</body>
</html>