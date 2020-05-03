<?php
	ob_start();
	session_start();
	include 'functions/db_connect.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Download Song!';
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
		<h2> Hey, <?php echo $_SESSION['user_name_first'] ?>! Are you sure you want to download "<?php echo str_replace('_', ' ', $_GET['name'])?>"?</h2>
		<p>	
		<?php 
        	if (isset($_SESSION['alert_message']) && strlen($_SESSION['alert_message']) > 2){
        		echo $_SESSION['alert_message'];
        		unset($_SESSION['alert_message']);                         		
        	}
        ?>		
		<form method="post"> 
			<input type="submit" name="confirm" value="Confirm" class="btn btn-primary btn-lg">
			<input type="submit" name="cancel" value="Cancel" class="btn btn-primary btn-lg">
		</form>
		<?php 
			if (isset($_POST['cancel'])){
				header("Location: welcome.php");
				exit;
			}
			if (isset($_POST['confirm'])){
				$sql = "SELECT song_path FROM songs WHERE song_id = " . $_GET['id'] . " AND song_soft_delete IS NULL";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					header('Content-Description: File Transfer');
   					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="your-song-from-ypmusic.mp3"');
					header('Content-Transfer-Encoding: binary');
				    header('Expires: 0');
				    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				    header('Pragma: public');
				    ob_clean();
				    flush();
				    readfile($row['song_path']);				    
					$sql = "INSERT INTO downloads (download_song, download_user, download_date) VALUES (" . $_GET['id'] . ", " . $_SESSION['user_id'] . ", '" . date("Y-m-d H:i:s") . "')";
					$result = mysqli_query($conn, $sql);
					exit;
				} else {
					$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Something went wrong with downloading. Try again!</h3>';
					header("Location: delete-song.php");
					exit;
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
