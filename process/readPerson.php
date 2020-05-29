<?php

	require('../config/define.php');
	require('../config/db.php');

	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$query = "SELECT * FROM crud WHERE id = " . $id;
	$result = mysqli_query($conn, $query);
	$person = mysqli_fetch_assoc($result);

	echo json_encode($person);

	mysqli_free_result($result);
	mysqli_close($conn);

?>