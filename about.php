<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - SRS Testing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap + FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .about-section {
            padding: 60px 20px;
            background-color: #fff;
        }

        .about-section img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            opacity: 0.95;
        }

        .about-section h2 {
            font-weight: 700;
            color: #0d6efd;
        }

        .about-section p {
            font-size: 17px;
            margin-top: 10px;
            color: #444;
        }

        .card i {
            font-size: 40px;
            color: #0d6efd;
        }

        .card-title {
            font-weight: 600;
            margin-top: 10px;
        }

        .card-body {
            color: #555;
        }

        .lab-section {
            background-color: #e9f2ff;
            padding: 60px 20px;
        }

        .lab-section h2 {
            color: #0d6efd;
            margin-bottom: 20px;
        }

        .lab-section p {
            font-size: 16px;
            color: #333;
        }

        .lab-icons i {
            font-size: 35px;
            margin-right: 15px;
            color: #0d6efd;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>

<?php include '<includes>header.php'; ?>

<section class="about-section container">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <h2>About SRS Testing</h2>
            <p>
                At <strong>SRS Testing</strong>, we specialize in modern lab automation solutions, bringing innovation and accuracy to the testing industry.
                Our journey began with a mission to simplify testing processes through technology. Today, we proudly serve clients across industries
                with reliable tools, user-friendly systems, and expert support.
            </p>
            <small class="text-muted d-block mt-2">Building a smarter, faster, and safer future in testing.</small>
        </div>
        <div class="col-md-6 text-center">
            <img src="https://tse3.mm.bing.net/th/id/OIP.tyUe4Y5S2WBRB3s3tsIJqQHaFY?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Lab About Image">
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm p-3">
                <i class="fas fa-eye"></i>
                <h5 class="card-title mt-3">Our Vision</h5>
                <p class="card-body">
                    To become the global leader in lab automation and testing technology, empowering industries with smart solutions.
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm p-3">
                <i class="fas fa-bullseye"></i>
                <h5 class="card-title mt-3">Our Mission</h5>
                <p class="card-body">
                    Providing safe, efficient, and transparent testing systems that ensure accuracy, ease, and trust for all clients.
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm p-3">
                <i class="fas fa-people-group"></i>
                <h5 class="card-title mt-3">Our Team</h5>
                <p class="card-body">
                    A skilled and passionate team of engineers, developers, and analysts dedicated to excellence and innovation.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="lab-section">
    <div class="container">
        <h2 class="text-center">Our Laboratory</h2>
        <p class="text-center mb-5">
            Our high-tech lab is equipped with automated machinery and AI-powered systems to conduct reliable, fast, and precise tests.
            We follow strict safety standards and quality assurance protocols to meet international testing benchmarks.
        </p>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="lab-icons"><i class="fas fa-microscope"></i></div>
                <h5>Advanced Equipment</h5>
                <p>Equipped with modern testing tools and IoT-enabled machines to improve speed and precision.</p>
            </div>
            <div class="col-md-4">
                <div class="lab-icons"><i class="fas fa-shield-alt"></i></div>
                <h5>Safety & Standards</h5>
                <p>Strict safety protocols and ISO-certified processes for trustworthy outcomes.</p>
            </div>
            <div class="col-md-4">
                <div class="lab-icons"><i class="fas fa-flask"></i></div>
                <h5>R&D Focus</h5>
                <p>We continuously research and innovate to keep our testing solutions up to date with global trends.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
