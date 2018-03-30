<?php
  include 'dbConfig.php';

  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=data.csv');
  // $output = fopen("php://output", "w");
  $output = fopen("truckdata_export.csv", "w");
  fputcsv($output, array('year', 'cab', 'engine', 'wheel_base', 'drive_train', 'fgawr', 'gvwr', 'rear_wheel', 'bed', 'trim_pkg', 'headlamp', 'plow_model', 'subframe', 'mount_kit', 'center_member', 'note_1', 'note_2', 'note_3', 'note_4', 'note_5', 'note_6', 'note_7', 'note_8', 'note_9', 'note_10'));
  $query = "SELECT * from TRUCKS";  //ORDER BY emp_id DESC";
  $result = mysqli_query($conn, $query);

  while($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
  }
  fclose($output);
?>
