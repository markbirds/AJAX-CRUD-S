<?php

	require('../config/define.php');
	require('../config/db.php');

	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$query = "SELECT * FROM crud WHERE id = " . $id;
	$result = mysqli_query($conn, $query);
	$person = mysqli_fetch_assoc($result);

	mysqli_free_result($result);
	mysqli_close($conn);

	echo 
	'<form id="updateForm" class="was-validated" novalidate>'. 
    '<div class="row"> <!--row-->'.
    '<div class="col-sm-8"> <!--column1-->'.
      '<div class="form-group">'.
        '<label for="name">Name:</label>'.
        '<input type="text" class="form-control" id="name" placeholder="Enter name" value="'.$person["name"].'" required>'.
      '</div>'.
      '<div class="form-group">'.
        '<label for="address">Address:</label>'.
        '<input type="text" class="form-control" id="address" placeholder="Enter address" value="'.$person["address"].'" required>'.
      '</div> '.
      '<div class="form-group">'.
        '<label for="email">Email:</label>'.
        '<input type="email" class="form-control" id="email" placeholder="Enter email" value="'.$person["email"].'" required>'.
      '</div> '.
    '</div> <!--column1-->'.
    '<div class="col-sm-4"> <!--column2-->'.
      '<div class="form-group">'.
        '<label for="age">Age:</label>'.
        '<input type="number" class="form-control" id="age" min="1" max="150" value="'.$person["age"].'" placeholder="Enter age" required>'.
      '</div>'.
      '<div class="form-group">'.
        '<label for="year">Year Level:</label>'.
        '<input type="text" class="form-control" id="year" placeholder="Enter year level" value="'.$person["year"].'" required>'.
      '</div>  '     . 
    '</div> <!--column1-->'.
  '</div> <!--row-->'.
  '<div class="form-group">'.
    '<label for="description">Describe yourself:</label>'.
    '<textarea class="form-control" rows="3" id="description" required>'.$person["description"].'</textarea>'.
  '</div>'.

  '<div class="text-right clearfix">'.
    '<button type="button" class="btn btn-dark float-left" onclick="ajaxUpdate()">Back</button>'.
    '<button type="button" class="btn text-light Orange" onclick="ajaxUpdateSubmit('.$person["id"].',getValues())">Update</button>'.
  '</div>'.
'</form>';

?>