<?php
  include 'dbConfig.php';

  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=data.csv');
  // $output = fopen("php://output", "w");
  $output = fopen("truckdata_export.csv", "w");
  fputcsv($output, array('id', 'name', 'email', 'phone', 'modified', 'created', 'status'));
  $query = "SELECT * from TRUCKS";  //ORDER BY emp_id DESC";
  $result = mysqli_query($conn, $query);

  while($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
  }
  fclose($output);
?>
