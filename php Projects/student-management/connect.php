<?php
class Connect
{
    const HOST_NAME = "localhost";
    const USER_NAME = "root";
    const PASSWORD = "";
    const DB_NAME = "students"; // <<== هذا هو اسم قاعدة البيانات لديكِ (students)

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(self::HOST_NAME, self::USER_NAME, self::PASSWORD, self::DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed to database: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }

    public function insert($data, $tablename): void
    {
        $fields = []; $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "`" . $this->conn->real_escape_string($key) . "`";
            $values[] = "'" . $this->conn->real_escape_string($value) . "'";
        }
        $fstr = implode(",", $fields);
        $vstr = implode(",", $values);
        $sql = "INSERT INTO `" . $this->conn->real_escape_string($tablename) . "` ($fstr) VALUES ($vstr)";
        $res = $this->conn->query($sql);
        if (!$res) {
            error_log("Insert error: " . $this->conn->error);
        }
    }

    public function select($table): array
    {
        $sql = "SELECT * FROM `" . $this->conn->real_escape_string($table) . "`";
        $res = $this->conn->query($sql);
        if (!$res) {
            error_log("SQL Error in select: " . $this->conn->error);
            return [];
        }
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            return [];
        }
    }

    public function findById($table, $id): ?array
    {
        if (!is_numeric($id)) {
            error_log("Invalid ID provided to findById: " . $id);
            return null;
        }
        $sql = "SELECT * FROM `" . $this->conn->real_escape_string($table) . "` WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare Error in findById: " . $this->conn->error);
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function update($table, $data, $id): bool
    {
        $setParts = []; $params = []; $types = "";
        foreach ($data as $key => $value) {
            $setParts[] = "`" . $this->conn->real_escape_string($key) . "` = ?";
            $params[] = $value;
            if (is_int($value)) { $types .= "i"; } elseif (is_float($value)) { $types .= "d"; } else { $types .= "s"; }
        }
        $sql = "UPDATE `" . $this->conn->real_escape_string($table) . "` SET " . implode(", ", $setParts) . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare Error in update: " . $this->conn->error);
            return false;
        }
        $params[] = $id;
        $types .= "i";
        $bind_names[] = $types;
        for ($i = 0; $i < count($params); $i++) {
            $bind_name = 'bind' . $i; $$bind_name = &$params[$i];
            $bind_names[] = &$$bind_name;
        }
        call_user_func_array([$stmt, 'bind_param'], $bind_names);
        $res = $stmt->execute();
        if (!$res) {
            error_log("Update Error: " . $stmt->error);
            return false;
        }
        return true;
    }

    public function delete($tableName, $id): bool
    {
        $sql = "DELETE FROM `" . $this->conn->real_escape_string($tableName) . "` WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare Error in delete: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        if (!$res) {
            error_log("Delete Error: " . $stmt->error);
            return false;
        }
        return true;
    }
}
?>