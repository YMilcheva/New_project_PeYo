<?php
	session_start();
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! Your profile page!';
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
		<h2>Thank you for you being here, <?php echo $_SESSION['user_name_first'] ?>! This is your profile page.</h2>
		<div id="profile-left">
			<h3>Your personal information</h3>
			<ul>
				<li>Name: <?php echo $_SESSION['user_name_first'] . ' ' . $_SESSION['user_name_second'] ?> <a href="profle-edit-name.php">Edit</a></li>
				<li>Email: <?php echo $_SESSION['user_mail'] ?></li>
				<li>You are with us since <?php echo $_SESSION['user_date_created'] ?></li>
				<li>You can edit your image - <a href="profle-edit-image.php">Here</a></li>
				<li><a href="password-edit.php">Edit your password</a></li>
			</ul>	
			<h3>Downloads</h3>
			<ul>
				<li>Number of downloaded songs: 0</li>
				<li><a href="#">See All</a></li>
			</ul>
			<h3>Uploads</h3>
			<ul>
				<li>Number of uploaded songs: 0</li>
				<li><a href="#">See All</a></li>
			</ul>
		</div>
		<div id="profile-right">
			<img width="300px" src=<?php echo '"' . $_SESSION['user_image'] . '"'?>>
		</div>
	</div>
</div>
<?php 
	include 'files/container-footer.php';	
?>
</div>  <! –– container ––> 

<?php	
	include 'files/footer.php';	
?>
