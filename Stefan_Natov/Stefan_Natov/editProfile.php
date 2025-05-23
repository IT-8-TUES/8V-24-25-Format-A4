<?php
session_start();
include("config.php");

$message = "";

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $id = $_SESSION['id'];


    $stmt = $conn->prepare("SELECT Email FROM users WHERE Email = ? AND ID != ?");
    $stmt->bind_param("si", $email, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
        $error = "<p style='color: red;'>This email is used. Please try another one!</p>";
    }else {
        $edit_query = mysqli_query($conn, "UPDATE users SET Username='$name', Email='$email', Password='$password' WHERE ID='$id'");
        $message = "<p style='color: green;'>Profile successfully updated!</p>";
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
    <title>Race The Earth - Edit Profile</title>
</head>

<body>
    <div class="allModal">
        <div class="loginmodal">
        <?php if (!empty($error)) {
            echo "$error";
        } else {
            echo "$message";
        }?>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Username" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input name="password" type="password" id="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>
                </button>
                <div class="buttonContainer">
                    <button type="submit" name="submit" class="loginBtn">Change Profile</button>
                </div>
                <p>Don't want to change your account? Click here to <a href="home.php">go back</a>!</p>
            </form>
        </div>
    </div>
</body>

</html>
