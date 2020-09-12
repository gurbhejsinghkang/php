<?php

class db_pdo
{
    public $db_host = 'localhost';
    public $db_user_name = 'electric_scooter';
    public $db_name = 'electric_scooter';
    public $db_user_pw = 'Kang@123456789';
    public $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name, $this->db_user_name, $this->db_user_pw);
        } catch (PDOException $e) {
            echo 'Error!: '.$e->getMessage().'<br/>';
            die();
        }
        // echo 'connected';
    }

    public function query($sql_str)
    {
        try {
            $result = $this->connection->query($sql_str);
        } catch (PDOException $e) {
            echo 'Error!: '.$e->getMessage().'<br/>';
            die();
        }

        return $result;
    }

    //query select for converted in php array
    public function querySelect($sql_str)
    {
        $records = $this->query($sql_str)->fetchAll();
        // print_r($records);

        return $records;
    }

    public function disconnect()
    {
        $this->connection = null;
    }

    public function queryParam($sql_str, $params)
    {
        $stmt = $this->connection->prepare($sql_str);
        $stmt->execute($params);

        return true;
    }

    public function querySelectParam($sql_str, $params)
    {
        $stmt = $this->connection->prepare($sql_str);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function table($table_name)
    {
        return $this->querySelect('SELECT * FROM '.$table_name);
    }
}
// $db = new db_pdo();
// $db->querySelect('select * from products')->fetchAll();
