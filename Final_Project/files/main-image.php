<?php 
	echo '<img src="images/main-image-';
	$num = rand(1, 4);
	switch ($num) {
			case 1:
				echo '1';
				break;
			case 2:
				echo '2';
				break;
			case 3:
				echo '3';
				break;
			case 4:
				echo '4';
				break;
			default:
				echo '1';
				break;
		}	
	echo '.png">';
?>