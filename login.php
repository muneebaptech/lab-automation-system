<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            header("Location: index.php"); // Redirect to dashboard
            exit();
        } else {
            $error = "❌ Invalid password";
        }
    } else {
        $error = "❌ Email not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Lab System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

     

    <style>
        body {
            background-color: #f2f5f7;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-box {
            max-width: 400px;
            margin: auto;
            margin-top: 60px;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 500;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .register-btn {
            margin-top: 15px;
            text-align: center;
        }

        .register-btn a {
            display: inline-block;
            background-color: #17a2b8;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        .register-btn a:hover {
            background-color: #138496;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 12px;
            margin-top: auto;
        }
        .dropdown:hover .dropdown-menu {
    display: block;
  }

        .dropdown-menu {
            margin-top: 0;
        }
        .nav-link {
            color: #fff !important;
        }
        .nav-link:hover {
            color: #ddd !important;
        }
        .nav-item:hover {
            background-color: #343a40;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="hero-banner text-center text-white position-relative fix d-top">
    <img src="https://blenderartists.org/uploads/default/optimized/4X/d/2/b/d2b7993e9c2ecd795b755c7ea4f2a22a2c755416_2_1024x576.png" class="w-100" style="height: 60vh; object-fit: cover;">
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5); z-index: 1;"></div>
    <div class="hero-content position-absolute top-50 start-50 translate-middle text-white" style="z-index: 2;">
        <h1 class="display-4 fw-bold">Lab Automation Started</h1>
        <p class="lead">Manage, Track, and Analyze Lab Operations Efficiently</p>
    </div>
</div>

    <div class="container">
        <div class="login-box">
            <h3 class="text-center mb-4">Login to Your Account</h3>

            <?php if (isset($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="register-btn mt-3">
                <a href="register.php"><i class="fas fa-user-plus me-2"></i>Don't have an account? Register</a>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
