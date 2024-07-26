<?php
if (file_exists(dirname(__FILE__).'/conn.php')) {
    require_once(dirname(__FILE__).'/conn.php');
}

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Delete the student
    $query = $conn->query("DELETE FROM stuinfo WHERE id = '$studentId'");

    if ($query) {
        $message = "Student deleted successfully";
    } else {
        $message = "There was something wrong";
    }

    // Redirect to the main page with a success or error message
    header("Location: index.php?message=" . urlencode($message));
    exit;
} else {
    die("Invalid request");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Admin Panel</title>
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
          <h2 class="text-center">Student Panel</h2>

          <?php if (isset($_GET['message'])) : ?>
            <div class="alert alert-success w-50">
              <?php echo "<p>" . htmlspecialchars($_GET['message']) . "</p>"; ?>
            </div>
          <?php endif; ?>

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">SL.</th>
                <th scope="col">Student's Name:</th>
                <th scope="col">Student's Class</th>
                <th scope="col">Student's Roll</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($students as $index => $student): ?>
                <tr>
                  <th scope="row"><?php echo $index + 1; ?></th>
                  <td><?php echo htmlspecialchars($student['studentName']); ?></td>
                  <td><?php echo htmlspecialchars($student['studentClass']); ?></td>
                  <td><?php echo htmlspecialchars($student['studentRoll']); ?></td>
                  <td>
                    <a href="update.php?id=<?php echo $student['id']; ?>"><i class="bi bi-pencil">Edit</i></a>
                    <a href="delete.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');"><i class="bi bi-x-circle"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="insert-area">
          <h4 class="text-center">Add Student</h4>
          <hr>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php if (isset($message)) : ?>
              <div class="alert alert-success w-50">
                <?php echo "<p>".$message."</p>"; ?>
              </div>
            <?php endif; ?>

            <div class="mb-3 row">
              <label for="studentName" class="col-sm-2 col-form-label">Student's Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="studentName" name="studentName">
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
                <input type="text" class="form-control" id="studentClass" name="studentClass">
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
                <input type="text" class="form-control" id="studentRoll" name="studentRoll">
                <?php if (isset($error['studentRoll'])) : ?>
                  <div class="alert alert-warning w-50">
                    <?php echo $error['studentRoll']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary" name="submit">Add Student</button>
              </div>
            </div>
          </form>
        </div>    
      </div>
    </div>
  </div>
</body>
</html>
