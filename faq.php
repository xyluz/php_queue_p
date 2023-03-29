<?php

namespace App\faq;

use Dotenv\Dotenv;
use mysqli;
/**
 * Undefined class
 */

 require 'vendor/autoload.php';
class faq
{
    private $db;

   
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

            // Use the environment variables to establish the database connection
        $this->db = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE']
        );
    }

    public function addFAQ($question, $answer) {
        $sql = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateFAQ($id, $question, $answer) {
        $sql = "UPDATE faqs SET question='$question', answer='$answer' WHERE id=$id";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFAQ($id) {
        $sql = "DELETE FROM faqs WHERE id=$id";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}


// Create a new instance of the FAQ class
$faq = new faq('localhost', 'username', 'password', 'database_name');
// Add a new FAQ
$faq->addFAQ('What is oop php?', 'OOP php is a server scripting language written in object oriented.');

// Update an existing FAQ
$faq->updateFAQ(1, 'What is PHP?', 'PHP is a server-side scripting language that is widely used for web development.');

// Delete an existing FAQ
$faq->deleteFAQ(1);



