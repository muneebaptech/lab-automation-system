

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Career | Lab Automation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    
  <style>
    body {
      background-color: #f8f9fa;
        font-family: Arial, sans-serif;
        color: #333;
    }
    .career-hero {
      padding: 50px 20px;
      color: black;
      text-align: center;
    }
    .job-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      background: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      transition: transform 0.2s ease-in-out;
    }
    .job-card:hover {
      transform: translateY(-5px);
    }
    .job-card h5 {
      color: #007bff;
    }
    .job-card p {
      margin: 0;
      color: #555;
    }
    .job-card a {
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
    }
    .job-card a:hover {
      text-decoration: underline;
    }

    .btn-success {
      background-color: #007bff;
      border: none;
      padding: 10px 20px;
      font-size: 14px;
      border-radius: 5px;
    }
    .btn-success:hover {
      background-color: #0056b3;
    }
    @media (max-width: 576px) {
      .career-hero {
        padding: 30px 10px;
      }
      .job-card {
        margin-bottom: 20px;
      }
    }
    .btn.btn-success.btn-sm {
      background-color: #007bff;
      border: none;
      padding: 5px 10px;
      font-size: 12px;
      border-radius: 5px;
      color: #bbb;
    }
    .btn.btn-success.btn-sm:hover {
      background-color: #0056b3;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
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
<div class="career-hero">
  <h1>Join Our Lab Automation Team</h1>
  <p>Innovate. Automate. Lead the future of lab testing.</p>
</div>

<div class="container my-5">
  <h3 class="mb-4">Current Job Openings</h3>

  <div class="row g-4">

    <!-- Job 1 -->
    <div class="col-md-6">
      <div class="job-card">
        <h5>Software Developer</h5>
        <p><strong>Location:</strong> Karachi</p>
        <p><strong>Experience:</strong> 1-2 years</p>
        <p>Join our development team and help build reliable lab automation tools.</p>
        <a href="mailto:careers@labautomation.com?subject=Job Application - Software Developer" class="btn btn-success btn-sm">Apply Now</a>
      </div>
    </div>

    <!-- Job 2 -->
    <div class="col-md-6">
      <div class="job-card">
        <h5>Quality Control Officer</h5>
        <p><strong>Location:</strong> Lahore</p>
        <p><strong>Experience:</strong> Fresh or 1 year</p>
        <p>Ensure our lab procedures meet the highest quality standards.</p>
        <a href="mailto:careers@labautomation.com?subject=Job Application - QC Officer" class="btn btn-success btn-sm">Apply Now</a>
      </div>
    </div>
    <!-- Job 3 -->
    <div class="col-md-6">
      <div class="job-card">
        <h5>Data Analyst</h5>
        <p><strong>Location:</strong> Islamabad</p>
        <p><strong>Experience:</strong> 2-3 years</p>
        <p>Analyze lab data to improve processes and outcomes.</p>
        <a href="mailto:careers@labautomation.com?subject=Job Application - Data Analyst" class="btn btn-success btn-sm">Apply Now</a>
      </div>
    </div>

    <!-- Job 4 -->
    <div class="col-md-6">
      <div class="job-card">
        <h5>Lab Technician</h5>
        <p><strong>Location:</strong> Multan</p>
        <p><strong>Experience:</strong> Fresh or 1 year</p>
        <p>Assist in daily lab operations and testing procedures.</p>
        <a href="mailto:careers@labautomation.com?subject=Job Application - Lab Technician" class="btn btn-success btn-sm">Apply Now</a>
      </div>
    </div>
    <!-- Job 5 -->
    <div class="col-md-6">
      <div class="job-card">
        <h5>Project Manager</h5>
        <p><strong>Location:</strong> Karachi</p>
        <p><strong>Experience:</strong> 3-5 years</p>
        <p>Lead projects to enhance our lab automation systems.</p>
        <a href="mailto:careers@labautomation.com?subject=Job Application - Project Manager" class="btn btn-success btn-sm">Apply Now</a>
      </div>
    </div>  
    <!-- Job 6 -->
    <!-- Add more jobs if needed -->
  </div>
</div>

<?php include 'includes/footer.php'; // Optional footer ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
