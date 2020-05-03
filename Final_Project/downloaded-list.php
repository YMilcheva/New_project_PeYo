<?php
	session_start();
	include 'functions/db_connect.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! List with all songs you downloaded!';
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
		<h2> Hey, <?php echo $_SESSION['user_name_first'] ?>! Here is the list with all songs you downloaded</h2>	
		
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Song Name</th>
		      <th scope="col">Performer</th>
		      <th scope="col">Genre</th>
		      <th scope="col">Date of downloading</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  		$sql = "SELECT songs.song_id, songs.song_name, singers.singer_name, songs.song_date, genres.genre_name, downloads.download_date FROM songs_singers JOIN singers ON songs_singers.singer_id = singers.singer_id JOIN songs ON songs.song_id = songs_singers.song_id JOIN songs_genres ON songs_singers.song_id = songs_genres.song_id JOIN genres ON songs_genres.genre_id = genres.genre_id JOIN downloads ON downloads.download_song = songs.song_id JOIN users ON downloads.download_user = users.user_id WHERE users.user_id = " . $_GET['id'] . " AND songs.song_soft_delete IS NULL ";
		  		$result = mysqli_query($conn, $sql);
		  		$songs = array();
		  		$song_keys = array();
		  		if ($result) {
    				while ($row = mysqli_fetch_assoc($result)) {
						if (array_key_exists($row['song_id'], $songs)){
							if (in_array($row['singer_name'], $songs[$row['song_id']]['singer_name']) == false){
								array_push($songs[$row['song_id']]['singer_name'], $row['singer_name']);
							}

							if (in_array($row['genre_name'], $songs[$row['song_id']]['genre_name']) == false){
								array_push($songs[$row['song_id']]['genre_name'], $row['genre_name']);
							}

						} else {
							$songs[$row['song_id']] = array('song_name' => $row['song_name'], 'singer_name' => array($row['singer_name']), 'song_date' => $row['download_date'], 'genre_name' => array($row['genre_name']));
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
