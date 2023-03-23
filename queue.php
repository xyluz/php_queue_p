<?php

namespace App\queue;

use Dotenv\Dotenv;
use mysqli;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//load phpmailer
// require 'vendor/phpmailer/src/PHPMailer.php';
// require 'vendor/phpmailer/src/Exception.php';
// require 'vendor/phpmailer/src/SMTP.php';
//Load Composer's autoloader
require 'vendor/autoload.php';

/**
 * Undefined class
 */

class Notification
{

    private $queue;
    private $from_email;

    public function __construct(queue $queue, $from_email)
    {
        $this->queue = $queue;
        $this->from_email = $from_email;
    }

    public function send_email($to, $subject, $message)
    {
        $data = array(
            'to_email' => $to,
            'from_email' => $this->from_email,
            'subject' => $subject,
            'message' => $message,
        );

        // Create a new queue with the email data
        //   $stmt = "INSERT INTO queues (to_email, from_email,) VALUES (?, NOW())";
        if ($this->queue->create_queue(json_encode($data))) {
            echo "Email notification added to the queue.\n";
            return true;
        } else {
            echo "Error adding email notification to the queue.\n";
            return false;
        }
    }

    public function process_queue()
    {
        while (true) {
            $next_queue = $this->queue->get_next_queue();
            if (!$next_queue) {
                sleep(5); // Wait for 5 seconds before checking again
                continue;
            }
            $data = json_decode($next_queue['data'], true);
            $to = $data['to_email'];
            $subject = $data['subject'];
            $message = $data['message'];
            $headers = "From: " . $data['from_email'] . "\r\n" .
                "Reply-To: " . $data['from_email'] . "\r\n";

            // Create a new instance of PHPMailer
            $mail = new PHPMailer(true);

            // Set the mailer to use SMTP
            $mail->isSMTP();

            // Set the SMTP host name
            $mail->Host = 'sandbox.smtp.mailtrap.io'; // Update with your SMTP server details

            // Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 2525;
            $mail->SMTPAuth = true;

            // Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';

            // Set the SMTP authentication username
            $mail->Username = 'f55d08baf4a54d'; // Update with your email address

            // Set the SMTP authentication password
            $mail->Password = '2022dc62cf8878'; // Update with your email password

            // Set the "From" email address and name
            $mail->setFrom('priscavincent2018@gmail.com', 'Your Name');

            // Set the "To" email address
            $mail->addAddress($to);

            // Set the email subject
            $mail->Subject = $subject;

            // Set the email body
            $mail->Body = $message;
            try {
                // Send the email
                $mail->send();

                // Email sent successfully, mark the queue as completed
                $this->queue->mark_queue_completed($next_queue['id']);
                echo "Email notification sent to " . $to . "\n";
            } catch (Exception $e) {
                // Email failed to send, mark the queue as failed
                $this->queue->mark_queue_failed($next_queue['id']);
                echo "Error sending email notification to " . $to . ": " . $mail->ErrorInfo . "\n";
            }
            sleep(1); // Wait for 1 second before processing the next queue
        }

    }
}

// Create a new queue object
$queue = new Queue();

// Create a new notification object
$notification = new Notification($queue, 'priscavincent2018@gmail.com');

// Send an email notification
$to = 'bukasongeneral2017@gmail.com';
$subject = 'Test Email Notification';
$message = 'This is a test email notification.';
$notification->send_email($to, $subject, $message);

// Process the queue to send the email
$notification->process_queue();

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
        //   $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        //   if ($this->conn->connect_error) {
        //       die("Connection failed: " . $this->conn->connect_error);
        //   }

        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

            // Use the environment variables to establish the database connection
        $this->conn = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE']
        );
    }

    // Create a new queue
    public function create_queue($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO queues (data, created_at) VALUES (?, NOW())");
        $stmt->bind_param("s", $data);

        if ($stmt->execute()) {
            echo "Queue created with ID: " . $stmt->insert_id . "\n";
            return true;
        } else {
            echo "Error creating queue: " . $this->conn->error . "\n";
            return false;
        }

        //   global $conn;
        //   $sql = "INSERT INTO queues (data, created_at) VALUES ($data, NOW())";
        //   //   print_r($sql);
        //   if ($this->conn->query($sql) == true) {
        //       // $queue_id = $this->conn->insert_id;
        //       echo "Queue created with ID: ";
        //       // return $queue_id;
        //   } else {
        //       echo "Error creating queue: " . $this->conn->error;
        //       return false;
        //   }

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

// class Notification
// {

//     private $queue;

//     public function __construct()
//     {
//         $this->queue = new queue();
//     }

//     public function send_notification($user_id, $message)
//     {
//         $data = array(
//             'user_id' => $user_id,
//             'message' => $message,
//             'sent_at' => null,
//         );

//         $this->queue->create_queue(json_encode($data));
//     }

//     public function dispatch_notifications()
//     {
//         while (true) {
//             $next_queue = $this->queue->get_next_queue();
//             if (!$next_queue) {
//                 sleep(5); // Wait for 5 seconds before checking again
//                 continue;
//             }

//             $data = json_decode($next_queue['data'], true);
//             $user_id = $data['user_id'];
//             $message = $data['message'];

//             // Send the notification here
//             $this->send_email_notification($user_id, $message);

//             $this->queue->mark_queue_dispatched($next_queue['id']);
//             $this->queue->mark_queue_completed($next_queue['id']);

//             sleep(1); // Wait for 1 second before processing the next queue
//         }
//     }

//     private function send_email_notification($user_id, $message)
//     {
//         // Code to send email notification to user
//         // You can replace this with your own code to send notifications through your preferred channel
//         echo "Sending notification to user $user_id: $message\n";
//     }
// }

// // Example usage:
// $notification = new Notification();
// $notification->send_notification(1, "Hello, World!");
// $notification->send_notification(2, "This is a test notification.");

// // Cron
