<?php
	session_start();
	include 'functions/db_connect.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Delete Song!';
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
		<h2> Hey, <?php echo $_SESSION['user_name_first'] ?>! Are you sure you want to delete "<?php echo str_replace('_', ' ', $_GET['name'])?>"?</h2>
		<p>		
		<form method="post"> 
			<input type="submit" name="confirm" value="Confirm" class="btn btn-primary btn-lg">
			<input type="submit" name="cancel" value="Cancel" class="btn btn-primary btn-lg">
		</form>
		<?php 
			if (isset($_POST['cancel'])){
				header("Location: uploaded-list.php");
				exit;
			}
			if (isset($_POST['confirm'])){
				$sql = "UPDATE songs SET song_soft_delete = '" . date("Y-m-d H:i:s") . "' WHERE song_id = " . $_GET['id'];
				$result = mysqli_query($conn, $sql);
				if ($result) {
					header("Location: uploaded-list.php");
					exit;
				} else {
					echo '<h3 class="text-center text-secondary">Something went wrong with deletion. Try again!</h3>';
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
