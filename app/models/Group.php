<?php

require_once __DIR__ . '/../database/Database.php';

class Group
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createGroup($groupName)
    {
        $stmt = $this->conn->prepare( "INSERT INTO groups (group_name)  VALUES (?)" );
        $stmt->bind_param("s",$groupName);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    // used for get all groups array
    public function getAllGroups()
    {
        $sql = "SELECT group_id,group_name,created_at FROM groups ORDER BY group_id DESC ";
            $result = $this->conn->query($sql);
            $groups = [];
        while ($row = $result->fetch_assoc()) {
            $groups[] = $row;
        }
        return $groups;
    }


    //used for get single group
    public function getGroupById($groupId)
    {
        $stmt = $this->conn->prepare(
            "SELECT
                 group_id,
                   group_name,
                created_at
            FROM groups
            WHERE group_id = ?"
        );

        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    //  used for groyup update
    public function updateGroup($groupId,$groupName)
    {
        $stmt = $this->conn->prepare("UPDATE groups SET group_name = ?    WHERE group_id = ?");
        $stmt->bind_param( "si",$groupName,$groupId);
        return $stmt->execute();
    }
}