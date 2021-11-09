<?php

class CategoryModel extends BaseModel
{
    const TABLE = 'categories';
    
    public function getAll()
    {
        $sql = 'SELECT * FROM ' . self::TABLE;
        $result = $this->query($sql);

        return $result->fetchAll();
    }
}