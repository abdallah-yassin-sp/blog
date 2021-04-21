<?php
require_once("DB.inc.php");

class Category
{
    private $name;

    public function db_connect()
    {
        $db = new DB();
        return $db->connect();
    }

    public function get_all_categories()
    {
        $query = "SELECT * FROM categories";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
