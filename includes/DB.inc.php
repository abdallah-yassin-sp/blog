<?php

class DB
{
    private $server_name;
    private $username;
    private $password;
    private $db_name;

    public function connect()
    {
        $this->server_name = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->db_name = "blog";

        $con = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);
        if (!$con) {
            echo "Connection Error";
        }
    }
}
