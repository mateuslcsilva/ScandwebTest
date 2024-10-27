<?php

namespace Project\Connection;

define('DB_HOST','localhost');
define('DB_USER','mateus');
define('DB_PASSWORD','3003');
define('DB_DATABASE','scandiweb_test');

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

    public function insert(string $table, $data)
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
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }
}

?>