<?php
require_once "Conect.php";

$connect = new connect(); // ← إنشاء كائن الاتصال مرة واحدة
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['first_name'])) {
    // إدخال البيانات
    $connect->insert($_POST, "students_info");
}
?>

<div class="container mt-5">
    <form method="POST">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php
    // عرض البيانات
    $data = $connect->select("info");
    ?>

    <h3 class="mt-5"> students data</h3>
    <table class="table table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php

    foreach ($data as $key => $row) {?>
 
        <tr>
            <th scope="row"><?php echo $key+1?></th>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['laste_name']) ?></td>
            <td><?= htmlspecialchars($row['emaile']) ?></td>
            <td><?= htmlspecialchars($row['age']) ?></td>
            <td>
                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            
            </td>
           <td> <a herf="#" class="btn btn-sm btn-info">Edit</a></td>
        </tr>
<?php }?>


        </tbody>
    </table>
    <?php
    if (isset($_POST['id'])) {
    $connect = new Connect();
    $id = $_POST['id'];
    $connect->delete('students_info', $id);
}
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
