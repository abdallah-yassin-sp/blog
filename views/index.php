<?php
require_once("header.php");
require_once("../includes/Article.inc.php");
require_once("../includes/Category.inc.php");
require_once("../includes/User.inc.php");
require_once("../includes/Slider.inc.php");

$slider = new Slider();
$slider = $slider->get_home_slider();

$new_article = new Article();
$home_articles = $new_article->get_all_articles();
$home_popular_articles = $new_article->get_popular_articles();

$category = new Category();
$categories = $category->get_all_categories();

$page = $_GET['page'];

if ($page == "") {
?>
    <div class="page">
        <div class="row">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    $i = 0;
                    foreach ($slider as $slide) {
                        $actives = "";
                        if ($i == 0) {
                            $actives = "active";
                        }
                    ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?= $actives ?>"></li>
                    <?php
                        $i++;
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($slider as $slide) {
                        $actives = "";
                        if ($i == 0) {
                            $actives = "active";
                        }
                    ?>
                        <div class="carousel-item <?= $actives ?>">
                            <img class="d-block w-100 slider-image" src="../assets/images/<?= $slide['image_name'] ?>" alt="First slide">
                            <div class="heading-wrapper">
                                <h2><?= $slide['slide_heaeding'] ?></h2>
                            </div>
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="container home-section-2">
                <div class="home-left-column">
                    <?php
                    $last_id;
                    foreach ($home_articles as $article) {
                    ?>
                        <div class="article">
                            <a href="index.php?page=article&article=<?= $article['article_id'] ?>">
                                <img src="../assets/images/<?= $article['image'] ?>" alt="ARTICLE IMAGE">
                                <h4><?= $article['cat_name'] ?></h4>
                                <h2><?= $article['title'] ?></h2>
                                <p><?= substr($article['body'], 0, 200) . "..." ?></p>
                                <span class="read-more">READ MORE</span>
                            </a>
                        </div>
                    <?php
                        $last_id = $article['article_id'];
                    }

                    ?>
                    <div class="row load-more-container">
                        <button id="load_more_btn" class="btn btn-outline-success" data-id="<?= $last_id ?>">LOAD MORE</button>
                    </div>
                </div>
                <div class="home-right-column">
                    <div class="categories">
                        <h3>Sections</h3>
                        <?php
                        foreach ($categories as $category) {
                        ?>
                            <div class="category">
                                <a href="index.php?page=category&category=<?= $category['cat_name'] ?>"><?= $category['cat_name'] ?></a>
                                <span>(<?php echo $new_article->count_category_articles($category['category_id']) ?>)</span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="popular-articles-container">
                        <h3>Popular Articles</h3>
                        <?php
                        foreach ($home_popular_articles as $popular_art) {
                        ?>
                            <div class="popular-article">
                                <a href="index.php?page=article&article=<?= $popular_art['article_id'] ?>">
                                    <img src="../assets/images/<?= $popular_art['image'] ?>" alt="popular" width="250">
                                    <h4><?= $popular_art['title'] ?></h4>
                                    <h6><?= $popular_art['views'] ?><span> Views</span></h6>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else if ($page == "category") {
    $category_name = $_GET['category'];
    $cat = new Article();
    $category_articles = $cat->get_category_articles($category_name);
    $category_popular_articles = $cat->get_category_popular_articles($category_name);

    $category = new Category();
    $categories = $category->get_all_categories();

    if ($category_articles == "empty category") {
        header("location: index.php?page=404");
    } else {
    ?>
        <div class="row">
            <div class="container category-title">
                <h1><?= $_GET['category'] ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="container category_page">
                <div class="left-column">
                    <?php
                    $last_id;
                    foreach ($category_articles as $article) {
                    ?>
                        <div class="category_article">
                            <a href="index.php?page=article&article=<?= $article['article_id'] ?>">
                                <img src="../assets/images/<?= $article['image'] ?>" alt="image">
                                <h4><?= $article['title'] ?></h4>
                                <p><?= substr($article['body'], 0, 75) . "..." ?></p>
                            </a>

                        </div>
                    <?php
                        $last_id = $article['article_id'];
                    }
                    ?>
                    <div class="row load-more-container">
                        <button id="category_load_more_btn" class="btn btn-outline-success" data-id="<?= $last_id ?>" data-category="<?= $_GET['category'] ?>">LOAD MORE</button>
                    </div>
                </div>
                <div class="right-column">
                    <div class="categories">
                        <h3>Sections</h3>
                        <?php
                        foreach ($categories as $category) {
                        ?>
                            <div class="category">
                                <a href="index.php?page=category&category=<?= $category["cat_name"] ?>"><?= $category['cat_name'] ?></a>
                                <span>(<?php echo $cat->count_category_articles($category['category_id']) ?>)</span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="home-popular-articles">
                        <div class="popular-articles-container">
                            <h3>Popular Articles</h3>
                            <?php
                            foreach ($category_popular_articles as $popular_art) {
                            ?>
                                <div class="popular-article">
                                    <a href="index.php?page=article&id=<?= $popular_art['article_id'] ?>">
                                        <img src="../assets/images/<?= $popular_art['image'] ?>" alt="popular" width="250">
                                        <h4><?= $popular_art['title'] ?></h4>
                                        <h6><?= $popular_art['views'] ?><span> Views</span></h6>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
} else if ($page == "article") {
    $article_id = $_GET['article'];

    $new_article = new Article();
    echo $category;
    echo $image;
    $new_article->add_view($article_id);
    $article = $new_article->get_article($article_id);
    $category = $article['cat_id'];
    $related_articles = $new_article->get_related_articles($category);
    ?>

    <div class="article-page">
        <div class="row article-image">
            <img src="../assets/images/<?= $article['image'] ?>" alt="ARTICLE IMAGE">
        </div>
        <div class="row">
            <div class="container">
                <div class="article-contents">
                    <h1><?= $article['title'] ?></h1>
                    <?php
                    echo $category;
                    echo $image;
                    ?>
                    <input type="submit" value="ADD COMMENT" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container related-section">
                <h2>RELATED ARTICLES</h2>
                <div class="related-articles-container">
                    <?php
                    foreach ($related_articles as $article) {
                    ?>
                        <div class="related-article">
                            <a href="index.php?page=article&article=<?= $article['article_id'] ?>">
                                <img src="../assets/images/<?= $article['image'] ?>" alt="RELATED ARTICLE IMAGE">
                                <h4><?= $article['title'] ?></h4>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
} else if ($page == "user") {
    //post new article
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $user = $_SESSION['user'][0]["id"];
        $title = $_POST['article_title'];
        $body = $_POST['article_body'];
        $category = $_POST['category'];
        if (isset($_FILES['article_image'])) {
            $image = $_FILES['article_image'];
        } else {
            $image = "";
        }

        var_dump($_POST);
        var_dump($user);
        var_dump($title);
        var_dump($body);
        var_dump($category);
        var_dump($image);
        die();

        $article = new Article();
        $article->post($user, $title, $body, $category, $image);

        $_POST = [];
    }

    $user_id = $_GET['user'];
    $user = new User();
    $user = $user->get_user_articles($user_id);
    if (!$user) {
    ?>
        <div class="row">
            <div class="container">
                <h1>You don't have an articles yet, Start adding new articles: </h1>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="row">
            <div class="container">
                <?php
                echo "<pre>";
                print_r($user);
                ?>
            </div>
        </div>

    <?php
    }
    ?>
    <div class="row">
        <div class="container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#new_article">
                NEW ARTICLE
            </button>

            <!-- Modal -->
            <div class="modal fade" id="new_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">New Article</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="new-article-input">
                                    <label for="title">Title</label>
                                    <input type="text" name="article_title" required>
                                </div>
                                <div class="new-article-input">
                                    <label for="body">Text</label>
                                    <textarea type="text" name="article_body" rows="10" cols="50" required></textarea>
                                </div>
                                <div class="new-article-input">
                                    <label for="category">Category</label>
                                    <select name="category" required>
                                        <option value="7" selected>Architecture</option>
                                        <option value="8">Art & Illustration</option>
                                        <option value="9">Business & Corporate</option>
                                        <option value="10">Culture & Education</option>
                                        <option value="11">E-commerce</option>
                                        <option value="12">Design Agencies</option>
                                    </select>
                                </div>
                                <div class="new-article-input">
                                    <label for="image">Image</label>
                                    <input type="file" name="article_image">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="submit" value="POST" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

} else if ($page == "signin") {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $find_user = $user->get_user($email);

        if ($find_user == "No user found") {
    ?>
            <div class="container">
                <?php die($find_user) ?>
            </div>
    <?php
        } else {
            foreach ($find_user as $user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $find_user;
                    header("location: index.php");
                }
            }
        }
    }
    ?>
    <div class="sign-in-page row">
        <div class="container">
            <div class="left-column col-lg-6">
                <form action="" method="POST">
                    <div class="form-item">
                        <label for="email">Email: </label>
                        <input type="email" name="email">
                    </div>
                    <div class="form-item">
                        <label for="password">Password: </label>
                        <input type="password" name="password">
                    </div>
                    <div class="form-item sign-in">
                        <input type="submit" value="SIGN IN">
                    </div>
                </form>
            </div>
            <div class="right-column col-lg-6">
                <h2>SIGN IN</h2>
                <p>Don't have account, <a href="index.php?page=signup">SIGN UP</a></p>
            </div>
        </div>
    </div>
<?php
} else if ($page == "signup") {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (empty($_POST["first_name"])) {
            $first_name_err = "First Name is required";
        } else {
            $first_name_err = test_input($_POST["first_name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
                $first_name_err = "Only letters and white space allowed";
            } else {
                $first_name_err = "";
            }
        }

        if (empty($_POST["last_name"])) {
            $last_name_err = "Last Name is required";
        } else {
            $last_name_err = test_input($_POST["last_name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
                $last_name_err = "Only letters and white space allowed";
            } else {
                $last_name_err = "";
            }
        }

        if (empty($_POST["email"])) {
            $email_err = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format";
            } else {
                $email_err = "";
            }
        }

        if (empty($_POST["password"])) {
            $password_err = "password is required";
        } else {
            $password = $_POST["password"];
            $password_err = "";
        }

        $user = new User();
        $users = $user->get_all_users();
        foreach ($users as $user) {
            if ($user['email'] == $email) {
                die("Email exists, try another email");
            }
        }

        $new_user = new User();
        $new_user->create($first_name, $last_name, $email, $password);
        header("location: index.php?page=signin");
    }

?>
    <div class="sign-up-page row">
        <div class="container">
            <div class="left-column col-lg-6">
                <form action="" method="POST">
                    <div class="form-item">
                        <label for="frist-name">First Name: </label>
                        <input type="text" name="first_name">
                        <span><?= $first_name_err ?></span>
                    </div>
                    <div class="form-item">
                        <label for="last-name">Last Name: </label>
                        <input type="text" name="last_name">
                        <span><?= $last_name_err ?></span>
                    </div>
                    <div class="form-item">
                        <label for="email">Email: </label>
                        <input type="email" name="email">
                        <span><?= $email_err ?></span>
                    </div>
                    <div class="form-item">
                        <label for="password">Password: </label>
                        <input type="password" name="password">
                        <span><?= $password_err ?></span>
                    </div>
                    <div class="form-item sign-in">
                        <input type="submit" name="submit" value="SIGN UP">
                    </div>
                </form>
            </div>
            <div class="right-column col-lg-6">
                <h2>SIGN UP AND GET STARTED</h2>
                <p>Already have account, <a href="index.php?page=signin">SIGN IN</a></p>
            </div>
        </div>
    </div>
<?php
} else if ($page == "logout") {
    unset($_SESSION['user']);
    header('location: index.php');
} else if ($page == "404") {
?>
    <div class="row error-page">
        <div class="container">
            <h1><i class="fas fa-exclamation-circle"></i>404 | NOT FOUND</h1>
        </div>
    </div>
<?php
} else {
?>
    <div class="row _404">
        <div class="container">
            <h1><i class="fas fa-exclamation-circle"></i>404 | NOT FOUND</h1>
        </div>
    </div>
<?php
}
?>

<?php
require_once("footer.php");
?>