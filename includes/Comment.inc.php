<?php
require_once("DB.inc.php");

class Comment
{
    private $body;
    private $author_name;
    private $author_email;
    private $article_id;

    public function __construct($body, $author_name, $author_email, $article_id)
    {
        $this->body = $body;
        $this->author_name = $author_name;
        $this->author_email = $author_email;
        $this->article_id = $article_id;
    }

    public function db_connect()
    {
        $db = new DB();
        return $db->connect();
    }

    public function create_comment()
    {
        $insert_comment = "INSERT INTO comments (body, author_name, author_email, article_id) 
        VALUES ('{$this->body}', '{$this->author_name}','{$this->author_email}', '$this->article_id')";
        echo $insert_comment;
    }
}
