<?php
session_start();

// Redirect to login if not logged in

include 'db.php';

$user_id = $_SESSION['user_id'];

$products = [];
$sql = "SELECT * FROM products WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="products.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f8;
        margin: 0;
        padding: 0;
    }

    header, footer {
        background-color: #343a40;
        color: white;
        padding: 10px 20px;
        text-align: center;
    }

    h1 {
        color: #007bff;
        text-align: center;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .container {
        max-width: 950px;
        margin: 30px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .button {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        text-align: center;
        transition: background-color 0.3s ease;
        margin: 10px 5px 20px 5px;
    }

    .button:hover {
        background-color: #0056b3;
    }

    .product-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .product-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        background: #fafafa;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 15px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .product-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .product-item img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 20px;
        border: 2px solid #ddd;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-details strong {
        display: inline-block;
        color: #333;
        font-weight: 600;
        margin-right: 5px;
    }

    .product-details div {
        margin-bottom: 6px;
        color: #555;
    }

    p {
        text-align: center;
        font-size: 16px;
        color: #777;
        margin-top: 20px;
    }

    @media (max-width: 600px) {
        .product-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-item img {
            margin-bottom: 15px;
            margin-right: 0;
        }
    }
    header, footer {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 7px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
</style>



</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Your Products</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <?php if (count($products) > 0): ?>
           <ul class="product-list">
    <?php foreach ($products as $product): ?>
       <li class="product-item">
    <?php if (!empty($product['image_path'])): ?>
        <img src="<?php echo htmlspecialchars($product['image_path']); ?>">
    <?php endif; ?>

    <div class="product-details">
        <div><strong>Product ID:</strong> <?= htmlspecialchars($product['product_id']) ?></div>
        <div><strong>Product Name:</strong> <?= htmlspecialchars($product['product_name']) ?></div>
        <div><strong>Revise:</strong> <?= htmlspecialchars($product['revise']) ?></div>
        <div><strong>Manufacture Date:</strong> <?= htmlspecialchars($product['manufacture_date']) ?></div>
    </div>
</li>

    <?php endforeach; ?>
</ul>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>

        <a href="index.php" class="button">Back to Dashboard</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
