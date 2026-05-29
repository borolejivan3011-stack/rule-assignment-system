<?php

require_once __DIR__ . '/../database/Database.php';

class Rule
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getRules()
    {
        $sql = "SELECT * FROM rules ORDER BY rule_id ASC";
        $result = $this->conn->query($sql);
        $rules = [];
        while ($row = $result->fetch_assoc()) {
            $rules[] = $row;
        }
        return $rules;
    }
}