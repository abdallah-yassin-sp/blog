<?php
$matchFound = (array_key_exists("page", $_GET)) && trim($_GET["page"]) == 'link1';
$slide = $matchFound ? trim($_GET["id"]) : '';

$category_name = $_GET['category'];
$cat = new Article();
$category_articles = $cat->get_category_articles($category_name);
$category_popular_articles = $cat->get_category_popular_articles($category_name);

$category = new Category();
$categories = $category->get_all_categories();

if ($category_articles == "empty category") {
    header("location: 404");
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
                                    <img src="assets/images/<?= $popular_art['image'] ?>" alt="popular" width="250">
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
?>