<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get total products
$productResult = $conn->query("SELECT COUNT(*) as total FROM products");
$totalProducts = $productResult->fetch_assoc()['total'];

// Get total tests completed
$testResult = $conn->query("SELECT COUNT(*) as total FROM testing");
$totalTests = $testResult->fetch_assoc()['total'];

// Get passed tests
$passResult = $conn->query("SELECT COUNT(*) as pass FROM testing WHERE status='Pass'");
$passCount = $passResult->fetch_assoc()['pass'];

// Calculate success rate
$successRate = $totalTests > 0 ? round(($passCount / $totalTests) * 100) : 0;

// Optional: Active sessions (you can make this dynamic later)
$activeSessions = 3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }

    header {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      padding: 20px 40px;
      z-index: 10;
      background-color: rgba(0, 0, 0, 0.3);
      color: #fff;
      backdrop-filter: blur(5px);
      display: flex;
    }

    header h1 {
      margin: 0;
      color: transparent;
    }

    .dashboard-container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
      animation: fadeInUp 1s ease-in-out;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-container h2 {
      font-size: 28px;
      margin-bottom: 30px;
      color: #2c3e50;
      text-align: center;
    }

    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }

    .card.stat {
      background-color: #e9f7ef;
      border-left: 6px solid #007bff;
      padding: 20px;
      border-radius: 10px;
      position: relative;
      transition: all 0.3s ease-in-out;
      transform: translateY(0);
    }

    .card.stat:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .card.stat h3 {
      font-size: 18px;
      margin-bottom: 10px;
      color: #2c3e50;
    }

    .card.stat .value {
      font-size: 32px;
      font-weight: bold;
      color: #1a1a1a;
    }

    .card.stat .icon {
      font-size: 24px;
      position: absolute;
      top: 20px;
      right: 20px;
      opacity: 0.2;
    }

    .card.stat .change {
      font-size: 14px;
      color: #007bff;
      margin-top: 8px;
    }

    .quick-actions {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
    }

    .card.action {
      display: flex;
      flex-direction: column;
      background-color: #fefefe;
      padding: 20px;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      text-decoration: none;
      color: inherit;
      transition: all 0.3s ease-in-out;
      align-items: center;
      text-align: center;
    }

    .card.action:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.08);
    }

    .card.action .icon {
      font-size: 30px;
      margin-bottom: 10px;
      color: #007bff;
    }

    .card.action h4 {
      margin: 10px 0 5px;
      font-size: 18px;
      color: #2c3e50;
    }

    .card.action p {
      font-size: 14px;
      color: #555;
      margin-bottom: 10px;
    }

    .card.action button {
      padding: 6px 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .card.action button:hover {
      background-color: #007bff;
    }

    .lab-automation-section {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin: 40px 0;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
      background: #eafaf1;
      border-radius: 12px;
    }

    .lab-text {
      flex: 1;
      min-width: 280px;
    }

    .lab-text h3 {
      font-size: 22px;
      color: #2c3e50;
      margin-bottom: 10px;
    }

    .lab-text p {
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    .lab-image {
      flex: 1;
      min-width: 280px;
      text-align: center;
    }

    .lab-image img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    nav a.nav-link:hover {
      background: none !important;
      color: inherit !important;
    }
   .hero-banner {
    position: relative;
    background: url('../assets/images/lab-banner.jpg') center center/cover no-repeat;
    height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    overflow: hidden;
}

.hero-banner .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* dark overlay */
    z-index: 1;
}

.hero-banner .hero-content {
    position: relative;
    z-index: 2;
}

.hero-banner h1,
.hero-banner p {
    color: #fff;
}

.hero-banner h1 {
    font-size: 48px;
    color: #fff;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
}

.hero-content p {
    font-size: 20px;
    color: #f0f0f0;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
}

.dropdown:hover .dropdown-menu {
    display: block;
  }
  .service-card {
  background: #f8f9fa;
  padding: 20px;
  border-radius: 12px;
  text-align: left;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.service-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}

.service-card .icon {
  font-size: 40px;
  color: #007bff;
}

.service-card .read-more {
  font-weight: 500;
  color: #007bff;
  text-decoration: none;
}

.service-card.featured {
  background-color: #007bff;
  color: #fff;
}

.service-card.featured .icon {
  color: #fff;
}
.service-card.active-card {
  transform: translateY(-8px);
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}
    .service-card.active-card .icon {
      color: #fff;
    }

    .service-card.active-card h5 {
      color: #fff;
    }

    .service-card.active-card p {
      color: #e8e8e8;
    }
    .hero-banner {
  margin-top: 15px;
}
 .section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 60px;
      max-width: 1200px;
      margin: auto;
    }
    .left {
      width: 50%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-template-rows: 1fr 1fr;
      gap: 10px;
      position: relative;
    }
    .left img {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }
    .experience-box {
      position: absolute;
      bottom: 30px;
      left: 200px;
      background-color: #007bff;
      color: #fff;
      padding: 20px 30px;
      border-radius: 10px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      margin-right: 80px;
    }
    .experience-box span {
      display: block;
      font-size: 16px;
      font-weight: normal;
      margin-top: 5px;
    }

    .right {
      width: 45%;
    }

    .right h2 {
      font-size: 32px;
      color: #0c3c89;
      margin-bottom: 20px;
    }

    .right p {
      font-size: 16px;
      color: #333;
      margin-bottom: 40px;
    }

    .counters {
      display: flex;
      justify-content: space-between;
    }

    .counter-box {
      width: 100px;
      height: 100px;
      background-color: #007bff;
      color: white;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-right: 10px;
    }

    .counter-box:last-child {
      margin-right: 0;
    }

    .counter-label {
      font-size: 12px;
      font-weight: normal;
      margin-top: 5px;
    }
    .lab-automation-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 40px;
      background-color: #f0f8ff;
      border-radius: 10px;
      margin-top: 40px;
    }
    .lab-text {
      flex: 1;
      min-width: 280px;
    }
  .counter-box {
  width: 200px;
  height: 150px;
  border-radius: 80%;
  background-color: #dc3545;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  font-weight: bold;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}
  .counter-box .icon {
    font-size: 40px;
    margin-bottom: 10px;
  }
    .lab-image {
      flex: 1;
      min-width: 280px;
      text-align: center;
    }

    .lab-image img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .hero-banner {
      margin-top: 0px;
    }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>
<!-- Banner Section -->
<div class="hero-banner text-center text-white position-relative fix d-top">
    <img src="https://blenderartists.org/uploads/default/optimized/4X/d/2/b/d2b7993e9c2ecd795b755c7ea4f2a22a2c755416_2_1024x576.png" class="w-100" style="height: 60vh; object-fit: cover;">
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5); z-index: 1;"></div>
    <div class="hero-content position-absolute top-50 start-50 translate-middle text-white" style="z-index: 2;">
        <h1 class="display-4 fw-bold">Lab Automation Started</h1>
        <p class="lead">Manage, Track, and Analyze Lab Operations Efficiently</p>
    </div>
</div>
<div class="section">
  <div class="left">
    <img src="https://th.bing.com/th/id/R.f7ce2ca93f684ef91d4604fea09eafbb?rik=jxEqLze1itJFaA&pid=ImgRaw&r=0" alt="Lab 1" id="lab1">
    <img src="https://tse1.mm.bing.net/th/id/OIP.EodN2p5YVsGVoGSMY2_Y6QHaEf?w=2000&h=1212&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Lab 2" id="lab2">
    <img src="https://tse2.mm.bing.net/th/id/OIP.jNSXFfk0jaTWYKPM-WbNmgHaE8?w=800&h=534&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Lab 3" id="lab3">
    <div class="experience-box" >
      25
      <span>Years Experience</span>
    </div>

  </div>
  <div class="right">
    <h2>Trusted Lab Experts and Latest Lab Technologies</h2>
    <p>
      Our team of experienced lab specialists is dedicated to delivering accurate and timely results using the latest innovations in laboratory science. From routine tests to complex diagnostics, we ensure precision and care at every step.
    </p>
    <div class="counters">
      <div class="counter-box">
        <div class="counter" data-target="9999">0</div>
        <div class="counter-label">Awards Winning</div>
      </div>
      <div class="counter-box" style="background-color: #5a92f2;">
        <div class="counter" data-target="9999">0</div>
        <div class="counter-label">Complete Cases</div>
      </div>
      <div class="counter-box" style="background-color: #003a8c;">
        <div class="counter" data-target="9999">0</div>
        <div class="counter-label">Happy Clients</div>
      </div>
    </div>
  </div>
</div>
<div class="dashboard-container">
  <h2>Manage your products and testing efficiently</h2>
  <div class="lab-automation-section">
    <div class="lab-text">
      <h3>What is Lab Automation?</h3>
      <p>
        Lab automation refers to the use of technology and equipment to automate laboratory tasks such as sample handling, data collection, testing, and analysis.
        It improves efficiency, accuracy, and productivity by minimizing manual interventions and reducing human error.
      </p>
    </div>
    <div class="lab-image">
      <img src="https://tse4.mm.bing.net/th/id/OIP.99L0F5yxjaDwnLubqyORXwHaE8?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Lab Automation Image">
    </div>
  </div>
  <div class="container py-5">
  <h2 class="text-center fw-bold mb-5">Laboratory Services</h2>
  <div class="row g-4">
    <!-- Card 1 -->
    <div class="col-md-3">
      <div class="service-card h-100">
        <div class="icon mb-3"><i class="bi bi-heart-pulse-fill"></i></div>
        <h5 class="fw-bold">Component Quality Assurance</h5>
        <p>We specialize in pathology tests that help detect various diseases with accurate and timely results.</p>
        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to view more details about this section.">Read More</button>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="col-md-3">
      <div class="service-card h-100">
        <div class="icon mb-3"><i class="bi bi-virus2"></i></div>
        <h5 class="fw-bold">Error Detection and Correction</h5>
        <p>Our microbiology tests identify bacterial, viral, and fungal infections with precision end is working.</p>
        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to view more details about this section.">Read More</button>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="col-md-3">
      <div class="service-card h-100 featured">
        <div class="icon mb-3"><i class="bi bi-droplet-half"></i></div>
        <h5 class="fw-bold text-white">Testing Under Extreme Conditions</h5>
        <p class="text-white">We analyze your body’s chemical processes to detect metabolic and endocrine disorders.</p>
        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to view more details about this section.">Read More</button>
      </div>
    </div>
    <!-- Card 4 -->
    <div class="col-md-3">
      <div class="service-card h-100">
        <div class="icon mb-3"><i class="bi bi-capsule"></i></div>
        <h5 class="fw-bold">Logic Testing</h5>
        <p>Histopathology tests help diagnose cancer and other conditions that require immediate attention to mucuh have end.</p>
        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to view more details about this section.">Read More</button>
      </div>
    </div>
  </div>
</div>

  <div class="stats">
    <div class="card stat">
      <h3>Total Products</h3>
      <p class="value"><?= $totalProducts ?></p>
      <span class="icon">📦</span>
      <p class="change">+12%</p>
    </div>
    <div class="card stat">
      <h3>Tests Completed</h3>
      <p class="value"><?= $totalTests ?></p>
      <span class="icon">🧪</span>
      <p class="change">+8%</p>
    </div>
    <div class="card stat">
      <h3>Success Rate</h3>
      <p class="value"><?= $successRate ?>%</p>
      <span class="icon">📈</span>
      <p class="change">+2%</p>
    </div>
    <div class="card stat">
      <h3>Active Sessions</h3>
      <p class="value"><?= $activeSessions ?></p>
      <span class="icon">💓</span>
      <p class="change">0%</p>
    </div>
  </div>

  <h3>Quick Actions</h3>
  <div class="quick-actions">
    <a href="products.php" class="card action">
      <span class="icon">📦</span>
      <h4>Your Products</h4>
      <p>Manage your product catalog</p>
      <button>View Products</button>
    </a>
    <a href="testing.php" class="card action">
      <span class="icon">🧪</span>
      <h4>Test History</h4>
      <p>Review test reports</p>
      <button>View Tests</button>
    </a>
    <a href="add_product.php" class="card action">
      <span class="icon">➕</span>
      <h4>Add Product</h4>
      <p>Register new product</p>
      <button>Add Product</button>
    </a>
    <a href="add_test.php" class="card action">
      <span class="icon">🆕</span>
      <h4>New Test</h4>
      <p>Start a new testing session</p>
      <button>Start Test</button>
    </a>
  </div>
</div>
<script>
  // Activate hover effect on click
  document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('click', function () {
      // Remove from all
      document.querySelectorAll('.service-card').forEach(c => c.classList.remove('active-card'));
      // Add to clicked
      this.classList.add('active-card');
    });
  });
</script>
<script>
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  tooltipTriggerList.forEach(t => new bootstrap.Tooltip(t))
</script>
<script>
  // Animate numbers
  const counters = document.querySelectorAll('.counter');
  counters.forEach(counter => {
    const updateCount = () => {
      const target = +counter.getAttribute('data-target');
      const count = +counter.innerText;
      const speed = 50; // smaller = faster
      const increment = Math.ceil(target / speed);

      if (count < target) {
        counter.innerText = count + increment;
        setTimeout(updateCount, 20);
      } else {
        counter.innerText = target;
      }
    };

    updateCount();
  });
</script>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
