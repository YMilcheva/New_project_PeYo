<?php
	session_start();
	include 'functions/db_connect.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Edit your image!';
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
		<h2><?php echo $_SESSION['user_name_first'] ?>, you can edit your image here:</h2>
		<div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post"  enctype="multipart/form-data">                            
                             <div class="form-group"> 
                                <label for="user_image" class="text-secondary">Change image (jpg, jpeg only; 8mb max size)</label><br>
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
            		if (isset($_FILES["user_image"]["type"]) && strlen($_FILES["user_image"]["type"]) > 1){
                            if ($_FILES["user_image"]["type"] != 'image/jpeg'){
                                echo '<h3 class="text-center text-secondary">Error: Your picture is not in the right format!</h3>';
                                die;
                            }

                            if ($_FILES["user_image"]["error"] != 0){
                                echo '<h3 class="text-center text-secondary">Error ' . $_FILES["user_image"]["error"] . ': Please contact us from the form below!</h3>';
                                die;
                            }

                            if ($_FILES["user_image"]["size"] > 8000000){
                                echo '<h3 class="text-center text-secondary">Error: The image size if above the limit!</h3>';
                                die;
                            }
                            $random_string_to_change_img_name = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)) )), 1, 6);
                            $uploadfile = 'images/uploaded/' . $random_string_to_change_img_name . '-' . basename($_FILES['user_image']['name']);                       
                            if (move_uploaded_file($_FILES['user_image']['tmp_name'], $uploadfile) == false) {
                                 echo '<h3 class="text-center text-secondary">There was an error with handling your picture. Please contact us from the form below!</h3>';
                                 die;
                             } 

                             $sql = "UPDATE users SET user_image = '" . $uploadfile . "' WHERE user_username = '" . $_SESSION['user_name'] . "'";
                             $result = mysqli_query($conn, $sql);
                             if ($result) {
                                $_SESSION['user_image'] = $uploadfile;
                                header("location: profile.php");    
                                exit;       
                            } else {
                                echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';
                            }
                        } else {
                             echo '<h3 class="text-center text-secondary">You haven\'t chosen an image. Please try again!</h3>';
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
