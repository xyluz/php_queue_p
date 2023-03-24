<?php

use App\customers\customers;
  // Include database file
  include 'customers.php';
  $customerObj = new customers();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $customerObj->insertData($_POST);
  }
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
  <title>Add Customer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>
<div class="card text-center" style="padding:15px;">
</div><br> 
<div class="container">
  <form action="addcustomer.php" method="POST">
    <div class="form-group">
      <label for="name">FullName:</label>
      <input type="text" class="form-control" name="fullname" placeholder="Enter fullname" required="">
    </div>
    <div class="form-group">
      <label for="username">Phone:</label>
      <input type="number" class="form-control" name="phone" placeholder="Enter Phone" required="">
    </div>
    <div class="form-group">
      <label for="email">Email address:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>