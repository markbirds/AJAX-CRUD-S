<?php 
  require('C:\xampp\htdocs\Projects\PHPAJAX\config\define.php');
  require('C:\xampp\htdocs\Projects\PHPAJAX\config\db.php');


  if(isset($_POST['name'])&&isset($_POST['age'])&&isset($_POST['address'])&&
  isset($_POST['year'])&&isset($_POST['email'])&&isset($_POST['description'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);   
    $address = mysqli_real_escape_string($conn, $_POST['address']); 
    $year = mysqli_real_escape_string($conn, $_POST['year']); 
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_var($age, FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
    $year = filter_var($year, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);

    // checking if values were empty
    if(!empty($name) && !empty($age) && !empty($address) && !empty($year) && !empty($email) && !empty($description)){   
    $query = "INSERT INTO crud (name,age,address,year,email,description) 
          VALUES ('$name', '$age','$address','$year','$email','$description')";
    }

    if(mysqli_query($conn, $query)){
    }else{
      echo 'ERROR';
    }
  }

?>

<!-- The Modal -->
<div class="modal" id="create">
<div class="modal-dialog modal-lg modal-dialog-scrollable">
<div class="modal-content">
    
<!-- Modal Header -->
<div class="modal-header">
  <h3 class="modal-title">Create</h3>
  <button type="button" class="close" data-dismiss="modal">×</button>
</div>
    
    <!-- Modal body -->
<div class="modal-body px-5">
    <form id="createForm" class="was-validated" novalidate>
    <div class="row"> <!--row-->
    <div class="col-sm-8"> <!--column1-->
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" required>
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" placeholder="Enter address" required>
      </div>    
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" required>
      </div>      
    </div> <!--column1-->
    <div class="col-sm-4"> <!--column2-->
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" id="age" min="1" max="150" placeholder="Enter age" required>
      </div>
      <div class="form-group">
        <label for="year">Year Level:</label>
        <input type="text" class="form-control" id="year" placeholder="Enter year level" required>
      </div>        
    </div> <!--column1-->
  </div> <!--row-->
  <div class="form-group">
    <label for="description">Describe yourself:</label>
    <textarea class="form-control" rows="3" id="description" required></textarea>
  </div>
  <div class="text-right">
    <input type="submit" id="submit" name="submit" class="btn btn-success mt-2" value="Create">   
  </div>
</form>
</div>
       
      
</div>
</div>
</div>