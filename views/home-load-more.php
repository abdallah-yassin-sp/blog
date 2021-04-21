<?php
require_once("../includes/Article.inc.php");
$last_id = $_POST['id'];
$art = new Article();
$art2 = $art->home_load_more($last_id);

foreach ($art2 as $article) {
?>
    <div class="article">
        <a href="<?= $article['article_id'] ?>">
            <img src="../assets/images/<?= $article['image'] ?>" alt="ARTICLE IMAGE">
            <h4><?= $article['cat_name'] ?></h4>
            <h2><?= $article['title'] ?></h2>
            <p><?= substr($article['body'], 0, 200) . "..." ?></p>
        </a>
    </div>
<?php
    $last_id = $article['article_id'];
}
?>
<div class="row load-more-container">
    <button id="load_more_btn" class="btn btn-outline-success" data-id="<?= $last_id ?>">LOAD MORE</button>
</div>

<script src="../assets/script.js"></script>