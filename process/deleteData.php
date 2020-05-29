<?php

	require('../config/define.php');
	require('../config/db.php');

	if(isset($_GET['id'])){
		$delete_id = mysqli_real_escape_string($conn, $_GET['id']);

		$query = "DELETE FROM crud WHERE id = " . $delete_id;

		if(mysqli_query($conn, $query)){
		}else{
			echo 'ERROR';
		}
	}	

?>