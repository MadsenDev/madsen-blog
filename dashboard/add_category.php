<?php
// Database connection
require_once '../db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== "" ? mysqli_real_escape_string($conn, $_POST['parent_id']) : null;

    // Check if name is not empty
    if(!empty($name)) {
        // Prepare the SQL statement
        $query = "INSERT INTO categories (name, description, parent_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Check if parent_id is null
        if($parent_id === null) {
            $stmt->bind_param("sss", $name, $description, $parent_id);
        } else {
            $stmt->bind_param("ssi", $name, $description, $parent_id);
        }

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to manage_categories.php
            header("Location: manage_categories.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Name field must be filled out.";
    }
}
?>