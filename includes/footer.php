<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Updated Footer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 70px;
      transition: background-color 0.3s, color 0.3s;
    }

    .navbar {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      transition: background-color 0.3s ease;
    }

    .navbar-brand {
      font-size: 26px;
      font-weight: 600;
    }

    .nav-link.btn {
      margin: 5px 7px;
      padding: 6px 14px;
      font-size: 15px;
      border-radius: 6px;
      transition: all 0.3s ease;
      position: relative;
      color: black;
    }
.footer {
  background-color: #343a40;
  color: #f8f9fa;
  padding: 40px 0;
}
.footer-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 20px;
}
.footer-link {
  color: #adb5bd;
  text-decoration: none;
  display: inline-block;
  position: relative;
  padding-bottom: 3px;
  transition: all 0.3s ease;
}
.footer-link::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 0%;
  height: 2px;
  background-color: #ffffff;
  transition: width 0.3s ease;
}
.footer-link:hover {
  color: #ffffff;
}
.footer-link:hover::after {
  width: 100%;
}
.footer-bottom {
  border-top: 1px solid #495057;
  margin-top: 30px;
  padding-top: 15px;
  font-size: 14px;
  color: #ced4da;
  text-align: center;
}
.social-icons a {
  color: #adb5bd;
  font-size: 20px;
  margin-right: 15px;
  transition: color 0.3s ease;
}
.social-icons a:hover {
  color: #ffffff;
}
.footer p {
  font-size: 15px;
}
</style>

  </style>
</head>
<body>

<!-- Footer Section -->
<!-- footer.php -->
<!-- footer.php -->
<footer class="footer mt-5">
  <div class="container">
    <div class="row text-center text-md-start">
      
      <!-- Main Menu -->
      <div class="col-md-3 mb-4">
        <h5 class="footer-title">Main Menu</h5>
        <ul class="list-unstyled">
          <li><a class="footer-link" href="index.php">Home</a></li>
          <li><a class="footer-link" href="products.php">Your Products</a></li>
          <li><a class="footer-link" href="testing.php">Your Test History</a></li>
          <li><a class="footer-link" href="add_product.php">Add Product</a></li>
          <li><a class="footer-link" href="add_test.php">Add Test</a></li>
        </ul>
      </div>

      <!-- Info -->
      <div class="col-md-3 mb-4">
        <h5 class="footer-title">Info</h5>
        <ul class="list-unstyled">
          <li><a class="footer-link" href="search.php">Search</a></li>
          <li><a class="footer-link" href="about.php">About Us</a></li>
          <li><a class="footer-link" href="contact.php">Contact Us</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-md-3 mb-4">
        <h5 class="footer-title">Get in Touch</h5>
        <p class="mb-1">📧 support@srstesting.com</p>
        <p class="mb-1">📞 +92 300 1234567</p>
        <p>📍 Karachi, Pakistan</p>
      </div>

      <!-- About / Social -->
      <div class="col-md-3 mb-4">
        <h5 class="footer-title">Lab Information</h5>
        <p class="mb-2">
          SRS Lab Testing System is committed to providing fast, reliable, and automated lab testing results.
        </p>
        <div class="social-icons">
          <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
          <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

    </div>

    <!-- Bottom Footer -->
    <div class="footer-bottom mt-4">
      &copy; <?= date("Y"); ?> SRS Testing System. All rights reserved.
    </div>
  </div>
</footer>


<!-- External Scripts (Only if not already included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
