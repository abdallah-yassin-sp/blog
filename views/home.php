<div class="page">
    <div class="row">
        <div class="container home-section-2">
            <div class="home-left-column">
                <?php
                $last_id;
                foreach ($home_articles as $article) {
                ?>
                    <div class="article">
                        <a href="index.php?page=article&article=<?= $article['article_id'] ?>">
                            <img src="assets/images/<?= $article['image'] ?>" alt="ARTICLE IMAGE">
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