<?php
	session_start();
	include 'functions/db_connect.php'; 
	include 'functions/functions.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! You are welcome!';
	include 'files/header.php';
	include 'files/navigation-user.php';
	include 'files/container.php';		

	function print_song_table($songs, $song_keys, $songs_downloads, $songs_rates){
		$size = sizeof($songs);
		for ($i=0; $i < $size; $i++) { 
			$key = $song_keys[$i];					
			echo '<tr>';
			echo '<th scope="row">' . ($i + 1) . '</th>';
			echo '<td>' . $songs[$key]['song_name'] . '</td>';
			echo '<td>' . $songs[$key]['singer_name'][0];
			for ($a=1; $a < sizeof($songs[$key]['singer_name']); $a++) { 
				echo '; ' . $songs[$key]['singer_name'][$a];
			}
			echo '</td>';
			echo '<td>' . $songs[$key]['genre_name'][0];
			for ($a=1; $a < sizeof($songs[$key]['genre_name']); $a++) { 
				echo '; ' . $songs[$key]['genre_name'][$a];
			}
			echo '</td>';					
			echo '<td>' . $songs[$key]['song_date'] . '</td>';
			echo '<td>' . $songs[$key]['user_username'] . '</td>';
			echo '<td>' . $songs_downloads[$key] . '</td>';
			echo '<td><span title="Average rating of ' . round($songs_rates[$key]['average_rating'], 2) . ' from ' . $songs_rates[$key]['count_ratings'] .  ' total votes">';
			for ($stars=1; $stars <= 5; $stars++) { 
				if ($stars <= $songs_rates[$key]['average_rating']){
					echo '<span class="fa fa-star checked_stars"></span>';
				} else {
					echo '<span class="fa fa-star"></span>';
				}						
			}
			echo '</span></td>';
			echo '<td><a href="rate-song.php?id=' . $key . '&name=' . str_replace(' ', '_', $songs[$key]['song_name']) . '">Rate</a></td>';
			echo '<td><a href=download.php?id=' . $key . '&name=' . str_replace(' ', '_', $songs[$key]['song_name']) . '>Download</a></td>';
			echo '</tr>';
		}
	}
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
<<<<<<< Updated upstream
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel risus vel lacus pellentesque eleifend. Cras eget aliquet nisl. Donec sodales erat risus, vitae eleifend tortor faucibus sit amet. Praesent ut mauris arcu. Aenean sodales ex eu dignissim sollicitudin. Phasellus finibus a diam ut vulputate. Fusce eget ex sem. Vivamus pharetra tincidunt neque, ac viverra lectus luctus ut. Quisque ac hendrerit tellus, egestas pretium dolor. Praesent arcu ligula, vulputate quis ipsum ut, viverra semper orci. Duis non feugiat arcu. Curabitur nec imperdiet lectus, non mollis neque. Ut fringilla ipsum ut scelerisque eleifend. Nullam suscipit nibh nec elit sollicitudin, ut hendrerit est rhoncus. Integer tempus elit turpis, a ultricies ex dignissim nec. 
		Aenean sit amet ipsum nulla. Aenean vitae enim nibh. Quisque id consectetur nibh, mattis luctus enim. Sed eget nibh vestibulum, dictum lectus quis, euismod leo. Ut hendrerit lorem et accumsan ornare. Cras sit amet diam lacus. Donec ullamcorper eget arcu ut eleifend. Duis sollicitudin odio malesuada augue luctus, vel condimentum mauris ultrices. Duis viverra ipsum sit amet justo placerat fermentum. Duis feugiat erat id velit interdum, nec porttitor justo laoreet. 
		<p>
		Morbi nisi enim, dapibus eu tempus vitae, efficitur nec odio. Sed neque turpis, ullamcorper sit amet diam nec, consequat porttitor leo. Etiam a erat aliquam, commodo justo in, bibendum sapien. Morbi non dolor fringilla, semper nibh sed, semper tellus. Sed laoreet ligula quis mauris volutpat, sit amet congue justo rhoncus. Donec dignissim nisl sem, in rutrum ex tincidunt sed. Integer at orci hendrerit mauris tristique tincidunt. Donec nec porttitor ante. Quisque euismod magna nec nibh gravida, eu dignissim felis pretium. In auctor eros nec ipsum imperdiet, a ultrices tellus varius. In vehicula pellentesque nisl. Fusce tincidunt tellus odio, eget molestie risus suscipit sed. 
		<p>
		Nullam eleifend nibh condimentum dolor imperdiet, sed pretium turpis ullamcorper. Nunc eget purus ac dui gravida aliquam eget vitae turpis. Pellentesque hendrerit est eu diam suscipit ornare id ut massa. Praesent rhoncus lobortis ultrices. Mauris id ultrices diam. Duis pulvinar placerat mi eget tempus. Integer a viverra elit. Nullam nisl leo, ornare non tellus sit amet, lacinia varius enim. Suspendisse ipsum metus, molestie vitae lectus placerat, rhoncus lobortis justo. 
		<p>
		Sed egestas lacus eu varius sagittis. Duis accumsan fringilla ex ut scelerisque. Mauris nisi sem, tempor a erat quis, vestibulum semper tellus. Donec et vehicula lectus. Sed nec tempor dolor, a sollicitudin felis. Integer congue auctor arcu, ut pharetra elit porttitor dignissim. Duis blandit elementum magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris feugiat sem nec nibh viverra, quis accumsan mauris congue. Nullam turpis urna, fermentum non diam eget, malesuada egestas enim. Vivamus eget facilisis tortor. Pellentesque rutrum eget massa a posuere. 
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel risus vel lacus pellentesque eleifend. Cras eget aliquet nisl. Donec sodales erat risus, vitae eleifend tortor faucibus sit amet. Praesent ut mauris arcu. Aenean sodales ex eu dignissim sollicitudin. Phasellus finibus a diam ut vulputate. Fusce eget ex sem. Vivamus pharetra tincidunt neque, ac viverra lectus luctus ut. Quisque ac hendrerit tellus, egestas pretium dolor. Praesent arcu ligula, vulputate quis ipsum ut, viverra semper orci. Duis non feugiat arcu. Curabitur nec imperdiet lectus, non mollis neque. Ut fringilla ipsum ut scelerisque eleifend. Nullam suscipit nibh nec elit sollicitudin, ut hendrerit est rhoncus. Integer tempus elit turpis, a ultricies ex dignissim nec. 
		Aenean sit amet ipsum nulla. Aenean vitae enim nibh. Quisque id consectetur nibh, mattis luctus enim. Sed eget nibh vestibulum, dictum lectus quis, euismod leo. Ut hendrerit lorem et accumsan ornare. Cras sit amet diam lacus. Donec ullamcorper eget arcu ut eleifend. Duis sollicitudin odio malesuada augue luctus, vel condimentum mauris ultrices. Duis viverra ipsum sit amet justo placerat fermentum. Duis feugiat erat id velit interdum, nec porttitor justo laoreet. 
		<p>
		Morbi nisi enim, dapibus eu tempus vitae, efficitur nec odio. Sed neque turpis, ullamcorper sit amet diam nec, consequat porttitor leo. Etiam a erat aliquam, commodo justo in, bibendum sapien. Morbi non dolor fringilla, semper nibh sed, semper tellus. Sed laoreet ligula quis mauris volutpat, sit amet congue justo rhoncus. Donec dignissim nisl sem, in rutrum ex tincidunt sed. Integer at orci hendrerit mauris tristique tincidunt. Donec nec porttitor ante. Quisque euismod magna nec nibh gravida, eu dignissim felis pretium. In auctor eros nec ipsum imperdiet, a ultrices tellus varius. In vehicula pellentesque nisl. Fusce tincidunt tellus odio, eget molestie risus suscipit sed. 
		<p>
		Nullam eleifend nibh condimentum dolor imperdiet, sed pretium turpis ullamcorper. Nunc eget purus ac dui gravida aliquam eget vitae turpis. Pellentesque hendrerit est eu diam suscipit ornare id ut massa. Praesent rhoncus lobortis ultrices. Mauris id ultrices diam. Duis pulvinar placerat mi eget tempus. Integer a viverra elit. Nullam nisl leo, ornare non tellus sit amet, lacinia varius enim. Suspendisse ipsum metus, molestie vitae lectus placerat, rhoncus lobortis justo. 
		<p>
		Sed egestas lacus eu varius sagittis. Duis accumsan fringilla ex ut scelerisque. Mauris nisi sem, tempor a erat quis, vestibulum semper tellus. Donec et vehicula lectus. Sed nec tempor dolor, a sollicitudin felis. Integer congue auctor arcu, ut pharetra elit porttitor dignissim. Duis blandit elementum magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris feugiat sem nec nibh viverra, quis accumsan mauris congue. Nullam turpis urna, fermentum non diam eget, malesuada egestas enim. Vivamus eget facilisis tortor. Pellentesque rutrum eget massa a posuere. 
=======
		<h2> Hey, <?php echo $_SESSION['user_name_first'] ?>! If you have something new to upload, you can do it <a href="upload.php">here</a> or check our song list below</h2><p>
		<?php 
        	if (isset($_SESSION['alert_message']) && strlen($_SESSION['alert_message']) > 2){
        		echo $_SESSION['alert_message'];
        		unset($_SESSION['alert_message']);                         		
        	}
        ?>
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Song Name <a href="welcome.php?order=1&dir=1#text">&uarr;</a> <a href="welcome.php?order=1&dir=0#text">&darr;</a></th>
		      <th scope="col">Performer <a href="welcome.php?order=2&dir=1#text">&uarr;</a> <a href="welcome.php?order=2&dir=0#text">&darr;</a></th>
		      <th scope="col">Genre <a href="welcome.php?order=5&dir=1#text">&uarr;</a> <a href="welcome.php?order=5&dir=0#text">&darr;</a></th>
		      <th scope="col">Date of uploading <a href="welcome.php?order=4&dir=1#text">&uarr;</a> <a href="welcome.php?order=4&dir=0#text">&darr;</a></th>
		      <th scope="col">Uploader <a href="welcome.php?order=3&dir=1#text">&uarr;</a> <a href="welcome.php?order=3&dir=0#text">&darr;</a></th>
		      <th scope="col">Download counts <a href="welcome.php?order=6&dir=1#text">&uarr;</a> <a href="welcome.php?order=6&dir=0#text">&darr;</a></th>
		      <th scope="col">Song rating <a href="welcome.php?order=7&dir=1#text">&uarr;</a> <a href="welcome.php?order=7&dir=0#text">&darr;</a></th>
		      <th scope="col">Rate the song</th>
		      <th scope="col">Download</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  		$order = 'songs.song_name';
		  		if (isset($_GET['order'])){
		  			$order = return_order_variable($_GET['order']); 
		  		}		  		

				$direction = 'ASC';
		  		if (isset($_GET['dir'])){
		  			$direction = return_order_direction($_GET['dir']);
		  		}

		  		$temp_array = return_songs_info($order, $direction, $conn);
		  		$songs = $temp_array[0];
		  		$song_keys = $temp_array[1];

				$sql = "SELECT songs.song_id, COUNT(downloads.download_song) AS count_downloads FROM downloads RIGHT JOIN songs ON downloads.download_song=songs.song_id WHERE songs.song_soft_delete IS NULL GROUP BY songs.song_id ORDER BY count_downloads " . $direction;
		  		$result = mysqli_query($conn, $sql);
		  		$songs_downloads = array();
		  		if (isset($_GET['order']) && $_GET['order'] > 5){
		  			$song_keys = array();
		  		}

		  		if ($result) {
		  			while ($row = mysqli_fetch_assoc($result)) {
		  				array_push($songs_downloads, $row['song_id']);
		  				$songs_downloads[$row['song_id']] = $row['count_downloads'];
		  				if (isset($_GET['order']) && $_GET['order'] == 6){
				  			array_push($song_keys, $row['song_id']);
				  		}
		  			}
		  		} else {
		  			echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';	
		  		}

		  		$sql = "SELECT songs.song_id, COUNT(ratings.rating_number) AS count_ratings, AVG(ratings.rating_number) as average_rating FROM ratings RIGHT JOIN songs ON ratings.rating_song = songs.song_id WHERE songs.song_soft_delete IS NULL GROUP BY songs.song_id ORDER BY average_rating " . $direction;
		  		$result = mysqli_query($conn, $sql);
		  		$songs_rates = array();
		  		if ($result) {
		  			while ($row = mysqli_fetch_assoc($result)) {
		  				$songs_rates[$row['song_id']] = array('count_ratings' => $row['count_ratings'], 'average_rating' => $row['average_rating']);
		  				if (isset($_GET['order']) && $_GET['order'] == 7){
				  			array_push($song_keys, $row['song_id']);
				  		}
		  			}
		  		} else {
		  			echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';	
		  		}

		  		print_song_table($songs, $song_keys, $songs_downloads, $songs_rates);				
		  	?>		    
		  </tbody>
		</table>
>>>>>>> Stashed changes
	</div>
</div>
<?php 
	include 'files/container-footer.php';	
?>
</div>  <! –– container ––> 

<?php	
	include 'files/footer.php';	
?>
