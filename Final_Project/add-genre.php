<?php
	ob_start();
	include 'functions/db_connect.php'; 
	session_start();
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Add new music genre!';
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
		<h2>Thank you for you being here, <?php echo $_SESSION['user_name_first'] ?>! Add new music genre</h2>	
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
                                <label for="genre_name" class="text-secondary">Genre name:</label><br>
                                <input type="text" name="genre_name" id="genre_name" class="form-control">
                            </div>                            
                            <div class="form-group">                                
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                                <input type="submit" name="cancel" value="Cancel" class="btn btn-info btn-md">
                            </div>                           
                        </form>
                    </div>
                </div>
            </div>

            <?php
            	if(isset($_POST['submit'])){ 
					if (strlen(trim($_POST['genre_name'])) < 1){
						 echo '<h3 class="text-center text-secondary">Please fill Singer name field</h3>';   						 
					} else {
						$insert_query = "INSERT INTO genres (genre_name, genre_approved) VALUES ('" . $_POST['genre_name'] . "', 0)";
						$result = mysqli_query($conn, $insert_query); 
						if($result){
							$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-success">Music genre is added. Please give us some time to approve your insertion</h3>';
							header("Location: add-genre.php");
							exit;
						} else {
							$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
							header("Location: add-genre.php");
							exit;
						}
					}
				}

				if (isset($_POST['cancel'])){
					header("Location: upload.php");
					exit;
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
