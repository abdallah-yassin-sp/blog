<?php

require_once("DB.inc.php");

class Article
{
    private $title;
    private $body;
    private $user;
    private $category;

    private function db_connect()
    {
        $db = new DB();
        return $db->connect();
    }

    public function create($title, $body, $user, $category)
    {
        $this->title = $title;
        $this->body = $body;
        $this->user = $user;
        $this->category = $category;

        $sql = "INSERT INTO articles (title, body, category, user_id)
        VALUES ('$this->title', '$this->body', '$this->category', '$this->user')";

        $new_article = $this->db_connect()->query($sql);
        if (!$new_article) {
            return "Error Occured";
        }
    }

    public function get_category_articles($category)
    {
        // $query = "SELECT articles.title, articles.body, articles.user_id FROM articles INNER JOIN categories ON articles."
    }
}
