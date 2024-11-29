<?php 

include_once __DIR__ . "/db.php";

function queryInsertComment(array $comment) {
    return "INSERT INTO `comment`(`id`, `postId`, `name`, `email`, `body`) VALUES ({$comment['id']},{$comment['postId']},'{$comment['name']}','{$comment['email']}','{$comment['body']}')";
}

