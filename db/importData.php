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

      // parse data from csv file line by line
      while(($line = fgetcsv($csvFile)) !== FALSE){
        $year = $line[0];
        $cab = $line[1];
        $engine = $line[2];
        $wheel_base = $line[3];
        $drive_train = $line[4];
        $fgawr = $line[5];
        $gvwr = $line[6];
        $rear_wheel = $line[7];
        $bed = $line[8];
        $trim_pkg = $line[9];
        $headlamp = $line[10];
        $plow_model = addslashes($line[11]);
        $subframe = addslashes($line[12]);
        $mount_kit = addslashes($line[13]);
        $center_member = addslashes($line[14]);
        $note_1 = addslashes($line[15]);
        $note_2 = addslashes($line[16]);
        $note_3 = addslashes($line[17]);
        $note_4 = addslashes($line[18]);
        $note_5 = addslashes($line[19]);
        $note_6 = addslashes($line[20]);
        $note_7 = addslashes($line[21]);
        $note_8 = addslashes($line[22]);
        $note_9 = addslashes($line[23]);
        $note_10 = addslashes($line[24]);

        // check whether truck already exists in database with same email
        // $prevQuery = "SELECT id FROM $table WHERE cab = '". $line[1] ."'";
        // $prevResult = $conn->query($prevQuery);
        // if ($prevResult->num_rows > 0) {
        //   //update truck data
        //   $conn->query("UPDATE $table SET name = '".$line[0]."', phone = '".$line[2]."', created = '".$line[3]."', modified = '".$line[3]."', status = '".$line[4]."' WHERE email = '".$line[1]."'");
        //   echo "update truck data";
        //   die();
        // } else {

          //insert truck data into database
          $conn->query("INSERT INTO $table (year, cab, engine, wheel_base, drive_train, fgawr, gvwr, rear_wheel, bed, trim_pkg, headlamp, plow_model, subframe, mount_kit, center_member, note_1, note_2, note_3, note_4, note_5, note_6, note_7, note_8, note_9, note_10) VALUES ('$year', '$cab', '$engine', '$wheel_base', '$drive_train', '$fgawr', '$gvwr', '$rear_wheel', '$bed', '$trim_pkg', '$headlamp', '$plow_model', '$subframe', '$mount_kit', '$center_member', '$note_1', '$note_2', '$note_3', '$note_4', '$note_5', '$note_6', '$note_7', '$note_8', '$note_9', '$note_10')");
        // }
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
header("Location: ../index.php" . $qstring);
