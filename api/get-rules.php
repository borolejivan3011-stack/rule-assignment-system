<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../app/models/Rule.php';
$model = new Rule();
echo json_encode($model->getRules());