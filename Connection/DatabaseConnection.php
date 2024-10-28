<?php

namespace Project\Connection;

if($_SERVER['HTTP_HOST'] == 'localhost'){
    define('DB_HOST','localhost');
    define('DB_USER','mateus');
    define('DB_PASSWORD','3003');
    define('DB_DATABASE','scandiweb_test');
} else {
    define('DB_HOST','localhost');
    define('DB_USER','scandiweb_test');
    define('DB_PASSWORD','teste@123');
    define('DB_DATABASE','scandiweb_test');
}

class DatabaseConnection
{
    private $conn;

    public function __construct()
    {
        $conn = new \mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);

        if($conn->connect_error)
        {
            die ("<h1>Database Connection Failed</h1>");
        }
        //echo "Database Connected Successfully";
        return $this->conn = $conn;
    }

    public function insert(string $table, $data): int
    {
        $columns = '';
        $values = '';
    
        foreach ($data as $key => $value) {
            $columns .= "$key, ";
            $values .= "'$value', ";
        }

        $query = "INSERT INTO $table (" . rtrim($columns, ", ") . ") values (" . rtrim($values, ", ") . ");";
        try{
            mysqli_query($this->conn, $query);
            return $this->conn->insert_id;
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }

    public function update(string $table, $data)
    {

    }

    public function select(string $sql)
    {
        $result = mysqli_query($this->conn, $sql);
        $rows = [];
        while($row=mysqli_fetch_assoc($result)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function delete(string $table, string $column = null, string $value = null)
    {        
        try{
            $where = $column != null && $value != null ? "where $column = '$value'" : '';
            mysqli_query($this->conn, "delete from $table $where");
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }

    public function query(string $query)
    {
        try{
            $result = mysqli_query($this->conn, $query);
            return $result;
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }
}

?>