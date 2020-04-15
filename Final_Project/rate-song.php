<?php
	session_start();
	include 'functions/db_connect.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Rate Song!';
	include 'files/header.php';
	include 'files/navigation-user.php';
	include 'files/container.php';	
?>
	<div id="main_title">
		<div id="main_image">
	<?php
		include 'files/main-image.php';	
	?>		
		</div>
		<div id="main_text">
			<h1>Music is passion</h1>
			<h3>Listen! Share! Rate!</h3>
		</div>	
	</div>
<div id="song-content">
	<div id="text">
		<?php 
			$sql = "SELECT rating_number, rating_date FROM ratings WHERE rating_user = " . $_SESSION['user_id'] . " AND rating_song = " . $_GET['id'];
			$result = mysqli_query($conn, $sql);
				if ($result) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$rate_date = $row['rating_date']; 
					$rating_number = $row['rating_number'];
				} else {
					echo '<h3 class="text-center text-secondary">Something went wrong with deletion. Try again!</h3>';
				}
				if (strlen($rate_date) > 0){
					echo '<h2>Hey, ' . $_SESSION['user_name_first'] . '! You already gave rating for "' . str_replace('_', ' ', $_GET['name']) . '". It was on ' . $rate_date . ' and you rated it with ' . $rating_number . ' from 5!</h2>';
				} else {
		?>
		<h2> Hey, <?php echo $_SESSION['user_name_first'] ?>! Please rate this one: "<?php echo str_replace('_', ' ', $_GET['name'])?>"!</h2>
		<p>		
		<form method="post"> 
			<div style="margin-bottom: 30px">
				Please choose one of the five options: <select class="rating" name="rating">
				  <option value="1">1 star or Bad</option>
				  <option value="2">2 stars or Well, not good</option>
				  <option value="3">3 stars or Average</option>
				  <option value="4">4 stars or Great song</option>
				  <option value="5">5 stars or This is a beast</option>
				</select>
			</div>
			<input type="submit" name="confirm" value="Confirm" class="btn btn-primary btn-lg">
			<input type="submit" name="cancel" value="Cancel" class="btn btn-primary btn-lg">
		</form>
		<?php 
			if (isset($_POST['cancel'])){
				header("Location: welcome.php");
				exit;
			}
			if (isset($_POST['confirm'])){
				$sql = "INSERT INTO ratings (rating_song, rating_number, rating_user, rating_date) VALUES (" . $_GET['id'] . ", " . $_POST['rating'] . ", " . $_SESSION['user_id'] . ", '" . date("Y-m-d H:i:s") . "')";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					header("Location: welcome.php");
					exit;
				} else {
					echo '<h3 class="text-center text-secondary">Something went wrong with deletion. Try again!</h3>';
				}
			}
		}
		?>
	</div>
</div>
<?php 
	include 'files/container-footer.php';	
?>
</div>  <! –– container ––> 

<?php	
	include 'files/footer.php';	
?>
