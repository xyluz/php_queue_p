<?php

use App\store\queue;
use App\store\store;

// Import the necessary classes
require_once 'store.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract the data from the request body
    $name = $_POST['name'];
    $school = $_POST['school'];
    $dept = $_POST['dept'];
    
    // Create a new instance of the queue class
    $queue = new queue();
    
    // Add the data to the queue
    $data = array('name' => $name, 'school' => $school, 'dept' => $dept);
    $queue->add($data);
    
    // Process the queue to insert the data into the database
    $queue->process();
    
    // Return a success message to the user
    echo "Data saved to database!";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add queue</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>
<div class="card text-center" style="padding:15px;">
</div><br>
<div class="container">
  <form action="postreq.php" method="POST">
    <div class="form-group">
      <label for="name">FullName:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter fullname" required="">
    </div>
    <div class="form-group">
      <label for="school">school:</label>
      <input type="text" class="form-control" name="school" placeholder="Enter school" required="">
    </div>
    <div class="form-group">
      <label for="dept">Department:</label>
      <input type="text" class="form-control" name="dept" placeholder="Enter dept" required="">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
