<?php
class Connect
{
    const HOST_NAME = "localhost";
    const USER_NAME = "root";
    const PASSWORD = "";
    const DB_NAME = "students";

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(self::HOST_NAME, self::USER_NAME, self::PASSWORD, self::DB_NAME);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insert($data, $tablename): void
    {
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "`$key`";
            $values[] = "'" . $this->conn->real_escape_string($value) . "'";
        }

        $fstr = implode(",", $fields);
        $vstr = implode(",", $values);

        $sql = "INSERT INTO `$tablename` ($fstr) VALUES ($vstr)";
        $res = $this->conn->query($sql);

        if (!$res) {
            echo "Insert error: " . $this->conn->error;
        }
    }

    public function select($table): array
{
    $sql = "SELECT * FROM $table";
    $res = $this->conn->query($sql);

    if (!$res) {
        // طباعة الخطأ لتصحيحه
        echo "SQL Error: " . $this->conn->error;
        return [];
    }

    if ($res->num_rows > 0) {
        $data = $res->fetch_all(MYSQLI_ASSOC);
        return $data;
    } else {
        return [];
    }
}

}
?>
