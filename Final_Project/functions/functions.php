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
?>