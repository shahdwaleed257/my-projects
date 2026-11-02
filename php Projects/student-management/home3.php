<?php
// home3.php (الكود المعدّل لصفحة الهوم)

// تأكدي أن اسم ملف الاتصال هو 'connect3.php' وتم تغيير اسمه بالفعل في المجلد
require_once "connect3.php"; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connect = new Connect(); // إنشاء كائن الاتصال مرة واحدة

$tableName = "info"; // اسم الجدول الصحيح في قاعدة البيانات

// 1. معالجة طلبات الإدخال
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['first_name'])) {
    // التأكد من أن حقول الإدخال موجودة لتجنب الأخطاء
    $dataToInsert = [
        'first_name' => $_POST['first_name'] ?? '',
        'laste_name'  => $_POST['last_name'] ?? '', 
        'emaile'      => $_POST['email'] ?? '',     
        'age'        => $_POST['age'] ?? ''
    ];
    $connect->insert($dataToInsert, $tableName); // استخدام $tableName الصحيح
    // إعادة التوجيه لمنع إعادة إرسال النموذج عند تحديث الصفحة
    header("Location: home3.php");
    exit();
}

// 2. معالجة طلبات الحذف
if (isset($_POST['delete_id'])) {
    $id_to_delete = $_POST['delete_id'];
    if ($connect->delete($tableName, $id_to_delete)) { // استخدام $tableName الصحيح
        // إعادة تحميل الصفحة لعرض البيانات المحدثة بعد الحذف
        header("Location: home3.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting student.</div>";
    }
}

// جلب البيانات لعرضها في الجدول
$data = $connect->select($tableName);
?>

<?php include 'navpar.php'; ?>


<div class="container mt-5">
    <form method="POST">
        <h3 class="mb-4">Student_Info</h3>
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

    <h3 class="mt-5">Students_Data</h3>
    <table class="table table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Delete</th>
                <th>Edit</th> </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) { // التأكد أن هناك بيانات لعرضها
                foreach ($data as $key => $row) {?>
                    <tr>
                        <th scope="row"><?php echo $key + 1 ?></th>
                        <td><?= htmlspecialchars($row['first_name']) ?></td>
                        <td><?= htmlspecialchars($row['laste_name']) ?></td>
                        <td><?= htmlspecialchars($row['emaile']) ?></td>
                        <td><?= htmlspecialchars($row['age']) ?></td>
                        <td>
                            <form method="POST" action="home3.php" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                        <td> 
                            <a href="edit_student.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-info">Edit</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="7" class="text-center">No student data available.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'footers.php'; ?>