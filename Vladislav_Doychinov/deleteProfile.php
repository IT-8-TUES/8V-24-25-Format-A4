<?php
session_start();
include("config.php");

$error = "";
$message = "";
$check = 0;

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $id = $_SESSION['id'];

    $stmt = $conn->prepare("SELECT Password FROM users WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && $row['Password'] === $password) {
        $del = $conn->prepare("DELETE FROM users WHERE ID = ?");
        $del->bind_param("i", $id);
        if ($del->execute()) {
            $message = "<p style='color: green;'>Profile successfully deleted!</p>";
            $check = 1;
        } else {
            $error = "<p style='color: red;'>Something went wrong. Try again!</p>";
        }
    } else {
        $error = "<p style='color: red;'>Incorrect password.</p>";
    }
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
    <title>Race The Earth - Delete Profile</title>
</head>
<style>
    h1 {
        text-align: center;
    }
</style>
<body>
    <div class="allModal">
        <div class="loginmodal">
        <h1>DELETE PROFILE</h1>
        <?php if (!empty($error)) {
            echo "$error";
        } else {
            echo "$message";
        }?>
            <form method="POST" action="">
                <input name="password" type="password" id="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>
                </button>
                <div class="buttonContainer">
                    <button type="submit" name="submit" class="loginBtn">Confirm</button>
                </div>
                <?php if($check === 0): ?>
                    <p>Don't want to delete your account? Click here to <a href="home.php">go back</a>!</p>
                <?php else: ?>
                    <p>You want to make an account again? Click here to make a <a href="register.php">new one</a>!</p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>
