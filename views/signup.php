<?php
require_once("header.php");
require_once("../includes/User.inc.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["first_name"])) {
        $first_name_err = "First Name is required";
    } else {
        $first_name_err = test_input($_POST["first_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
            $first_name_err = "Only letters and white space allowed";
        } else {
            $first_name_err = "";
        }
    }

    if (empty($_POST["last_name"])) {
        $last_name_err = "Last Name is required";
    } else {
        $last_name_err = test_input($_POST["last_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
            $last_name_err = "Only letters and white space allowed";
        } else {
            $last_name_err = "";
        }
    }

    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        } else {
            $email_err = "";
        }
    }

    if (empty($_POST["password"])) {
        $password_err = "password is required";
    } else {
        $password = $_POST["password"];
        $password_err = "";
    }

    $user = new User();
    $users = $user->get_all_users();
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            die("Email exists, try another email");
        }
    }

    $new_user = new User();
    $new_user->create($first_name, $last_name, $email, $password);
    header("location: signIn.php");
}

?>

<div class="sign-up-page row">
    <div class="container">
        <div class="left-column col-lg-6">
            <form action="" method="POST">
                <div class="form-item">
                    <label for="frist-name">First Name: </label>
                    <input type="text" name="first_name">
                    <span><?= $first_name_err ?></span>
                </div>
                <div class="form-item">
                    <label for="last-name">Last Name: </label>
                    <input type="text" name="last_name">
                    <span><?= $last_name_err ?></span>
                </div>
                <div class="form-item">
                    <label for="email">Email: </label>
                    <input type="email" name="email">
                    <span><?= $email_err ?></span>
                </div>
                <div class="form-item">
                    <label for="password">Password: </label>
                    <input type="password" name="password">
                    <span><?= $password_err ?></span>
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