<?php
session_start();
require_once("../includes/Article.inc.php");
require_once("../includes/Category.inc.php");
require_once("../includes/User.inc.php");
require_once("../includes/Comment.inc.php");
require_once("../includes/Slider.inc.php");

$slider = new Slider();
$slider = $slider->get_home_slider();

$new_article = new Article();
$home_articles = $new_article->get_all_articles();
$home_popular_articles = $new_article->get_popular_articles();

$category = new Category();
$categories = $category->get_all_categories();

$page = $_GET['page'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Custome Style -->
    <link rel="stylesheet" href="../style/style.css" />
    <!-- Custome JS -->
    <script src="../assets/script.js" defer></script>

</head>

<body>

    <div class="header">
        <div class="header-1 row">
            <div class="container">
                <a href="index.php" class="logo col-lg-6">
                    <h2>WRITE YOUR NAME</h2>
                </a>
                <div class="right-col col-lg-6">
                    <a href="#"><i class="fas fa-search"></i></a>
                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                        <a href="index.php?page=user&user=<?= $_SESSION['user']['first_name'] ?>"><?= $_SESSION['user']['first_name'] ?></a>
                        <a href="index.php?page=logout">LOGOUT</a>
                    <?php
                    } else {
                    ?>
                        <a href="index.php?page=signin">Sign in</a>
                    <?php
                    }
                    ?>
                    <a href="#" class="btn btn-outline-success">Get Started</a>
                </div>
            </div>
        </div>
        <div class="header-2 row">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">HOME</a>
                            </li>
                            <?php
                            foreach ($categories as $category) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=category&category=<?= $category['cat_name'] ?>"><?= $category['cat_name'] ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="inner-content">
        <?php
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
            $new_article->add_view($article_id);
            $article = $new_article->get_article($article_id);

            $category = $article['cat_id'];
            $related_articles = $new_article->get_related_articles($category);

            $comment = new Comment();
            $comments = $comment->get_comments($article_id);
            ?>

            <div class="article-page">
                <div class="row article-image">
                    <img src="../assets/images/<?= $article['image'] ?>" alt="ARTICLE IMAGE">
                </div>
                <div class="row">
                    <div class="container">
                        <div class="article-contents">
                            <span><?= $article['views'] ?> (VIEWS)</span>
                            <h1><?= $article['title'] ?></h1>
                            <p><?= $article['body'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="row comments-section">
                    <div class="container">
                        <h2>Comments</h2>
                        <div class="row comments">
                            <div class="container">

                                <?php
                                foreach ($comments as $comment) {
                                ?>
                                    <div class="comment">
                                        <p class="author"><?= $comment['author_name'] ?></p>
                                        <p class="body"><?= $comment['body'] ?></p>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <form action="" method="POST">
                            <h2>JOIN THE DISCUSSION</h2>
                            <div class="comment-body">
                                <textarea name="comment-body" cols="30" rows="10" placeholder="Write Your Comment ..."></textarea>
                            </div>
                            <div class="comment-name-and-email">
                                <div class="name">
                                    <input type="text" name="author_name" placeholder="Your Name">
                                </div>
                                <div class="email">
                                    <input type="email" name="author_email" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="submit">
                                <input type="submit" value="Comment" name="submit" class="btn btn-success">
                            </div>

                        </form>
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $body = $_POST['comment-body'];
                $author_name = $_POST['author_name'];
                $author_email = $_POST['author_email'];

                $new_comment = new Comment();
                $new_comment->add_comment($body, $author_name, $author_email, $article_id);
                echo "<meta http-equiv='refresh' content='0'>";
            }
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

                $article = new Article();
                $article->post($user, $title, $body, $category, $image);

                $_POST = [];
            }

            if (isset($_SESSION['user'])) {
                $current_user_name = $_SESSION['user']['first_name'];
                $current_user_email = $_SESSION['user']['email'];
                $current_user_id = $_SESSION['user']['user_id'];
                $user = new User();
                $user_page = $user->get_user($current_user_email);

                // var_dump($_SESSION['user']);
                // var_dump();

                if ($user_page['first_name'] == $current_user_name) {
                    $user_articles = $user->get_user_articles($current_user_id);
            ?>
                    <div class="row">
                        <div class="container">
                            <div class="user-articles">
                                <?php
                                foreach ($user_articles as $article) {
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
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                }
            } else {
                ?>
                <div class="row">
                    <div class="container">
                        <h1>This user have no articles.</h1>
                    </div>
                </div>
            <?php
            }

            $user_id = $_GET['user'];
            $user = new User();
            $user_articles = $user->get_user_articles($user_id);
            if (!$user_articles) {
            } else {
            ?>
                <div class="row">
                    <div class="container">
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
                        if (password_verify($password, $find_user['password'])) {
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
    </div>
    <footer>
        <div class="sprintive-background"></div>
        <div class="row footer-contact-form">
            <div class="container">
                <h3>CONTACT ME</h3>
                <form action="" method="POST">
                    <input type="email" name="email" placeholder="your email">
                    <input type="submit" value="SEND" class="btn btn-success">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="container footer-menu-container">
                <div class="logo">
                    <img src="../assets/images/footer-logo.svg" alt="logo">
                </div>
                <div class="footer-menu">
                    <ul>
                        <li><a href="#">CAREERS</a></li>
                        <li><a href="#">CONTACT US</a></li>
                        <li><a href="#">SPRINTIVE CARE</a></li>
                    </ul>
                </div>
                <div class="social-media">
                    <ul>
                        <li><a href="#"><i class="fab fa-drupal"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>

    <!-- jQuery & Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>