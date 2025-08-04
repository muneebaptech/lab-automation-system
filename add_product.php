<?php
session_start();
include 'db.php';
// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $revise = $_POST['revise'];
    $manufacture_date = $_POST['manufacture_date'];
    $user_id = $_SESSION['user_id'];
    $image_path = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image_path = $targetPath;
        } else {
            echo "❌ Failed to upload image.";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO products (product_id, product_name, revise, manufacture_date, image_path, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $product_id, $product_name, $revise, $manufacture_date, $image_path, $user_id);

    if ($stmt->execute()) {
        echo "success";
        exit();
    } else {
        echo "❌ Database insert failed: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="add_product.css">
  <style>
    body {
      background: #f4f7fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .form-box {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: 50px auto;
    }
    .btn-success {
      background-color: #007bff;
      border: none;
    }
    .btn-success:hover {
      background-color: #007bff;
    }
    .return-button, .action-button {
      padding: 10px 20px;
      font-size: 14px;
    }
    #popup-message {
      display: none;
      text-align: center;
      margin-bottom: 20px;
      padding: 10px;
      border-radius: 5px;
      font-weight: bold;
    }
    .alert-success {
      background-color: #d4edda;
      color: #007bff;
    }
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
    }
    .dropdown:hover .dropdown-menu {
    display: block;
  }
    .dropdown-menu {
      margin-top: 0;
    }
    #blue {
      background-color: #007bff;
      color: white;
    }
    #blue:hover {
      background-color: #0056b3;
    }
    
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
  <div id="popup-message" class="alert"></div>

  <div class="form-box">
    <h3 class="text-center mb-4">➕ Add New Product</h3>
    <form id="product-form" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="product_id" class="form-label">Product ID</label>
        <input type="text" id="product_id" name="product_id" class="form-control" value="<?= strtoupper(substr(md5(time()), 0, 12)) ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" id="product_name" name="product_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="revise" class="form-label">Revision</label>
        <input type="number" id="revise" name="revise" class="form-control" min="1" required>
      </div>
      <div class="mb-3">
        <label for="manufacture_date" class="form-label">Manufacture Date</label>
        <input type="date" id="manufacture_date" name="manufacture_date" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-success w-100" id="blue">Add Product</button>
    </form>
  </div>

  <div class="d-flex justify-content-between mt-4">
    <a href="index.php" class="btn btn-outline-primary return-button">← Back to Index</a>
    <a href="add_test.php" class="btn btn-outline-dark action-button">Add New Test</a>
  </div>
</div>

<script>
document.getElementById('product-form').addEventListener('submit', function(event) {
  event.preventDefault();
  var form = this;
  var formData = new FormData(form);

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'add_product.php', true);

  xhr.onload = function() {
    var popup = document.getElementById('popup-message');
    if (xhr.status === 200 && xhr.responseText.trim() === "success") {
      popup.textContent = "✅ Product added successfully!";
      popup.className = "alert alert-success";
      popup.style.display = "block";
      form.reset();
      setTimeout(() => {
        popup.style.display = "none";
        window.location.href = "products.php";
      }, 2000);
    } else {
      popup.textContent = "❌ Error: " + xhr.responseText;
      popup.className = "alert alert-danger";
      popup.style.display = "block";
    }
  };
  xhr.onerror = function () {
    alert("❌ AJAX request failed.");
  };
  xhr.send(formData);
});
</script>
<footer class="bg-dark text-light text-center py-4 mt-5">
  <div class="container">
    <p class="mb-1">&copy; <?= date("Y") ?> Lab Automation System. All rights reserved.</p>
    <small>Designed by M E M O N I R</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
