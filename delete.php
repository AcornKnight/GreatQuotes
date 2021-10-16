<!doctype html>
<html lang="en">
	<head>
	<!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" 
		<title>ASE 230 - class of Fall 2021 Great Authors - Delete Quote</title>
	</head>

	<?php
		
		include('csv_util.php');
		
		
	?>

	<body style="text-align:center;">
		<!-- Page to delete a quote from an author -->
		<p>
			<?php
			$quotes = readContentHeader('quotes.csv');
			?>
			<h2>Would you like to delete this quote?</h2>
			<h1><?= $quotes[$_GET['index']]['Author'] ?></h1>
			<p><?= $quotes[$_GET['index']]['Quote'] ?></p>
			
			 <?php
				
				if(isset($_POST['delete'])) {
					deleteContent('quotes.csv',$quotes[$_POST['index']]);
					echo 'That Quote and Author entry was deleted.';
				}
			?>
			
			
			<form method="post"	action="<?= $_SERVER['PHP_SELF']?>">
				<p>
				<input type="submit" name="submit" value="Cancel">
				</p>
			</form>
			
			<form method="post"	action="index.php">
				<p>
				<input type="submit" name="delete" value="Delete Quote">
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