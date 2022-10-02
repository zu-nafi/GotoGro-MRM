<?php
class Database {
    private $db;

    function __construct(){
        $dbServername = "localhost";
        $dbUsername = ""; // username
        $dbPassword = ""; // password
        $dbName = ""; // database name
        $this->db = new PDO("mysql:host=$dbServername;dbname=$dbName", $dbUsername, $dbPassword);
    }

    public function isRecordExists($table, $condition){
        return !empty($this->getData(null, $table, null, $condition));
    }

    public function getData ($query, $table = null, $columns = null, $conditions = null, $order = null, $limit = null){
        $sql = "SELECT ";
        if($query){
            $sql = $query;
        }else{
            $sql .= $columns ? implode(', ',$columns) : " * ";
            $sql .= " FROM ".$table;
            if($conditions){
                $sql .= " WHERE ";
                foreach ($conditions as $c){
                    $sql .= $c." AND ";
                }
                $sql = rtrim($sql, " AND");
            }
            if($order){
                $params = explode(',',$order);
                $sql .= " ORDER BY $params[0] $params[1]";
            }
            if($limit){
                $sql .= " LIMIT $limit";
            }
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertData($table, $columns=[], $values=[], $conditions = null){
        $sql = "INSERT INTO ".$table." (";
        foreach ($columns as $c){
            $sql .= $c.", ";
        }
        $sql = rtrim($sql, ", ").") VALUES (";
        foreach ($values as $v){
            $sql .= " ?,";
        }
        $sql = rtrim($sql, ", ").")";
        if($conditions){
            $sql .= " WHERE ";
            foreach ($conditions as $c){
                $sql .= $c." AND ";
            }
            $sql = rtrim($sql, " AND");
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function updateData($table, $columns=[], $values=[], $conditions = null){
        $sql = "UPDATE ".$table." SET ";
        foreach ($columns as $c){
            $sql .= $c." = ?, ";
        }
        $sql = rtrim($sql, ", ");
        if($conditions){
            $sql .= " WHERE ";
            foreach ($conditions as $c){
                $sql .= $c." AND ";
            }
            $sql = rtrim($sql, " AND");
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function deleteData($table, $conditions){
        $sql = "DELETE FROM ".$table." WHERE ";
        foreach ($conditions as $c){
            $sql .= $c." AND ";
        }
        $sql = rtrim($sql, " AND");
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }
}
