<?php

class BaseModel extends Database
{

    protected $connect;

    public function __construct()
    {
        $this->connect = Database::connect(); //left: basemodel's, right: database's
    }

    public function query($sql)
    {
        try {
            return $this->connect->query($sql);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function prepare_query($sql)
    {
        try {
            return $this->connect->prepare($sql);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
