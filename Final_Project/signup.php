<?php
	ob_start();
	session_start();
	include 'functions/db_connect.php';
	include  'functions/functions.php';
	$siteTitle = 'Sign Up :: Music is passion!!!';
	include 'files/header.php';
?>
<?php
	include 'files/navigation.php';
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
        	if (isset($_SESSION['alert_message']) && strlen($_SESSION['alert_message']) > 2){
        		echo $_SESSION['alert_message'];
        		unset($_SESSION['alert_message']);                         		
        	}
        ?>
		 <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post" enctype="multipart/form-data">
                            <h3 class="text-center text-secondary">Register</h3>
                            <div class="form-group">
                                <label for="username" class="text-secondary">* Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-secondary">* Password (between 8 and 15 letters):</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password_repeat" class="text-secondary">* Repeat Password:</label><br>
                                <input type="password" name="password_repeat" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name_first" class="text-secondary">* First Name:</label><br>
                                <input type="text" name="name_first" id="name_first" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name_last" class="text-secondary">* Last Name:</label><br>
                                <input type="text" name="name_last" id="name_last" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-secondary">* Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group"> 
      							<label for="user_image" class="text-secondary">Add image (jpg, jpeg only; 8mb max size)</label><br>
      							<input type="file" id="user_image" name="user_image" accept="image/jpeg"> 
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
					$register_data = add_values_to_register_data();
					if ($register_data[sizeof($register_data) - 1] === false){
						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Please fill all fields</h3>';
						header("Location: signup.php");
						exit;
					} elseif ($register_data[1] != $register_data[2]){
						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Passwords don\'t match</h3>';
						header("Location: signup.php");
						exit;
					} elseif (strlen($register_data[1]) < 8){
						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: Your Password is too short</h3>';
						header("Location: signup.php");
						exit;
					} elseif (strlen($register_data[1]) > 15){
						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: Your Password is too long</h3>';
						header("Location: signup.php");
						exit;
					} elseif (filter_var($register_data[5], FILTER_VALIDATE_EMAIL) == false){ 
						$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: Please provide valid Email</h3>';
						header("Location: signup.php");
						exit;
					} else {
						$uploadfile = NULL;
						if (isset($_FILES["user_image"]["type"]) && strlen($_FILES["user_image"]["type"]) > 1){
							if ($_FILES["user_image"]["type"] != 'image/jpeg'){
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: Your picture is not in the right format!</h3>';
								header("Location: signup.php");
								exit;
							}

							if ($_FILES["user_image"]["error"] != 0){
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error ' . $_FILES["user_image"]["error"] . ': Please contact us from the form below!</h3>';
								header("Location: signup.php");
								exit;
							}

							if ($_FILES["user_image"]["size"] > 8000000){
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: The image size is above the limit!</h3>';
								header("Location: signup.php");
								exit;
							}
							$random_string_to_change_img_name = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)) )), 1, 6);
							$uploadfile = 'images/uploaded/' . $random_string_to_change_img_name . '-' . basename($_FILES['user_image']['name']); 						
							if (move_uploaded_file($_FILES['user_image']['tmp_name'], $uploadfile) == false) {
							    $_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">There was an error with handling your picture. Please contact us from the form below!</h3>';
								header("Location: signup.php");
								exit;
							 } 
						}

						$insert_query = "INSERT INTO users(user_username, user_password, user_name_first, user_name_second, user_email, user_image, user_role, user_date_created, user_date_deleted) VALUES ('" . $register_data[0] . "','" . password_hash($register_data[1], PASSWORD_BCRYPT) . "','" . $register_data[3] . "','" . $register_data[4] . "','" . $register_data[5] . "','" . $uploadfile . "',1,'" . date("Y-m-d H:i:s") . "',null)";
						$result = mysqli_query($conn, $insert_query); 
						if ($result) { 
							$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-success">Your registration is successfull! You can now log in!</h3>';
							header("Location: login.php");
							exit;
						} else { 
							$error = mysqli_error($conn);
							if (strpos($error, 'Duplicate entry') !== false) {	
								if (strpos($error, 'user_username') !== false){
									$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">There is username ' . $_POST['username'] . '! Please use another one!</h3>';
									header("Location: signup.php");
									exit;
								} elseif (strpos($error, 'user_name_email') !== false){
									$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">This email ' . $_POST['email'] . ' has been used before! Please use another one!</h3>';
									header("Location: signup.php");
									exit;
								} else {
									$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
									header("Location: signup.php");
									exit;
								}
							} else {
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary text-danger">Error: ' . mysqli_error($conn) . '</h3>';
									header("Location: signup.php");
									exit;
							}
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
