<?php

require_once("DB.inc.php");

class Article
{
    private $title;
    private $body;
    private $user;
    private $category;
    private $image;

    private function db_connect()
    {
        $db = new DB();
        return $db->connect();
    }

    public function post($user, $title, $body, $category, $image)
    {
        $this->user = $user;
        $this->title = $title;
        $this->body = $body;
        $this->category = $category;
        $this->image = $image;

        $allawed_extensions = ['png', 'jpg', 'jpeg'];
        $image_path = pathinfo($this->image['name']);

        $image_name = $this->image['name'];
        $image_tmp_name = $this->image['tmp_name'];
        $image_error = $this->image['error'];
        $image_size = $this->image['size'];
        $image_extension = strtolower($image_path['extension']);

        $dir = dirname(__FILE__, 2);
        // die($dir);

        //check if image exist, add number between name
        $counter = 1;
        while (file_exists($image_name)) {
            $image_name = $image_path['filename'] . '_' . $counter . '.' . $image_extension;
            $counter++;
        }

        $img_new_dir = $dir . "/assets/images/" . $image_name;
        echo $img_new_dir;

        if (in_array($image_extension, $allawed_extensions)) {
            if ($image_error === 0) {
                if ($image_size < 2000000) {
                    if (!move_uploaded_file($image_tmp_name, $img_new_dir)) {
                        return "Error Uploading";
                    }
                } else {
                    return "Error: Image larger than 2MB";
                }
            } else {
                return "Upload Error";
            }
        } else {
            return "This file extension not allowed";
        }

        echo "<pre>";
        var_dump($this->title);
        var_dump($this->body);
        var_dump($this->user);
        var_dump($this->category);
        var_dump($this->image);
        die();

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
