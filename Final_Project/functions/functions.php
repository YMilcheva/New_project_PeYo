<?php 
	function add_values_to_register_data(){		
		$register_data = array();
		if (isset($_POST['submit']) == true){
			$register_data[0] = trim(htmlentities($_POST['username']));
			$register_data[1] = trim(htmlentities($_POST['password']));
			$register_data[2] = trim(htmlentities($_POST['password_repeat']));
			$register_data[3] = trim(htmlentities($_POST['name_first']));
			$register_data[4] = trim(htmlentities($_POST['name_last']));
			$register_data[5] = trim(htmlentities($_POST['email']));
			$register_data[6] = check_are_all_fields_set($register_data);
		}
		return $register_data;
	}

	function check_are_all_fields_set($register_data){
		$is_ok = true;
		for ($i=0; $i < 6 ; $i++) { 
			if (strlen($register_data[$i]) == 0){
				$is_ok = false;
			}
		}
		return $is_ok;
	}

	function return_order_variable($order_rule){
		switch ($order_rule) {
			case 1:
				return 'songs.song_name';
			case 2:
				return 'singers.singer_name';
			case 3:
				return 'users.user_username';
			case 4:
				return 'songs.song_date';
			case 5:
				return 'genres.genre_name';
			case 6:
				return 'count_downloads';
			case 7:
				return 'average_rating';
			default:
				return 'songs.song_name';
		}						
	}

	function return_order_direction($order_rule){
		switch ($order_rule) {
			case 1:
				return 'DESC';
			case 0:
				return 'ASC';	
			default:
				return 'ASC';
		}				
	}

	function return_songs_info($order, $direction, $conn, $limit, $offset){
		$order = return_order_variable($order); 
		$direction = return_order_direction($direction);
		$sql = "SELECT 
			songs.song_id, 
    		songs.song_name, 
		    GROUP_CONCAT(DISTINCT singers.singer_name ORDER BY songs_singers.singer_id) AS singers, 
		    songs.song_date, 
		    users.user_username, 
		    GROUP_CONCAT(DISTINCT genres.genre_name ORDER BY songs_genres.genre_id) AS genres,
		   	(SELECT COUNT(downloads.download_song) FROM downloads WHERE download_song = songs.song_id) as count_downloads,
		    (SELECT COUNT(ratings.rating_number) FROM ratings WHERE ratings.rating_song = songs.song_id) as count_ratings,
		    (SELECT AVG(ratings.rating_number) FROM ratings WHERE ratings.rating_song = songs.song_id) as average_rating
		FROM songs JOIN songs_singers ON songs.song_id = songs_singers.song_id 
				   JOIN singers ON songs_singers.singer_id = singers.singer_id 
		           JOIN users ON songs.song_uploader = users.user_id 
		           JOIN songs_genres ON songs_singers.song_id = songs_genres.song_id 
		           JOIN genres ON songs_genres.genre_id = genres.genre_id 
		           LEFT JOIN downloads ON songs.song_id = downloads.download_song 
		           LEFT JOIN ratings ON songs.song_id = ratings.rating_song
		WHERE songs.song_soft_delete IS NULL 
		GROUP BY songs.song_name 
		ORDER BY " . $order . ' ' . $direction . " LIMIT " . $limit . "
        OFFSET " . $offset;
		$result = mysqli_query($conn, $sql);
		$songs = array();
		$song_keys = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$songs[$row['song_id']] = array('song_name' => $row['song_name'], 'singer_name' => $row['singers'], 'song_date' => $row['song_date'], 'user_username' => $row['user_username'], 'genre_name' => $row['genres'], 'count_downloads' => $row['count_downloads'], 'count_ratings' => $row['count_ratings'], 'average_rating' => $row['average_rating']);
				array_push($song_keys, $row['song_id']);				
			}
		} else {
			echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';			
		}
		$temp_array = array($songs, $song_keys);
		return $temp_array;
	 }

	 function return_songs_count($conn){
		$sql = "SELECT COUNT(song_id) as songs_count FROM songs WHERE song_soft_delete IS NULL";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				return 	$row['songs_count'];			
			}
		} else {
			echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';			
		}
	}

	function print_pagination($page_no, $total_no_of_pages, $direction, $order){
		$adjacents = "2";
		$second_last = $total_no_of_pages - 1;
		$previous_page = $page_no - 1;
		$next_page = $page_no + 1;
		echo '<p><strong>Page ' . $page_no . ' of ' . $total_no_of_pages . '</strong> </p>';
		echo '<ul class="pagination">';
		if ($page_no > 1) {
			echo "<li><a href='?page_no=1&order=" . $order . "&dir=" . $direction . "#text'>First Page</a></li>";
		}
		echo '<li ';
		if ($page_no <= 1){ 
			echo "class='disabled'";
		}
		echo '>';
		echo '<a ';
		if ($page_no > 1){
			echo "href='?page_no=$previous_page&order=" . $order . "&dir=" . $direction . "#text'";
		} 
		echo '>Previous</a>';
		echo '</li>';
		if ($total_no_of_pages <= 10){   
			for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
				if ($counter == $page_no) {
					echo "<li class='active'><a>$counter</a></li>"; 
			    } else {
			    	echo "<li><a href='?page_no=$counter&order=" . $order . "&dir=" . $direction . "#text'>$counter</a></li>";
			    }
			}
		} elseif ($total_no_of_pages > 10){
			if($page_no <= 4) { 
				for ($counter = 1; $counter < 8; $counter++){ 
					if ($counter == $page_no) {
				    	echo "<li class='active'><a>$counter</a></li>"; 
					} else{
				        echo "<li><a href='?page_no=$counter&order=" . $order . "&dir=" . $direction . "#text'>$counter</a></li>";
				    }
				}
				echo "<li><a>...</a></li>";
				echo "<li><a href='?page_no=$second_last&order=" . $order . "&dir=" . $direction . "#text'>$second_last</a></li>";
				echo "<li><a href='?page_no=$total_no_of_pages&order=" . $order . "&dir=" . $direction . "#text'>$total_no_of_pages</a></li>";
			} elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) { 
				echo "<li><a href='?page_no=1&order=" . $order . "&dir=" . $direction . "#text'>1</a></li>";
				echo "<li><a href='?page_no=2&order=" . $order . "&dir=" . $direction . "#text'>2</a></li>";
				echo "<li><a>...</a></li>";
				for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) { 
				    if ($counter == $page_no) {
					 	echo "<li class='active'><a>$counter</a></li>"; 
					} else{
					    echo "<li><a href='?page_no=$counter&order=" . $order . "&dir=" . $direction . "#text'>$counter</a></li>";
					}                  
				}
				echo "<li><a>...</a></li>";
				echo "<li><a href='?page_no=$second_last&order=" . $order . "&dir=" . $direction . "#text'>$second_last</a></li>";
				echo "<li><a href='?page_no=$total_no_of_pages&order=" . $order . "&dir=" . $direction . "#text'>$total_no_of_pages</a></li>";
			} else {
				echo "<li><a href='?page_no=1'>1</a></li>";
				echo "<li><a href='?page_no=2'>2</a></li>";
				echo "<li><a>...</a></li>";
				for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++){
				    if ($counter == $page_no) {
						echo "<li class='active'><a>$counter</a></li>";	
					} else{
				        echo "<li><a href='?page_no=$counter&order=" . $order . "&dir=" . $direction . "#text'>$counter</a></li>";
					}                   
				}
			}
		}
		echo '<li '; 
		if ($page_no >= $total_no_of_pages){
			echo "class='disabled'";
		} 
		echo '>';
		echo '<a ';
		if ($page_no < $total_no_of_pages) {
			echo "href='?page_no=$next_page&order=" . $order . "&dir=" . $direction . "#text'";
		} 
		echo '>Next</a>';
		echo '</li>';			 
		if ($page_no < $total_no_of_pages){
			echo "<li><a href='?page_no=$total_no_of_pages&order=" . $order . "&dir=" . $direction . "#text'>Last &rsaquo;&rsaquo;</a></li>";
		}
		echo '</ul>';
	}
?>