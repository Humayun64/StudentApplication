<?php 
// Include the database connection file
if(file_exists(dirname(__FILE__).'/conn.php')){
    require_once(dirname(__FILE__).'/conn.php');
}

// Start the session
session_start();

// Initialize error array
$errors = [];

// Handle form submission
if(isset($_POST['submit'])){
    $studentName  = $_POST['studentName'];
    $studentClass = $_POST['studentClass'];
    $studentRoll  = $_POST['studentRoll'];

    // Validate input fields
    if(empty($studentName)){
        $errors['studentName'] = "Name cannot be empty";
    }
    if(empty($studentClass)){
        $errors['studentClass'] = "Class name cannot be empty";
    }
    if(empty($studentRoll)){
        $errors['studentRoll'] = "Student Roll cannot be empty";
    }

    // If no errors, insert data into the database
    if(count($errors) == 0){
        $query = $conn->query("INSERT INTO stuinfo (studentName, studentClass, studentRoll) VALUES ('$studentName', '$studentClass', '$studentRoll')");
        if($query){
            $message = "Added successfully";
        } else {
            $message = "There was something wrong";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add aStudent</title>
  <link rel="stylesheet" href="style.css">
  
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
            
            <div class="insert-area">
                <h4 class="text-center">Add Student</h4>
                <hr>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <?php if(isset($message)) : ?>
                        <div class="alert alert-<?php echo ($query ? 'success' : 'danger'); ?> w-50">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3 row">
                        <label for="studentName" class="col-sm-2 col-form-label">Student's Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo isset($studentName) ? htmlspecialchars($studentName) : ''; ?>">
                            <?php if(isset($errors['studentName'])) : ?>
                                <div class="alert alert-danger w-50">
                                    <?php echo $errors['studentName']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="studentClass" class="col-sm-2 col-form-label">Student's Class:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="studentClass" name="studentClass" value="<?php echo isset($studentClass) ? htmlspecialchars($studentClass) : ''; ?>">
                            <?php if(isset($errors['studentClass'])) : ?>
                                <div class="alert alert-danger w-50">
                                    <?php echo $errors['studentClass']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="studentRoll" class="col-sm-2 col-form-label">Student's Roll:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="studentRoll" name="studentRoll" value="<?php echo isset($studentRoll) ? htmlspecialchars($studentRoll) : ''; ?>">
                            <?php if(isset($errors['studentRoll'])) : ?>
                                <div class="alert alert-danger w-50">
                                    <?php echo $errors['studentRoll']; ?>
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
