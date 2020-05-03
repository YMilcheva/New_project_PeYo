<div id="footer">
	<div id="about_us">
		<div id="text">
			<h2> About Us</h2>
			<div class="margin-top-20">
				This website is created by Yordanka Ivanova and Petar Ivanov as a school project. Both participated in PHP/MySQL course in <a href="https://school.vratsasoftware.com/">Vratsa Software Bulgaria</a>. They studied PHP for two months followed by another two months long MySQL course. This website is for their final assestments.
			</div>
			<div class="margin-top-20">
				The task is to create a website where the registered users must be able to share audio (mp3) files. The files must be accessible to the users in the following order: Song name | Performer | Date of uploading | Uploader | The count of downloads | Rating | Rate | Download. The file must be ordered by Song name | Performer | Date of uploading | Uploader | The count of downloads | Rating. Every user must be able to rate the songs from 1 to 5. 
			</div>
			<div class="margin-top-20">
				We don't own the rights over the uploaded on the server songs. We don't intend to make profit from this web site which is created only for educational purpose.
			</div>
			<div class="margin-top-20">
				If you have some questions or remarks please use the contact form on your right!
			</div>
		</div>
	</div>
	<div id="contact_form">
		<div id="form">
		<?php 
			if (isset($_SESSION['user_mail'])){
				?>
				<form method="post">
					<h3 class="feature-title">Get in Touch!</h3>				
					<div class="form-group">
					  <textarea class="form-control" rows="8" name="mail_text"></textarea>
					</div>
					<input type="submit" class="btn btn-secondary btn-block" value="Send" name="mail">
				</form>
			<?php
			} else {
			?>
				<form method="post">
					<h3 class="feature-title">Get in Touch!</h3>
					<div class="form-group">
					  <input type="text" class="form-control" placeholder="Name" name="name">
					</div>
					<div class="form-group">
					  <input type="email" class="form-control" placeholder="Email Address" name="email">
					</div>
					<div class="form-group">
					  <textarea class="form-control" rows="4" name="mail_text"></textarea>
					</div>
					<input type="submit" class="btn btn-secondary btn-block" value="Send" name="mail">
				</form>
			<?php	
			}
		?>		
			<?php				
				if (isset($_POST['mail'])){
					if (isset($_SESSION['user_mail'])){
						$user_mail = $_SESSION['user_mail'];
						$user_name = $_SESSION['user_name_first'] . ' ' . $_SESSION['user_name_second'];
					} else {
						$user_mail = trim(htmlentities($_POST['email']));
						$user_name = trim(htmlentities($_POST['name']));
					}
					if (mail('info@ypmusic.xyz', 'Query from ' . $user_mail . ' - ' . $user_name,  trim(htmlentities(str_replace('<br>', "\r\n", $_POST['mail_text']))))){
						?>
						<h3>Your mail is sent!</h3>
						<?php
					} else {
						?>
						<h3>There was an error! Please try again!</h3>
						<?php
					}
				}
			?>
		</div>
	</div>
</div>