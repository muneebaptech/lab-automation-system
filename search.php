<?php
include 'db.php';
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$search = "%" . $query . "%";

// Search products
$product_stmt = $conn->prepare("SELECT * FROM products WHERE product_id LIKE ? OR product_name LIKE ?");
$product_stmt->bind_param("ss", $search, $search);
$product_stmt->execute();
$product_result = $product_stmt->get_result();

// Search lab tests
$test_stmt = $conn->prepare("SELECT * FROM testing WHERE product_id LIKE ? OR tester_name LIKE ? OR test_result LIKE ? OR status LIKE ?");
$test_stmt->bind_param("ssss", $search, $search, $search, $search);
$test_stmt->execute();
$test_result = $test_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Products & Lab Tests</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f7fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .container {
      max-width: 1100px;
    }

    h4 {
      margin-top: 40px;
      font-weight: bold;
      color: #004085;
    }

    .search-box {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .table thead {
      background-color: #003366;
      color: white;
    }

    .table img {
      border-radius: 5px;
    }

    .no-results {
      text-align: center;
      color: #a94442;
      font-weight: bold;
      padding: 10px;
    }

    .search-header {
      font-size: 24px;
      font-weight: 600;
      color: #222;
    }

    .btn-primary {
      background-color: #0069d9;
      border: none;
    }

    .btn-primary:hover {
      background-color: #004a9f;
    }

    @media (max-width: 768px) {
      .form-control {
        width: 100% !important;
      }
    }
    .dropdown:hover .dropdown-menu {
    display: block;
  }
    .dropdown-menu {
      margin-top: 0;
    }
  
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container mt-5">
  <div class="search-box">
    <form method="GET" class="d-flex flex-wrap gap-2">
      <input type="text" name="query" class="form-control flex-grow-1" placeholder="Search by product name, ID, tester name, result, etc..." value="<?= htmlspecialchars($query) ?>" required>
      <button type="submit" class="btn btn-primary px-4">Search</button>
    </form>
  </div>

  <!-- 🔧 Products Section -->
  <h4 class="mt-5">🔧 Matching Products</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-hover mt-3">
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Revision</th>
          <th>Manufacture Date</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($product_result->num_rows > 0): ?>
          <?php while ($p = $product_result->fetch_assoc()): ?>
            <tr>
              <td><?= $p['product_id'] ?></td>
              <td><?= $p['product_name'] ?></td>
              <td><?= $p['revise'] ?></td>
              <td><?= $p['manufacture_date'] ?></td>
              <td>
                <?php if (!empty($p['image_path'])): ?>
                  <img src="<?= $p['image_path'] ?>" width="60">
                <?php else: ?>
                  <span class="text-muted">No image</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5" class="no-results">No matching products found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- 🧪 Lab Tests Section -->
  <h4 class="mt-5">🧪 Matching Lab Tests</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-hover mt-3">
      <thead>
        <tr>
          <th>Test ID</th>
          <th>Product ID</th>
          <th>Test Type</th>
          <th>Date</th>
          <th>Tester</th>
          <th>Result</th>
          <th>Remarks</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($test_result->num_rows > 0): ?>
          <?php while ($t = $test_result->fetch_assoc()): ?>
            <tr>
              <td><?= $t['test_id'] ?></td>
              <td><?= $t['product_id'] ?></td>
              <td><?= $t['test_type'] ?></td>
              <td><?= $t['test_date'] ?></td>
              <td><?= $t['tester_name'] ?></td>
              <td><?= $t['test_result'] ?></td>
              <td><?= $t['remarks'] ?></td>
              <td><?= $t['STATUS'] ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="8" class="no-results">No matching lab tests found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

        <div class="dropdown me-2 mb-2">
          <a class="nav-link btn btn-success text-black dropdown-toggle" href="#" data-bs-toggle="dropdown"
          aria-expanded="false">
            User
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php">Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</nav>
</body>
</html>