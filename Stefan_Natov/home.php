<?php
session_start();
include("config.php");

$currentCollect = 0;
$message = "<p>User not logged in</p>";

if (isset($_GET['score'])) {
    $score = (int)$_GET['score'];
} else {
    $score = 0;
}

if (isset($_GET['collect'])) {
    $collect = (int)$_GET['collect'];
} else {
    $collect = 0;
}

if (isset($_SESSION['id'])) {
    $id = (int)$_SESSION['id'];

    $query = "SELECT Username FROM users WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        $name = $row['Username'];
    }
    $stmt->close();

    if ($id) {
        $selectQuery = $conn->prepare("SELECT Score, Cubes FROM users WHERE ID = ?");
        $selectQuery->bind_param("i", $id);
        $selectQuery->execute();
        $result = $selectQuery->get_result();

        $currentScore = 0;
        if ($result && $row = $result->fetch_assoc()) {
            $currentScore = (int)$row['Score'];
            $currentCubes = (int)$row['Cubes'];
            $currentCollect = $currentCubes + $collect;
        }
        $selectQuery->close();

        if($collect) {
            $update1 = $conn->prepare("UPDATE users SET Cubes = ? WHERE ID = ?");
            $update1->bind_param("ii", $currentCollect, $id);

            if ($update1->execute()) {
                echo "<script>window.location.href =  'home.php?score=' + $score;</script>";
            }
            $update1->close();
        }

      if ($score > $currentScore) {
        $update = $conn->prepare("UPDATE users SET Score = ? WHERE ID = ?");
        $update->bind_param("ii", $score, $id);

        if ($update->execute()) {
          $message = "<p>Here you can see your score:</p><p style='color: green;'>NEW HIGHEST SCORE! Congratulations! Highest score:<b> $score</b></p>";
        }
        $update->close();
      } else if ($score <= $currentScore) {
        $message = "<p>Here you can see your score:</p><p style='color: yellow;'>Highest score: $currentScore</p><p>Score: $score</p>";
        if ($score === 0) {
          $message = "<p>Here you can see your score:</p><p style='color: yellow;'>Highest score: $currentScore</p>";
        }
      }
    }
} else {
    $message = "<p>User not logged in.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="homeStyle.css" rel="stylesheet">
  <link rel="stylesheet" href="car.css">
  <script src="car.js" defer></script>
  <script src="score.js" defer></script>
  <title>Race The Earth - Home</title>
</head>
<style>
  #car {
    top: 50%;
    left: 50%;
  }

  #addBtn {
    font-size: xx-large;
    height: auto;
    width: 10%;
    margin-left: calc(50% - 10px);
  }
</style>
<body>
  <h1>Welcome, <?php if(empty($name)) {
    echo "Guest!";
  } else {
    echo "$name!";
  } ?></h1>
  <div id="overlay"></div>
  <button class="button" id="cubeBtn" onclick="document.getElementById('cubeModal').style.display = 'flex'; document.getElementById('overlay').style.display = 'block'">
    <?php if(isset($_SESSION['id'])) {
        echo "$currentCollect";
      } else {
        echo "0";
      }?>
    <div class="container">
      <div class="cube">
          <div class="face front"></div>
          <div class="face back"></div>
          <div class="face left"></div>
          <div class="face right"></div>
          <div class="face top"></div>
          <div class="face bottom"></div>
      </div>
    </div>
  </button>
  <div id="cubeModal">
    <p>You must collect these cubes because you may be able to buy new cars and upgrade them in some point in the future.</p>
    <button class='button' id="close" onclick="document.getElementById('cubeModal').style.display = 'none'; document.getElementById('overlay').style.display = 'none'"><i class="fa fa-close"></i></button>
  </div>
  
  <button class="button" id="setting" onclick="document.getElementById('settingsModal').style.display = 'flex'; document.getElementById('overlay').style.display = 'block'"><i class="fa fa-gear fa-spin"></i></button>
  <?php if (isset($_SESSION['id'])): ?>
    <div id="settingsModal">
      <p>Profile settings</p>
      <button class="button" id="editBtn" onclick="location.href='editProfile.php'"><i class="fa fa-edit"></i></button>
      <button class="button" id="deleteBtn" onclick="location.href='deleteProfile.php'"><i class="fa fa-trash"></i></button>
      <button class="button" id="close" onclick="document.getElementById('settingsModal').style.display = 'none'; document.getElementById('overlay').style.display = 'none'"><i class="fa fa-close"></i></button>
    </div>
  <?php else: ?>
    <div id="settingsModal">
      <button class="button" id="addBtn" onclick="document.getElementById('signOutModal').style.display = 'block'"><i class="material-icons">add</i></button>
      <button class="button" id="close" onclick="document.getElementById('settingsModal').style.display = 'none'; document.getElementById('overlay').style.display = 'none'"><i class="fa fa-close"></i></button>
    </div>
  <?php endif; ?>


  
  <button class="button" id="scoreBtn"><i class="fa fa-line-chart" onclick = "document.getElementById('scoreModal').style.display = 'block'; document.getElementById('overlay').style.display = 'block'"></i></button>
  <div id="scoreModal">
    <?php echo $message; ?>
    <button class="button" id="close" onclick="document.getElementById('scoreModal').style.display = 'none'; document.getElementById('overlay').style.display = 'none'"><i class="fa fa-close"></i></button>
  </div>
  
  <button class="button" id="color" onclick="document.getElementById('colormodal').style.display = 'flex'">
    <i class="fa fa-paint-brush"></i>
  </button>
    
  <button class="button" id="game" onclick="location.href='game.html'"><i class="fa fa-gamepad"></i></button>

  <button class="button" id="signOutBtn" onclick="document.getElementById('signOutModal').style.display = 'block'; document.getElementById('overlay').style.display = 'block'"><i class="fa fa-sign-out"></i></button>

  <?php if (isset($_SESSION['id'])): ?>
    <div id="signOutModal">
      <p>You want to sign out. Are you sure?</p>
      <button class='button' onclick="location.href='login.php'">Yes</button>
      <button class='button' onclick="document.getElementById('signOutModal').style.display = 'none'; document.getElementById('overlay').style.display = 'none'">No</button>
    </div>
  <?php else: ?>
    <div id="signOutModal">
      <p>You do not have an account. Do you want to make one? Your progress until now won't be saved.</p>
      <button class='button' onclick="location.href='register.php'">Yes</button>
      <button class='button' onclick="document.getElementById('signOutModal').style.display = 'none'; document.getElementById('overlay').style.display = 'none'">No</button>
    </div>
  <?php endif; ?>

  <div id="colormodal">
      <button onclick="colorChange('#2e2e2e');" class="color"></button>
      <button onclick="colorChange('red');" class="color"></button>
      <button onclick="colorChange('green');" class="color"></button>
      <button onclick="colorChange('blue');" class="color"></button>
      <button onclick="colorChange('black');" class="color"></button>
      <button onclick="colorChange('white');" class="color"></button>
      <button onclick="colorChange('#5C4033');" class="color"></button>
      <button onclick="colorChange('yellow');" class="color"></button>
      <button onclick="colorChange('orange');" class="color"></button>
      <button onclick="colorChange('purple');" class="color"></button>
      <button class="button" id="close" onclick="document.getElementById('colormodal').style.display = 'none'"><i class="fa fa-close"></i></button>
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

  <script>
    const car = document.getElementById('side');
    let angleX = 0;
    let angleY = 0;

    window.onkeydown = function (event) {
      if (event.key === 'ArrowRight') {
        angleY += 10;
      } else if (event.key === 'ArrowLeft') {
        angleY -= 10;
      } else if (event.key === 'ArrowUp') {
        angleX += 10;
      } else if (event.key === 'ArrowDown') {
        angleX -= 10;
      }

      car.style.transform = `rotateY(${angleY}deg) rotateX(${angleX}deg)`;
    };
  </script>
</body>
</html>