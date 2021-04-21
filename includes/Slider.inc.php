<?php
require_once("../includes/DB.inc.php");

class Slider
{
    private $image_name;
    private $slide_heaeding;

    public function db_connect()
    {
        $db = new DB();
        return $db->connect();
    }

    public function get_home_slider()
    {
        $query = "SELECT * FROM slider";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $slides[] = $row;
            }
            return $slides;
        }
    }
}
