<?php

$page = $_GET['page'] ?? 'create';

switch ($page)
{
    case 'create':
        include 'app/views/create.php';
        break;

    case 'groups':
        include 'app/views/groups.php';
        break;

    case 'edit':
        include 'app/views/edit-group.php';
        break;

    case '404':
        http_response_code(404);
        include 'app/views/404.php';
        break;

    default:
        http_response_code(404);
        include 'app/views/404.php';
        break;
}