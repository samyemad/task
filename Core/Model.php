<?php
namespace Core;

use Core\Interfaces\ConnectionInterface;
use Core\Interfaces\ModelInterface;

//do not return anything if on error // now returning ERROR at blah blah
class Model implements ModelInterface
{
    public function __construct(ConnectionInterface $db)
    {
        $this->connection =  $db->getConnection();
    }
    /*
        ****tablename required !
        $tableName => 'customer'

        ****what to read
         use accorgingly if all read / read particular column
        $args => array('*') / array('id','phone')

        ****optional arg (call with null argument to avoid warnings)
        //for where clause
        $whereArgs => array( 'id' => '1')
    */

    public function read($tableName, $args, $whereArgs, $subCases = null, $mainCases = null)
    {
        $sql='SELECT ';
        foreach ($args as $key => $value) {
            $sql .= $value . ',';
        }
        $sql=rtrim($sql, ',');
        if ($subCases != null) {
            $sql = $this->getSubCases($subCases, $sql);
        }
        if ($mainCases != null) {
            $sql=$this->getMainCases($mainCases, $sql);
        }

        $sql.=' FROM '.$tableName;

        if ($whereArgs) {
            $sql = $this->where($sql, $whereArgs);
        }
        $sql=$this->appendSemicolon($sql);
        $finalResult=array();
        $result = $this->connection->query($sql);
        if ($result) {
            while ($row=mysqli_fetch_assoc($result)) {
                array_push($finalResult, $row);
            }
            return $finalResult;
        } else {
            return 'Error at Read';
        }
    }
    private function getMainCases($mainCases, $sql)
    {
        $result=$mainCases['result'];
        $field=$mainCases['field'];
        $sql .= ", CASE ";
        foreach ($mainCases['value'] as $key => $value) {
            $modifiedValue=ucfirst(strtolower($value));
            $sql .= " WHEN(`$field` LIKE '($key)%') THEN '$modifiedValue'";
        }
        $sql.="END AS $result";
        return $sql;
    }

    private function getSubCases($subCases, $sql)
    {
        $match=$subCases['match'];
        $result=$subCases['result'];
        $length = count($subCases['value']);
        $sql.=" ,CASE WHEN(";
        $x = 1;
        foreach ($subCases['value'] as $key => $value) {
            $sql.="(
            `$subCases[field]` LIKE '($key)%' AND `$subCases[field]` REGEXP '$value'
        )";
            if ($x != $length) {
                $sql.=" OR";
            }
            $x++;
        }
        $sql.="
        ) THEN '$match' ELSE 'no $match'
        END AS $result";

        return $sql;
    }
    public function where($sql, $whereArgs)
    {
        $sql.=' WHERE ';
        foreach ($whereArgs as $whereArg) {
            $sql .= $whereArg['element'] .' '. $whereArg['operator'].' \'' . $whereArg['value']  . $whereArg['argument'].'\' '.$whereArg['union'].' ';
        }
        $sql=rtrim($sql, $whereArg['union'].' ');
        return $sql;
    }
    public function appendSemicolon($sql)
    {
        if (substr($sql, -1)!=';') {
            return $sql.' ;';
        }
    }
}
