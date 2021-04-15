<?php

require_once("DB.inc.php");

class User
{
    private $first_name;
    private $last_name;
    private $email;
    private $password;

    private function db_connect()
    {
        $db = new DB();
        return $db->connect();
    }

    public function get_user($email)
    {
        $sql = "SELECT * FROM users WHERE email = '" . $email . "'";
        $result = $this->db_connect()->query($sql);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "No user found";
        }
    }

    public function get_all_users()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db_connect()->query($sql);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function create($first_name, $last_name, $email, $password)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO users (first_name, last_name, email, password) 
        VALUES ('$this->first_name', '$this->last_name', '$this->email', '$this->password')";

        $result = $this->db_connect()->query($insert_query);

        if (!$result) {
            return "Error Occured";
        }
    }

    public function get_articles($user)
    {
        $query1 = "SELECT id FROM users WHERE email = '" . $user . "'";
        $result1 = $this->db_connect()->query($query1);
        $rows = $result1->num_rows;
        if ($rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $data[] = $row;
            }
            $user_id = $data[0]['id'];
        }
        $query = "SELECT articles.title, articles.body from articles 
        INNER JOIN users ON articles.user_id = users.id WHERE users.id = '" . $user_id . "'";

        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }
}
