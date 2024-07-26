<?php
if (file_exists(dirname(__FILE__).'/conn.php')) {
    require_once(dirname(__FILE__).'/conn.php');
}

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Fetch the student data
    $query = $conn->query("SELECT * FROM stuinfo WHERE id = '$studentId'");
    $student = $query->fetch_assoc();

    if (!$student) {
        die("Student not found!");
    }

    // Handle form submission
    if (isset($_POST['update'])) {
        $studentName  = $_POST['studentName'];
        $studentClass = $_POST['studentClass'];
        $studentRoll  = $_POST['studentRoll'];

        $error = array();
        if ($studentName == NULL) {
            $error['studentName'] = "Name cannot be empty";
        }
        if (empty($studentClass)) {
            $error['studentClass'] = "Class name cannot be empty";
        }
        if (empty($studentRoll)) {
            $error['studentRoll'] = "Student Roll cannot be empty";
        }

        if (count($error) == 0) {
            $query = $conn->query("UPDATE stuinfo SET studentName='$studentName', studentClass='$studentClass', studentRoll='$studentRoll' WHERE id='$studentId'");

            if ($query) {
                $message = "Updated Successfully";
            } else {
                $message = "There was something wrong";
            }
        }
    }
} else {
    die("Invalid request");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Student</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-YgRSKL5LZ0DxWgCCAVtX4e8SPxEqPVp+zxP3bIca0uX7UilKgOe5HJ2lGWyJwYbY" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="header-area">
          <h2 class="text-center">Update Student</h2>
          <?php if (isset($message)) : ?>
            <div class="alert alert-success w-50">
              <?php echo "<p>".$message."</p>"; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="insert-area">
          <h4 class="text-center">Edit Student Information</h4>
          <hr>
          <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $studentId; ?>" method="POST">
            <div class="mb-3 row">
              <label for="studentName" class="col-sm-2 col-form-label">Student's Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo htmlspecialchars($student['studentName']); ?>">
                <?php if (isset($error['studentName'])) : ?>
                  <div class="alert alert-danger w-50">
                    <?php echo $error['studentName']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="studentClass" class="col-sm-2 col-form-label">Student's Class:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="studentClass" name="studentClass" value="<?php echo htmlspecialchars($student['studentClass']); ?>">
                <?php if (isset($error['studentClass'])) : ?>
                  <div class="alert alert-warning w-50">
                    <?php echo $error['studentClass']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="studentRoll" class="col-sm-2 col-form-label">Student's Roll:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="studentRoll" name="studentRoll" value="<?php echo htmlspecialchars($student['studentRoll']); ?>">
                <?php if (isset($error['studentRoll'])) : ?>
                  <div class="alert alert-warning w-50">
                    <?php echo $error['studentRoll']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary" name="update">Update Student</button>
              </div>
            </div>
          </form>
        </div>    
      </div>
    </div>
  </div>
</body>
</html>
