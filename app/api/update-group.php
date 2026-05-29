<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../models/Group.php';
require_once __DIR__ . '/../models/GroupRule.php';
$data = json_decode(file_get_contents("php://input"), true);

$groupId = $data['group_id'] ?? 0;
$groupName = $data['group_name'] ?? '';
$rules = $data['rules'] ?? [];

if ($groupId == 0 || $groupName == '' || count($rules) == 0) {
    echo json_encode(['status' => false,'message' => 'Invalid update data']);
    exit;
}

$groupModel = new Group();
$groupRuleModel = new GroupRule();

$groupModel->updateGroup($groupId, $groupName);
$groupRuleModel->deleteByGroup($groupId);

$sortOrder = 1;

foreach ($rules as $rule) {
    $groupRuleModel->assignRule([
        'fk_group_id' => $groupId,
        'fk_rule_id' => $rule['rule_id'],
         'parent_rule_id' => $rule['parent_rule_id'] != '' ? $rule['parent_rule_id'] : NULL,
        'tier' => $rule['tier'],
        'sort_order' => $sortOrder
    ]);

    $sortOrder++;
}

echo json_encode([
    'status' => true,
    'message' => 'Group Updated Successfully'
]);