<?php

class CategoryModel extends BaseModel
{
    const TABLE = 'categories';
    
    public function get_all()
    {
        $sql = 'SELECT * FROM ' . self::TABLE;
        $result = $this->query($sql);

        return $result->fetchAll();
    }
}
