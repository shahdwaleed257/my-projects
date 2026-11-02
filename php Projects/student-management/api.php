<?php
require_once "connect.php"; // تأكد أن الملف ده في نفس المسار

$db = new Connect();
$request = $_SERVER['REQUEST_METHOD'];
$table = "info";

// Handle GET request
if ($request === "GET") {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $student = $db->findById($table, $id);
        if ($student) {
            echo json_encode(['status' => 'success', 'data' => $student]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Student not found']);
        }
    } else {
        $data = $db->select($table);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }
}

// Handle POST request
elseif ($request === "POST") {
    $data = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'age' => $_POST['age'] ?? 0
    ];
    $db->insert($data, $table);
    echo json_encode(['status' => 'success', 'message' => 'Student added successfully']);
}

// Handle PUT request
elseif ($request === "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);
    if (!isset($_PUT['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing ID']);
        exit;
    }

    $id = intval($_PUT['id']);
    unset($_PUT['id']); // Remove ID from data array

    $updated = $db->update($table, $_PUT, $id);
    if ($updated) {
        echo json_encode(['status' => 'success', 'message' => 'Student updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }
}

// Handle DELETE request
elseif ($request === "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    if (!isset($_DELETE['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing ID']);
        exit;
    }

    $id = intval($_DELETE['id']);
    $deleted = $db->delete($table, $id);
    if ($deleted) {
        echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
    }
}
?>
