<?php
require_once("DB.inc.php");

class Comment
{
    private $body;
    private $author_name;
    private $author_email;
    private $article_id;

    public function db_connect()
    {
        $db = new DB();
        return $db->connect();
    }

    public function add_comment($body, $author_name, $author_email, $article_id)
    {
        $this->body = $body;
        $this->author_name = $author_name;
        $this->author_email = $author_email;
        $this->article_id = $article_id;

        $insert_comment = "INSERT INTO comments (body, author_name, author_email, article_id) 
        VALUES ('{$this->body}', '{$this->author_name}','{$this->author_email}', '$this->article_id')";

        $result = $this->db_connect()->query($insert_comment);
    }

    public function get_comments($article_id)
    {
        $query = "SELECT body, author_name FROM comments WHERE article_id = '{$article_id}'";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row;
            }
            return $comments;
        }
    }
}
