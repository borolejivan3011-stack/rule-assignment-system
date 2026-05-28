<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../app/models/GroupRule.php';
$groupId = isset($_GET['group_id']) ?$_GET['group_id']: 0;
$model = new GroupRule();
echo json_encode($model->getRulesByGroup($groupId));