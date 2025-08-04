<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $success = "✔ Message sent successfully!";
    } else {
        $error = "❌ Failed to send message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
        }
        .hero {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .hero img {
            width: 100%;
            border-radius: 8px;
        }
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }
        .contact-form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        #address-link, #phone-link, #email-link {
            text-decoration: none;
            color: black;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        #address-link:hover, #phone-link:hover, #email-link:hover {
            color: #007bff;
            text-decoration: underline;
        }
        .card {
            transition: transform 0.3s;
        }
        .dropdown-menu.dropdown-hover{
            display: block;
        }
        .header-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
      <div class="row align-items-center">
        <!-- Left side text -->
        <div class="col-md-6">
            <h1 class="display-5 fw-bold">Let’s Connect — We’re Here to Help!</h1>
            <p class="lead mt-3">
                Have a question, feedback, or need support? Our team is just a message away. Whether you're looking to collaborate, inquire about our services, or simply want to get in touch — we value your time and promise to respond promptly. Let’s start a conversation!
            </p>
        </div>

        <!-- Right side image with caption -->
        <div class="col-md-6 text-center">
            <img src="https://cdn.pixabay.com/photo/2016/01/21/19/32/contact-1154550_1280.png" alt="Contact Illustration" class="img-fluid" style="max-height: 350px;">
            <p class="mt-3">We usually respond within 24 hours!</p>
        </div>
    </div>
</div>

       <!-- Contact Form Section -->
   <!-- Contact Section Two Columns -->

    <!-- Left: Contact Form -->


    <!-- Right: Location or Info -->
<!-- Two-column layout: Left - Contact Info Cards, Right - Map -->
<div class="container mt-5">
    <div class="row">
        <!-- Left: Map / Visit Us -->
        <div class="col-md-6">
            <div class="contact-form d-flex flex-column justify-content-center align-items-center h-100 p-4 shadow-sm bg-white rounded">
                <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                <h5 class="mb-2">Visit Us</h5>
                <p class="text-muted small mb-3">Indus Hospital, Karachi, Pakistan</p>
                <iframe src="https://maps.google.com/maps?q=indus%20hospital%20karachi&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                        width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>

        <!-- Right: Contact Info beside map -->
        <div class="col-md-6 d-flex flex-column justify-content-between">
            <div class="card mb-3 shadow-sm p-3 d-flex flex-row align-items-center">
                <i class="fas fa-map-marker-alt fa-lg text-primary me-3"></i>
                <div>
                    <h6 class="mb-0">Our Address</h6>
                    <a href="https://indushospital.org.pk/" id="address-link" class="text-muted small d-block">Karachi, Pakistan</a>
                </div>
            </div>

            <div class="card mb-3 shadow-sm p-3 d-flex flex-row align-items-center">
                <i class="fas fa-phone fa-lg text-success me-3"></i>
                <div>
                    <h6 class="mb-0">Call Us</h6>
                    <a href="tel:03260185998" id="phone-link" class="text-muted small d-block">0326 0185998</a>
                </div>
            </div>

            <div class="card mb-3 shadow-sm p-3 d-flex flex-row align-items-center">
                <i class="fas fa-envelope fa-lg text-danger me-3"></i>
                <div>
                    <h6 class="mb-0">Email Support</h6>
                    <a href="mailto:muneebaptech70@gmail.com" id="email-link" class="text-muted small d-block">muneebaptech70@gmail.com</a>
                </div>
            </div>
        </div>
    </div>
</div>


<p class="text-center mt-5">
    <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
</p> 
<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>
