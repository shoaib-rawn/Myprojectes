<!DOCTYPE html>
<html>
<head>
  <title>Student Submission</title>
  <!-- ✅ Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding: 30px;
      background-color: #f9f9f9;
    }

    .submitted-box {
      background-color: #e3f6e8;
      padding: 20px;
      border: 2px solid #0f5132;
      border-radius: 10px;
      margin-bottom: 40px;
    }

    .student-card {
      border: 3px solid darkgreen;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .student-card img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<?php
$conn = mysqli_connect("localhost", "root", "", "crud_db");

// 1. Get form data
$name  = $_POST['name'];
$age   = $_POST['age'];
$email = $_POST['email'];
$car   = $_POST['car'];

// 2. Handle uploaded file
$photo = $_FILES['photo']['name'];
$tmp   = $_FILES['photo']['tmp_name'];

$uploadPath = "uploads/";
move_uploaded_file($tmp, $uploadPath . $photo);

// 3. Insert into student table
$sql = "INSERT INTO student (name, age, email, favorite_car, photo)
        VALUES ('$name', $age, '$email', '$car', '$photo')";
$result = mysqli_query($conn, $sql);

// 4. Show recent submitted data
if ($result) {
    echo "<div class='submitted-box'>";
    echo "<h3>✅ Your Recent Submitted Data:</h3>";
    echo "<strong>Name:</strong> $name<br>";
    echo "<strong>Age:</strong> $age<br>";
    echo "<strong>Email:</strong> $email<br>";
    echo "<strong>Car:</strong> $car<br>";
    echo "<strong>Photo:</strong><br><img src='uploads/$photo' width='200'>";
    echo "</div>";
} else {
    echo "<p class='text-danger'>❌ Error: " . mysqli_error($conn) . "</p>";
}

// 5. Show all students in grid
$sql1 = "SELECT * FROM student";
$result1 = mysqli_query($conn, $sql1);

echo "<h3>📋 All Submitted Students:</h3>";
echo "<div class='container'><div class='row'>";

$count = 0;
while ($row = mysqli_fetch_assoc($result1)) {
    echo "<div class='col-md-4'>";
    echo "<div class='student-card'>";
    echo "<b>Name:</b> " . $row['name'] . "<br>";
    echo "<b>Age:</b> " . $row['age'] . "<br>";
    echo "<b>Email:</b> " . $row['email'] . "<br>";
    echo "<b>Car:</b> " . $row['favorite_car'] . "<br>";
    
    if (!empty($row['photo'])) {
        echo "<img src='uploads/{$row['photo']}' width='100%'>";
    }
    echo "</div></div>";
}
echo "</div></div>";
?>
</body>
</html>
