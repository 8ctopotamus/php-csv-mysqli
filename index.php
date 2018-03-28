<?php
//load the database configuration file
include 'dbConfig.php';

if(!empty($_GET['status'])){
  switch($_GET['status']){
    case 'succ':
      $statusMsgClass = 'alert-success';
      $statusMsg = 'Truck data has been inserted successfully.';
      break;
    case 'err':
      $statusMsgClass = 'alert-danger';
      $statusMsg = 'Some problem occurred, please try again.';
      break;
    case 'invalid_file':
      $statusMsgClass = 'alert-danger';
      $statusMsg = 'Please upload a valid CSV file.';
      break;
    default:
      $statusMsgClass = '';
      $statusMsg = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Truck Data CSV Import</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container" style="margin-top: 30px;">
    <?php if(!empty($statusMsg)){
      echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
    <div class="panel panel-info">
      <div class="panel-heading">
        Trucks
      </div>
      <div class="panel-body">
        <form action="importData.php" method="post" enctype="multipart/form-data" id="importFrm" style="margin-bottom: 20px;">
          <div class="row">
            <div class="col-sm-6">
              <label for="file">CSV file</label>
              <div class="input-group">
                 <input type="file" name="file" class="form-control" placeholder="CSV file" />
                 <span class="input-group-btn">
                    <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                 </span>
              </div>
            </div>

            <div class="col-sm-3 col-sm-offset-3">
              <?php
                if (isset($_GET['ajax'])) {
                  echo $_GET['myString'];
                } else {
              ?>
                <button id="exportData" name="export" class="btn btn-default" type="button">
                  Export <?php echo $table; ?> data CSV
                </button>
                <pre id="data"></pre>
              <?php } ?>
            </div>
          </div>
        </form>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Created</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
            //get records from database
            $query = $conn->query("SELECT * FROM TRUCKS ORDER BY id DESC");
            if ($query->num_rows > 0) {
              while($row = $query->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['created']; ?></td>
                  <td><?php echo ($row['status'] == '1') ? 'Active' : 'Inactive'; ?></td>
                </tr>
            <?php }
              } else { ?>
              <tr><td colspan="5">No trucks(s) found.....</td></tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var scriptString = 'THIS IS MY JS STRING';
    $('#exportData').click(function(){
      $.ajax({
        method: 'post',
        url: 'exportData.php',
        data: {
          'myString': scriptString,
          'ajax': true
        },
        success: function(data) {
          $('#data').text(data);
          console.log('CSV exported!')
        }
      });
    });
  </script>
</body>
</html>
