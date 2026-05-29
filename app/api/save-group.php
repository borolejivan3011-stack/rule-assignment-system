<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../controllers/GroupController.php';
$data = json_decode(file_get_contents("php://input"), true);

if(empty($data['group_name']) || empty($data['rules']))
{
    echo json_encode([ 'status' => false, 'message' => 'Invalid data' ]);
    exit;
}

$controller = new GroupController();
$result = $controller->saveGroup($data);
if($result)
{
    echo json_encode([ 'status' => true,'message' => 'Group Saved Successfully'  ]);
}
else
{
    echo json_encode([ 'status' => false,'message' => 'Invalid rule assignment' ]);
}