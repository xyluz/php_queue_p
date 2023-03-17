<?php

use App\createqueue\createqueue;
include "createqueue.php";

$queue = new createqueue();
//here i am inserting data into the queue using enqueue

$queue->enqueue("apple");
$queue->enqueue("banana");
$queue->enqueue("cherry");

echo "Queue size: " . $queue->size() . "\n"; // Output: Queue size: 3
// echo "Front of queue: " . $queue->peek() . "\n"; // Output: Front of queue: apple
// echo "Dequeued item: " . $queue->dequeue() . "\n"; // Output: Dequeued item: apple
// echo "Queue size: " . $queue->size() . "\n"; // Output: Queue size: 2
