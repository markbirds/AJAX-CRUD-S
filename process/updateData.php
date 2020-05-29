<?php 
  require('C:\xampp\htdocs\Projects\PHPAJAX\config\define.php');
  require('C:\xampp\htdocs\Projects\PHPAJAX\config\db.php');


  if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['age'])&&isset($_POST['address'])&&
  isset($_POST['year'])&&isset($_POST['email'])&&isset($_POST['description'])){

    $update_id = mysqli_real_escape_string($conn, $_POST['id']);
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

    if(!empty($name) && !empty($age) && !empty($address) && !empty($year) && !empty($email) && !empty($description)){   
      $query = "UPDATE crud SET 
            name = '$name',
            age = '$age',
            address = '$address',
            year = '$year',
            email = '$email',
            description = '$description'
            WHERE id = {$update_id}";
    }

    if(mysqli_query($conn, $query)){
    }else{
      echo 'ERROR';
    }
  }

?>