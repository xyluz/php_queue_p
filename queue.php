<?php

namespace App\queue;

use mysqli;

/**
 * Undefined class
 */
class queue
{
    //     private $db;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "phpqueue";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Create a new queue
    public function create_queue($data)
    {
        global $conn;
        $sql = "INSERT INTO queues (data, created_at) VALUES ('prisca', NOW())";
      //   print_r($sql);
        if ($this->conn->query($sql) == true) {
            // $queue_id = $this->conn->insert_id;
            echo "Queue created with ID: ";
            // return $queue_id;
        } else {
            echo "Error creating queue: " . $this->conn->error;
            return false;
        }
    }

    // Get the next queue to dispatch
    public function get_next_queue()
    {
        global $conn;
        $sql = "SELECT * FROM queues WHERE dispatched_at IS NULL ORDER BY created_at ASC LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "No queue found\n";
            return false;
        }
    }

    // Mark a queue as dispatched
    public function mark_queue_dispatched($queue_id)
    {
        global $conn;
        $sql = "UPDATE queues SET dispatched_at = NOW() WHERE id = $queue_id";
        if ($this->conn->query($sql) === true) {
            echo "Queue marked as dispatched\n";
            return true;
        } else {
            echo "Error marking queue as dispatched: " . $this->conn->error;
            return false;
        }
    }

    // Mark a queue as completed
    public function mark_queue_completed($queue_id)
    {
        global $conn;
        $sql = "UPDATE queues SET completed_at = NOW() WHERE id = $queue_id";
        if ($this->conn->query($sql) === true) {
            echo "Queue marked as completed\n";
            return true;
        } else {
            echo "Error marking queue as completed: " . $this->conn->error;
            return false;
        }
    }

    // Mark a queue as failed
    public function mark_queue_failed($queue_id)
    {
        global $conn;
        $sql = "UPDATE queues SET failed_at = NOW() WHERE id = $queue_id";
        if ($this->conn->query($sql) === true) {
            echo "Queue marked as failed\n";
            return true;
        } else {
            echo "Error marking queue as failed: " . $this->conn->error;
            return false;
        }
    }

    // Check for failed queues and mark them as such
    public function check_failed_queues()
    {
        global $conn;
        $sql = "SELECT * FROM queues WHERE dispatched_at IS NOT NULL AND completed_at IS NULL AND failed_at IS NULL AND dispatched_at < DATE_SUB(NOW(), INTERVAL 1 HOUR)";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               $this->mark_queue_failed($row['id']);
            }
        }
    }

    

}

// Example usage:
// $queue = new queue();
// $queue->create_queue('data1');
// $queue->create_queue('data2');
// $queue->create_queue('data3');

// Cron job example:
while (true) {
    $queue = new queue();
    $next_queue = $queue->get_next_queue();
    if (!$next_queue) {
        sleep(5); // Wait for 5 seconds before checking again
        continue;
    }
    // Dispatch the queue here
    $queue->mark_queue_dispatched($next_queue['id']);
    // Once the queue is completed
    $queue->mark_queue_completed($next_queue['id']);
    sleep(1); // Wait for 1 second before processing the next queue
}


