<?php
include_once dirname(__DIR__, 1) . "/post.php";

$params = $_GET;

if (empty($params['search']) || mb_strlen($params['search'], "UTF-8") < 3) {
    echo json_encode(['message' => "Ошибка при отправке данных", "status" => false]);
    die();
}

try {
    $posts = getPostsByCommentsStr($params['search']);
    echo json_encode(['message' => "Данные успешно получены", "status" => true, 'data' => $posts]);
} catch (Exception $e) {
    echo json_encode(['message' => "Ошибка, попробуйте позднее", "status" => false]);
}
