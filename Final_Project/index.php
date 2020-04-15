<?php
	session_start();
	include 'functions/db_connect.php'; 
	include 'functions/functions.php';
	if (isset($_SESSION['user_name_first'])){
		header("location: welcome.php");
		exit;
	}
	$siteTitle = 'Music is passion!!! Rate your Songs';
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
		<h2>Enjoy!!!</h2>
		<p>
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Song Name <a href="index.php?order=1&dir=1#text">&uarr;</a> <a href="index.php?order=1&dir=0#text">&darr;</a></th>
		      <th scope="col">Performer <a href="index.php?order=2&dir=1#text">&uarr;</a> <a href="index.php?order=2&dir=0#text">&darr;</a></th>
		      <th scope="col">Genre <a href="index.php?order=5&dir=1#text">&uarr;</a> <a href="index.php?order=5&dir=0#text">&darr;</a></th>
		      <th scope="col">Date of uploading <a href="index.php?order=4&dir=1#text">&uarr;</a> <a href="index.php?order=4&dir=0#text">&darr;</a></th>
		      <th scope="col">Download counts <a href="index.php?order=6&dir=1#text">&uarr;</a> <a href="index.php?order=6&dir=0#text">&darr;</a></th>
		      <th scope="col">Song rating <a href="index.php?order=7&dir=1#text">&uarr;</a> <a href="index.php?order=7&dir=0#text">&darr;</a></th>
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
					echo '</tr>';
				}
		  	?>		    
		  </tbody>
		</table>
	</div>
</div>
<?php 
	include 'files/container-footer.php';	
?>
</div>  <! –– container ––> 

<?php	
	include 'files/footer.php';	
?>
