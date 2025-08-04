<?php
session_start();
include 'db.php'; // Make sure this file connects to your database
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $product_id = $_POST['product_id'];
    $test_type = $_POST['test_type'];
    $test_date = $_POST['test_date'];
    $tester_name = $_POST['tester_name'];
    $test_result = $_POST['test_result'];
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];

    // SQL Insert Query
    $sql = "INSERT INTO testing (product_id, test_type, test_date, tester_name, test_result, remarks, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $product_id, $test_type, $test_date, $tester_name, $test_result, $remarks, $status);

    // Execute
    if ($stmt->execute()) {
        echo "<script>alert('Test added successfully!'); window.location.href='testing.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>




<!-- Form UI -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="add_test.css">
    <style>
        body {
            background: #f1f1f1;
        }
        .form-container {
            max-width: 850px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .dropdown:hover .dropdown-menu {
    display: block;
  }
        .form-container h2 {
            color: #0056b3;
            font-weight: bold;
        }
        .form-container input, .form-container select, .form-container textarea {
            border-radius: 12px;
            margin-bottom: 15px;
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="form-container">
        <h2 class="mb-4">🧪 Add New Lab Test</h2>
       <form method="POST" action="add_test.php">
    <input type="text" name="product_id" placeholder="Product ID" required><br>
    <input type="text" name="test_type" placeholder="Test Type" required><br>
    <input type="date" name="test_date" required><br>
    <input type="text" name="tester_name" placeholder="Tester Name" required><br>
    <input type="text" name="test_result" placeholder="Test Result" required><br>
    <textarea name="remarks" placeholder="Remarks" required></textarea><br>
    <select name="status" required>
        <option value="Pending">Pending</option>
        <option value="Passed">Passed</option>
        <option value="Failed">Failed</option>
    </select><br>
    <input type="submit" value="Submit Test">
</form>

        <div class="text-center mt-4">
            <a href="testing.php" class="btn btn-secondary">Back to Test History</a>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="testing.php" class="btn btn-secondary">Back to Testing</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'includes/footer.php'; ?>
</body>
</html>