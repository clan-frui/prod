<?php 
	if(isset($ajax) && is_array($ajax)){
		echo json_encode($ajax);
	} elseif (isset($ajax)){
		echo $ajax; 
	}
?>