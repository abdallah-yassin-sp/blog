<?php
require_once("../includes/Article.inc.php");

$last_id = $_POST['id'];
$category = $_POST['category'];
$art = new Article();
$art2 = $art->category_load_more($last_id, $category);

$last_id;
foreach ($art2 as $article) {
?>
    <div class="category_article">
        <a href="article.php?article=<?= $article['article_id'] ?>">
            <img src="assets/images/<?= $article['image'] ?>" alt="image">
            <h4><?= $article['title'] ?></h4>
            <p><?= substr($article['body'], 0, 75) . "..." ?></p>
        </a>
    </div>
<?php
    $last_id = $article['article_id'];
}
?>
<div class="row load-more-container">
    <button id="load_more_btn" class="btn btn-outline-success" data-id="<?= $last_id ?>">LOAD MORE</button>
</div>

<script src="assets/script.js"></script>