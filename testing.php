<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Fetch test history from the testing table
$sql = "SELECT * FROM testing ORDER BY test_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            padding-top: 80px; /* space for fixed header */
        }

        h2 {
            color: #007bff;
            font-weight: bold;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .btn {
            margin: 5px;
        }

        footer {
            background: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
        .dropdown:hover .dropdown-menu {
    display: block;
  }
        .dropdown-menu {
            margin-top: 0;
        }
        .table img {
            max-width: 100px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h2 class="mb-4 text-center">Test History</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Test ID</th>
                        <th>Product ID</th>
                        <th>Test Type</th>
                        <th>Test Date</th>
                        <th>Tester Name</th>
                        <th>Test Result</th>
                        <th>Remarks</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['test_id']}</td>
                                <td>{$row['product_id']}</td>
                                <td>{$row['test_type']}</td>
                                <td>{$row['test_date']}</td>
                                <td>{$row['tester_name']}</td>
                                <td>{$row['test_result']}</td>
                                <td>{$row['remarks']}</td>
                                <td>{$row['STATUS']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No test history found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="add_test.php" class="btn btn-success"><i class="fas fa-plus"></i> Add New Test</a>
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-home"></i> Back to Dashboard</a>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


