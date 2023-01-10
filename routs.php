<?php
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($url, '/'));

$page = $parts[0];

$pages = [
    '' => 'index.php',
    'upload' => ($_POST['phone_number'])?'upload.php':'404.php',
    'delete' => ($_POST['phone_id_del'])?'delete.php':'404.php',
    'search' => ($_POST['search'])?'search.php':'404.php',
    'info' => ($_POST['phone_number_search'])?'info.php':'404.php'
];

$page = ($pages[$page])?:'404.php';

require_once __DIR__ . '/pages/' . $page;