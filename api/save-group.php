<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../app/models/Group.php';
require_once __DIR__ . '/../app/models/GroupRule.php';
$data = json_decode(file_get_contents("php://input"), true);

$groupName = $data['group_name'] ?? '';
$rules = $data['rules'] ?? [];

if ($groupName == '' || count($rules) == 0) {
    echo json_encode(['status' => false,'message' => 'Invalid data'
    ]);
    exit;
}

$groupModel = new Group();
$groupRuleModel = new GroupRule();

$groupId = $groupModel->createGroup($groupName);
$sortOrder = 1;

foreach ($rules as $rule) {
    $groupRuleModel->assignRule([
        'fk_group_id' => $groupId, 
        'fk_rule_id' => $rule['rule_id'],
        'parent_rule_id' => $rule['parent_rule_id'] != '' ? $rule['parent_rule_id'] : NULL,
        'tier' => $rule['tier'],'sort_order' => $sortOrder
    ]);

    $sortOrder++;
}

echo json_encode(['status' => true,  
'message' => 'Group Saved Successfully']);