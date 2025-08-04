<?php
session_start();
header("location: insert_test.php"); // Redirect to the form page if accessed directly

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srs_testing";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = trim($_POST['product_id']);
    $test_type = trim($_POST['test_type']);
    $test_date = trim($_POST['test_date']);
    $tester_name = trim($_POST['tester_name']);
    $test_result = trim($_POST['test_result']);
    $remarks = trim($_POST['remarks']);
    $status = trim($_POST['status']);
    $user_id = $_SESSION['user_id'] ?? 'admin'; // fallback if session not set

    // ✅ Generate a 12-digit unique test ID (example logic)
    $test_code = strtoupper(substr($test_type, 0, 3));
    $random_number = rand(1000, 9999);
    $test_id = substr($product_id, 0, 6) . $test_code . $random_number;

    $stmt = $conn->prepare("INSERT INTO testing (test_id, product_id, test_type, test_date, tester_name, test_result, remarks, status, user_id) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssss", $test_id, $product_id, $test_type, $test_date, $tester_name, $test_result, $remarks, $status, $user_id);

    if ($stmt->execute()) {
        $message = "✅ New test added successfully with Test ID: <strong>$test_id</strong>";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!-- ✅ HTML Section Starts Here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Test</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-4">
        <h2>Add New Test Record</h2>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form action="insert_test.php" method="POST">
            <div class="mb-3">
                <label for="product_id" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="product_id" name="product_id" required>
            </div>
            <div class="mb-3">
                <label for="test_type" class="form-label">Test Type</label>
                <input type="text" class="form-control" id="test_type" name="test_type" required>
            </div>
            <div class="mb-3">
                <label for="test_date" class="form-label">Test Date</label>
                <input type="date" class="form-control" id="test_date" name="test_date" required>
            </div>
            <div class="mb-3">
                <label for="tester_name" class="form-label">Tester Name</label>
                <input type="text" class="form-control" id="tester_name" name="tester_name" required>
            </div>
            <div class="mb-3">
                <label for="test_result" class="form-label">Test Result</label>
                <select class="form-select" id="test_result" name="test_result" required>
                    <option value="pass">Pass</option>
                    <option value="fail">Fail</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Test</button>
            <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
            <a href="search.php" class="btn btn-info">Search Records</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
