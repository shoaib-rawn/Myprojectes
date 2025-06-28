<?php
$saved_email = isset($_COOKIE['remembered']) ? $_COOKIE['remembered'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <!-- ✅ Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-check-label {
      user-select: none;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="login-container">
    <h3 class="text-center mb-4">Login</h3>

    <form action="auth.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" name="email" value="<?php echo $saved_email; ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">
          Remember me
        </label>
      </div>

      <div class="d-grid">
        <input type="submit" value="Login" class="btn btn-primary">
      </div>
    </form>

    <!-- ✅ Signup link added here -->
    <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign up here</a></p>
  </div>
</div>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
