<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../models/Group.php';
$model = new Group();
echo json_encode($model->getAllGroups());