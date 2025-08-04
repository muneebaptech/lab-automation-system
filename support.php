<?php
include 'db.php'; // Your database connection

$success = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO support_queries (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success = "Your message has been submitted successfully!";
        } else {
            $success = "Error submitting your message.";
        }
    } else {
        $success = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Support | Lab Automation</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <style>
        body {
        background-color: #f5f8fa;
        font-family: 'Segoe UI', sans-serif;
        }
        h2 {
        color: #198754;
        font-weight: bold;
        }
        .form-control, .btn {
        border-radius: 12px;
        }
        footer {
        background: #198754;
        color: white;
        padding: 20px 0;
        text-align: center;
        }
        .form-label {
        font-weight: bold;
        }   
        .container {
        max-width: 600px;
        margin: auto;
        }
        .bg-white {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .dropdown:hover .dropdown-menu {
    display: block;
  }
        .dropdown-menu {
            margin-top: 0;
        }
        
    </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="support.css">
  <?php
  // Include your header file if needed
    include 'includes/header.php'; // Assuming you have a header.php file for the header
    ?>
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4 text-success fw-bold">Support</h2>
    <p class="mb-4">Facing issues or need help? Contact us below and our team will get back to you shortly.</p>

    <?php if ($success): ?>
      <div class="alert alert-info"><?= $success ?></div>
    <?php endif; ?>

    <form method="post" class="bg-white p-4 rounded shadow-sm">
      <div class="mb-3">
        <label class="form-label">Your Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Your Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea name="message" class="form-control" rows="5" required></textarea>
      </div>

      <button type="submit" class="btn btn-success">Send Message</button>
    </form>
  </div>
  <?php include 'includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
