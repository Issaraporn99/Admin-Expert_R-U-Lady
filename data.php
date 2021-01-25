<?php
  $connect = mysqli_connect('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046');
  $query = "SELECT * FROM `diagnosis` ";
  $result = mysqli_query($connect, $query);
  $data = array();
  foreach ($result as $row) {
      $data[] = $row;
  }
  ?>