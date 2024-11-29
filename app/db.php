<?php

// По хорошему лучше хранить данные подключения в .env файле. Сделано для упрощения
function getConnector(): PDO
{
    static $connector = new PDO('mysql:dbname=inline;host=localhost', 'root', 'root');
    return $connector;
}

function query(string $query, $params = []): \PDOStatement|false
{
    $sth = getConnector()->prepare($query);
    foreach ($params as $key => $param) {
        $sth->bindParam($key, $param);
    }
    $sth->execute();
    return $sth;
}
