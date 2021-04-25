<?php
session_start();
require_once("includes/Article.inc.php");
require_once("includes/Category.inc.php");
require_once("includes/User.inc.php");
require_once("includes/Comment.inc.php");
require_once("includes/Slider.inc.php");

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
    <link rel="stylesheet" href="style/style.css" />
    <!-- Custome JS -->
    <script src="assets/script.js" defer></script>

</head>

<body>
    <div class="header">
        <div class="header-1 row">
            <div class="container">
                <a href="home" class="logo col-lg-6">
                    <h2>WRITE YOUR NAME</h2>
                </a>
                <div class="right-col col-lg-6">
                    <a href="#" class="header-1-item"><i class="fas fa-search"></i></a>
                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                        <a href="user" class="header-1-item"><?= $_SESSION['user']['first_name'] ?></a>
                        <a href="index.php?page=logout" class="header-1-item">LOGOUT</a>
                    <?php
                    } else {
                    ?>
                        <a href="signin" class="header-1-item">Sign in</a>
                    <?php
                    }
                    ?>
                    <a href="#" class="btn btn-outline-success header-1-item">Get Started</a>
                </div>
            </div>
        </div>
        <div class="header-2 row">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="home">HOME</a>
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