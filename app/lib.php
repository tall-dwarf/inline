<?php

function loadData(string $url): array
{
    return json_decode(file_get_contents($url), true);
}

function createMany(array $data, string $generateQuery): int
{
    try {
        $connector = getConnector();
        $connector->beginTransaction();
        $cnt = 0;

        foreach ($data as $item) {
            $connector->exec($generateQuery($item));
            $cnt++;
        }

        $connector->commit();
        return $cnt;
    } catch (PDOException $e) {
        $connector->rollback();
        die("Error: " . $e->getMessage());
    }
}
