<?php
session_start();
include("config.php");

if (isset($_POST['submit']) && !isset($_POST['button'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE Email='$email' AND Password='$password' AND Username='$name'") or die("Select error");
    $row = mysqli_fetch_assoc($result);
    
    if (is_array($row) && !empty($row)) {
        $_SESSION['valid'] = $row['Email'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['password'] = $row['Password'];
        $_SESSION['id'] = $row['ID'];

        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid login! Please try again!";
    }
} else {
    unset($_SESSION['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <script src="togglePassword.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Race The Earth - Login</title>
</head>

<body>
    <div class="allModal">
        <?php if (!empty($error)) {
            echo "<div><p style='color: red;'>$error</p></div>";
        } ?>
        <div class="loginmodal">
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Username" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input name="password" type="password" id="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>
                </button>
                <div class="buttonContainer">
                    <button type="submit" name="submit" class="loginBtn">Login</button>
                    <button type="button" class="justplay"
                        onclick="document.getElementById('warningModal').style.display = 'block'">Just Play</button>
                </div>
                <p>Don't have an account? Click here to <a href="register.php">register</a>!</p>
            </form>
        </div>

        <div id="warningModal">
            <p>Without an account your progress won't be saved. Are you sure?</p>
            <button class="close" onclick="document.getElementById('warningModal').style.display = 'none'">Cancel</button>
            <button class="yes" onclick="location.href='game.html'">Yes</button>
        </div>
    </div>
</body>

</html>
