<?php
require_once("header.php");
require_once("../includes/User.inc.php");

$user = $_GET['user'];
$user1 = new User();
if (!$user1->get_articles($user)) {
    echo "No Articles Found !";
} else {
?>

    <div class="row">
        <div class="container"></div>
    </div>

<?php
}
require_once("footer.php");
?>