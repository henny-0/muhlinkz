<?php  
if (count($errors) > 0)
  {
		echo '<div style="color:red;"><ul>';
  	foreach ($errors as $error){
			echo "<li>" .  $error . "</li>"; 
		}
		echo '</ul></div>';
}
?>