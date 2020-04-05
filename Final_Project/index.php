<?php
	session_start();
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
	</div>
</div>
<?php 
	include 'files/container-footer.php';	
?>
</div>  <! –– container ––> 

<?php	
	include 'files/footer.php';	
?>
