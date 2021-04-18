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

    public function upload($title, $body, $user, $category)
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

    public function get_artice($art_title)
    {
        // $query = "SELECT "
    }

    public function get_category_articles($cat)
    {
        $get_cat_id = "SELECT category_id FROM categories WHERE cat_name = '" . $cat . "'";
        $category_result = $this->db_connect()->query($get_cat_id);
        $rows = $category_result->num_rows;
        if ($rows > 0) {
            $category[] = $category_result->fetch_assoc();
            $category_id = $category[0]["category_id"];
            $category_id;

            $articles_query = "SELECT title, body, user_id FROM articles WHERE cat_id = '" . $category_id . "'";
            $articles_result = $this->db_connect()->query($articles_query);
            $articles_rows = $articles_result->num_rows;
            if ($articles_rows > 0) {
                while ($row = $articles_result->fetch_assoc()) {
                    $articles[] = $row;
                }
                return $articles;
            } else {
                return "Category Empty";
            }
        } else {
            return "There is no category with this name";
        }
    }

    public function get_all_articles()
    {
        $query = "SELECT articles.title, articles.body, categories.cat_name FROM articles JOIN categories ON articles.cat_id = categories.category_id";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
            }
            return $articles;
        }
    }
}

// $art = new Article();
// echo $art->get_category_articles("culture-and-Education");
