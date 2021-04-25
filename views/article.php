<?php
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
        <img src="assets/images/<?= $article['image'] ?>" alt="ARTICLE IMAGE">
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
        <div class="container" id="comments">
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
                            <img src="assets/images/<?= $article['image'] ?>" alt="RELATED ARTICLE IMAGE">
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
?>