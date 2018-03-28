<?php
//load the database configuration file
include 'dbConfig.php';

if(isset($_POST['importSubmit'])){
  //validate whether uploaded file is a csv file
  $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

  if( !empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes) ){
    if(is_uploaded_file($_FILES['file']['tmp_name'])){

      //open uploaded csv file with read only mode
      $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

      //skip first line
      fgetcsv($csvFile);

      //parse data from csv file line by line
      while(($line = fgetcsv($csvFile)) !== FALSE){
        //check whether truck already exists in database with same email
        $prevQuery = "SELECT id FROM $table WHERE email = '". $line[1] ."'";
        $prevResult = $conn->query($prevQuery);
        if ($prevResult->num_rows > 0) {
          //update truck data
          $conn->query("UPDATE $table SET name = '".$line[0]."', phone = '".$line[2]."', created = '".$line[3]."', modified = '".$line[3]."', status = '".$line[4]."' WHERE email = '".$line[1]."'");
        } else {
          //insert truck data into database
          $conn->query("INSERT INTO $table (name, email, phone, created, modified, status) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[3]."','".$line[4]."')");
        }
      }

      //close opened csv file
      fclose($csvFile);

      $qstring = '?status=succ';
    } else {
      $qstring = '?status=err';
    }
  } else {
    $qstring = '?status=invalid_file';
  }
}

//redirect to the listing page
header("Location: index.php" . $qstring);
