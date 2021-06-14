<?php
namespace Core\Interfaces;

interface ModelInterface
{
    public function read($tableName, $args, $whereArgs);

    public function where($sql, $whereArgs);

    public function appendSemicolon($sql);
}
