<?php
require_once __DIR__ . "/app/lib.php";
include_once __DIR__ . "/app/post.php";
include_once __DIR__ . "/app/comment.php";

$posts = loadData('https://jsonplaceholder.typicode.com/posts');
$comments = loadData('https://jsonplaceholder.typicode.com/comments');

$postsCnt = createMany($posts, 'queryInsertPost');
$commentsCnt = createMany($comments, 'queryInsertComment');

print_r("Загружено $postsCnt записей и $commentsCnt комментариев");
