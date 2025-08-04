<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SRS Testing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 130px; /* Adjusted for both bars */
      transition: background-color 0.3s, color 0.3s;
    }

    /* TOP INFO BAR */
    .top-bar {
      z-index: 1040;
    }

    .top-bar a {
      font-size: 14px;
    }

    .navbar {
      z-index: 1030;
      box-shadow: none;
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

    .nav-link.btn::after {
      content: "";
      position: absolute;
      width: 0%;
      height: 2px;
      left: 0;
      bottom: -3px;
      background-color: #007bff;
      transition: width 0.3s ease;
    }

    .nav-link.btn:hover::after {
      width: 100%;
    }

    .dropdown-menu {
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .dropdown-item:hover {
      background-color: #f1f1f1;
    }

    /* DARK MODE */
    body.dark-mode {
      background-color: #007bff;
      color: #f8f9fa;
    }

    body.dark-mode .navbar {
      background-color: #2c2c2c !important;
    }

    body.dark-mode .nav-link.btn {
      background-color: #3a3a3a;
      color: #ffffff;
    }

    body.dark-mode .nav-link.btn:hover {
      background-color: #4a4a4a;
    }

    body.dark-mode .nav-link.btn::after {
      background-color: #ffffff;
    }

    body.dark-mode .dropdown-menu {
      background-color: #333;
    }

    body.dark-mode .dropdown-item {
      color: #fff;
    }

    body.dark-mode .dropdown-item:hover {
      background-color: #444;
    }

    body.dark-mode .btn-outline-light {
      color: #fff;
      border-color: #ccc;
    }

    body.dark-mode .btn-outline-light:hover {
      background-color: #333;
    }
    body.dark-mode .top-bar {
      background-color: #2c2c2c;
      color: #f8f9fa;
    }
    .dropdown-menu {
      margin-top: 0;
    }
   
  </style>
</head>
<body>

<!-- ✅ TOP BAR -->
<div class="top-bar bg-white text-secondary py-2 border-bottom fixed-top">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center small">
    <div class="mb-2 mb-md-0">
      <span class="me-3"><i class="fa-solid fa-location-dot me-1"></i>123 Street, New York, USA</span>
      <span><i class="fa-solid fa-clock me-1"></i>Mon-Sat 09am-5pm, Sun Closed</span>
    </div>
    <div>
      /
      <a href="career.php" class="text-secondary text-decoration-none me-3">Career</a>
      /
      <a href="support.php" class="text-secondary text-decoration-none me-3">Support</a>
      /
      <a href="faqs.php" class="text-secondary text-decoration-none">FAQs</a>
    </div>
  </div>
</div>

<!-- ✅ NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary px-3 fixed-top mt-5" style="z-index: 1030;">
  <a class="navbar-brand" href="index.php"> <span class="text-white">Lab </span>Automation</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link text-white" href="index.php">Home</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Products
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="add_product.php">Add Product</a></li>
          <li><a class="dropdown-item" href="search.php">Search Product and Testing</a></li>
          
        
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="testDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Tests
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="add_test.php">Add Test</a></li>
          <li><a class="dropdown-item" href="testing.php">Test History</a></li>
        </ul>
      </li>
      

      <li class="nav-item">
        <a class="nav-link text-white" href="contact.php">Contact</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn btn-success text-black mx-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="darkway">
          User
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="index.php">Profile</a></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>

    </ul>
  </div>
</nav>


<!-- DARK MODE SCRIPT -->
<script>
  document.getElementById('darkToggle').addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
    if (document.body.classList.contains('dark-mode')) {
      localStorage.setItem('theme', 'dark');
      this.innerHTML = '☀️ Light Mode';
    } else {
      localStorage.setItem('theme', 'light');
      this.innerHTML = '🌙 Dark Mode';
    }
  });

  window.onload = function () {
    if (localStorage.getItem('theme') === 'dark') {
      document.body.classList.add('dark-mode');
      document.getElementById('darkToggle').innerHTML = '☀️ Light Mode';
    }
  };
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
