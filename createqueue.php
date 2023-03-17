<?php

namespace App\createqueue;
/**
 * Undefined class
 */
class createqueue
{
    private $items = array();

  // enqueue an item to the end of the queue
  public function enqueue($item) {
    array_push($this->items, $item);
  }

  // dequeue an item from the front of the queue
  public function dequeue() {
    if ($this->isEmpty()) {
      return null;
    } else {
      return array_shift($this->items);
    }
  }

  // check if the queue is empty
  public function isEmpty() {
    return empty($this->items);
  }

  // get the size of the queue
  public function size() {
    return count($this->items);
  }

  // get the item at the front of the queue without removing it
  public function peek() {
    return $this->isEmpty() ? null : $this->items[0];
  }
}
