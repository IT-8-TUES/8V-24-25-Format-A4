<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
}

$score = $_GET['msg'] ?? 0; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
  <link href="homeStyle.css" rel="stylesheet" />
  <link rel="stylesheet" href="car.css" />
  <script src="car.js" defer></script>
  <script src="score.js" defer></script>
  <title>Race The Earth - Home</title>
</head>
<style>
  #car {
    top: 50%;
    left: 50%;
  }
</style>
<body>
  <div class="info">
    <h1>Welcome, <?php echo isset($name) ? $name : 'Guest'; ?></h1>
    <button class="button"><i class="fa fa-gear fa-spin"></i></button>
    <button class="button"><i class="fa fa-line-chart" onclick = "document.getElementById('scoreModal').style.display = 'block'"></i></button>
    <div id="scoreModal">
      <p>Here you can see your previous score:</p>
      <p><?php echo "Score: " . htmlspecialchars($score); ?></p>
      <button class="button" id="close" onclick="document.getElementById('scoreModal').style.display = 'none'"><i class="fa fa-close"></i></button>
    </div>
    <button class="button" onclick="location.href='game.html'"><i class="fa fa-gamepad"></i></button>

  <button class="button" onclick="document.getElementById('colormodal').style.opacity = '1'">
    <i class="fa fa-paint-brush"></i>
  </button>

  <div id="colormodal">
      <button onclick="colorChange('#2e2e2e')" class="color"></button>
      <button onclick="colorChange('red')" class="color"></button>
      <button onclick="colorChange('green')" class="color"></button>
      <button onclick="colorChange('blue')" class="color"></button>
      <button onclick="colorChange('black')" class="color"></button>
      <button onclick="colorChange('white')" class="color"></button>
      <button onclick="colorChange('#5C4033')" class="color"></button>
      <button onclick="colorChange('yellow')" class="color"></button>
      <button onclick="colorChange('orange')" class="color"></button>
      <button onclick="colorChange('purple')" class="color"></button>
      <button class="button" id="close" onclick="document.getElementById('colormodal').style.opacity = '0'"><i class="fa fa-close"></i></button>
  </div>

  <div id="car">
    <div id="coupe">
      <div id="side">
        <div id="front"></div>
        <div id="back"></div>
        <div id="left"></div>
        <div id="right"></div>
        <div id="top"></div>
        <div id="bottom"></div>
        <div id="frontBumper"></div>
        <div id="hood"></div>
        <div id="rightFender"></div>
        <div id="leftFender"></div>
        <div id="rearWindow"></div>
        <div id="headlightsFront1" class="headlightsFront"></div>
        <div id="headlightsFront2" class="headlightsFront"></div>
        <div id="headlightsBack1" class="headlightsBack"></div>
        <div id="headlightsBack2" class="headlightsBack"></div>
        
        <div id="frontRight" class="wheel">
          <div class="spinner">
            <div class="wheel-side">
              <div class="wheel-segment segment-1"></div>
              <div class="wheel-segment segment-2"></div>
              <div class="wheel-segment segment-3"></div>
              <div class="wheel-segment segment-4"></div>
              <div class="wheel-segment segment-5"></div>
              <div class="wheel-segment segment-6"></div>
              <div class="wheel-segment segment-7"></div>
              <div class="wheel-segment segment-8"></div>
              <div class="wheel-segment segment-9"></div>
              <div class="wheel-segment segment-10"></div>
              <div class="wheel-segment segment-11"></div>
              <div class="wheel-segment segment-12"></div>
            </div>
          </div>
        </div>

        <div id="frontLeft" class="wheel">
          <div class="spinner">
            <div class="wheel-side">
              <div class="wheel-segment segment-1"></div>
              <div class="wheel-segment segment-2"></div>
              <div class="wheel-segment segment-3"></div>
              <div class="wheel-segment segment-4"></div>
              <div class="wheel-segment segment-5"></div>
              <div class="wheel-segment segment-6"></div>
              <div class="wheel-segment segment-7"></div>
              <div class="wheel-segment segment-8"></div>
              <div class="wheel-segment segment-9"></div>
              <div class="wheel-segment segment-10"></div>
              <div class="wheel-segment segment-11"></div>
              <div class="wheel-segment segment-12"></div>
            </div>
          </div>
        </div>

        <div id="backRight" class="wheel">
          <div class="spinner">
            <div class="wheel-side">
              <div class="wheel-segment segment-1"></div>
              <div class="wheel-segment segment-2"></div>
              <div class="wheel-segment segment-3"></div>
              <div class="wheel-segment segment-4"></div>
              <div class="wheel-segment segment-5"></div>
              <div class="wheel-segment segment-6"></div>
              <div class="wheel-segment segment-7"></div>
              <div class="wheel-segment segment-8"></div>
              <div class="wheel-segment segment-9"></div>
              <div class="wheel-segment segment-10"></div>
              <div class="wheel-segment segment-11"></div>
              <div class="wheel-segment segment-12"></div>
            </div>
          </div>
        </div>

        <div id="backLeft" class="wheel">
          <div class="spinner">
            <div class="wheel-side">
              <div class="wheel-segment segment-1"></div>
              <div class="wheel-segment segment-2"></div>
              <div class="wheel-segment segment-3"></div>
              <div class="wheel-segment segment-4"></div>
              <div class="wheel-segment segment-5"></div>
              <div class="wheel-segment segment-6"></div>
              <div class="wheel-segment segment-7"></div>
              <div class="wheel-segment segment-8"></div>
              <div class="wheel-segment segment-9"></div>
              <div class="wheel-segment segment-10"></div>
              <div class="wheel-segment segment-11"></div>
              <div class="wheel-segment segment-12"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>