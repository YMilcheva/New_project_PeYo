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

	function return_songs_info($order, $direction, $conn){
		$sql = "SELECT songs.song_id, songs.song_name, singers.singer_name, songs.song_date, users.user_username, genres.genre_name FROM songs_singers JOIN singers ON songs_singers.singer_id = singers.singer_id JOIN songs ON songs.song_id = songs_singers.song_id JOIN songs_genres ON songs_singers.song_id = songs_genres.song_id JOIN genres ON songs_genres.genre_id = genres.genre_id JOIN users ON songs.song_uploader = users.user_id WHERE songs.song_soft_delete IS NULL ORDER BY " . $order . ' ' . $direction;
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
					$songs[$row['song_id']] = array('song_name' => $row['song_name'], 'singer_name' => array($row['singer_name']), 'song_date' => $row['song_date'], 'user_username' => $row['user_username'], 'genre_name' => array($row['genre_name']));
					array_push($song_keys, $row['song_id']);
				}							
			}
		} else {
			echo '<h3 class="text-center text-secondary">Error: ' . mysqli_error($conn) . '</h3>';			
		}
		$temp_array = array($songs, $song_keys);
		return $temp_array;
	 }
?>