<?php
require_once("header.php");
require_once("../includes/Article.inc.php");

$category = $_GET['category'];
$cat = new Article();
$category_articles = $cat->get_category_articles($category);

if ($category_articles == "Category Empty") {
    $category_empty =  "<h1 class=\"empty-category\">{$category_articles}</h1>";
}

?>

<div class="articels-container">
    <?php echo $category_empty ?>
</div>

<?php
require_once("footer.php");
?>