<?php
// edit_student.php (الصفحة المطلوبة التي تظهر في صورك)

require_once 'Connect.php'; // تأكدي أن Connect.php موجود في نفس المجلد

// تفعيل عرض الأخطاء: هذا مهم جداً للتشخيص! لكن يجب تعطيله في بيئة الإنتاج.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connect = new Connect();

$studentData = [];
$successMessage = '';
$errorMessage = ''; 
$tableName = "info"; // <<== تم ضبط اسم الجدول ليطابق 'info' كما في phpMyAdmin

// 1. الحصول على ID الطالب من الرابط (URL)
$studentId = $_GET['id'] ?? null; 

// 2. التحقق من أن الـ ID موجود وصالح (رقمي)
if (!$studentId || !is_numeric($studentId)) {
    // بما أنكِ طلبتِ id=1، ولكن ID 1 غير موجود في جدولك، 
    // سأظهر رسالة الخطأ هذه. الـ IDs المتوفرة هي 22, 28, 30, 26.
    $errorMessage = "Invalid or missing Student ID in the URL. Please use a valid ID from your table (e.g., ?id=22, ?id=28, ?id=30, ?id=26).";
    $studentData = null; 
} else {
    // 3. معالجة تحديث البيانات عند إرسال النموذج (POST Request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dataToUpdate = [
            'first_name' => $_POST['first_name'] ?? '',
            'laste_name'  => $_POST['last_name'] ?? '',  // <<== تم التعديل هنا لـ 'laste_name' لمطابقة جدولك
            'emaile'      => $_POST['email'] ?? '',      // <<== تم التعديل هنا لـ 'emaile' لمطابقة جدولك
            'age'        => $_POST['age'] ?? ''
        ];

        if ($connect->update($tableName, $dataToUpdate, $studentId)) {
            $successMessage = "Data Updated Successfully!"; //
            // إعادة جلب البيانات بعد التحديث لتعكس أي تغييرات قام المستخدم بإدخالها
            $studentData = $connect->findById($tableName, $studentId); 
        } else {
            $errorMessage = "Error updating data. Please check server logs for details."; 
        }
    }

    // 4. جلب بيانات الطالب لملء النموذج (سواء كانت أول مرة أو بعد التحديث)
    // هذا الجزء سيتم تنفيذه دائمًا لجلب البيانات الأولية للمرة الأولى عند فتح الصفحة
    // أو لجلب البيانات المحدثة بعد عملية POST
    if (empty($studentData)) { 
        $studentData = $connect->findById($tableName, $studentId);
    }

    // 5. التحقق النهائي من العثور على الطالب بعد محاولة الجلب
    if (!$studentData) {
        $errorMessage = "Student not found with ID: " . htmlspecialchars($studentId) . " in table '" . htmlspecialchars($tableName) . "'. Please check if this ID exists in your table. Available IDs: 22, 28, 30, 26.";
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
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert-success-custom { 
            background-color: #d4edda; /* نفس اللون الأخضر الفاتح في صورتك */
            color: #155724; 
            border-color: #c3e6cb; 
            padding: .75rem 1.25rem; 
            margin-bottom: 1rem; 
            border: 1px solid transparent; 
            border-radius: .25rem; 
        }
        .alert-danger-custom { /* تنسيق لرسائل الخطأ */
            background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;
            padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;
        }
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($successMessage): // عرض رسالة النجاح إذا كانت موجودة ?>
            <div class="alert alert-success-custom">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <?php if ($errorMessage): // عرض رسالة الخطأ إذا كانت موجودة ?>
            <div class="alert alert-danger-custom">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <?php if ($studentData): // عرض النموذج فقط إذا تم العثور على بيانات الطالب ?>
            <h2>Welcome <?php echo htmlspecialchars($studentData['first_name'] ?? 'Guest'); ?></h2>
            <hr>
            <h1>Edit Student Form</h1>

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
                           value="<?php echo htmlspecialchars($studentData['laste_name'] ?? ''); ?>" // <<== تم التعديل هنا لـ 'laste_name'
                           placeholder="Type your last name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php echo htmlspecialchars($studentData['emaile'] ?? ''); ?>" // <<== تم التعديل هنا لـ 'emaile'
                           placeholder="Type your Email">
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" name="age"
                           value="<?php echo htmlspecialchars($studentData['age'] ?? ''); ?>"
                           placeholder="Type your Age">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Submit</button>

            </form>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>