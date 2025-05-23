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
    <title>Race The Earth - Register</title>
</head>

<body>
    <div class="allModal">
        <?php 
            include("config.php");

            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $verify_query = mysqli_query($conn, "SELECT Email FROM users WHERE Email = '$email'");

                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='error'>
                            <p>This email is used. Please try another one!</p>
                            <br><button class='loginBtn' onclick='self.history.back()'>Go back</button></br>
                          </div>";
                } else {
                    mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')")
                        or die("Error Occurred");

                    echo "<div class='error'>
                            <p>Registration successful!</p>
                            <br><button class='loginBtn' onclick=\"location.href='login.php'\">Login now</button></br>
                          </div>";
                }
            } else {
        ?>
        <div class="loginmodal">
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Username" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input name="password" type="password" id="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>
                </button>
                <div class="buttonContainer">
                    <button type="submit" name="submit" class="loginBtn">Register</button>
                    <button type="button" class="justplay"
                        onclick="document.getElementById('warningModal').style.display = 'block'">Just Play</button>
                </div>
                <p>Already have an account? Click here to <a href="login.php">login</a>!</p>
            </form>
        </div>
        <?php } ?>

        <div id="warningModal">
            <p>Without an account your progress won't be saved. Are you sure?</p>
            <button class="close" onclick="document.getElementById('warningModal').style.display = 'none'">Cancel</button>
            <button class="yes" onclick="location.href='game.html'">Yes</button>
        </div>
    </div>
</body>

</html>
