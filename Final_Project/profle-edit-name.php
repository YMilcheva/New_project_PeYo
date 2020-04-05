<?php
	session_start();
	include 'functions/db_connect.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Edit your personal data!';
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
		<h2><?php echo $_SESSION['user_name_first'] ?>, you can edit your personal data here:</h2>
		<div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <div class="form-group">
                                <label for="name_first" class="text-secondary">First Name:</label><br>
                                <input type="text" name="name_first" id="name_first" class="form-control" value=<?php echo '"' . $_SESSION['user_name_first'] .'"'  ?>>
                            </div>
                            <div class="form-group">
                                <label for="name_second" class="text-secondary">Last Name:</label><br>
                                <input type="text" name="name_second" id="name_second" class="form-control" value=<?php echo '"' . $_SESSION['user_name_second'] .'"'  ?>>
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
            		if (isset($_POST['name_first']) && strlen($_POST['name_first']) > 1 && isset($_POST['name_second']) && strlen($_POST['name_second'])){
            			$name_first = trim(htmlentities($_POST['name_first']));
            			$name_second = trim(htmlentities($_POST['name_second']));
            			$sql = "UPDATE users SET user_name_first = '" . $name_first . "', user_name_second = '" . $name_second . "' WHERE user_username = '" . $_SESSION['user_name'] . "'";
            			$result = mysqli_query($conn, $sql);
            			if ($result) {
            				$_SESSION['user_name_first'] = $name_first;
            				$_SESSION['user_name_second'] = $name_second;
            				header("location: welcome.php");	
							exit;		
            			} else {
            				echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';
            			}
            		} else {
            			echo '<h3 class="text-center text-secondary">Please fill all fields!</h3>';
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
