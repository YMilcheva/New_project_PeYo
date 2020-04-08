<?php
	session_start();
	include 'functions/db_connect.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Edit your password!';
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
		<h2><?php echo $_SESSION['user_name_first'] ?>, you can edit your password here:</h2>
		<div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <div class="form-group">
                                <label for="current_password" class="text-secondary">Type your current password:</label><br>
                                <input type="password" name="current_password" id="current_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="text-secondary">Type your new password:</label><br>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="text-secondary">Confirm your new password:</label><br>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                            <div class="form-group">                                
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Change">
                            </div>                           
                        </form>
                    </div>
                </div>
            </div>
            <?php
            	if(isset($_POST['submit'])){
            		if (isset($_POST['current_password']) && strlen($_POST['current_password']) > 1 && isset($_POST['new_password']) && strlen($_POST['new_password']) && isset($_POST['confirm_password']) && strlen($_POST['confirm_password'])){
                        if (strlen($_POST['current_password']) < 8 || strlen($_POST['new_password']) < 8 || strlen($_POST['confirm_password']) < 8){
                            echo '<h3 class="text-center text-secondary">Error: Your Password is too short</h3>';
                        } elseif (strlen($_POST['current_password']) > 15 || strlen($_POST['new_password']) > 15 || strlen($_POST['confirm_password']) > 15){
                            echo '<h3 class="text-center text-secondary">Error: Your Password is too long</h3>';
                        } elseif ($_POST['new_password'] != $_POST['confirm_password']){
                             echo '<h3 class="text-center text-secondary">The new password and confirm password you entered are not the same!</h3>';
                        } else {
                            $sql = "SELECT user_password FROM users WHERE user_username = '" . $_SESSION['user_name'] . "'";
                            $result = mysqli_query($conn, $sql);
                            if ($result){
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                if (password_verify($_POST['current_password'], $row['user_password'])){
                                    $sql = "UPDATE users SET user_password = '" . password_hash($_POST['confirm_password'], PASSWORD_BCRYPT) . "' WHERE user_username = '" . $_SESSION['user_name'] . "'";
                                    $result = mysqli_query($conn, $sql); 
                                    if ($result) { 
                                        echo '<h3 class="text-center text-secondary">Your password has been changed!</h3>';
                                    } else { 
                                         echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';
                                    }                                   
                                } else {
                                    echo '<h3 class="text-center text-secondary">The password you entered was not correct!</h3>';
                                }
                            } else {
                                echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';
                            }
                        }
                    } else {
                         echo '<h3 class="text-center text-secondary">Please fill all fields</h3>';
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
