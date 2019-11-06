<?php
session_start();
if (isset($_POST["login"])) {
    $conn = mysqli_connect('localhost', "root", "pwdpwd", "test");
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        while ($row = $result->fetch_assoc())
            if ($_POST["username"] == $row["username"] && password_verify($_POST["password"], $row["password"])) {
                echo "welcome";
                $_SESSION["name"] = $_POST["username"];
                header('Location: chat.php');
            }
    mysqli_close($conn);
} else if (isset($_POST["signUp"])) {
    $conn = mysqli_connect('localhost', "root", "pwdpwd", "test");
    $sql = "INSERT INTO users VALUES('" . $_POST["susername"] . "' ,'" . password_hash($_POST["spassword"], PASSWORD_BCRYPT) . "')";
    $result = $conn->query($sql);
    mysqli_close($conn);
    $_SESSION["name"] = $_POST["susername"];
    echo '<script language="javascript">';
    echo 'alert("Sign up successful")';
    echo '</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Room</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST">
                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="sname" />
                <input type="text" placeholder="Username" name="susername" />
                <input type="password" placeholder="Password" name="spassword" />
                <button name="signUp" type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST">
                <h1>Sign in</h1>
                <input type="text" placeholder="Username" name="username" />
                <input type="password" placeholder="Password" name="password" />
                <button name="login" type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>