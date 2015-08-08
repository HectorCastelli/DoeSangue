<?php
  function fixDate($date) {
    return ($date[8].$date[9].'/'.$date[5].$date[6].'/'.$date[0].$date[1].$date[2].$date[3]);
  }
  function resTime($ini, $slot) {
    //consider the ini time and how many slots have already been completed.
    //$ini -> time
    //$slot -> int
    $slot = 20*$slot;
    $slot = '+'.$slot.' minutes';
    $ini = strtotime($ini);
    $time = date('H:i ', strtotime($slot, $ini));
    return ($time);
  }
?>
