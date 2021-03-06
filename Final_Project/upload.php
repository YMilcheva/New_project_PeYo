<?php
	ob_start();
	include 'functions/db_connect.php'; 
	session_start();
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Upload your songs!';
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
		<h2>Thank you for you being here, <?php echo $_SESSION['user_name_first'] ?>! Upload your songs</h2>
		<?php 
        	if (isset($_SESSION['alert_message']) && strlen($_SESSION['alert_message']) > 2){
        		echo $_SESSION['alert_message'];
        		unset($_SESSION['alert_message']);                         		
        	}
        ?>		
		<div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="song_name" class="text-secondary">Song Name:</label><br>
                                <input type="text" name="song_name" id="song_name" class="form-control">
                            </div>
                            <div class="form-group">
                            	 <label for="singer_name" class="text-secondary">Singer or Group (if you can't find the desired singer or group, add one <a href="add-singer.php">here</a>):</label><br>
                            	<input list="singer_name" name="singer_name" class="form-control">
                            	<?php 
                            			$sql = "SELECT singer_id, singer_name FROM singers WHERE singer_approved = 1";
                            			$result = mysqli_query($conn, $sql);
                            			$singer_validation = array();
                            			if ($result) {
                            				while ($row = mysqli_fetch_assoc($result)) {												
												array_push($singer_validation, $row['singer_name']);	
												$singer_validation[$row['singer_name']] = $row['singer_id'];										
											}
                            			} else {
                            				$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
											header("Location: upload.php");
											exit;	
										}
                            	?>            
                            	<datalist id="singer_name">
                            	<?php 
                            		foreach ($singer_validation as $key => $value) {
                            			echo '<option value="' . $key . '">';
                            		}
                            	?>                            		                		
								</datalist>
                            </div>
                           <div class="form-group">
                            	 <label for="genre_name" class="text-secondary">Genre (if you can't find the desired genre, add one <a href="add-genre.php">here</a>):</label><br>
                            	<input list="genre_name" name="genre_name" class="form-control">
                            	<datalist id="genre_name">
                            		<?php 
                            			$sql = "SELECT genre_id, genre_name FROM genres WHERE genre_approved = 1";
                            			$result = mysqli_query($conn, $sql);
                            			$genre_validation = array();
                            			if ($result) {
                            				while ($row = mysqli_fetch_assoc($result)) {
												echo '<option value="' . $row['genre_name'] . '">';
												array_push($genre_validation, $row['genre_name']);	
												$genre_validation[$row['genre_name']] = $row['genre_id'];						
											}
                            			} else {
											$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
											header("Location: upload.php");
											exit;			
										}
                            		?>                            		
								  </datalist>
                            </div>
                           <div class="form-group"> 
      							<label for="song_file" class="text-secondary">Add file (mp3 only; 8mb max size)</label><br>
      							<input type="file" id="song_file" name="song_file"> 
     						</div>   
                            <div class="form-group">                                
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>                           
                        </form>
                    </div>
                </div>
            </div>
            <?php
            	if(isset($_POST['submit'])){ 
					if (strlen(trim($_POST['song_name'])) < 1){
						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: Please fill Song Name field</h3>';
						header("Location: upload.php");
						exit;					 
					} elseif (in_array($_POST['singer_name'], $singer_validation) == false) {
						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Please provide valid Singer or Group name</h3>';
						header("Location: upload.php");
						exit;	
					} elseif (in_array($_POST['genre_name'], $genre_validation) == false) {
   						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Please provide valid Genre</h3>';
						header("Location: upload.php");
						exit;
					} else {						
						if (isset($_FILES["song_file"]["type"]) && strlen($_FILES["song_file"]["type"]) > 1){
							if ($_FILES["song_file"]["type"] != 'audio/mpeg'){
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: Your song is not in the right format!</h3>';
								header("Location: upload.php");
								exit;								
							} elseif ($_FILES["song_file"]["error"] != 0){
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error ' . $_FILES["song_file"]["error"] . ': Please contact us from the form below!</h3>';
								header("Location: upload.php");
								exit;	
							} elseif ($_FILES["song_file"]["size"] > 8000000){
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: The size of the song is above the limit!</h3>';
								header("Location: upload.php");
								exit;	
							} else {
								$random_string_to_change_song_name = strtr('()', '', substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)) )), 1, 6));
								$uploadfile = 'uploads/' . $random_string_to_change_song_name . '-' . basename($_FILES['song_file']['name']);
								if (move_uploaded_file($_FILES['song_file']['tmp_name'], $uploadfile) == false) {
							     echo '<h3 class="text-center text-secondary">There was an error with handling your song. Please contact us from the form below!</h3>';
							 	} else {
							 		$insert_query = "INSERT INTO songs (song_path, song_name, song_date, song_uploader, song_soft_delete) VALUES ('" . $uploadfile . "', '" . trim(htmlentities(str_replace("'", "''", $_POST['song_name']))) . "', '" . date("Y-m-d H:i:s") . "', " . $_SESSION['user_id'] . ", NULL" . ")";
									$result = mysqli_query($conn, $insert_query); 
									if ($result) { 
										$select_query = "SELECT song_id FROM songs WHERE song_path = '" . $uploadfile . "'";
										$result = mysqli_query($conn, $select_query);
										if ($result){
											$row = mysqli_fetch_array($result, MYSQLI_ASSOC);											
											$song_id = $row['song_id'];
											$insert_query = "INSERT INTO songs_singers (singer_id, song_id) VALUES (" . $singer_validation[$_POST['singer_name']] . ", " . $song_id . ")";
											$result = mysqli_query($conn, $insert_query);
											if ($result){
												$insert_query = "INSERT INTO songs_genres (genre_id, song_id) VALUES (" . $genre_validation[$_POST['genre_name']] . ", " . $song_id . ")";
												$result = mysqli_query($conn, $insert_query);
												if ($result){
													$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-success">Your song is uploaded!</h3>';	
													header("Location: welcome.php");
													exit;		
												}
											} else {
												$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
												header("Location: upload.php");
												exit;	
											}
										} else {
											$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
											header("Location: upload.php");
											exit;
										}					
									} else {
										$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
										header("Location: upload.php");
										exit;	
									}
							 	}
							}
							$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Something went wrong. Please contact us in the form below</h3>';
							header("Location: upload.php");
							exit;	
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
