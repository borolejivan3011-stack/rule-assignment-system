<?php

require_once __DIR__ . '/../core/Database.php';

class GroupRule
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function assignRule($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO group_rules (fk_group_id, fk_rule_id, parent_rule_id, tier, sort_order)
        VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "iiiii",
            $data['fk_group_id'],
            $data['fk_rule_id'],
            $data['parent_rule_id'],
            $data['tier'],
            $data['sort_order']
        );
        return $stmt->execute();
    }

    public function getRulesByGroup($groupId)
    {
        $stmt = $this->conn->prepare(
            "SELECT 
                gr.group_rule_id, gr.fk_group_id,
                gr.fk_rule_id,
                gr.parent_rule_id, gr.tier,
                gr.sort_order, r.rule_name,r.rule_type
            FROM group_rules gr
            INNER JOIN rules r ON r.rule_id = gr.fk_rule_id
            WHERE gr.fk_group_id = ?
            ORDER BY gr.sort_order ASC"
        );

        $stmt->bind_param("i", $groupId);
        $stmt->execute();

        $result = $stmt->get_result();

        $rules = [];

        while ($row = $result->fetch_assoc()) {
            $rules[] = $row;
        }

        return $rules;
    }

    public function deleteByGroup($groupId)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM group_rules WHERE fk_group_id = ?"
        );

        $stmt->bind_param("i", $groupId);

        return $stmt->execute();
    }
}