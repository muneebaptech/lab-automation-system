<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'db.php'; 
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "tester";

    // Duplicate check
    $check = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        $message = "❗ Email or Username already exists.";
    } else {
        $sql = "INSERT INTO users (username, email, password, role) 
                VALUES ('$username', '$email', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php?success=1");
            exit();
        } else {
            $message = "❌ Error: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab Registration System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header, footer {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            background-color: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .register-container label {
            margin-top: 10px;
        }

        .register-container input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register-container button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .register-container button:hover {
            background-color: #0056b3;
        }

        .button-container {
            margin-top: 15px;
            text-align: center;
        }

        .button-container a {
            margin: 0 10px;
            color: #007bff;
            text-decoration: none;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .popup-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .popup-content p {
            font-size: 16px;
        }

        .close {
            float: right;
            font-size: 22px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <?php include 'includes/header.php'; ?>


    <div class="main-content">
        <div class="register-container">
            <h2>Register</h2>
            <form method="post" action="register.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Register</button>
            </form>

            <div class="button-container">
                <a href="login.php">Login</a> |
                <a href="index.php">Back to Home</a>
            </div>
        </div>
    </div>

    <?php if ($message): ?>
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <p><?= $message ?></p>
            </div>
        </div>
        <script>
            document.getElementById("popup").style.display = "block";

            function closePopup() {
                document.getElementById("popup").style.display = "none";
            }

            <?php if ($redirect): ?>
            setTimeout(function() {
                window.location.href = "index.php";
            }, 3000);
            <?php endif; ?>
        </script>
    <?php endif; ?>

    <?php include 'includes/footer.php'; ?>

    <script>
        window.onclick = function(event) {
            var popup = document.getElementById("popup");
            if (event.target == popup) {
                popup.style.display = "none";
            }
        }
    </script>
</body>
</html>
