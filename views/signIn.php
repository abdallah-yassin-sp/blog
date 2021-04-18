<?php
require_once("header.php");
require_once("../includes/User.inc.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $find_user = $user->get_user($email);

    if ($find_user == "No user found") {
        die($find_user);
    } else {
        foreach ($find_user as $user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $find_user;
                header("location: index.php");
            }
        }
    }
}
?>

<div class="sign-in-page row">
    <div class="container">
        <div class="left-column col-lg-6">
            <form action="" method="POST">
                <div class="form-item">
                    <label for="email">Email: </label>
                    <input type="email" name="email">
                </div>
                <div class="form-item">
                    <label for="password">Password: </label>
                    <input type="password" name="password">
                </div>
                <div class="form-item sign-in">
                    <input type="submit" value="SIGN IN">
                </div>
            </form>
        </div>
        <div class="right-column col-lg-6">
            <h2>SIGN IN</h2>
            <p>Don't have account, <a href="signup.php">SIGN UP</a></p>
        </div>
    </div>
</div>