<?php

require_once("DB.inc.php");

class Article
{
    private $title;
    private $body;
    private $user;
    private $category;
    private $image;
    private $db;

    public function db_connect()
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
        if (!empty($image))
            $this->image = $image;
        else
            $this->image = "placeholder.jpg";

        $allawed_extensions = ['png', 'jpg', 'jpeg'];
        $image_path = pathinfo($this->image['name']);

        $image_name = $this->image['name'];
        $image_tmp_name = $this->image['tmp_name'];
        $image_error = $this->image['error'];
        $image_size = $this->image['size'];
        $image_extension = strtolower($image_path['extension']);

        $dir = dirname(__FILE__, 2);

        //check if image exist, add number between name
        $counter = 1;
        while (file_exists($dir . "/assets/images/" . $image_name)) {
            $image_name = $image_path['filename'] . '_' . $counter . '.' . $image_extension;
            $counter++;
        }

        $img_new_dir = $dir . "/assets/images/" . $image_name;

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

        $sql = "INSERT INTO articles (title, body, user_id, cat_id, image) 
        VALUES ('$this->title', '$this->body', '$this->user','$this->category', '$image_name')";

        $new_article = $this->db_connect()->query($sql);
        if (!$new_article) {
            return "Error Occured";
        }
    }

    public function get_article($article_id)
    {
        $query = "SELECT * FROM articles WHERE article_id = '{$article_id}'";
        $result = $this->db->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $article[] = $row;
            }
            return $article[0];
        }
    }

    public function get_category_articles($category_name)
    {
        $get_cat_id = "SELECT * FROM articles JOIN categories ON articles.cat_id = categories.category_id 
        WHERE cat_name = '{$category_name}' ORDER BY article_id LIMIT 8";

        $category_result = $this->db_connect()->query($get_cat_id);
        $rows = $category_result->num_rows;
        if ($rows > 0) {
            while ($row = $category_result->fetch_assoc()) {
                $category_articles[] = $row;
            }
            return $category_articles;
        } else {
            return "empty category";
        }
    }

    public function get_related_articles($category)
    {
        $query = "SELECT * FROM articles WHERE cat_id = '{$category}' ORDER BY RAND() LIMIT 4";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $related_articles[] = $row;
            }
            return $related_articles;
        }
    }

    public function get_popular_articles()
    {
        $query = "SELECT * FROM articles ORDER BY views DESC LIMIT 3";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $popular_articles[] = $row;
            }
            return $popular_articles;
        }
    }

    public function get_category_popular_articles($category)
    {
        $query = "SELECT * FROM articles JOIN categories ON articles.cat_id = categories.category_id 
        WHERE categories.cat_name = '{$category}' ORDER BY views DESC LIMIT 3";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $popular_articles[] = $row;
            }
            return $popular_articles;
        }
    }

    public function get_user_articles($user_id)
    {
        $query = "SELECT * FROM articles WHERE user_id = '{$user_id}'";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $user_articles[] = $row;
            }
            return $user_articles;
        }
    }

    public function get_all_articles()
    {
        $query = "SELECT articles.article_id, articles.title, articles.body, articles.image, categories.cat_name 
        FROM articles JOIN categories ON articles.cat_id = categories.category_id ORDER BY created_at LIMIT 3";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
            }
            return $articles;
        }
    }

    public function count_category_articles($category_id)
    {
        $query = "SELECT count(*) FROM articles WHERE cat_id = '{$category_id}'";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data[0]["count(*)"];
        }
    }

    public function home_load_more($last_id)
    {
        $query = "SELECT articles.article_id, articles.title, articles.body, articles.image, categories.cat_name 
        FROM articles JOIN categories ON articles.cat_id = categories.category_id WHERE articles.article_id > '{$last_id}' ORDER BY article_id ASC LIMIT 3";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
            }
            return $articles;
        }
    }

    public function category_load_more($last_id, $category)
    {
        $query = "SELECT articles.article_id, articles.title, articles.body, articles.image, categories.cat_name 
        FROM articles JOIN categories ON articles.cat_id = categories.category_id
        WHERE articles.article_id > '{$last_id}' 
        AND categories.cat_name = '{$category}'
        ORDER BY article_id ASC LIMIT 8";

        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
            }
            return $articles;
        }
    }

    // Add one view to the existing views of an article
    public function add_view($article_id)
    {
        $query = "SELECT views FROM articles WHERE article_id = '{$article_id}'";
        $result = $this->db_connect()->query($query);
        $rows = $result->num_rows;
        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $views[] = $row;
            }
            $views = $views[0]['views'];
        }
        $views += 1;
        $update_query = "UPDATE articles SET views = '{$views}' WHERE article_id = '{$article_id}'";
        $this->db_connect()->query($update_query);
    }
}
