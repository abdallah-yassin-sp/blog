<?php
require_once("header.php");
require_once("../includes/User.inc.php");

$user = $_GET['user'];
$user1 = new User();
$user1->get_user_articles($user);
if (!$user1->get_user_articles($user)) {
?>
    <div class="row">
        <div class="container">

            <h1>You don't have an articles yet, Start adding new articles: </h1>

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
                            <form action="" method="POST">
                                <input type="hidden" name="user" value="<?= $_SESSION['user'] ?>">
                                <div>
                                    <label for="title">Title</label>
                                    <input type="text" name="article_title" required>
                                </div>
                                <div>
                                    <label for="body">Text</label>
                                    <textarea type="text" name="article_body" required></textarea>
                                </div>
                                <div>
                                    <label for="category">Category</label>
                                    <select name="category" required>
                                        <option value="architecture" selected>Architecture</option>
                                        <option value="art-and-illustration">Art & Illustration</option>
                                        <option value="business-and-corporate">Business & Corporate</option>
                                        <option value="culture-and-education">Culture & Education</option>
                                        <option value="e-commerce">E-commerce</option>
                                        <option value="design-agencies">Design Agencies</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="image">Image</label>
                                    <input type="file" name="article_image">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="POST" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<?php
} else {
?>
    <div class="row">
        <div class="container"></div>
    </div>

<?php
}
require_once("footer.php");
?>