<?php
// edit_student.php

require_once 'connect3.php'; // <<== تم التعديل هنا لـ connect3.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connect = new Connect();

$studentData = [];
$successMessage = '';
$errorMessage = ''; 
$tableName = "info"; 

$studentId = $_GET['id'] ?? null; 

if (!$studentId || !is_numeric($studentId)) {
    $errorMessage = "Invalid or missing Student ID in the URL. Please use a valid ID from your table (e.g., ?id=22, ?id=28, ?id=30, ?id=26).";
    $studentData = null; 
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dataToUpdate = [
            'first_name' => $_POST['first_name'] ?? '',
            'laste_name'  => $_POST['last_name'] ?? '', 
            'emaile'      => $_POST['email'] ?? '',     
            'age'        => $_POST['age'] ?? ''
        ];

        if ($connect->update($tableName, $dataToUpdate, $studentId)) {
            $successMessage = "Updated successfully!"; 
            $studentData = $connect->findById($tableName, $studentId); 
        } else {
            $errorMessage = "Error updating data. Please check server logs for details."; 
        }
    }

    if (empty($studentData)) { 
        $studentData = $connect->findById($tableName, $studentId);
    }

    if (!$studentData) {
        $errorMessage = "Student not found with ID: " . htmlspecialchars($studentId) . " in table '" . htmlspecialchars($tableName) . "'. Please check if this ID exists. Available IDs: 22, 28, 30, 26.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
            display: flex; 
            justify-content: flex-start; 
            align-items: flex-start; 
            min-height: 100vh; 
            padding-top: 50px; 
            padding-left: 50px; 
        }
        .container {
            max-width: 500px; 
            margin: 0; 
            padding: 0; 
            background-color: transparent; 
            box-shadow: none; 
            border-radius: 0; 
        }
        .alert-success-custom { 
            background-color: #d4edda; 
            color: #155724; 
            border-color: #c3e6cb; 
            padding: .75rem 1.25rem; 
            margin-bottom: 1rem; 
            border: 1px solid transparent; 
            border-radius: .25rem; 
            text-align: left; 
            width: 100%; 
            max-width: 500px; 
        }
        .alert-danger-custom { 
            background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;
            padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;
            text-align: left; 
            width: 100%; 
            max-width: 500px; 
        }
        h1, h2 {
            text-align: left; 
            margin-bottom: 20px; 
            font-size: 1.75rem; 
            font-weight: bold; 
            width: 100%; 
            max-width: 500px; 
            margin-top: 0; 
        }
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
            width: 100%; 
            max-width: 500px; 
        }
        .form-group {
            margin-bottom: 1rem; 
            width: 100%; 
            max-width: 500px; 
        }
        .form-group label {
            font-weight: normal; 
            margin-bottom: .25rem; 
            display: block; 
        }
        .form-control {
            height: calc(1.5em + .75rem + 2px); 
            padding: .375rem .75rem; 
            font-size: 1rem; 
            line-height: 1.5;
            border-radius: .25rem;
            width: 100%; 
            max-width: 350px; 
        }
        .btn { 
            display: inline-block; 
            width: auto; 
            padding: .375rem .75rem; 
            font-size: 1rem; 
            line-height: 1.5;
            border-radius: .25rem; 
            color: #fff; 
            background-color: #007bff; 
            border-color: #007bff; 
            margin-top: 1rem; 
        }
        .form-actions { 
            text-align: left; 
            width: 100%;
            max-width: 500px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($studentData): ?>
            <h2>Welcome <?php echo htmlspecialchars($studentData['first_name'] ?? 'Guest'); ?></h2>
            <hr>
            <h1>Edit Student Form</h1>

            <?php if ($successMessage): ?>
                <div class="alert alert-success-custom">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>

            <?php if ($errorMessage): ?>
                <div class="alert alert-danger-custom">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            
            <form action="edit_student.php?id=<?php echo htmlspecialchars($studentId); ?>" method="POST">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                           value="<?php echo htmlspecialchars($studentData['first_name'] ?? ''); ?>"
                           placeholder="Type your first name">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                           value="<?php echo htmlspecialchars($studentData['laste_name'] ?? ''); ?>" 
                           placeholder="Type your last name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php echo htmlspecialchars($studentData['emaile'] ?? ''); ?>" 
                           placeholder="Type your Email">
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" name="age"
                           value="<?php echo htmlspecialchars($studentData['age'] ?? ''); ?>"
                           placeholder="Type your Age">
                </div>

                <div class="form-actions"> 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        <?php else: ?>
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger-custom">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>