<?php
// Start the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Include the database connection file
if (file_exists(dirname(__FILE__) . '/../conn.php')) {
    require_once(dirname(__FILE__) . '/../conn.php');
}

// Fetch data from the database
$query = $conn->query("SELECT * FROM stuinfo");
$students = $query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Admin Panel</title>
  <link rel="stylesheet" href="../style.css">
  
  <!-- Bootstrap CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <!-- jQuery via CDN (optional but recommended) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <!-- Bootstrap JS via CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-YgRSKL5LZ0DxWgCCAVtX4e8SPxEqPVp+zxP3bIca0uX7UilKgOe5HJ2lGWyJwYbY" crossorigin="anonymous"></script>
  
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="header-area">
                <h2 class="text-center">Student Panel</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Student's Name</th>
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
                                    <a href="update.php?id=<?php echo $student['id']; ?>" target="_blank"><i class="bi bi-pencil"></i></a>
                                    <a href="delete.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');"><i class="bi bi-x-circle"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <a href="addstudents.php" target="_blank"><button type="submit" class="btn btn-primary" name="submit">Add Student</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
