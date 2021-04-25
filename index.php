<?php
require_once("views/header.php");
if ($page == "") {
    require_once("views/slider.php");
    require_once("views/home.php");
} else if ($page == "category") {
    require_once("views/categories.php");
} else if ($page == "article") {
    require_once("views/article.php");
} else if ($page == "user") {
    require_once("views/user.php");
} else if ($page == "signin") {
    require_once("views/signin.php");
} else if ($page == "signup") {
    require_once("views/signup.php");
} else if ($page == "logout") {
    unset($_SESSION['user']);
    header('location: index.php');
} else if ($page == "404") {
    require_once("404.php");
} else {
    require_once("404.php");
}
require_once("views/footer.php");
