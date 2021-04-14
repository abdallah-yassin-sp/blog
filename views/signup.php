<?php
require_once("header.php");

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $first_name = $_POST['last_name'];
    $first_name = $_POST['email'];
    $first_name = $_POST['password'];

    $db = new DB();
    $db = $db->connect();
    $query = "SELECT * FROM users";
    $result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
}
?>

<div class="sign-up-page row">
    <div class="container">
        <div class="left-column col-lg-6">
            <form action="" method="POST">
                <div class="form-item">
                    <label for="frist-name">First Name: </label>
                    <input type="text" name="first_name">
                </div>
                <div class="form-item">
                    <label for="last-name">Last Name: </label>
                    <input type="text" name="last_name">
                </div>
                <div class="form-item">
                    <label for="email">Email: </label>
                    <input type="email" name="email">
                </div>
                <div class="form-item">
                    <label for="password">Password: </label>
                    <input type="password" name="password">
                </div>
                <div class="form-item sign-in">
                    <input type="submit" name="submit" value="SIGN UP">
                </div>
            </form>
        </div>
        <div class="right-column col-lg-6">
            <h2>SIGN UP AND GET STARTED</h2>
        </div>
    </div>
</div>