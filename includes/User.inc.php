<?php

include_once("DB.inc.php");

class User
{
    private $first_name;
    private $last_name;
    private $email;
    private $password;

    public function db_connect()
    {
        $db = new DB();
        $db->connect();
    }

    public function create_user($first_name, $last_name, $email, $password)
    {
        $this->db_connect();

        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }
}
