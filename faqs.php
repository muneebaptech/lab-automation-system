

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FAQs | Lab Automation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

  </head>
  <style>
    body {
      background-color: #f5f8fa;
    }
    .faq-hero {
      
      color: black;
      padding: 50px 20px;
      text-align: center;
    }
    .accordion-button:not(.collapsed) {
      background-color: #e9f5ff;
      color: #0d6efd;
    }
    .dropdown-menu .dropdown-hover {
      background-color: #f8f9fa;
    }

    .accordion-item {
      margin-bottom: 15px;
    }
    .accordion-header {
      background-color: #f1f1f1;
      border-radius: 5px;
    }
    .accordion-button {
      font-weight: bold;
      color: #333;
    }
    .accordion-body {
      background-color: #ffffff;
      border-radius: 5px;
      padding: 15px;
    }
    .accordion-button:focus {
      box-shadow: none;
    }
    .accordion-button:not(.collapsed) {
      background-color: #e9f5ff;
      color: #0d6efd;
    }
    .accordion-button:hover {
      background-color: #d1e7ff;
    }
    .accordion-item .accordion-header {
      border-bottom: 1px solid #dee2e6;
    }
    .accordion-item:last-child .accordion-header {
      border-bottom: none;
    }
    .accordion-item .accordion-body {
      border: 1px solid #dee2e6;
      border-radius: 0 0 5px 5px;
    }
    .dropdown-menu .dropdown-hover {
      display: block;
    }
    .dropdown-menu {
      margin-top: 0;
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
<div class="faq-hero">
  <h1>Frequently Asked Questions</h1>
  <p>Find answers to common queries about our lab automation system.</p>
</div>

<div class="container my-5">
  <div class="accordion" id="faqAccordion">

    <!-- FAQ 1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
          What is the Lab Automation System?
        </button>
      </h2>
      <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Our Lab Automation System helps manage product testing, quality control, and test history in a streamlined digital format.
        </div>
      </div>
    </div>

    <!-- FAQ 2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq2">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
          How do I register and log in?
        </button>
      </h2>
      <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Visit our homepage and click "Register" to create an account. After registration, you can log in using your credentials.
        </div>
      </div>
    </div>

    <!-- FAQ 3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq3">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
          Can I edit or delete test records?
        </button>
      </h2>
      <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Only authorized users (admins) can edit or delete test records. If you need help, contact the system administrator.
        </div>
      </div>
    </div>

    <!-- FAQ 4 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq4">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
          How is my data secured?
        </button>
      </h2>
      <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Your data is stored in a secured database with access control. We follow standard security protocols to keep it safe.
        </div>
      </div>
    </div>

    <!-- Add more FAQs as needed -->

  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
