<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f0f2f5; }
    .signup-container {
      max-width: 400px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="signup-container">
    <h3 class="text-center mb-4">Signup</h3>

    <form action="signup_save.php" method="POST" onsubmit="return validateForm()">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <div class="form-text">
          Must be at least 8 characters and include at least 1 letter and 1 number.
        </div>
      </div>

      <div class="d-grid">
        <input type="submit" value="Register" class="btn btn-success">
      </div>
    </form>

    <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
  </div>
</div>

<script>
function validateForm() {
  const password = document.getElementById("password").value;

  // At least 8 characters, 1 letter, 1 number
  const pattern = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;


  if (!pattern.test(password)) {
    alert("Password must be at least 8 characters long and contain at least one letter and one number.");
    return false;
  }

  return true;
}
</script>

</body>
</html>
