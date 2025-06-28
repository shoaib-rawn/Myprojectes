<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login_system");

$email = $_POST['email'];
$password = $_POST['password'];
$remember = isset($_POST['remember']);

// ✅ Fetch user by email
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

// ✅ Verify hashed password
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $email;

    if ($remember) {
        setcookie("remembered", $email, time() + (86400 * 7), "/");
    }

    header("Location: dashboard.php");
    exit();
}

// ❌ If login fails, show nice styled error
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <title>Login Failed</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .error-box {
      max-width: 450px;
      margin: 100px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
    }
    .emoji {
      font-size: 48px;
    }
    .btn-custom {
      padding: 10px 20px;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <div class='container'>
    <div class='error-box'>
      <div class='emoji'>❌</div>
      <h4 class='mt-3 text-danger'>Login failed!</h4>
      <p>Invalid email or password.</p>
      <a href='login.php' class='btn btn-danger mt-3 btn-custom'>Try Again</a>
    </div>
  </div>
</body>
</html>";
?>