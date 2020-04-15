<?php
	include 'functions/db_connect.php'; 
	session_start();
?>
<?php
	$siteTitle = 'Log In :: Music is passion!!!';
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
		 <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-secondary">Login</h3>
                            <?php 
                            	if (isset($_SESSION['alert_message']) && strlen($_SESSION['alert_message']) > 2){
                            		echo $_SESSION['alert_message'];
                            		unset($_SESSION['alert_message']);                      		
                            	}

                            ?>
                            <div class="form-group">
                                <label for="username" class="text-secondary">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-secondary">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">                                
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                            </div>                           
                        </form>
                    </div>
                </div>
            </div>
            <?php
            	if(isset($_POST['submit']) && strlen($_POST['username']) > 0 && strlen($_POST['password']) > 0){
            		$user_name = trim(htmlentities($_POST['username']));
					$password = trim(htmlentities($_POST['password']));
					$sql = "SELECT user_password, user_name_first, user_name_second, user_name_email, user_name_date_created FROM `users` WHERE user_username = '" . $user_name . "'";					
					$result = mysqli_query($conn, $sql);					
					if ($result) {
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);							
							if (password_verify($password, $row['user_password'])) {
								$_SESSION['user_name'] = $user_name;
								$_SESSION['user_name_first'] = $row['user_name_first'];
								$_SESSION['user_name_second'] = $row['user_name_second'];
								$_SESSION['user_mail'] = $row['user_name_email'];
								$_SESSION['user_date_created'] = $row['user_name_date_created'];
								header("location: welcome.php");	
								exit;					
							} else {
								$_SESSION['alert_message'] = '<h3 class="text-center text-secondary">Wrong username or password. Try again!</h3>';
								header("location: login.php");	
								exit;	
							}
					} else {
							$_SESSION['alert_message'] = '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';
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
