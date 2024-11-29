<?php
include_once __DIR__ . "/db.php";


function queryInsertPost(array $post)
{
    return "INSERT INTO `post` (`id`,`userId`,`title`,`body`) VALUES ({$post['id']}, {$post['userId']},'{$post['title']}','{$post['body']}')";
}

function querySearch()
{
    return "SELECT post.id as postId, post.title, comment.id as commentId, comment.body  FROM comment 
            INNER JOIN post ON post.id = comment.postId
            WHERE comment.body LIKE ?";
}

function getPostsByCommentsStr(string $search)
{
    $connector = getConnector();
    $query = $connector->prepare(querySearch());
    $query->execute(["%$search%"]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
