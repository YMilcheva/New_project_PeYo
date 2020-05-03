<?php
	ob_start();
	session_start();
	include 'functions/db_connect.php'; 
	include 'functions/functions.php'; 
	$siteTitle = 'Music is your passion ' . $_SESSION['user_name_first'] . '! You are welcome!';
	include 'files/header.php';
	include 'files/navigation-user.php';
	include 'files/container.php';		

	function print_song_table($songs, $song_keys, $offset){
		$size = sizeof($songs);
		for ($i=0; $i < $size; $i++) { 
			$key = $song_keys[$i];					
			echo '<tr>';
			echo '<th scope="row">' . ($offset + $i + 1) . '</th>';
			echo '<td>' . $songs[$key]['song_name'] . '</td>';
			echo '<td>' . $songs[$key]['singer_name'] . '</td>';
			echo '<td>' . $songs[$key]['genre_name'] . '</td>';					
			echo '<td>' . $songs[$key]['song_date'] . '</td>';
			echo '<td>' . $songs[$key]['user_username'] . '</td>';
			echo '<td>' . $songs[$key]['count_downloads'] . '</td>';
			echo '<td><span title="Average rating of ' . round($songs[$key]['average_rating'], 2) . ' from ' . $songs[$key]['count_ratings'] .  ' total votes">';
			for ($stars=1; $stars <= 5; $stars++) { 
				if ($stars <= $songs[$key]['average_rating']){
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

	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
   		$page_no = $_GET['page_no'];
	} else {
	    $page_no = 1;
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
		<h2> Hey, <?php echo $_SESSION['user_name_first'] ?>! Check our song list below or press the Upload button!</h2><p>
		<?php 
        	if (isset($_SESSION['alert_message']) && strlen($_SESSION['alert_message']) > 2){
        		echo $_SESSION['alert_message'];
        		unset($_SESSION['alert_message']);                         		
        	}
        ?>
       <div class="search_nav">			
			<div class="text-left">	
				<a href="upload.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Upload</a>
			</div> 
			<form method="post">
			<div class="text-right">
				<div class="text-left">
					<input type="text" name="search_string" class="form-control" placeholder="Search...">
				</div>
				<div class="text-right">	
					<input type="submit" class="btn btn-success btn-md" name="search" value="SEARCH">
				</div>		
			</div>								
		</form>
			<?php
				if (isset($_POST['search'])){
					$search = $_POST['search_string'];
				} else {
					$search = "";
				}
			?>
		</div>
		<div class="table-responsive">
		<table class="table table-striped">
		  <thead>
		    <tr>
		    	<?php 
		    		if (strlen($search) > 0){
		    			?>
		      <th scope="col">#</th>
		      <th scope="col">Song Name</th>
		      <th scope="col">Performer</th>
		      <th scope="col">Genre</th>
		      <th scope="col">Date of uploading</th>
		      <th scope="col">Uploader</th>
		      <th scope="col">Download counts</th>
		      <th scope="col">Song rating</th>
		      <th scope="col">Rate the song</th>
		      <th scope="col">Download</th>
		    			<?php
		    		} else {		    		
		    	?>
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
		      <?php 
		      	}
		      ?>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
	        	if (isset($_SESSION['songs_count']) == false){
	        		$_SESSION['songs_count'] = return_songs_count($conn, $search);	        		
	        	}
	        	if (strlen($search) > 0) {
	        		$page_no = 1;
	        		$total_records_per_page = $_SESSION['songs_count'];
	        	} else {
	        		$total_records_per_page = 10;
	        	}
	        	
				$total_no_of_pages = ceil($_SESSION['songs_count'] / $total_records_per_page);				
				$offset = ($page_no - 1) * $total_records_per_page;
									
		  		if (isset($_GET['order'])){
		  			$order = $_GET['order']; 
		  		} else {
		  			$order = 1;
		  		}
				
		  		if (isset($_GET['dir'])){		  			
		  			$direction = $_GET['dir'];
		  		} else {
		  			$direction = 0;
		  		}

		  		$temp_array = return_songs_info($order, $direction, $conn, $total_records_per_page, $offset, $search);
		  		$songs = $temp_array[0];
		  		$song_keys = $temp_array[1];	
		  		if (strlen($search) > 0){
		  			echo '<p><h2>Search results for "' . $search . '"</h2></p>';
		  		}
		  		print_song_table($songs, $song_keys, $offset);	
		  	?>		  	 
		  	</tbody>
		</table>
		<div class="current_page">
		<?php
			if (strlen($search) == 0){
				print_pagination($page_no, $total_no_of_pages, $direction, $order);
			}		  	
		?>	
		</div>	   
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