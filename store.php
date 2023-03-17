<?php

namespace App\store;

use mysqli;
/**
 * Undefined class
 */
class store
{
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "phpqueue";
        private $conn;
      
        public function __construct() {
          $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
          if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
          }
        }
      
        public function insert($data) {
            $name = $data['name'];
            $school = $data['school'];
            $dept = $data['dept'];
          $sql = "INSERT INTO queuedata (name, school, dept) VALUES ('$name', '$school', '$dept')";
        //   print_r($arr);
          if ($this->conn->query($sql) == TRUE) {
            return true;
          } else {
            return false;
          }
        }
      }
      
     class queue {
        private $queue = array();
      
        public function add($data) {
          array_push($this->queue, $data);
     }
      
        public function process() {
          $database = new store();
          while(count($this->queue) > 0) {
            $data = array_shift($this->queue);
            $database->insert($data);
          }
        }
      }
      

