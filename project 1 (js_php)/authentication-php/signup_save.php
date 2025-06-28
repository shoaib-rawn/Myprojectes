<?php
$conn = mysqli_connect("localhost", "root", "", "login_system");

$email = $_POST['email'];
$password = $_POST['password'];

// ✅ Validate password format
if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d).{8,}$/", $password)) {
    showMessage("⚠️", "Invalid password format.<br>Password must be at least 8 characters and include 1 letter & 1 number.", "signup.php", "Back to Signup", "warning");
    exit();
}

// ✅ Check if email exists (fixed!)
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (!$check) {
    die("Query failed: " . mysqli_error($conn));
}
if (mysqli_num_rows($check) > 0) {
    showMessage("⚠️", "Email already exists!", "signup.php", "Try Again", "warning");
    exit();
}

// ✅ Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// ✅ Insert user using correct column names
$sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
if (mysqli_query($conn, $sql)) {
    showMessage("✅", "Signup Successful!", "login.php", "Login Now", "success");
} else {
    showMessage("❌", "Signup Failed. Try again.", "signup.php", "Back to Signup", "danger");
}

// ✅ UI function (unchanged)
function showMessage($emoji, $message, $link, $btnText, $btnType) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <title>Signup Result</title>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
      <style>
        body {
          background-color: #f0f2f5;
        }
        .message-box {
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
        <div class='message-box'>
          <div class='emoji'>$emoji</div>
          <h4 class='mt-3'>$message</h4>
          <a href='$link' class='btn btn-$btnType mt-4 btn-custom'>$btnText</a>
        </div>
      </div>
    </body>
    </html>";
}
?>
