<?php

	require('../config/define.php');
	require('../config/db.php');

	$query = "SELECT * FROM crud ORDER BY date DESC";
	$result = mysqli_query($conn, $query);
	$persons = mysqli_fetch_all($result, MYSQLI_ASSOC);

	echo json_encode($persons);

	mysqli_free_result($result);
	mysqli_close($conn);

?>