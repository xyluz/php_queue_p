<?php

namespace App\customers;

use mysqli;
use SplQueue;

include __DIR__ . '/vendor/autoload.php';

/**
 * Undefined class
 */
class customers
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "phpqueue";
    private $conn;

    //databse connection
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect: " . mysqli_connect_error());
        } else {
            return $this->conn;
        }
    }

    //insert data into customer table
    public function insertData($post)
    {
        $name = $this->conn->real_escape_string($_POST['fullname']);
        $phone = $this->conn->real_escape_string($_POST['phone']);
        $email = $this->conn->real_escape_string($_POST['email']);
        $query = "INSERT INTO customers (fullname,phone,email) VALUES('$name','$phone','$email')";
        // print_r($query);
        $sql = $this->conn->query($query);

		//creating an instance of SplQueue class
        $newqueue = new SplQueue();
		//using enqueue() function to the add items to the queue from the tail of the queue
        $newqueue->enqueue($name);
        $newqueue->enqueue($phone);
        $newqueue->enqueue($email);
		//using rewind() function to bring the file pointer to the beginning of the queue
        $newqueue->rewind();
		//using valid() function to check if the queue is valid or not after using rewind() function and then displaying the elements of the queue
        while ($newqueue->valid()) {
            echo $newqueue->current(), "\n";
            $newqueue->next();
        }
        if ($sql == true) {
            header("Location:index.php?msg1=insert");

        } else {
            echo "failed try again!";
        }
    }
		//fetch customer list for view
    public function displayData()
    {
        $query = "SELECT * FROM customers";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "No found records";
        }
    }

    // Fetch single data for edit from customer table
    public function displyaRecordById($id)
    {
        $query = "SELECT * FROM customers WHERE id = '$id'";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "Record not found";
        }
    }

    // Update customer data into customer table
    public function updateRecord($updatecustomer)
    {
        $fullname = $this->conn->real_escape_string($_POST['fullname']);
        $phone = $this->conn->real_escape_string($_POST['phone']);
        $email = $this->conn->real_escape_string($_POST['email']);
        $id = $this->conn->real_escape_string($_POST['id']);
        if (!empty($id) && !empty($updatecustomer)) {
            $query = "UPDATE customers SET fullname = '$fullname', email = '$email', phone = '$phone' WHERE id = '$id'";
            $sql = $this->conn->query($query);
            if ($sql == true) {
                header("Location:index.php?msg2=update");
            } else {
                echo "Registration updated failed try again!";
            }
        }

    }

    // Delete customer data from customer table
    public function deleteRecord($id)
    {
        $query = "DELETE FROM customers WHERE id = '$id'";
        $sql = $this->conn->query($query);
        if ($sql == true) {
            header("Location:index.php?msg3=delete");
        } else {
            echo "Record does not delete try again";
        }
    }
}
