<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srs_testing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$status = isset($_GET['status']) ? trim($_GET['status']) : '';

$sql = "SELECT * FROM products WHERE (product_name LIKE ? OR product_id LIKE ?)";
if ($status) {
    $sql .= " AND status = ?";
}

$stmt = $conn->prepare($sql);
$searchQuery1 = "%$query%";
$searchQuery2 = "%$query%";

if ($status) {
    $stmt->bind_param('sss', $searchQuery1, $searchQuery2, $status);
} else {
    $stmt->bind_param('ss', $searchQuery1, $searchQuery2);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p class='message'>No results found.</p>";
    echo "<p class='message'>Please try a different search.</p>";
    echo "<p class='message'>You can also check the <a href='testing.php'>Testing Page</a> for more details.</p>";
} else {
    echo "<table class='table table-bordered'>
        <thead>
            <tr>
                <th>Test ID</th>
                <th>Product ID</th>
                <th>Test Type</th>
                <th>Test Date</th>
                <th>Tester Name</th>
                <th>Test Result</th>
                <th>Remarks</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row['test_id']."</td>
            <td>".$row['product_id']."</td>
            <td>".$row['test_type']."</td>
            <td>".$row['test_date']."</td>
            <td>".$row['tester_name']."</td>
            <td>".$row['test_result']."</td>
            <td>".$row['remarks']."</td>
            <td>".$row['status']."</td>
        </tr>";
    }

    echo "</tbody></table>";
}

$conn->close();
?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>