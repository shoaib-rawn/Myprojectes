<?php
session_start();
session_unset();
session_destroy();
setcookie("remembered", "", time() - 3600, "/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
    }
    .logout-box {
      max-width: 450px;
      margin: 100px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .emoji {
      font-size: 48px;
    }
    .btn-custom {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="logout-box">
    <div class="emoji">👋</div>
    <h4 class="text-success mt-3">You’ve been logged out successfully!</h4>
    <a href="login.php" class="btn btn-primary btn-custom">Login Again</a>
  </div>
</div>

</body>
</html>
