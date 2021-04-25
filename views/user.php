<?php
if (!isset($_SESSION['user'])) {
    header(("location: 404"));
}
//post new article
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_SESSION['user']["user_id"];
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
}

if (isset($_SESSION['user'])) {
    $current_user_name = $_SESSION['user']['first_name'];
    $current_user_email = $_SESSION['user']['email'];
    $current_user_id = $_SESSION['user']['user_id'];
    $user = new User();
    $user_page = $user->get_user($current_user_email);

    if ($user_page['first_name'] == $current_user_name) {
        $user_articles = $user->get_user_articles($current_user_id);
?>
        <div class="row">
            <div class="container add-new-article-wrapper">
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
        <div class="row">
            <div class="container">
                <div class="user-articles">
                    <?php
                    foreach ($user_articles as $article) {
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
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
} else {
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