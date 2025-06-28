<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
    }
    .dashboard-box {
      max-width: 500px;
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
  <div class="dashboard-box">
    <div class="emoji">👋</div>
    <h3 class="mt-3">Welcome,</h3>
    <h4 class="text-primary"><?php echo $_SESSION['user']; ?></h4>
    <a href="logout.php" class="btn btn-danger btn-custom">Logout</a>
  </div>
</div>

</body>
</html>
